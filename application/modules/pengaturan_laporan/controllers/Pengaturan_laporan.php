<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Pengaturan_laporan extends MX_Controller {
		

		function __construct()
		{
			parent::__construct();

	        $this->functions->check_session();
	        $this->functions->check_access($this->uri->segment(1));

	        $this->load->model('m_pengaturan_laporan');

	        $this->load->library('Datatables');
	        $this->load->library('table');
		}	

		function index()
		{
			$d['page_title']	= 'Pengaturan Laporan';
			$d['menus']			= $this->functions->generate_menu();
			
			$d['priv']			= $this->functions->check_priv2($this->uri->segment(1));

			$privileges			= explode(',',$d['priv']['privileges']);

			//set table id in table open tag
	        $tmpl = array('table_open' => '<table id="tbl-pengaturan-laporan" width="100%" class="table table-striped table-responsive table-bordered datatable">');
	        $this->table->set_template($tmpl);

	        if($privileges[1] == 1 or $privileges[2] == 1) {
        	 $this->table->set_heading('Jenis Kegiatan', 'Laporan', 'Aksi');
	        } else {
	            $this->table->set_heading('Jenis Kegiatan', 'Laporan');
	        }

	        $this->template->set_layout('backoffice')
	        				->title('Pengaturan Laporan - Badan Ekonomi Kreatif Indonesia')
	        				->build('v_pengaturan_laporan', $d);

		}

		function dt_pengaturan_laporan()
		{
			if(!$this->input->is_ajax_request()) show_404();

			$edit_priv = $this->input->post('edit_priv', TRUE);
			$delete_priv = $this->input->post('delete_priv', TRUE);

			$this->datatables->select('p.jenis_kegiatan_id as kode, p.jenis_kegiatan_id, p.jenis_laporan_id, k.jenis_kegiatan_id, k.jenis_kegiatan, l.jenis_laporan_id, GROUP_CONCAT(l.jenis_laporan," ") as jenis_laporan', FALSE)
								->from('nb_pengaturan_laporan as p')
								->join('nb_jenis_laporan as l','l.jenis_laporan_id = p.jenis_laporan_id')
								->join('jenis_kegiatan as k','k.jenis_kegiatan_id = p.jenis_kegiatan_id')
								->group_by('k.jenis_kegiatan_id');
								// ->concat('l.jenis_laporan',', ','l.jenis_laporan');

			$this->datatables->unset_column('kode');
			
			$edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('pengaturan_laporan/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
	        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
	        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

	        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');
			
			echo $this->datatables->generate();	
		}

		function add()
		{
			$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

	        $d['page_title']    = 'Tambah Ruangan';
	        $d['menus']         = $this->functions->generate_menu();
	        $d['jenis_laporan']	= $this->m_pengaturan_laporan->fetch('nb_jenis_laporan')->result_array();

	        $d['pengaturan_laporan'] = NULL;
	        $jenis_kegiatan_laporan = $this->m_pengaturan_laporan->fetch('nb_pengaturan_laporan',null, 'jenis_kegiatan_id');
	        // return var_dump($jenis_kegiatan_laporan);
         	
         	if($jenis_kegiatan_laporan->num_rows() > 0) {
         		$jenis_kegiatan_laporan = $jenis_kegiatan_laporan->result_array();
         		foreach($jenis_kegiatan_laporan as $t)
		        {
		        	$jenis_kegiatan_id[] = $t['jenis_kegiatan_id'];
		        }
		        $d['jenis_kegiatan'] = $this->m_pengaturan_laporan->jenis_kegiatan_not_create($jenis_kegiatan_id)->result_array();
         	} else {
         		$d['jenis_kegiatan'] = $this->m_pengaturan_laporan->fetch('jenis_kegiatan')->result_array();
         	}

	        // echo "<pre>";
	        // var_dump($jenis_kegiatan_id);
	        // exit;

	        
	        // echo "<pre>";
	        // var_dump($d['jenis_kegiatan']);
	        // exit;

	        $this->load->library('form_validation');
	        $this->form_validation->set_rules('jenis_kegiatan_id', 'Jenis Kegiatan', 'required');
	        $this->form_validation->set_rules('jenis_laporan_id[]', 'Jenis Laporan', 'required');

	        if ($this->form_validation->run() == FALSE) {
	        	# code...
	        } else {
	        	$this->db->trans_begin();

	        	$jenis_kegiatan = $this->input->post('jenis_kegiatan_id', true);
	        	$jenis_laporan = $this->input->post('jenis_laporan_id', true);

	        	for($i = 0; $i < count($jenis_laporan); $i++)
	        	{	
	        		$data[] = array(
	        			'jenis_kegiatan_id'	=> $jenis_kegiatan,
	        			'jenis_laporan_id'	=> $jenis_laporan[$i],
	       				'created_by'		=> $this->session->name
        			);
	        	}

	        	// echo "<pre>";
	        	// var_dump($data);

	        	$this->m_pengaturan_laporan->save_batch($data, true);

	        	if ($this->db->trans_status() === FALSE){
	                $this->db->trans_rollback();
	                $message                        = "Data pengaturan laporan gagal disimpan!";
	                $type                           = "error";
	            } else {
	                $this->db->trans_commit();
	                $message                        = "Data pengaturan laporan berhasil disimpan!";
	                $type                           = "success";
	            }

	            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));
            	redirect('pengaturan_laporan');
	        }

	        $this->template->set_layout('backoffice')
	        				->title('Tambah Pengaturan Laporan - Badan Ekonomi Kreatif Indonesia')
	        				->build('f_pengaturan_laporan', $d);
		}

		function edit()
		{
			$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

	        $d['page_title']    = 'Ubah Pengaturan Laporan';
	        $d['menus']         = $this->functions->generate_menu();

	        $d['jenis_kegiatan'] = $this->m_pengaturan_laporan->fetch('jenis_kegiatan')->result_array();
	        $d['jenis_laporan']	= $this->m_pengaturan_laporan->fetch('nb_jenis_laporan')->result_array();

	        $jenis_kegiatan_id = decode($this->uri->segment(3));
	        if(!empty($jenis_kegiatan_id)) {
	        	$cek = $this->m_pengaturan_laporan->get_laporan_kegiatan($jenis_kegiatan_id);
	        	// echo "<pre>";
	        	// var_dump($cek);
	        	// exit;
	        	if($cek->num_rows() > 0) {
	        		$d['pengaturan_laporan'] = $cek->row_array();
	        		$d['_pengaturan_laporan'] = $cek->result_array(); 
	        		// echo "<pre>";
		        	// var_dump($d['pengaturan_laporan']);
		        	// exit;
	        		// $d['pengaturan_laporan'] = $cek->result();

	        	} else {
	        		redirect('pengaturan_laporan');
	        	}
	        } else {
	        	redirect('pengaturan_laporan');
	        }

	        $this->load->library('form_validation');

	        $this->form_validation->set_rules('jenis_kegiatan_id', 'Jenis Kegiatan', 'required');
	        $this->form_validation->set_rules('jenis_laporan_id[]', 'Jenis Laporan', 'required');

	        if ($this->form_validation->run() == FALSE) {
	        		# code...
        	} else {
        		$id 	= $jenis_kegiatan_id;

        		$jenis_kegiatan	= $this->input->post('jenis_kegiatan_id', true);
        		$jenis_laporan 	= $this->input->post('jenis_laporan_id', true);

        // 		$temp_laporan = [];
        //  		foreach($jenis_laporan_id as $key => $value) {
        //  			$data = array(
        // 				'jenis_kegiatan_id'	=>	$jenis_kegiatan_id,
        // 				'jenis_laporan_id'	=>	$value,
        // 				'modified_by'		=>	$this->session->nama
    				// );
        //  		}
        //  		$this->m_pengaturan_laporan->update('nb_pengaturan_laporan',$data, $id);

        //  		var_dump($temp_laporan);
        // 		exit;
        		for($i = 0; $i < count($jenis_laporan); $i++)
	        	{	
	        		$data[] = array(
	        			'jenis_kegiatan_id'	=> $jenis_kegiatan,
	        			'jenis_laporan_id'	=> $jenis_laporan[$i],
	       				'created_by'		=> $this->session->name
        			);
	        	}

        		// return var_dump($data);

        		$this->db->trans_begin();
        		$this->m_pengaturan_laporan->destroy('nb_pengaturan_laporan', array('jenis_kegiatan_id'=>$id));
        		$this->m_pengaturan_laporan->save_batch($data, true);

        		if($this->db->trans_status() === FALSE) {
        			$this->db->trans_rollback();
        			$message                        = "Data pengaturan laporan gagal diperbaharui!";
	                $type                           = "error";
	            } else {
	                $this->db->trans_commit();
	                $message                        = "Data pengaturan laporan berhasil diperbaharui!";
	                $type                           = "success";
	            }

	            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

	            redirect('pengaturan_laporan');
	        }	
        	
        	$this->template->set_layout('backoffice')
	        				->title('Ubah Pengaturan Laporan - Badan Ekonomi Kreatif Indonesia')
	        				->build('f_pengaturan_laporan', $d);	
		}

		function delete()
		{
			$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
			if(! $this->input->is_ajax_request()) show_404();

			$id = decode($this->input->post('id', TRUE));

			$this->db->trans_begin();

			$this->m_pengaturan_laporan->destroy('nb_pengaturan_laporan', array('jenis_kegiatan_id' => $id));

			if ($this->db->trans_status() === FALSE){
	            $this->db->trans_rollback();
	            $result['message']              = "Data pengaturan laporan gagal dihapus!";
	            $result['type']                 = "error";
	        } else {
	            $this->db->trans_commit();
	            $result['message']              = "Data pengaturan laporan berhasil dihapus!";
	            $result['type']                 = "success";
	        }

	        echo json_encode($result);
		}
	}
	
	/* End of file Pengaturan_laporan.php */
	/* Location: ./application/modules/pengaturan_laporan/controllers/Pengaturan_laporan.php */	
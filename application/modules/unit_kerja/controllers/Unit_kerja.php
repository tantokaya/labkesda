<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_kerja extends MX_Controller {

	function __construct()
	{
		parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_unit_kerja');

        $this->load->library('Datatables');
        $this->load->library('table');
	}

	function index()
	{
		$d['page_title']	= 'Unit Kerja';
		$d['menus']			= $this->functions->generate_menu();
		
		$d['priv']			= $this->functions->check_priv2($this->uri->segment(1));

		$privileges			= explode(',',$d['priv']['privileges']);

		//set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-unit-kerja" width="100%" class="table table-striped table-responsive table-bordered datatable">');
        $this->table->set_template($tmpl);

        if($privileges[1] == 1 or $privileges[2] == 1) {
        	$this->table->set_heading('Kode Unit Kerja', 'Unit Kerja', 'Akses','Esselon','Jabatan','Mark','Aksi');
        } else {
            $this->table->set_heading('Kode Unit Kerja', 'Unit Kerja', 'Akses','Esselon','Jabatan','Mark');
        }

        $this->template->set_layout('backoffice')
        				->title('Unit Kerja - Badan Ekonomi Kreatif Indonesia')
        				->build('v_unit_kerja', $d);
	}

	function dt_unit_kerja()
	{
		if(!$this->input->is_ajax_request()) show_404();

		$edit_priv = $this->input->post('edit_priv', TRUE);
		// $delete_priv = $this->input->post('delete_priv', TRUE);

		$this->datatables->select('uk.unit_kerja_id as kode, uk.unit_kerja_id as unit_kerja_id, uk.unit_kerja as unit_kerja, uk.akses_id, uk.eselon as eselon, uk.jabatan_id, uk.mark as mark, a.akses_id, a.akses, j.jabatan_id, j.jabatan as jabatan', FALSE)
							->from('unit_kerja as uk')
							->join('akses as a','uk.akses_id = a.akses_id','LEFT')
							->join('jabatan as j','uk.jabatan_id = j.jabatan_id','LEFT');

		$this->datatables->unset_column('kode');

		$edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('unit_kerja/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        // $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        // $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

     	$this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . '</ul></li></ul>' , 'encode(kode)'); // $divider . $delete_button .

        echo $this->datatables->generate();

	}

	function add ()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Unit Kerja';
        $d['menus']         = $this->functions->generate_menu();

        $d['akses'] = $this->m_unit_kerja->fetch('akses')->result_array();
        $d['all_unit_kerja'] = $this->m_unit_kerja->fetch('unit_kerja')->result_array();
        $d['jabatan'] = $this->m_unit_kerja->fetch('jabatan')->result_array();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('unit_kerja_id', 'Kode Unit Kerja', 'required|is_unique[unit_kerja.unit_kerja_id]');
        $this->form_validation->set_rules('unit_kerja', 'Unit Kerja', 'required');
        $this->form_validation->set_rules('eselon', 'eselon', 'required');
        $this->form_validation->set_rules('jabatan_id', 'Jabatan', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');        
        $this->form_validation->set_rules('mark', 'Mark', 'required');


        if ($this->form_validation->run() == FALSE) {
        	# code...
        } else {
        	$this->db->trans_begin();

        	$data['unit_kerja_id'] = $this->input->post('unit_kerja_id',true);
        	$data['unit_kerja'] = $this->input->post('unit_kerja',true);
        	$data['eselon'] = $this->input->post('eselon',true);
        	$data['akses_id'] = (int) $data['eselon'] +(int)2;
        	$data['jabatan_id'] = $this->input->post('jabatan_id',true);
        	$data['level'] = $this->input->post('level',true);
        	$data['mark'] = $this->input->post('mark',true);
        	$data['parent'] = !empty($this->input->post('parent', true))?$this->input->post('parent', true):NULL;
        	$data['created_by'] = $this->session->name;

        	// return var_dump($data);

        	$this->m_unit_kerja->save('unit_kerja', $data, true);

        	if($this->db->trans_status() === FALSE) {
        		$this->db->trans_rollback()
        		;$message	= 'Data unit kerja gagal disimpan!';
        		$type		= 'error';
        	} else {
        		$this->db->trans_commit();
        		$message	= 'Data unit kerja berhasil disimpan!';
        		$type		= 'success';
        	}

        	$this->session->set_flashdata(array('notif' => $message, 'type' => $type));

        	redirect('unit_kerja');
        }

        $this->template->set_layout('backoffice')
         					->title('Tambah Unit Kerja - Badan Ekonomi Kreatif Indonesia')
         					->build('f_unit_kerja', $d);
	}

	function edit()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Unit Kerja';
        $d['menus']         = $this->functions->generate_menu();

        $d['akses'] = $this->m_unit_kerja->fetch('akses')->result_array();
        $d['all_unit_kerja'] = $this->m_unit_kerja->fetch('unit_kerja')->result_array();
        $d['jabatan'] = $this->m_unit_kerja->fetch('jabatan')->result_array();

        $unit_kerja_id = decode($this->uri->segment(3));
       	if(!empty($unit_kerja_id)){
            $cek = $this->m_unit_kerja->fetch('unit_kerja', array('unit_kerja_id' => $unit_kerja_id));

            if($cek->num_rows() > 0){
                $d['unit_kerja']      =  $cek->row_array();

                // echo "<pre>";
                // return var_dump($d['unit_kerja']);

            } else {
                redirect('unit_kerja');
            }
        } else {
            redirect('unit_kerja');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('unit_kerja', 'Unit Kerja', 'required');
        $this->form_validation->set_rules('eselon', 'eselon', 'required');
        $this->form_validation->set_rules('jabatan_id', 'Jabatan', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('mark', 'Mark', 'required');

        if ($this->form_validation->run() == FALSE) {
        	# code...
        } else {
        	$id['unit_kerja_id'] 		= $unit_kerja_id;

        	$data['unit_kerja'] 		= $this->input->post('unit_kerja',true);
        	$data['eselon'] 			= $this->input->post('eselon',true);
        	$data['akses_id'] 			= $data['eselon'] +(int)2;
        	$data['jabatan_id'] 		= $this->input->post('jabatan_id',true);
        	$data['level'] 				= $this->input->post('level',true);
        	$data['mark'] 				= $this->input->post('mark',true);
        	$data['parent'] 			= !empty($this->input->post('parent', true))?$this->input->post('parent', true):NULL;
        	$data['modified_by']        = $this->session->nama;

        	// return var_dump($data);

        	$this->db->trans_begin();
        	$this->m_unit_kerja->update('unit_kerja', $data, $id);

        	if($this->db->trans_status() === FALSE) {
        		$this->db->trans_rollback()
        		;$message	= 'Data unit kerja gagal diperbaharui!';
        		$type		= 'error';
        	} else {
        		$this->db->trans_commit();
        		$message	= 'Data unit kerja berhasil diperbaharui!';
        		$type		= 'success';
        	}

        	$this->session->set_flashdata(array('notif' => $message, 'type' => $type));

        	redirect('unit_kerja');
        }

        $this->template->set_layout('backoffice')
         					->title('Ubah Unit Kerja - Badan Ekonomi Kreatif Indonesia')
         					->build('f_unit_kerja', $d);
	}

	// function delete()
	// {
	// 	$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
	// 	if(! $this->input->is_ajax_request()) show_404();

	// 	$id = decode($this->input->post('id', TRUE));

	// 	$this->db->trans_begin();

	// 	$this->m_unit_kerja->destroy('unit_kerja', array('unit_kerja_id' => $id));

	// 	if ($this->db->trans_status() === FALSE){
 //            $this->db->trans_rollback();
 //            $result['message']              = "Data kode unit gagal dihapus!";
 //            $result['type']                 = "error";
 //        } else {
 //            $this->db->trans_commit();
 //            $result['message']              = "Data kode unit berhasil dihapus!";
 //            $result['type']                 = "success";
 //        }

 //        echo json_encode($result);
	// }
}

/* End of file Unit_kerja.php */
/* Location: ./application/modules/unit_kerja/controllers/Unit_kerja.php */
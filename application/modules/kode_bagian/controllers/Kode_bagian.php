<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kode_bagian extends MX_Controller {

	function __construct()
	{
		parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_kode_bagian');

        $this->load->library('Datatables');
        $this->load->library('table');
	}

	function index()
	{
		$d['page_title']	= 'Kode Bagian';
		$d['menus']			= $this->functions->generate_menu();
		
		$d['priv']			= $this->functions->check_priv2($this->uri->segment(1));

		$privileges			= explode(',',$d['priv']['privileges']);

		//set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-kode-bagian" width="100%" class="table table-striped table-responsive table-bordered datatable">');
        $this->table->set_template($tmpl);
	
        if($privileges[1] == 1 or $privileges[2] == 1) {
        	 $this->table->set_heading('Kode Bagian', 'Deskipsi', 'Aksi');
        } else {
            $this->table->set_heading('Kode Bagian','Deskipsi');
        }

        $this->template->set_layout('backoffice')
        				->title('Kode Bagian - Badan Ekonomi Kreatif Indonesia')
        				->build('v_kode_bagian', $d);
	}

	function dt_kode_bagian()
	{
		if(!$this->input->is_ajax_request()) show_404();

		$edit_priv = $this->input->post('edit_priv', TRUE);
		$delete_priv = $this->input->post('delete_priv', TRUE);

		$this->datatables->select('kode_bagian as kode, kode_bagian, deskripsi', FALSE)
							->from('nb_kode_bagian');
		
		$this->datatables->unset_column('kode');

		$edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('kode_bagian/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

     	$this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

     	echo $this->datatables->generate();
	}

	function add()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Kode Bagian';
        $d['menus']         = $this->functions->generate_menu();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('kode_bagian', 'Kode Bagian', 'required|is_unique[nb_kode_bagian.kode_bagian]');

        if ($this->form_validation->run() == FALSE) {
        	# code...
        } else {
        	$this->db->trans_begin();

        	$data['kode_bagian'] 	= $this->input->post('kode_bagian', true);
        	$data['deskripsi']		= !empty($this->input->post('deskripsi', true))?$this->input->post('deskripsi', true):NULL;
        	$data['created_by']		= $this->session->name;

        	$this->m_kode_bagian->save('nb_kode_bagian', $data, true);

        	if($this->db->trans_status() === FALSE) {
        		$this->db->trans_rollback();
        		$message	= 'Data kode bagian gagal disimpan!';
        		$type		= 'error';
        	} else {
        		$this->db->trans_commit();
        		$message	= 'Data kode bagian berhasil disimpan!';
        		$type		= 'success';
        	}

        	$this->session->set_flashdata(array('notif' => $message, 'type' => $type));

        	redirect('kode_bagian');
        }

        $this->template->set_layout('backoffice')
         					->title('Tambah Kode Bagian - Badan Ekonomi Kreatif Indonesia')
         					->build('f_kode_bagian', $d);
	}

	function edit()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Kode Bagian';
        $d['menus']         = $this->functions->generate_menu();

        $kode_bagian = decode($this->uri->segment(3));
        if(!empty($kode_bagian)) {
        	$cek = $this->m_kode_bagian->fetch('nb_kode_bagian', array('kode_bagian'=>$kode_bagian));
        	if($cek->num_rows() > 0) {
        		$d['kode_bagian'] = $cek->row_array();
        	} else {
        		redirect('kode_bagian');
        	}
        } else {
        	redirect('kode_bagian');
        }

        $this->load->library('form_validation');

		$this->form_validation->set_rules('kode_bagian', 'Kode Bagian', 'required');	

		if ($this->form_validation->run() == FALSE) {
			# code...
		} else {
			$id['kode_bagian'] = $kode_bagian;

			$data['kode_bagian'] 	= $this->input->post('kode_bagian', true);
        	$data['deskripsi']		= !empty($this->input->post('deskripsi', true))?$this->input->post('deskripsi', true):NULL;
        	$data['modified_by']	= $this->session->nama;

        	$this->db->trans_begin();
        	$this->m_kode_bagian->update('nb_kode_bagian', $data, $id);

        	if($this->db->trans_status() === FALSE) {
        		$this->db->trans_rollback();
        		$message	= 'Data kode bagian gagal diperbaharui!';
        		$type		= 'error';
        	} else {
        		$this->db->trans_commit();
        		$message	= 'Data kode bagian berhasil diperbaharui';
        		$type 		= 'success';
        	}

        	$this->session->set_flashdata(array('notif'=> $message, 'type'=>$type));
        	redirect('kode_bagian');
		}

		$this->template->set_layout('backoffice')
     					->title('Ubah Kode Bagian - Badan Ekonomi Kreatif Indonesia')
     					->build('f_kode_bagian', $d);

	}

	function delete()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
		if(! $this->input->is_ajax_request()) show_404();

		$id = decode($this->input->post('id', TRUE));

		$this->db->trans_begin();

		$this->m_kode_bagian->destroy('nb_kode_bagian', array('kode_bagian' => $id));

		if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data kode bagian gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data kode bagian berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
	}
}

/* End of file Kode_bagian.php */
/* Location: ./application/modules/kode_bagian/controllers/Kode_bagian.php */
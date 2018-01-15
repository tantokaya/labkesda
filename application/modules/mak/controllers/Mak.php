<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mak extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->functions->check_session();
		$this->functions->check_access($this->uri->segment(1));

		$this->load->model('m_mak');

		$this->load->library('Datatables');
		$this->load->library('table');
	}	

	function index()
	{
		$d['page_title'] = 'MAK';
		$d['menus'] = $this->functions->generate_menu();

		$d['priv'] = $this->functions->check_priv2($this->uri->segment(1));

		$privileges = explode(',', $d['priv']['privileges']);

		$tmpl = array(
			'table_open' => '<table id="tbl-mak" width="100%" class="table table-striped table-responsive table-bordered datatable">'
		);
		$this->table->set_template($tmpl);

		if($privileges[1]==1 or $privileges[2]==1) {
			$this->table->set_heading('MAK','Deskripsi','Aksi');
		} else {
			$this->table->set_heading('MAK','Deskripsi');
		}

		$this->template->set_layout('backoffice')
						->title('MAK - Badan Ekonomi Kreatif Indonesia')
						->build('v_mak',$d);	
	}

	function dt_mak()
	{
		if(! $this->input->is_ajax_request()) show_404();

		$edit_priv = $this->input->post('edit_priv', TRUE);
		$delete_priv = $this->input->post('delete_priv', TRUE);

		$this->datatables->select('mak as kode, mak, deskripsi',FALSE)
							->from('nb_mak');

		$this->datatables->unset_column('kode');

		$edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('mak/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();
	}

	function add()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah MAK';
        $d['menus']         = $this->functions->generate_menu();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('mak', 'MAK', 'required|is_unique[nb_mak.mak]');

        if ($this->form_validation->run() == FALSE) {
        	# code...
        } else {
        	$this->db->trans_begin();

        	$data['mak']	= $this->input->post('mak',true);
    	 	$data['deskripsi']		= !empty($this->input->post('deskripsi', true))?$this->input->post('deskripsi', true):NULL;
        	$data['created_by']		= $this->session->name;

        	$this->m_mak->save('nb_mak', $data, true);
        	if($this->db->trans_status() === FALSE)
        	{
        		$this->db->trans_rollback();
        		$message	= 'Data MAK gagal disimpan!';
        		$type		= 'error';
        	} else {
        		$this->db->trans_commit();
        		$message 	= 'Data MAK berhasil disimpan!';
        		$type 		= 'success';
        	}

        	$this->session->set_flashdata(array('notif'=>$message, 'type'=>$type));
        	redirect('mak');
        }

        $this->template->set_layout('backoffice')
     					->title('Tambah MAK - Badan Ekonomi Kreatif Indonesia')
     					->build('f_mak', $d);
	}

	function edit()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Kode Bagian';
        $d['menus']         = $this->functions->generate_menu();

        $mak = decode($this->uri->segment(3));
        if(!empty($mak)) {
        	$cek = $this->m_mak->fetch('nb_mak', array('mak' => $mak));
        	if($cek->num_rows() > 0){
        		$d['mak'] = $cek->row_array();
        	} else {
        		redirect('mak');
        	}
        } else {
        	redirect('mak');
        }

        $this->load->library('form_validation');

		$this->form_validation->set_rules('mak', 'MAK', 'required');	

		if ($this->form_validation->run() == FALSE) {
			# code...
		} else {
			$id['mak']	= $mak;

			$data['mak']	= $this->input->post('mak', true);
			$data['deskripsi']		= !empty($this->input->post('deskripsi', true))?$this->input->post('deskripsi', true):NULL;
        	$data['modified_by']	= $this->session->nama;

        	$this->db->trans_begin();
        	$this->m_mak->update('nb_mak', $data, $id);

        	if($this->db->trans_status() === FALSE) {
        		$this->db->trans_rollback();
        		$message	= 'Data MAK gagal diperbaharui!';
        		$type		= 'error';
        	} else {
        		$this->db->trans_commit();
        		$message	= 'Data MAK bagian berhasil diperbaharui';
        		$type 		= 'success';
        	}

        	$this->session->set_flashdata(array('notif'=> $message, 'type'=>$type));
        	redirect('mak');
		}

		$this->template->set_layout('backoffice')
     					->title('Ubah MAK - Badan Ekonomi Kreatif Indonesia')
     					->build('f_mak', $d);
	}

	function delete()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
		if(! $this->input->is_ajax_request()) show_404();

		$id = decode($this->input->post('id', TRUE));

		$this->db->trans_begin();

		$this->m_mak->destroy('nb_mak', array('mak' => $id));

		if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data MAK gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data MAK bagian berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
	}

}

/* End of file Mak.php */
/* Location: ./application/modules/mak/controllers/Mak.php */
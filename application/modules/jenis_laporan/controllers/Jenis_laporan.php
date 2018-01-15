<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_laporan extends MX_Controller {

	function __construct()
	{
		parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_jenis_laporan');

        $this->load->library('Datatables');
        $this->load->library('table');
	}

	function index()
	{
		$d['page_title']	= 'Jenis Laporan';
		$d['menus']			= $this->functions->generate_menu();
		
		$d['priv']			= $this->functions->check_priv2($this->uri->segment(1));

		$privileges			= explode(',',$d['priv']['privileges']);

		//set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-jenis-laporan" width="100%" class="table table-striped table-responsive table-bordered datatable">');
        $this->table->set_template($tmpl);
	
        if($privileges[1] == 1 or $privileges[2] == 1) {
        	 $this->table->set_heading('Jenis Laporan', 'Aksi');
        } else {
            $this->table->set_heading('Jenis Laporan');
        }

        $this->template->set_layout('backoffice')
        				->title('Jenis Laporan - Badan Ekonomi Kreatif Indonesia')
        				->build('v_jenis_laporan', $d);
	}

	function dt_jenis_laporan()
	{
		if(!$this->input->is_ajax_request()) show_404();

		$edit_priv = $this->input->post('edit_priv', TRUE);
		$delete_priv = $this->input->post('delete_priv', TRUE);

		$this->datatables->select('jenis_laporan_id as kode, jenis_laporan')
							->from('nb_jenis_laporan');
		$this->datatables->unset_column('kode');

		$edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('jenis_laporan/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();
	}

	function add()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Jenis Laporan';
        $d['menus']         = $this->functions->generate_menu();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('jenis_laporan', 'Jenis Laporan', 'required');
        if ($this->form_validation->run() == FALSE) {
        	# code...
        } else {
        	$this->db->trans_begin();

        	$data['jenis_laporan']	= $this->input->post('jenis_laporan',true);
        	$data['created_by']		= $this->session->nama;

        	$this->m_jenis_laporan->save('nb_jenis_laporan', $data, true);

        	if($this->db->trans_status() === FALSE) {
        		$this->db->trans_rollback();
        		$message	= 'Data jenis laporan gagal disimpan!';
        		$type		= 'error';
        	} else {
        		$this->db->trans_commit();
        		$message	= 'Data jenis laporan berhasil disimpan!';
        		$type		= 'success';
        	}

        	$this->session->set_flashdata(array('notif' => $message,  'type' => $type));
        	redirect('jenis_laporan');
        }

       	$this->template->set_layout('backoffice')
       					->title('Tambah Jenis Laporan - Badan Ekonomi Kreatif Indonesia')
       					->build('f_jenis_laporan', $d);
	}

	function edit()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Jenis Laporan';
        $d['menus']         = $this->functions->generate_menu();

        $jenis_laporan_id = decode($this->uri->segment(3));
        if(!empty($jenis_laporan_id)) {
        	$cek = $this->m_jenis_laporan->fetch('nb_jenis_laporan', array('jenis_laporan_id'=> $jenis_laporan_id));

        	if($cek->num_rows() > 0) {
        		$d['jenis_laporan'] = $cek->row_array();
        	} else {
        		redirect('jenis_laporan');
        	}
        } else {
        	redirect('jenis_laporan');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('jenis_laporan', 'Jenis Laporan', 'required');

        if ($this->form_validation->run() == FALSE) {
        	# code...
        } else {
        	$id['jenis_laporan_id'] = $jenis_laporan_id;

        	$data['jenis_laporan']	= $this->input->post('jenis_laporan', true);
            $data['modified_by']    = $this->session->nama;

            $this->db->trans_begin();
            $this->m_jenis_laporan->update('nb_jenis_laporan', $data, $id);

            if($this->db->trans_status() === FALSE) {
            	$this->db->trans_rollback();
            	$message	= 'Data jenis laporan gagal diperbaharui!';
            	$type		= 'error';
            } else {
            	$this->db->trans_commit();
            	$message	= 'Data jenis laporan berhasil diperbaharui!';
            	$type		= 'success';
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('jenis_laporan');
        }

        $this->template->set_layout('backoffice')
       					->title('Ubah Jenis Laporan - Badan Ekonomi Kreatif Indonesia')
       					->build('f_jenis_laporan', $d);

	}

	function delete()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $this->m_jenis_laporan->destroy('nb_jenis_laporan', array('jenis_laporan_id' => $id));

        if($this->db->trans_status() === FALSE) {
        	$this->db->trans_rollback();
        	$result['message']		= 'Data jenis laporan gagal dihapus!';
        	$result['type']			= 'error';
        } else {
        	$this->db->trans_commit();
        	$result['message']		= 'Data jenis laporan berhasil dihapus';
        	$result['tpye']			= 'success';
        }

        echo json_encode($result);
	}

}

/* End of file Jenis_laporan.php */
/* Location: ./application/modules/jenis_laporan/controllers/Jenis_laporan.php */
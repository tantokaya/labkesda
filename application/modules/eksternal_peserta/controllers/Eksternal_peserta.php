<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eksternal_peserta extends MX_Controller {

	function __construct()
	{
		parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_eksternal_peserta');

        $this->load->library('Datatables');
        $this->load->library('table');
	}

	function index()
	{	
		$d['page_title']    = 'Eksternal Peserta';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-eksternal-peserta" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Nama', 'Email', 'No Telp/Hp', 'NPWP', 'Alamat', 'Instansi', 'Golongan', 'Jabatan', 'Representatif', 'Aksi');
        } else {
            $this->table->set_heading('Nama', 'Email', 'No Telp/Hp', 'NPWP', 'Alamat', 'Instansi', 'Golongan', 'Jabatan', 'Representatif');
        }

        $this->template->set_layout('backoffice')->title('Eksternal Peserta - Badan Ekonomi Kreatif Indonesia')->build('v_eksternal_peserta', $d);
	}

	function dt_eksternal_peserta()
	{
		if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('peserta_eksternal_id as kode, nm_peserta, golongan, jabatan, email, alamat, no_telepon, nm_instansi, no_npwp, representatif')
        ->from('nb_peserta_eksternal');

         $this->datatables->unset_column('kode');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('eksternal_peserta/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();
	}

	function add()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Peserta Eksternal';
        $d['menus']         = $this->functions->generate_menu();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nm_peserta', 'Nama Peserta', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
        	$this->db->trans_begin();
        	$data['nm_peserta'] = $this->input->post('nm_peserta');
        	$data['golongan'] = !empty($this->input->post('golongan', true))?$this->input->post('golongan', true):NULL;
        	$data['jabatan'] = !empty($this->input->post('jabatan', true))?$this->input->post('jabatan', true):NULL;
        	$data['email'] = !empty($this->input->post('email', true))?$this->input->post('email', true):NULL;
        	$data['alamat'] = !empty($this->input->post('alamat', true))?$this->input->post('alamat', true):NULL;
        	$data['no_telepon'] = !empty($this->input->post('no_telepon', true))?$this->input->post('no_telepon', true):NULL;
        	$data['nm_instansi'] = !empty($this->input->post('nm_instansi', true))?$this->input->post('nm_instansi', true):NULL;
        	$data['no_npwp'] = !empty($this->input->post('no_npwp', true))?$this->input->post('no_npwp', true):NULL;
        	$data['representatif'] = !empty($this->input->post('representatif', true))?$this->input->post('representatif', true):NULL;
        	$data['created_by'] = $this->session->nama;

        	$this->m_eksternal_peserta->save('nb_peserta_eksternal',$data,true); 

        	if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data peserta eksternal gagal disimpan!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data peserta eksternal berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('eksternal_peserta');
        }

        $this->template->set_layout('backoffice')->title('Tambah Peserta Eksternal - Badan Ekonomi Kreatif Indonesia')->build('f_eksternal_peserta', $d);
	}

	function edit()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Peserta Eksternal';
        $d['menus']         = $this->functions->generate_menu();

        $peserta_eksternal_id  	= decode($this->uri->segment(3));
        if(!empty($peserta_eksternal_id)) {
	        $cek = $this->m_eksternal_peserta->fetch('nb_peserta_eksternal',['peserta_eksternal_id'=> $peserta_eksternal_id]);
	        if($cek->num_rows() > 0) {
	        	$d['eksternal_peserta'] = $cek->row_array();
	        } else {
	        	redirect('eksternal_peserta');
	        }
        } else {
        	redirect('eksternal_peserta');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nm_peserta', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
        	$id['peserta_eksternal_id'] = $peserta_eksternal_id;
        	$data['nm_peserta'] = $this->input->post('nm_peserta');
        	$data['golongan'] = !empty($this->input->post('golongan', true))?$this->input->post('golongan', true):NULL;
        	$data['jabatan'] = !empty($this->input->post('jabatan', true))?$this->input->post('jabatan', true):NULL;
        	$data['email'] = !empty($this->input->post('email', true))?$this->input->post('email', true):NULL;
        	$data['alamat'] = !empty($this->input->post('alamat', true))?$this->input->post('alamat', true):NULL;
        	$data['no_telepon'] = !empty($this->input->post('no_telepon', true))?$this->input->post('no_telepon', true):NULL;
        	$data['nm_instansi'] = !empty($this->input->post('nm_instansi', true))?$this->input->post('nm_instansi', true):NULL;
        	$data['no_npwp'] = !empty($this->input->post('no_npwp', true))?$this->input->post('no_npwp', true):NULL;
        	$data['representatif'] = !empty($this->input->post('representatif', true))?$this->input->post('representatif', true):NULL;
        	$data['modified_by'] = $this->session->nama;

    		$this->db->trans_begin();
            $this->m_eksternal_peserta->update('nb_peserta_eksternal', $data, $id);

        	if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data peserta eksternal gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data peserta eksternal berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('eksternal_peserta');
        }

        $this->template->set_layout('backoffice')->title('Ubah Peserta Eksternal - Badan Ekonomi Kreatif Indonesia')->build('f_eksternal_peserta', $d);
	}

	function delete()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $this->m_eksternal_peserta->destroy('nb_peserta_eksternal', array('peserta_eksternal_id' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data peserta eksternal gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data peserta eksternal berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
	}

}

/* End of file Esksternal_peserta.php */
/* Location: ./application/modules/eksternal_peserta/controllers/Esksternal_peserta.php */
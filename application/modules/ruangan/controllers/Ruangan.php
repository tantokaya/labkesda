<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangan extends MX_Controller {

	function __construct()
	{
		parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_ruangan');

        $this->load->library('Datatables');
        $this->load->library('table');
	}

	function index()
	{
		$d['page_title']    = 'Ruangan';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-ruangan" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Lantai','Nama Gedung','Nama Ruang','Deskrpisi','PIC', 'Aksi');
        } else {
            $this->table->set_heading('Lantai','Nama Gedung','Nama Ruang','Deskrpisi','PIC');
        }

        $this->template->set_layout('backoffice')->title('Ruangan - Badan Ekonomi Kreatif Indonesia')->build('v_ruangan', $d);
	}

	function dt_ruangan()
	{
		if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('ruang_id as kode, ruang.lantai, nama_gedung, nama_ruang, deskripsi, pic', FALSE)
            ->from('ruang')
            ->join('lantai','lantai.lantai = ruang.lantai');

        $this->datatables->unset_column('kode');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('ruangan/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
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

        $d['lantai']		= $this->m_ruangan->fetch('lantai')->result_array();
        $d['pegawai']       = $this->m_ruangan->fetch('pegawai')->result_array();
        // return var_dump($d['pegawai']);

        $this->load->library('form_validation');

        $this->form_validation->set_rules('lantai', 'Lantai', 'required');
        $this->form_validation->set_rules('nama_ruang', 'Nama Ruang', 'required');
        $this->form_validation->set_rules('pic', 'PIC', 'required');


        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            $this->db->trans_begin();

            $data['lantai']      		= $this->input->post('lantai', true);
            $data['nama_ruang']      	= $this->input->post('nama_ruang', true);
            $data['deskripsi']			= !empty($this->input->post('deskripsi', true))?$this->input->post('deskripsi', true):NULL;
            $data['pic']                = $this->input->post('pic');
            $data['user_id']            = $this->input->post('user_id');
            $data['created_by']         = $this->session->nama;

            // echo "<pre>";
            // return var_dump($data);

            $this->m_ruangan->save('ruang', $data, true);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data ruangan gagal disimpan!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data ruangan berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('ruangan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Tambah Ruang - Badan Ekonomi Kreatif Indonesia')->build('f_ruangan', $d);
	}

	function edit()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Ruang';
        $d['menus']         = $this->functions->generate_menu();

        $d['lantai']		= $this->m_ruangan->fetch('lantai')->result_array();
        $d['pegawai']       = $this->m_ruangan->fetch('pegawai')->result_array();


        $ruang_id = decode($this->uri->segment(3));
        if(!empty($ruang_id)){
            $cek = $this->m_ruangan->fetch('ruang', array('ruang_id' => $ruang_id), NULL, 'lantai','lantai.lantai = ruang.lantai');
            // return var_dump($cek->row_array());

            if($cek->num_rows() > 0){
                $d['ruang']      =  $cek->row_array();

            } else {
                redirect('ruang');
            }
        } else {
            redirect('ruang');
        }


        $this->load->library('form_validation');

       	$this->form_validation->set_rules('lantai', 'Lantai', 'required');
		$this->form_validation->set_rules('nama_ruang', 'Nama Ruang', 'required');


        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;
            $id['ruang_id']             = $ruang_id;

            $data['lantai']        		= $this->input->post('lantai', true);
            $data['nama_ruang']        	= $this->input->post('nama_ruang', true);
            $data['deskripsi']        	= $this->input->post('deskripsi', true);
            $data['pic']                = $this->input->post('pic');
            $data['user_id']            = $this->input->post('user_id');
            $data['modified_by']        = $this->session->nama;
            
            // echo "<pre>";
            // return var_dump($data);
            
            $this->db->trans_begin();
            $this->m_ruangan->update('ruang', $data, $id);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data ruang gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data ruang berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('ruangan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Ruang - Badan Ekonomi Kreatif Indonesia')->build('f_ruangan', $d);
	}

	function delete()
	{
		$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
		if(! $this->input->is_ajax_request()) show_404();

		$id = decode($this->input->post('id', TRUE));

		$this->db->trans_begin();

		$this->m_ruangan->destroy('ruang', array('ruang_id' => $id));

		if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data ruang gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data ruang berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
	}

	function get_lantai()
	{
		$filter = $this->uri->segment(3);
		$data = $this->m_ruangan->fetch('lantai', array('lantai'=>$filter))->row_array();
		echo json_encode($data);
	}

    function autocomplete_pegawai_by_nama()
    {
        if(!$this->input->is_ajax_request()) show_404();

        $nama    = $this->input->post('nama');
        $data   = $this->m_ruangan->autocomplete_pegawai_by_nama($nama);

        echo json_encode($data);
    }

}

/* End of file Ruangan.php */
/* Location: ./application/modules/ruangan/controllers/Ruangan.php */
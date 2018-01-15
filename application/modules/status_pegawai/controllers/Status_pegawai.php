<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Status_pegawai extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_status_pegawai');

        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $d['page_title']    = 'Status Pegawai';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-status-pegawai" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Status Pegawai', 'Aksi');
        } else {
            $this->table->set_heading('Status Pegawai');
        }


        $this->template->set_layout('backoffice')->title('Status Pegawai - Badan Ekonomi Kreatif Indonesia')->build('v_status_pegawai', $d);
    }

    public function dt_status_pegawai(){
        if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('status_pegawai_id as kode, status_pegawai', FALSE)
            ->from('status_pegawai');

        $this->datatables->unset_column('kode');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('status_pegawai/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();

    }

    public function add(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Status Pegawai';
        $d['menus']         = $this->functions->generate_menu();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('status_pegawai', 'Status Pegawai', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            $this->db->trans_begin();

            $data['status_pegawai']      = $this->input->post('status_pegawai', true);
            $data['created_by']         = $this->session->nama;

            $this->m_status_pegawai->save('status_pegawai', $data, true);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data status pegawai gagal disimpan!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data status pegawai berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('status_pegawai');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Tambah Status Pegawai - Badan Ekonomi Kreatif Indonesia')->build('f_status_pegawai', $d);

    }

    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Status Pegawai';
        $d['menus']         = $this->functions->generate_menu();

        $status_pegawai_id = decode($this->uri->segment(3));
        if(!empty($status_pegawai_id)){
            $cek = $this->m_status_pegawai->fetch('status_pegawai', array('status_pegawai_id' => $status_pegawai_id));

            if($cek->num_rows() > 0){
                $d['status_pegawai']      =  $cek->row_array();

            } else {
                redirect('status_pegawai');
            }
        } else {
            redirect('status_pegawai');
        }


        $this->load->library('form_validation');

        $this->form_validation->set_rules('status_pegawai', 'Status Pegawai', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;
            $id['status_pegawai_id']             = $status_pegawai_id;

            $data['status_pegawai']              = $this->input->post('status_pegawai', true);
            $data['modified_by']        = $this->session->nama;

            $this->db->trans_begin();
            $this->m_status_pegawai->update('status_pegawai', $data, $id);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data status pegawai gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data status pegawai berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('status_pegawai');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Status Pegawai - Badan Ekonomi Kreatif Indonesia')->build('f_status_pegawai', $d);

    }

    public function delete(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $this->m_status_pegawai->destroy('status_pegawai', array('status_pegawai_id' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data status pegawai gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data status pegawai berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

}

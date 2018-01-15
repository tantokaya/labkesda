<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Status_peserta_kegiatan extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_status_peserta_kegiatan');

        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $d['page_title']    = 'Status Peserta Kegiatan';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-status-peserta" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Status Peserta', 'Aksi');
        } else {
            $this->table->set_heading('Status Peserta');
        }


        $this->template->set_layout('backoffice')->title('Status Peserta Kegiatan - Badan Ekonomi Kreatif Indonesia')->build('v_status_peserta_kegiatan', $d);
    }

    public function dt_status_peserta_kegiatan(){
        if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('status_peserta_id as kode, status_peserta', FALSE)
            ->from('status_peserta');

        $this->datatables->unset_column('kode');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('status_peserta_kegiatan/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();

    }

    public function add(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Status Peserta Kegiatan';
        $d['menus']         = $this->functions->generate_menu();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('status_peserta', 'Status Peserta', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            $this->db->trans_begin();

            $data['status_peserta']     = $this->input->post('status_peserta', true);
            $data['created_by']         = $this->session->nama;

            $this->m_status_peserta_kegiatan->save('status_peserta', $data, true);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data status peserta kegiatan gagal disimpan!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data status peserta kegiatan berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('status_peserta_kegiatan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Tambah Status Peserta Kegiatan - Badan Ekonomi Kreatif Indonesia')->build('f_status_peserta_kegiatan', $d);

    }

    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Status Peserta Kegiatan';
        $d['menus']         = $this->functions->generate_menu();

        $status_peserta_id = decode($this->uri->segment(3));
        if(!empty($status_peserta_id)){
            $cek = $this->m_status_peserta_kegiatan->fetch('status_peserta', array('status_peserta_id' => $status_peserta_id));

            if($cek->num_rows() > 0){
                $d['status_peserta']      =  $cek->row_array();

            } else {
                redirect('status_peserta_kegiatan');
            }
        } else {
            redirect('status_peserta_kegiatan');
        }


        $this->load->library('form_validation');

        $this->form_validation->set_rules('status_peserta', 'Status Peserta', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;
            $id['status_peserta_id']             = $status_peserta_id;

            $data['status_peserta']              = $this->input->post('status_peserta', true);
            $data['modified_by']        = $this->session->nama;

            $this->db->trans_begin();
            $this->m_status_peserta_kegiatan->update('status_peserta', $data, $id);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data status peserta kegiatan gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data status peserta kegiatan berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('status_peserta_kegiatan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Status Peserta Kegitan - Badan Ekonomi Kreatif Indonesia')->build('f_status_peserta_kegiatan', $d);

    }

    public function delete(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $this->m_status_peserta_kegiatan->destroy('status_peserta', array('status_peserta_id' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data status peserta kegiatan gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data status peserta kegiatan berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

}

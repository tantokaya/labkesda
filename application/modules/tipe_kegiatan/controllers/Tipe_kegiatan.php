<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Tipe_kegiatan extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_tipe_kegiatan');

        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $d['page_title']    = 'Tipe Kegiatan';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-tipe-kegiatan" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Tipe Kegiatan', 'Aksi');
        } else {
            $this->table->set_heading('Tipe Kegiatan');
        }


        $this->template->set_layout('backoffice')->title('Tipe Kegiatan - Badan Ekonomi Kreatif Indonesia')->build('v_tipe_kegiatan', $d);
    }

    public function dt_tipe_kegiatan(){
        if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('tipe_kegiatan_id as kode, tipe_kegiatan', FALSE)
            ->from('tipe_kegiatan');

        $this->datatables->unset_column('kode');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('tipe_kegiatan/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();

    }

    public function add(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Tipe Kegiatan';
        $d['menus']         = $this->functions->generate_menu();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('tipe_kegiatan', 'Tipe Kegiatan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            $this->db->trans_begin();

            $data['tipe_kegiatan']      = $this->input->post('tipe_kegiatan', true);
            $data['created_by']         = $this->session->nama;

            $this->m_tipe_kegiatan->save('tipe_kegiatan', $data, true);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data tipe kegiatan gagal disimpan!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data tipe kegiatan berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('tipe_kegiatan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Tambah Tipe Kegiatan - Badan Ekonomi Kreatif Indonesia')->build('f_tipe_kegiatan', $d);

    }

    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Tipe Kegiatan';
        $d['menus']         = $this->functions->generate_menu();

        $tipe_kegiatan_id = decode($this->uri->segment(3));
        if(!empty($tipe_kegiatan_id)){
            $cek = $this->m_tipe_kegiatan->fetch('tipe_kegiatan', array('tipe_kegiatan_id' => $tipe_kegiatan_id));

            if($cek->num_rows() > 0){
                $d['tipe_kegiatan']      =  $cek->row_array();

            } else {
                redirect('tipe_kegiatan');
            }
        } else {
            redirect('tipe_kegiatan');
        }


        $this->load->library('form_validation');

        $this->form_validation->set_rules('tipe_kegiatan', 'Tipe Kegiatan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;
            $id['tipe_kegiatan_id']             = $tipe_kegiatan_id;

            $data['tipe_kegiatan']              = $this->input->post('tipe_kegiatan', true);
            $data['modified_by']        = $this->session->nama;

            $this->db->trans_begin();
            $this->m_tipe_kegiatan->update('tipe_kegiatan', $data, $id);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data tipe kegiatan gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data tipe kegiatan berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('tipe_kegiatan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Tipe Kegiatan - Badan Ekonomi Kreatif Indonesia')->build('f_tipe_kegiatan', $d);

    }

    public function delete(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $this->m_tipe_kegiatan->destroy('tipe_kegiatan', array('tipe_kegiatan_id' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data tipe kegiatan gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data tipe kegiatan berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

}

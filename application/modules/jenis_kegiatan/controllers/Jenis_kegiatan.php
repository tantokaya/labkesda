<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Jenis_kegiatan extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_jenis_kegiatan');

        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $d['page_title']    = 'Jenis Kegiatan';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-jenis-kegiatan" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Jenis Kegiatan', 'Warna Jenis Kegiatan', 'Aksi');
        } else {
            $this->table->set_heading('Jenis Kegiatan', 'Warna Jenis Kegiatan');
        }


        $this->template->set_layout('backoffice')->title('Jenis Kegiatan - Badan Ekonomi Kreatif Indonesia')->build('v_jenis_kegiatan', $d);
    }

    public function dt_jenis_kegiatan(){
        if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('jenis_kegiatan_id as kode, jenis_kegiatan, warna_jenis_kegiatan', FALSE)
            ->from('jenis_kegiatan');

        $this->datatables->unset_column('kode');

        $this->datatables->edit_column('warna_jenis_kegiatan', '<div class="alert" style="background-color: $1; border-color: $1; color: #fff!important;padding:4px;margin-bottom:0px;"><span class="text-semibold">$1</span></div>' , 'warna_jenis_kegiatan');
        //$this->datatables->edit_column('warna_jenis_kegiatan', '<span class="label label-rounded">$1</span>' , 'warna_jenis_kegiatan');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('jenis_kegiatan/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();

    }

    public function add(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Jenis Kegiatan';
        $d['menus']         = $this->functions->generate_menu();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('jenis_kegiatan', 'Jenis Kegiatan', 'required');
        $this->form_validation->set_rules('warna_jenis_kegiatan', 'Warna Jenis Kegiatan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            $this->db->trans_begin();

            $data['jenis_kegiatan']              = $this->input->post('jenis_kegiatan', true);
            $data['warna_jenis_kegiatan']        = $this->input->post('warna_jenis_kegiatan', true);
            $data['created_by']                  = $this->session->nama;

            $this->m_jenis_kegiatan->save('jenis_kegiatan', $data, true);
            

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data jenis kegiatan gagal disimpan!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data jenis kegiatan berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('jenis_kegiatan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Tambah Jenis Kegiatan - Badan Ekonomi Kreatif Indonesia')->build('f_jenis_kegiatan', $d);

    }

    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Jenis Kegiatan';
        $d['menus']         = $this->functions->generate_menu();

        $jenis_kegiatan_id = decode($this->uri->segment(3));
        if(!empty($jenis_kegiatan_id)){
            $cek = $this->m_jenis_kegiatan->fetch('jenis_kegiatan', array('jenis_kegiatan_id' => $jenis_kegiatan_id));

            if($cek->num_rows() > 0){
                $d['jenis_kegiatan']      =  $cek->row_array();

            } else {
                redirect('jenis_kegiatan');
            }
        } else {
            redirect('jenis_kegiatan');
        }


        $this->load->library('form_validation');

        $this->form_validation->set_rules('jenis_kegiatan', 'Jenis Kegiatan', 'required');
        $this->form_validation->set_rules('warna_jenis_kegiatan', 'Warna Jenis Kegiatan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;
            $id['jenis_kegiatan_id']             = $jenis_kegiatan_id;

            $data['jenis_kegiatan']              = $this->input->post('jenis_kegiatan', true);
            $data['warna_jenis_kegiatan']        = $this->input->post('warna_jenis_kegiatan', true);
            $data['modified_by']        = $this->session->nama;

            $this->db->trans_begin();
            $this->m_jenis_kegiatan->update('jenis_kegiatan', $data, $id);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data jenis kegiatan gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data jenis kegiatan berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('jenis_kegiatan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Jenis Kegiatan - Badan Ekonomi Kreatif Indonesia')->build('f_jenis_kegiatan', $d);

    }

    public function delete(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $this->m_jenis_kegiatan->destroy('jenis_kegiatan', array('jenis_kegiatan_id' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data jenis kegiatan gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data jenis kegiatan berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

}

<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Akses extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_akses');

        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $d['page_title']    = 'Grup Pengguna';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-akses" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Grup Pengguna', 'Aksi');
        } else {
            $this->table->set_heading('Grup Pengguna');
        }


        $this->template->set_layout('backoffice')->title('Grup Pengguna - Badan Ekonomi Kreatif Indonesia')->build('v_akses', $d);
    }

    public function dt_akses(){
        if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('akses_id as kode, akses', FALSE)
            ->from('akses');

        $this->datatables->unset_column('kode');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('akses/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();

    }

    public function add(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Grup Pengguna';
        $d['menus']         = $this->functions->generate_menu();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('akses', 'Grup Pengguna', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            $this->db->trans_begin();

            $data['akses']              = $this->input->post('akses', true);
            $data['created_by']         = $this->session->nama;

            $akses_id = $this->m_akses->save('akses', $data, true);

            // insert akses menu for new user default 0
            $menu_list = $this->m_akses->fetch('menu')->result_array();
            foreach($menu_list as $menu):
                $akses_menu['akses_id']     = $akses_id;
                $akses_menu['menu_id']      = $menu['menu_id'];
                $akses_menu['read_priv']    = 0;
                $akses_menu['add_priv']     = 0;
                $akses_menu['edit_priv']    = 0;
                $akses_menu['delete_priv']  = 0;
                $akses_menu['created_by']   = $this->session->nama;

                $this->m_akses->save('akses_menu', $akses_menu);
            endforeach;

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data grup pengguna gagal disimpan!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data grup pengguna berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('akses');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Tambah Grup Pengguna - Badan Ekonomi Kreatif Indonesia')->build('f_akses', $d);

    }

    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Grup Pengguna';
        $d['menus']         = $this->functions->generate_menu();

        $akses_id = decode($this->uri->segment(3));
        if(!empty($akses_id)){
            $cek = $this->m_akses->fetch('akses', array('akses_id' => $akses_id));

            if($cek->num_rows() > 0){
                $d['akses']      =  $cek->row_array();

            } else {
                redirect('akses');
            }
        } else {
            redirect('akses');
        }


        $this->load->library('form_validation');

        $this->form_validation->set_rules('akses', 'Grup Pengguna', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;
            $id['akses_id']             = $akses_id;

            $data['akses']              = $this->input->post('akses', true);
            $data['modified_by']        = $this->session->nama;

            $this->db->trans_begin();
            $this->m_akses->update('akses', $data, $id);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data grup pengguna gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data grup pengguna berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('akses');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Grup Pengguna - Badan Ekonomi Kreatif Indonesia')->build('f_akses', $d);

    }

    public function delete(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $this->m_akses->destroy('akses', array('akses_id' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data grup pengguna gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data grup pengguna berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

}

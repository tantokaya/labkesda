<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Hartanto Kurniawan.
 * Email  : hartanto.kurniawan@bppt.go.id
 * Copyrights 2018
 */

class Sub_gol_tindakan extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_sub_gol_tindakan');

        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $d['page_title']    = 'Sub Golongan Tindakan';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-sub-gol-tindakan" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Nama', 'Aksi');
        } else {
            $this->table->set_heading('Nama');
        }


        $this->template->set_layout('backoffice')->title('Sub Gol Tindakan - Labkesda')->build('v_sub_gol_tindakan', $d);
    }

    public function dt_sub_gol_tindakan(){
        if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('sub_gol_tind_id as kode, sub_gol_tind_nama', FALSE)
            ->from('mst_sub_gol_tind');

        $this->datatables->unset_column('kode');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('sub_gol_tindakan/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();

    }

    public function add(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Sub Gol Tindakan';
        $d['menus']         = $this->functions->generate_menu();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('sub_gol_tind_nama', 'Golongan Tindakan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            $this->db->trans_begin();

            $data['sub_gol_tind_nama'] = $this->input->post('sub_gol_tind_nama', true);
            $data['created_by']        = $this->session->nama;

            $this->m_gol_tindakan->save('mst_gol_tindakan', $data, true);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data sub gol tindakan gagal disimpan!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data sub gol tindakan berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('sub_gol_tindakan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Tambah Sub Gol Tindakan - Labkesda')->build('f_sub_gol_tindakan', $d);

    }

    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Sub Gol Tindakan';
        $d['menus']         = $this->functions->generate_menu();

        $sub_gol_tind_id = decode($this->uri->segment(3));
        if(!empty($sub_gol_tind_id)){
            $cek = $this->m_sub_gol_tindakan->fetch('mst_sub_gol_tind', array('sub_gol_tind_id' => $sub_gol_tind_id));

            if($cek->num_rows() > 0){
                $d['sub_gol_tind']      =  $cek->row_array();

            } else {
                redirect('sub_gol_tindakan');
            }
        } else {
            redirect('sub_gol_tindakan');
        }


        $this->load->library('form_validation');

        $this->form_validation->set_rules('sub_gol_tind_nama', 'Sub Gol Tindakan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;
            $id['sub_gol_tind_id']      = $sub_gol_tind_id;

            $data['sub_gol_tind_nama']  = $this->input->post('sub_gol_tind_nama', true);
            $data['modified_by']        = $this->session->nama;

            $this->db->trans_begin();
            $this->m_sub_gol_tindakan->update('mst_sub_gol_tind', $data, $id);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data Sub Gol Tindakan gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data Sub Gol Tindakan berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('sub_gol_tindakan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Sub Gol Tindakan - Labkesda')->build('f_sub_gol_tindakan', $d);

    }

    public function delete(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $this->m_sub_gol_tindakan->destroy('mst_sub_gol_tind', array('sub_gol_tind_id' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data sub gol tindakan gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data sub gol tindakan berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

}

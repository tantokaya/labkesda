<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Hartanto Kurniawan.
 * Email  : hartanto.kurniawan@bppt.go.id
 * Copyrights 2018
 */

class Gol_tindakan extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_gol_tindakan');

        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $d['page_title']    = 'Golongan Tindakan';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-gol-tindakan" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Nama', 'Aksi');
        } else {
            $this->table->set_heading('Nama');
        }


        $this->template->set_layout('backoffice')->title('Gol Tindakan - Labkesda')->build('v_gol_tindakan', $d);
    }

    public function dt_gol_tindakan(){
        if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('gol_tindakan_id as kode, gol_tindakan_nama', FALSE)
            ->from('mst_gol_tindakan');

        $this->datatables->unset_column('kode');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('gol_tindakan/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();

    }

    public function add(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Gol Tindakan';
        $d['menus']         = $this->functions->generate_menu();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('gol_tindakan_nama', 'Golongan Tindakan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            $this->db->trans_begin();

            $data['gol_tindakan_nama'] = $this->input->post('gol_tindakan_nama', true);
            $data['created_by']        = $this->session->nama;

            $this->m_gol_tindakan->save('mst_gol_tindakan', $data, true);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data gol tindakan gagal disimpan!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data gol tindakan berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('gol_tindakan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Tambah Gol Tindakan - Labkesda')->build('f_gol_tindakan', $d);

    }

    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Gol Tindakan';
        $d['menus']         = $this->functions->generate_menu();

        $gol_tindakan_id = decode($this->uri->segment(3));
        if(!empty($gol_tindakan_id)){
            $cek = $this->m_gol_tindakan->fetch('mst_gol_tindakan', array('gol_tindakan_id' => $gol_tindakan_id));

            if($cek->num_rows() > 0){
                $d['gol_tindakan']      =  $cek->row_array();

            } else {
                redirect('gol_tindakan');
            }
        } else {
            redirect('gol_tindakan');
        }


        $this->load->library('form_validation');

        $this->form_validation->set_rules('gol_tindakan_nama', 'Gol Tindakan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;
            $id['gol_tindakan_id']      = $gol_tindakan_id;

            $data['gol_tindakan_nama']  = $this->input->post('gol_tindakan_nama', true);
            $data['modified_by']        = $this->session->nama;

            $this->db->trans_begin();
            $this->m_gol_tindakan->update('mst_gol_tindakan', $data, $id);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data Gol Tindakan gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data Gol Tindakan berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('gol_tindakan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Gol Tindakan - Labkesda')->build('f_gol_tindakan', $d);

    }

    public function delete(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $this->m_gol_tindakan->destroy('mst_gol_tindakan', array('gol_tindakan_id' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data gol tindakan gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data gol tindakan berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

}

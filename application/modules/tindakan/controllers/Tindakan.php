<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Hartanto Kurniawan.
 * Email  : hartanto.kurniawan@bppt.go.id
 * Copyrights 2018
 */

class Tindakan extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_tindakan');

        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $d['page_title']    = 'Tindakan';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-tindakan" width="100%" class="table table-striped table-hover table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Tindakan','Gol.Tindakan','Sub Gol Tindakan','Tarif', 'Aksi');
        } else {
            $this->table->set_heading('Tindakan','Gol.Tindakan','Sub Gol Tindakan','Tarif');
        }


        $this->template->set_layout('backoffice')->title('Tindakan - Labkesda')->build('v_tindakan', $d);
    }

    public function dt_tindakan(){
        if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('kd_tindakan as kode, tindakan, gol_tindakan_nama, sub_gol_tind_nama, harga', FALSE)
            ->from('mst_tindakan ti')
            ->join('mst_gol_tindakan gt','gt.gol_tindakan_id = ti.gol_tindakan_id')
            ->join('mst_sub_gol_tind sgt','sgt.sub_gol_tind_id = ti.sub_gol_tind_id');

        $this->datatables->unset_column('kode');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('tindakan/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();

    }

    public function add(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Tindakan';
        $d['menus']         = $this->functions->generate_menu();

        $d['l_gol_tindakan']        = $this->m_tindakan->fetch('mst_gol_tindakan')->result_array();
        $d['l_sub_gol_tindakan']    = $this->m_tindakan->fetch('mst_sub_gol_tind')->result_array();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('tindakan', 'Tindakan', 'required');
        $this->form_validation->set_rules('gol_tindakan_id', 'GOl Tindakan', 'required');
        $this->form_validation->set_rules('sub_gol_tind_id', 'Sub GOl Tindakan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            $this->db->trans_begin();

            $data['tindakan']           = $this->input->post('tindakan', true);
            $data['gol_tindakan_id']    = $this->input->post('gol_tindakan_id', true);
            $data['sub_gol_tind_id']    = $this->input->post('sub_gol_tind_id', true);
            $data['singkatan']          = $this->input->post('singkatan', true);
            $data['n_rujukan']          = $this->input->post('n_rujukan', true);
            $data['harga_sarana']       = $this->input->post('harga_sarana', true);
            $data['harga']              = $this->input->post('harga', true);
            $data['is_default']         = $this->input->post('publish', true);
            $data['created_by']         = $this->session->nama;

            $this->m_tindakan->save('mst_tindakan', $data, true);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data tindakan gagal disimpan!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data tindakan berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('tindakan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Tambah Tindakan - Labkesda')->build('f_tindakan', $d);

    }

    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Tindakan';
        $d['menus']         = $this->functions->generate_menu();

        $d['l_gol_tindakan']        = $this->m_tindakan->fetch('mst_gol_tindakan')->result_array();
        $d['l_sub_gol_tindakan']    = $this->m_tindakan->fetch('mst_sub_gol_tind')->result_array();

        $tindakan_id = decode($this->uri->segment(3));
        if(!empty($tindakan_id)){
            $cek = $this->m_tindakan->fetch('mst_tindakan', array('kd_tindakan' => $tindakan_id));

            if($cek->num_rows() > 0){
                $d['tindakan']      =  $cek->row_array();

            } else {
                redirect('tindakan');
            }
        } else {
            redirect('tindakan');
        }


        $this->load->library('form_validation');

        $this->form_validation->set_rules('tindakan', 'Tindakan', 'required');
        $this->form_validation->set_rules('gol_tindakan_id', 'GOl Tindakan', 'required');
        $this->form_validation->set_rules('sub_gol_tind_id', 'Sub GOl Tindakan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;
            $id['kd_tindakan']      = $tindakan_id;

            $data['tindakan']           = $this->input->post('tindakan', true);
            $data['gol_tindakan_id']    = $this->input->post('gol_tindakan_id', true);
            $data['sub_gol_tind_id']    = $this->input->post('sub_gol_tind_id', true);
            $data['singkatan']          = $this->input->post('singkatan', true);
            $data['n_rujukan']          = $this->input->post('n_rujukan', true);
            $data['harga_sarana']       = $this->input->post('harga_sarana', true);
            $data['harga']              = $this->input->post('harga', true);
            $data['is_default']         = $this->input->post('publish', true);
            $data['modified_by']        = $this->session->nama;

            $this->db->trans_begin();
            $this->m_tindakan->update('mst_tindakan', $data, $id);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data Tindakan gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data Tindakan berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('tindakan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Tindakan - Labkesda')->build('f_tindakan', $d);

    }

    public function delete(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $this->m_tindakan->destroy('mst_tindakan', array('tindakan_id' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data tindakan gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data tindakan berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

}

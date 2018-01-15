<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Sbk_fgd extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_sbk_fgd');

        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $d['page_title']    = 'SBK FGD';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-sbk-fgd" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Nama Provinsi','Fullboard Luar Kota','Fullboard Dalam Kota','Fullday / Halfday Dalam Kota', 'Aksi');
        } else {
            $this->table->set_heading('Nama Provinsi','Fullboard Luar Kota','Fullboard Dalam Kota','Fullday / Halfday Dalam Kota');
        }


        $this->template->set_layout('backoffice')->title('SBK FGD - Badan Ekonomi Kreatif Indonesia')->build('v_sbk_fgd', $d);
    }

    public function dt_sbk_fgd(){
        if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('harian_fgd.propinsi_id as kode,propinsi,fblk,fbdk,fddk', FALSE)
            ->from('harian_fgd')
            ->join('propinsi','propinsi.propinsi_id = harian_fgd.propinsi_id');

        $this->datatables->unset_column('kode');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('sbk_fgd/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();

    }


    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah SBK FGD';
        $d['menus']         = $this->functions->generate_menu();

        $propinsi_id = decode($this->uri->segment(3));
        //echo $propinsi_id; exit;
        if(!empty($propinsi_id)){
            $cek = $this->m_sbk_fgd->fetch('harian_fgd', array('harian_fgd.propinsi_id' => $propinsi_id),NULL, 'propinsi','propinsi.propinsi_id = harian_fgd.propinsi_id');

            if($cek->num_rows() > 0){
                $d['sbk_fgd']      =  $cek->row_array();

            } else {
                redirect('sbk_fgd');
            }
        } else {
            redirect('sbk_fgd');
        }


        $this->load->library('form_validation');

        $this->form_validation->set_rules('fblk', 'Fullboard Luar Kota', 'required');
        $this->form_validation->set_rules('fbdk', 'Fullboard Dalam Kota ','required');
        $this->form_validation->set_rules('fddk', 'Fullday','required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;
            $id['propinsi_id']         = $propinsi_id;

            $data['fblk']              = $this->input->post('fblk', true);
            $data['fbdk']              = $this->input->post('fbdk', true);
            $data['fddk']              = $this->input->post('fddk', true);
            $data['modified_by']       = $this->session->nama;

            $this->db->trans_begin();
            $this->m_sbk_fgd->update('harian_fgd', $data, $id);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data SBK FGD gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data SBK FGD berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('sbk_fgd');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah SBK FGD - Badan Ekonomi Kreatif Indonesia')->build('f_sbk_fgd', $d);

    }

    public function delete(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $this->m_sbk_fgd->destroy('harian_fgd', array('propinsi_id' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data SBK FGD gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data SBK FGD berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

}

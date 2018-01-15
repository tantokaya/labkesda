<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Wilayah_administrasi extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));


        $this->load->model('m_wilayah_administrasi');

        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $d['page_title']    = 'Wilayah Administrasi';
        $d['panel_title']   = 'Data Propinsi Indonesia';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-propinsi" width="100%" class="table table-striped table-responsive table-bordered datatable">');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Propinsi', 'Aksi');
        } else {
            $this->table->set_heading('Propinsi');
        }


        $this->template->set_layout('backoffice')->title('Data Propinsi - Badan Ekonomi Kreatif Indonesia')->build('v_wilayah_administrasi', $d);
    }

    public function kota()
    {
        $propinsi_id        = $this->uri->segment(3);
        $d['propinsi']      = $this->m_wilayah_administrasi->fetch('propinsi', array('propinsi_id' => $propinsi_id))->row_array();
        $d['page_title']    = 'Wilayah Administrasi';
        $d['panel_title']   = 'Data Kota/Kabupaten di Propinsi '.ucwords(strtolower($d['propinsi']['propinsi']));
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);


        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-kota" width="100%" class="table table-striped table-responsive table-bordered datatable">');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Kota', 'Aksi');
        } else {
            $this->table->set_heading('Kota');
        }


        $this->template->set_layout('backoffice')->title('Data Kota/Kabupaten - Badan Ekonomi Kreatif Indonesia')->build('v_kota', $d);
    }

    public function kecamatan()
    {
        $kota_id            = $this->uri->segment(3);
        $d['propinsi']      = $this->m_wilayah_administrasi->fetch('propinsi', array('propinsi_id' => substr($kota_id,0,2)))->row_array();
        $d['kota']          = $this->m_wilayah_administrasi->fetch('kota', array('kota_id' => $kota_id))->row_array();
        $d['page_title']    = 'Data Wilayah Administrasi';
        $d['panel_title']   = 'Data Kecamatan di '.ucwords(strtolower($d['kota']['kota']));
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);


        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-kecamatan" width="100%" class="table table-striped table-responsive table-bordered datatable">');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Kecamatan', 'Aksi');
        } else {
            $this->table->set_heading('Kecamatan');
        }


        $this->template->set_layout('backoffice')->title('Data Kecamatan - Badan Ekonomi Kreatif Indonesia')->build('v_kecamatan', $d);
    }

    public function kelurahan()
    {
        $kecamatan_id       = $this->uri->segment(3);
        $d['propinsi']      = $this->m_wilayah_administrasi->fetch('propinsi', array('propinsi_id' => substr($kecamatan_id,0,2)))->row_array();
        $d['kota']          = $this->m_wilayah_administrasi->fetch('kota', array('kota_id' => substr($kecamatan_id,0,4)))->row_array();
        $d['kecamatan']     = $this->m_wilayah_administrasi->fetch('kecamatan', array('kecamatan_id' => $kecamatan_id))->row_array();
        $d['page_title']    = 'Data Wilayah Administrasi';
        $d['panel_title']   = 'Data Kelurahan di Kecamatan '.ucwords(strtolower($d['kecamatan']['kecamatan']));
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);


        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-kelurahan" width="100%" class="table table-striped table-responsive table-bordered datatable">');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Kelurahan', 'Aksi');
        } else {
            $this->table->set_heading('Kelurahan');
        }


        $this->template->set_layout('backoffice')->title('Data Kecamatan - Badan Ekonomi Kreatif Indonesia')->build('v_kelurahan', $d);
    }

    public function dt_propinsi(){
        if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('propinsi_id as kode, propinsi', FALSE)
            ->from('propinsi');

        $this->datatables->unset_column('kode');

        $this->datatables->edit_column('propinsi', '<a href="'.base_url('wilayah_administrasi/kota/$1').'" class="text-info">$2</a>', 'kode,propinsi');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('wilayah_administrasi/edit/propinsi/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'kode');

        echo $this->datatables->generate();

    }

    public function dt_kota(){
        if(!$this->input->is_ajax_request()) show_404();

        $propinsi_id = $this->input->post('propinsi_id', true);

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('kota_id as kode, kota', FALSE)
            ->from('kota')
            ->where('SUBSTRING(kota_id,1,2)', $propinsi_id);

        $this->datatables->unset_column('kode');

        $this->datatables->edit_column('kota', '<a href="'.base_url('wilayah_administrasi/kecamatan/$1').'" class="text-info">$2</a>', 'kode,kota');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('wilayah_administrasi/edit/kota/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'kode');

        echo $this->datatables->generate();

    }

    public function dt_kecamatan(){
        if(!$this->input->is_ajax_request()) show_404();

        $kota_id = $this->input->post('kota_id', true);

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('kecamatan_id as kode, kecamatan', FALSE)
            ->from('kecamatan')
            ->where('SUBSTRING(kecamatan_id,1,4)', $kota_id);

        $this->datatables->unset_column('kode');

        $this->datatables->edit_column('kecamatan', '<a href="'.base_url('wilayah_administrasi/kelurahan/$1').'" class="text-info">$2</a>', 'kode,kecamatan');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('wilayah_administrasi/edit/kecamatan/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'kode');

        echo $this->datatables->generate();

    }

    public function dt_kelurahan(){
        if(!$this->input->is_ajax_request()) show_404();

        $kecamatan_id = $this->input->post('kecamatan_id', true);

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('kelurahan_id as kode, kelurahan', FALSE)
            ->from('kelurahan')
            ->where('SUBSTRING(kelurahan_id,1,6)', $kecamatan_id);

        $this->datatables->unset_column('kode');


        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('wilayah_administrasi/edit/kelurahan/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'kode');

        echo $this->datatables->generate();

    }

    public function add(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Data Wilayah Administrasi';
        $d['menus']         = $this->functions->generate_menu();

        $this->load->library('form_validation');

        $type = $this->uri->segment(3);
        switch($type){
            case 'propinsi':
                $d['panel_title']   = 'Tambah Data Propinsi';
                $this->form_validation->set_rules('propinsi_id', 'Kode Propinsi', 'required|exact_length[2]');
                $this->form_validation->set_rules('propinsi', 'Propinsi', 'required|max_length[50]');

                if ($this->form_validation->run() == FALSE) {
                    // do nothing
                    $this->template->set_layout('backoffice')->title('Tambah Data Propinsi - Badan Ekonomi Kreatif Indonesia')->build('f_wilayah_administrasi', $d);
                } else {
                    $data['propinsi_id']    = $this->input->post('propinsi_id', true);
                    $data['propinsi']       = strtoupper($this->input->post('propinsi', true));
                    $data['created_by']     = $this->session->nama;

                    $this->db->trans_begin();

                    $this->m_wilayah_administrasi->save('propinsi', $data);

                    if ($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        $message                        = "Data propinsi gagal dsimpan!";
                        $type                           = "error";
                    } else {
                        $this->db->trans_commit();
                        $message                        = "Data propinsi berhasil disimpan!";
                        $type                           = "success";
                    }

                    $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

                    redirect('wilayah_administrasi');
                }

                break;
            case 'kota':
                $d['panel_title']   = 'Tambah Data Kota/Kabupaten';
                $d['propinsi']      = $this->m_wilayah_administrasi->fetch('propinsi', array('propinsi_id' => $this->uri->segment(4)))->row_array();
                $this->form_validation->set_rules('kota_id', 'Kode Kota', 'required|exact_length[4]');
                $this->form_validation->set_rules('kota', 'Kota', 'required|max_length[50]');

                if ($this->form_validation->run() == FALSE) {
                    // do nothing
                    $this->template->set_layout('backoffice')->title('Tambah Data Kota - Badan Ekonomi Kreatif Indonesia')->build('f_kota', $d);
                } else {
                    $data['kota_id'] = $this->input->post('kota_id', true);
                    $data['kota'] = strtoupper($this->input->post('kota', true));
                    $data['created_by']     = $this->session->nama;

                    $this->db->trans_begin();

                    $this->m_wilayah_administrasi->save('kota', $data);

                    if ($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        $message                        = "Data kota gagal disimpan!";
                        $type                           = "error";
                    } else {
                        $this->db->trans_commit();
                        $message                        = "Data kota berhasil disimpan!";
                        $type                           = "success";
                    }

                    $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

                    redirect('wilayah_administrasi/kota/'. $this->uri->segment(4));
                }

                break;
            case 'kecamatan';
                $d['panel_title']   = 'Tambah Data Kecamatan';
                $d['propinsi']      = $this->m_wilayah_administrasi->fetch('propinsi', array('propinsi_id' => substr($this->uri->segment(4),0,2)))->row_array();
                $d['kota']          = $this->m_wilayah_administrasi->fetch('kota', array('kota_id' => $this->uri->segment(4)))->row_array();

                $this->form_validation->set_rules('kecamatan_id', 'Kode Kecamatan', 'required|exact_length[6]');
                $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|max_length[50]');

                if ($this->form_validation->run() == FALSE) {
                    // do nothing
                    $this->template->set_layout('backoffice')->title('Tambah Data Kecamatan - Badan Ekonomi Kreatif Indonesia')->build('f_kecamatan', $d);
                } else {
                    $data['kecamatan_id']   = $this->input->post('kecamatan_id', true);
                    $data['kecamatan']      = strtoupper($this->input->post('kecamatan', true));
                    $data['created_by']     = $this->session->nama;

                    $this->db->trans_begin();

                    $this->m_wilayah_administrasi->save('kecamatan', $data);

                    if ($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        $message                        = "Data kecamatan gagal disimpan!";
                        $type                           = "error";
                    } else {
                        $this->db->trans_commit();
                        $message                        = "Data kecamatan berhasil disimpan!";
                        $type                           = "success";
                    }

                    $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

                    redirect('wilayah_administrasi/kecamatan/'. $this->uri->segment(4));
                }

                break;
            case 'kelurahan';
                $d['panel_title']   = 'Tambah Data Kelurahan/Desa';
                $d['propinsi']      = $this->m_wilayah_administrasi->fetch('propinsi', array('propinsi_id' => substr($this->uri->segment(4),0,2)))->row_array();
                $d['kota']          = $this->m_wilayah_administrasi->fetch('kota', array('kota_id' => substr($this->uri->segment(4),0,4)))->row_array();
                $d['kecamatan']     = $this->m_wilayah_administrasi->fetch('kecamatan', array('kecamatan_id' => $this->uri->segment(4)))->row_array();

                $this->form_validation->set_rules('kelurahan_id', 'Kode Kelurahan', 'required|exact_length[10]');
                $this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required|max_length[50]');

                if ($this->form_validation->run() == FALSE) {
                    // do nothing
                    $this->template->set_layout('backoffice')->title('Tambah Data Kelurahan - Badan Ekonomi Kreatif Indonesia')->build('f_kelurahan', $d);
                } else {
                    $data['kelurahan_id']   = $this->input->post('kelurahan_id', true);
                    $data['kelurahan']      = strtoupper($this->input->post('kelurahan', true));
                    $data['created_by']     = $this->session->nama;

                    $this->db->trans_begin();

                    $this->m_wilayah_administrasi->save('kelurahan', $data);

                    if ($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        $message                        = "Data kelurahan gagal disimpan!";
                        $type                           = "error";
                    } else {
                        $this->db->trans_commit();
                        $message                        = "Data kelurahan berhasil disimpan!";
                        $type                           = "success";
                    }

                    $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

                    redirect('wilayah_administrasi/kelurahan/'. $this->uri->segment(4));
                }

                break;
        }

        #echo '<pre>'; print_r($d); exit;

    }

    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Data Wilayah Administrasi';
        $d['menus']         = $this->functions->generate_menu();

        $type               = $this->uri->segment(3);
        $id                 = $this->uri->segment(4);

        $this->load->library('form_validation');

        switch($type){
            case 'propinsi':
                $d['panel_title']   = 'Ubah Data Propinsi';
                if(!empty($id)){
                    $cek = $this->m_wilayah_administrasi->fetch('propinsi', array('propinsi_id' => $id));

                    if($cek->num_rows() > 0){
                        $d['propinsi']      =  $cek->row_array();

                    } else {
                        redirect('wilayah_administrasi');
                    }
                } else {
                    redirect('wilayah_administrasi');
                }

                $this->form_validation->set_rules('propinsi_id', 'Kode Propinsi', 'required|exact_length[2]');
                $this->form_validation->set_rules('propinsi', 'Propinsi', 'required|max_length[50]');

                if ($this->form_validation->run() == FALSE) {
                    $this->template->set_layout('backoffice')->title('Ubah Data Propinsi - Badan Ekonomi Kreatif Indonesia')->build('f_wilayah_administrasi', $d);
                } else {
                    #echo '<pre>'; print_r($this->input->post()); exit;

                    $data['propinsi_id']    = $this->input->post('propinsi_id', true);
                    $data['propinsi']       = strtoupper($this->input->post('propinsi', true));
                    $data['modified_by']    = $this->session->nama;

                    $this->db->trans_begin();

                    $this->m_wilayah_administrasi->update('propinsi', $data, array('propinsi_id' => $id));

                    if ($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        $message                        = "Data propinsi gagal diperbaharui!";
                        $type                           = "error";
                    } else {
                        $this->db->trans_commit();
                        $message                        = "Data propinsi berhasil diperbaharui!";
                        $type                           = "success";
                    }

                    $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

                    redirect('wilayah_administrasi');
                }

                break;
            case 'kota':
                $d['panel_title']   = 'Ubah Data Kota/Kabupaten';

                if(!empty($id)){
                    $cek = $this->m_wilayah_administrasi->fetch('kota', array('kota_id' => $id));

                    if($cek->num_rows() > 0){
                        $d['kota']      =  $cek->row_array();

                    } else {
                        redirect('wilayah_administrasi/edit/kota/'.$id);
                    }
                } else {
                    redirect('wilayah_administrasi');
                }

                $d['propinsi']      = $this->m_wilayah_administrasi->fetch('propinsi', array('propinsi_id' => substr($this->uri->segment(4),0,2)))->row_array();

                $this->form_validation->set_rules('kota_id', 'Kode Kota', 'required|exact_length[4]');
                $this->form_validation->set_rules('kota', 'Kota', 'required|max_length[50]');

                if ($this->form_validation->run() == FALSE) {
                    $this->template->set_layout('backoffice')->title('Ubah Data Kota/Kabupaten - Badan Ekonomi Kreatif Indonesia')->build('f_kota', $d);
                } else {
                    #echo '<pre>'; print_r($this->input->post()); exit;

                    $data['kota_id']        = $this->input->post('kota_id', true);
                    $data['kota']           = strtoupper($this->input->post('kota', true));
                    $data['modified_by']    = $this->session->nama;

                    $this->db->trans_begin();

                    $this->m_wilayah_administrasi->update('kota', $data, array('kota_id' => $id));

                    if ($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        $message                        = "Data kota gagal diperbaharui!";
                        $type                           = "error";
                    } else {
                        $this->db->trans_commit();
                        $message                        = "Data kota berhasil diperbaharui!";
                        $type                           = "success";
                    }

                    $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

                    redirect('wilayah_administrasi/kota/'.substr($id,0,2));
                }

                break;
            case 'kecamatan':
                $d['panel_title']   = 'Ubah Data Kecamatan';
                if(!empty($id)){
                    $cek = $this->m_wilayah_administrasi->fetch('kecamatan', array('kecamatan_id' => $id));

                    if($cek->num_rows() > 0){
                        $d['kecamatan']      =  $cek->row_array();

                    } else {
                        redirect('wilayah_administrasi/edit/kecamatan/'.$id);
                    }
                } else {
                    redirect('wilayah_administrasi');
                }

                $d['propinsi']      = $this->m_wilayah_administrasi->fetch('propinsi', array('propinsi_id' => substr($this->uri->segment(4),0,2)))->row_array();
                $d['kota']          = $this->m_wilayah_administrasi->fetch('kota', array('kota_id' => substr($this->uri->segment(4),0,4)))->row_array();

                $this->form_validation->set_rules('kecamatan_id', 'Kode Kecamatan', 'required|exact_length[6]');
                $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|max_length[50]');

                if ($this->form_validation->run() == FALSE) {
                    $this->template->set_layout('backoffice')->title('Ubah Data Kecamatan - Badan Ekonomi Kreatif Indonesia')->build('f_kecamatan', $d);
                } else {
                    #echo '<pre>'; print_r($this->input->post()); exit;

                    $data['kecamatan_id']        = $this->input->post('kecamatan_id', true);
                    $data['kecamatan']           = strtoupper($this->input->post('kecamatan', true));
                    $data['modified_by']         = $this->session->nama;

                    $this->db->trans_begin();

                    $this->m_wilayah_administrasi->update('kecamatan', $data, array('kecamatan_id' => $id));

                    if ($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        $message                        = "Data kecamatan gagal diperbaharui!";
                        $type                           = "error";
                    } else {
                        $this->db->trans_commit();
                        $message                        = "Data kecamatan berhasil diperbaharui!";
                        $type                           = "success";
                    }

                    $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

                    redirect('wilayah_administrasi/kecamatan/'.substr($id,0,4));
                }

                break;
            case 'kelurahan':
                $d['panel_title']   = 'Ubah Data Kelurahan/Desa';
                if(!empty($id)){
                    $cek = $this->m_wilayah_administrasi->fetch('kelurahan', array('kelurahan_id' => $id));

                    if($cek->num_rows() > 0){
                        $d['kelurahan']      =  $cek->row_array();

                    } else {
                        redirect('wilayah_administrasi/edit/kelurahan/'.$id);
                    }
                } else {
                    redirect('wilayah_administrasi');
                }

                $d['propinsi']      = $this->m_wilayah_administrasi->fetch('propinsi', array('propinsi_id' => substr($this->uri->segment(4),0,2)))->row_array();
                $d['kota']          = $this->m_wilayah_administrasi->fetch('kota', array('kota_id' => substr($this->uri->segment(4),0,4)))->row_array();
                $d['kecamatan']     = $this->m_wilayah_administrasi->fetch('kecamatan', array('kecamatan_id' => substr($this->uri->segment(4),0,6)))->row_array();

                $this->form_validation->set_rules('kelurahan_id', 'Kode Kelurahan', 'required|exact_length[10]');
                $this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required|max_length[50]');

                if ($this->form_validation->run() == FALSE) {
                    $this->template->set_layout('backoffice')->title('Ubah Data Kelurahan - Badan Ekonomi Kreatif Indonesia')->build('f_kelurahan', $d);
                } else {
                    #echo '<pre>'; print_r($this->input->post()); exit;

                    $data['kelurahan_id']        = $this->input->post('kelurahan_id', true);
                    $data['kelurahan']           = strtoupper($this->input->post('kelurahan', true));
                    $data['modified_by']    = $this->session->nama;

                    $this->db->trans_begin();

                    $this->m_wilayah_administrasi->update('kelurahan', $data, array('kelurahan_id' => $id));

                    if ($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        $message                        = "Data kelurahan gagal diperbaharui!";
                        $type                           = "error";
                    } else {
                        $this->db->trans_commit();
                        $message                        = "Data kelurahan berhasil diperbaharui!";
                        $type                           = "success";
                    }

                    $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

                    redirect('wilayah_administrasi/kelurahan/'.substr($id,0,6));
                }

                break;
        }

        #echo '<pre>'; print_r($d); exit;

    }

    public function delete(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $type = $this->uri->segment(3);

        if(empty($type)) show_404();

        switch($type){
            case 'propinsi':
                $id['propinsi_id'] = $this->input->post('id', true);

                $this->db->trans_begin();

                $this->m_wilayah_administrasi->destroy('propinsi', $id);

                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $result['message']  = "Data propinsi gagal dihapus!";
                    $result['type']     = "error";
                } else {
                    $this->db->trans_commit();
                    $result['message']  = "Data propinsi berhasil dihapus!";
                    $result['type']     = "success";
                }

                break;
            case 'kota':
                $id['kota_id'] = $this->input->post('id', true);

                $this->db->trans_begin();

                $this->m_wilayah_administrasi->destroy('kota', $id);

                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $result['message']  = "Data kota/kabupaten gagal dihapus!";
                    $result['type']     = "error";
                } else {
                    $this->db->trans_commit();
                    $result['message']  = "Data kota/kabupaten berhasil dihapus!";
                    $result['type']     = "success";
                }

                break;
            case 'kecamatan':
                $id['kecamatan_id'] = $this->input->post('id', true);

                $this->db->trans_begin();

                $this->m_wilayah_administrasi->destroy('kecamatan', $id);

                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $result['message']  = "Data kecamatan gagal dihapus!";
                    $result['type']     = "error";
                } else {
                    $this->db->trans_commit();
                    $result['message']  = "Data kecamatan berhasil dihapus!";
                    $result['type']     = "success";
                }

                break;
            case 'kelurahan':
                $id['kelurahan_id'] = $this->input->post('id', true);

                $this->db->trans_begin();

                $this->m_wilayah_administrasi->destroy('kelurahan', $id);

                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $result['message']  = "Data kelurahan/desa gagal dihapus!";
                    $result['type']     = "error";
                } else {
                    $this->db->trans_commit();
                    $result['message']  = "Data kelurahan/desa berhasil dihapus!";
                    $result['type']     = "success";
                }

                break;
        }

        echo json_encode($result);
    }

}

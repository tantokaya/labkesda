<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Pegawai extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_pegawai');

        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $d['page_title']    = 'Pegawai';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-pegawai" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('NIP', 'Nama Pegawai', 'Tempat Lahir', 'Tanggal Lahir', 'Aksi');
        } else {
            $this->table->set_heading('NIP', 'Nama Pegawai', 'Tempat Lahir', 'Tanggal Lahir');
        }


        $this->template->set_layout('backoffice')->title('Pegawai - Badan Ekonomi Kreatif Indonesia')->build('v_pegawai', $d);
    }

    public function dt_pegawai(){
        if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('pegawai_id as kode, nip, nm_pegawai, tempat_lahir, DATE_FORMAT(tanggal_lahir,\'%d/%m/%Y\') as tanggal_lahir', FALSE)
            ->from('pegawai');

        $this->datatables->unset_column('kode');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('pegawai/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();

    }

    public function add(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']        = 'Tambah Pegawai';
        $d['menus']             = $this->functions->generate_menu();

        $d['l_jenis_kelamin']   = $this->m_pegawai->fetch('jenis_kelamin')->result_array();
        $d['l_agama']           = $this->m_pegawai->fetch('agama')->result_array();
        $d['l_speg']            = $this->m_pegawai->fetch('status_pegawai')->result_array();
        $d['l_sjab']            = $this->m_pegawai->fetch('status_jabatan')->result_array();
        $d['l_golongan']        = $this->m_pegawai->fetch('golongan')->result_array();
        $d['l_eselon']          = $this->m_pegawai->fetch('eselon')->result_array();
        $d['l_propinsi']        = $this->m_pegawai->fetch('propinsi')->result_array();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nip', 'NIP', 'required|max_length[18]|is_natural_no_zero|is_unique[pegawai.nip]');
        $this->form_validation->set_rules('nip_lama', 'NIP Lama', 'is_unique[pegawai.nip_lama]');
        $this->form_validation->set_rules('no_kartu_pegawai', 'No. Kartu Pegawai', 'is_unique[pegawai.no_kartu_pegawai]');
        $this->form_validation->set_rules('nm_pegawai', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('agama_id', 'Agama', 'required');
        $this->form_validation->set_rules('jenis_kelamin_id', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('status_pegawai_id', 'Status Pegawai', 'required');
        $this->form_validation->set_rules('status_jabatan_id', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('eselon_id', 'Eselon', 'required');
        $this->form_validation->set_rules('golongan_id', 'Golongan', 'required');
        //$this->form_validation->set_rules('propinsi_id', 'Propinsi', 'required');
        //$this->form_validation->set_rules('kota_id', 'Kota/Kabupaten', 'required');
        //$this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            $this->db->trans_begin();

            $data['nip']                = $this->input->post('nip', true);
            $data['nip_lama']           = !empty($this->input->post('nip_lama', true))?$this->input->post('nip_lama', true):NULL;
            $data['no_kartu_pegawai']   = !empty($this->input->post('no_kartu_pegawai', true))?$this->input->post('no_kartu_pegawai', true):NULL;
            $data['gelar_depan']        = !empty($this->input->post('gelar_depan', true))?$this->input->post('gelar_depan', true):NULL;
            $data['nm_pegawai']         = ucwords(strtolower($this->input->post('nm_pegawai', true)));
            $data['gelar_belakang']     = !empty($this->input->post('gelar_belakang', true))?$this->input->post('gelar_belakang', true):NULL;
            $data['tempat_lahir']       = ucwords(strtolower($this->input->post('tempat_lahir', true)));
            $data['tanggal_lahir']      = $this->functions->convert_date_sql($this->input->post('tanggal_lahir', true));
            $data['jenis_kelamin_id']   = $this->input->post('jenis_kelamin_id', true);
            $data['agama_id']           = $this->input->post('agama_id', true);
            $data['status_pegawai_id']  = $this->input->post('status_pegawai_id', true);
            $data['status_jabatan_id']  = $this->input->post('status_jabatan_id', true);
            $data['eselon_id']          = $this->input->post('eselon_id', true);
            $data['golongan_id']        = $this->input->post('golongan_id', true);
            $data['no_npwp']            = !empty($this->input->post('no_npwp', true))?$this->input->post('no_npwp', true):NULL;
            $data['alamat']             = $this->input->post('alamat', true);
            $data['propinsi_id']        = $this->input->post('propinsi_id', true);
            $data['kota_id']            = $this->input->post('kota_id', true);
            // add new field table pegawai
            $data['no_telepon']         = !empty($this->input->post('no_telepon', true))?$this->input->post('no_telepon', true):NULL;
            $data['email']              = !empty($this->input->post('email', true))?$this->input->post('email', true):NULL;

            $data['created_by']         = $this->session->nama;

            $this->m_pegawai->save('pegawai', $data, true);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data pegawai gagal disimpan!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data pegawai berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('pegawai');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Tambah Pegawai - Badan Ekonomi Kreatif Indonesia')->build('f_pegawai', $d);

    }

    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Pegawai';
        $d['menus']         = $this->functions->generate_menu();

        $pegawai_id = decode($this->uri->segment(3));
        if(!empty($pegawai_id)){
            $cek = $this->m_pegawai->fetch('pegawai', array('pegawai_id' => $pegawai_id));

            if($cek->num_rows() > 0){
                $d['pegawai']      =  $cek->row_array();

                $d['l_jenis_kelamin']   = $this->m_pegawai->fetch('jenis_kelamin')->result_array();
                $d['l_agama']           = $this->m_pegawai->fetch('agama')->result_array();
                $d['l_speg']            = $this->m_pegawai->fetch('status_pegawai')->result_array();
                $d['l_sjab']            = $this->m_pegawai->fetch('status_jabatan')->result_array();
                $d['l_golongan']        = $this->m_pegawai->fetch('golongan')->result_array();
                $d['l_eselon']          = $this->m_pegawai->fetch('eselon')->result_array();
                $d['l_propinsi']        = $this->m_pegawai->fetch('propinsi')->result_array();
                $d['l_kota']            = $this->m_pegawai->fetch('kota', array('SUBSTRING(kota_id,1,2)' => $d['pegawai']['propinsi_id']))->result_array();

            } else {
                redirect('pegawai');
            }
        } else {
            redirect('pegawai');
        }

        $this->load->library('form_validation');

        if($this->input->post('nip', true) !== $d['pegawai']['nip']) {
            $is_unique =  '|is_unique[pegawai.nip]';
        } else {
            $is_unique =  '';
        }
        $this->form_validation->set_rules('nip', 'NIP', 'required|max_length[18]|is_natural_no_zero'.$is_unique);

        if($this->input->post('nip_lama', true) !== $d['pegawai']['nip_lama']) {
            $is_unique =  '|is_unique[pegawai.nip_lama]';
        } else {
            $is_unique =  '';
        }
        $this->form_validation->set_rules('nip_lama', 'NIP Lama', 'trim'.$is_unique);

        if($this->input->post('no_kartu_pegawai', true) !== $d['pegawai']['no_kartu_pegawai']) {
            $is_unique =  '|is_unique[pegawai.no_kartu_pegawai]';
        } else {
            $is_unique =  '';
        }
        $this->form_validation->set_rules('no_kartu_pegawai', 'No. Kartu Pegawai', 'trim'.$is_unique);

        $this->form_validation->set_rules('nm_pegawai', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('agama_id', 'Agama', 'required');
        $this->form_validation->set_rules('jenis_kelamin_id', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('status_pegawai_id', 'Status Pegawai', 'required');
        $this->form_validation->set_rules('status_jabatan_id', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('eselon_id', 'Eselon', 'required');
        $this->form_validation->set_rules('golongan_id', 'Golongan', 'required');
        //$this->form_validation->set_rules('propinsi_id', 'Propinsi', 'required');
        //$this->form_validation->set_rules('kota_id', 'Kota/Kabupaten', 'required');
        //$this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;
            $id                         = $pegawai_id;

            $data['nip']                = $this->input->post('nip', true);
            $data['nip_lama']           = !empty($this->input->post('nip_lama', true))?$this->input->post('nip_lama', true):NULL;
            $data['no_kartu_pegawai']   = !empty($this->input->post('no_kartu_pegawai', true))?$this->input->post('no_kartu_pegawai', true):NULL;
            $data['gelar_depan']        = !empty($this->input->post('gelar_depan', true))?$this->input->post('gelar_depan', true):NULL;
            $data['nm_pegawai']         = ucwords(strtolower($this->input->post('nm_pegawai', true)));
            $data['gelar_belakang']     = !empty($this->input->post('gelar_belakang', true))?$this->input->post('gelar_belakang', true):NULL;
            $data['tempat_lahir']       = ucwords(strtolower($this->input->post('tempat_lahir', true)));
            $data['tanggal_lahir']      = $this->functions->convert_date_sql($this->input->post('tanggal_lahir', true));
            $data['jenis_kelamin_id']   = $this->input->post('jenis_kelamin_id', true);
            $data['agama_id']           = $this->input->post('agama_id', true);
            $data['status_pegawai_id']  = $this->input->post('status_pegawai_id', true);
            $data['status_jabatan_id']  = $this->input->post('status_jabatan_id', true);
            $data['eselon_id']          = $this->input->post('eselon_id', true);
            $data['golongan_id']        = $this->input->post('golongan_id', true);
            $data['no_npwp']            = !empty($this->input->post('no_npwp', true))?$this->input->post('no_npwp', true):NULL;
            $data['alamat']             = $this->input->post('alamat', true);
            $data['propinsi_id']        = $this->input->post('propinsi_id', true);
            $data['kota_id']            = $this->input->post('kota_id', true);
            // add new field table pegawai
            $data['no_telepon']         = !empty($this->input->post('no_telepon', true))?$this->input->post('no_telepon', true):NULL;
            $data['email']              = !empty($this->input->post('email', true))?$this->input->post('email', true):NULL;

            $data['modified_by']        = $this->session->nama;

            #print_r($data); exit;

            $this->db->trans_begin();
            $this->m_pegawai->update('pegawai', $data, array('pegawai_id' => $id));

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data pegawai gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data pegawai berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('pegawai');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Pegawai - Badan Ekonomi Kreatif Indonesia')->build('f_pegawai', $d);

    }

    public function delete(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $this->m_pegawai->destroy('pegawai', array('pegawai_id' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data pegawai gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data pegawai berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

    public function get_list_kota(){
        if(!$this->input->is_ajax_request()) show_404();

        $propinsi_id = $this->input->post('propinsi_id', true);
        $kota_id = $this->input->post('kota_id', true);

        $kota = $this->m_pegawai->fetch('kota', array('SUBSTR(kota_id,1,2)' => $propinsi_id))->result_array();

        $output = '<option></option>';

        foreach($kota as $rs) {
            if(!empty($kota_id) && $kota_id == $rs['kota_id']) :
                $output .= '<option value="'.$rs['kota_id'].'" selected>'.$rs['kota'].'</option>';
            else :
                $output .= '<option value="'.$rs['kota_id'].'">'.$rs['kota'].'</option>';
            endif;
        }

        echo $output;
    }

}

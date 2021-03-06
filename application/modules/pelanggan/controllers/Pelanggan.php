<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Hartanto Kurniawan.
 * Email  : hartanto.kurniawan@bppt.go.id
 * Copyrights 2018
 */

class Pelanggan extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->load->model('m_pelanggan');

        $this->load->library('Datatables');
        $this->load->library('table');

    }

    public function index()
    {
        $d['page_title']    = 'Pasien';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-pelanggan" width="100%" class="table table-striped table-hover table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Kd Rekmed','NIK','Nama','Tgl Lahir','Alamat', 'Aksi');
        } else {
            $this->table->set_heading('Nama');
        }


        $this->template->set_layout('backoffice')->title('Pelanggan - Labkesda')->build('v_pelanggan', $d);
    }

    public function dt_pelanggan(){
        if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('kd_rekmed as kode,nik, nm_lengkap, DATE_FORMAT(tgl_lahir, "%d/%m/%Y") as tgl_lahir, alamat', FALSE)
            ->from('mst_pasien');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('pelanggan/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="'.base_url('delete/edit/$1').'" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
            <ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();

    }


    public function add(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Pelanggan / Pasien';
        $d['menus']         = $this->functions->generate_menu();

        $d['l_agama']           = $this->m_pelanggan->fetch('agama')->result_array();
        $d['l_jk']              = $this->m_pelanggan->fetch('jenis_kelamin')->result_array();
        $d['l_propinsi']        = $this->m_pelanggan->fetch('propinsi', NULL, 'propinsi ASC')->result();
        $d['l_goldar']          = $this->m_pelanggan->fetch('mst_goldar', NULL, 'goldar_nama ASC')->result_array();
        $d['l_pendidikan']      = $this->m_pelanggan->fetch('mst_pendidikan', NULL, 'pendidikan_nama ASC')->result_array();
        $d['l_pekerjaan']       = $this->m_pelanggan->fetch('mst_pekerjaan', NULL, 'pekerjaan_nama ASC')->result_array();
        $d['l_stmarital']       = $this->m_pelanggan->fetch('mst_stmarital', NULL, 'stmarital_nama ASC')->result_array();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nm_lengkap', 'Nama Lengkap', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            $this->db->trans_begin();

            $ctime_now      = date('Y-m-d H:i:s');

            $data['kd_rekmed']      = $this->m_pelanggan->generate_kode_rekmed('LABKES001');
            $data['nik']            = $this->input->post('nik', true);
            $data['nm_lengkap']     = !empty($this->input->post('nm_lengkap', true))?$this->input->post('nm_lengkap', true):NULL;
            $data['tmp_lahir']      = ucwords(strtolower($this->input->post('tmp_lahir', true)));
            $data['tgl_lahir']      = $this->functions->convert_date_sql($this->input->post('tgl_lahir'));
            $data['agama_id']       = $this->input->post('agama_id', true);
            $data['jk_id']          = $this->input->post('jk_id', true);
            $data['alamat']         = $this->input->post('alamat', true);
            $data['propinsi_id']    = $this->input->post('propinsi_id', true);
            $data['kota_id']        = $this->input->post('kota_id', true);
            $data['kecamatan_id']   = $this->input->post('kecamatan_id', true);
            $data['kelurahan_id']   = $this->input->post('kelurahan_id', true);
            $data['no_kk']          = !empty($this->input->post('no_kk', true))?$this->input->post('no_kk', true):NULL;
            $data['nm_kk']          = !empty($this->input->post('nm_kk', true))?$this->input->post('nm_kk', true):NULL;
            $data['goldar_id']      = !empty($this->input->post('goldar_id', true))?$this->input->post('goldar_id', true):NULL;
            $data['pendidikan_id']  = !empty($this->input->post('pendidikan_id', true))?$this->input->post('pendidikan_id', true):NULL;
            $data['pekerjaan_id']   = !empty($this->input->post('pekerjaan_id', true))?$this->input->post('pekerjaan_id', true):NULL;
            $data['stmarital_id']   = !empty($this->input->post('stmarital_id', true))?$this->input->post('stmarital_id', true):NULL;

            $data['created_by']     = $this->session->nama;
            $data['ctime']          = $ctime_now;

            $this->m_pelanggan->save('mst_pasien', $data, true);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data pasien tindakan gagal disimpan!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data pasien tindakan berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('pelanggan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Tambah Pelanggan - Labkesda')->build('f_pelanggan', $d);

    }

    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Pelanggan';
        $d['menus']         = $this->functions->generate_menu();

        $kd_rekmed = decode($this->uri->segment(3));
        if(!empty($kd_rekmed)){
            $cek = $this->m_pelanggan->fetch('mst_pasien', array('kd_rekmed' => $kd_rekmed));

            if($cek->num_rows() > 0){
                $d['pelanggan']      =  $cek->row_array();

                $d['l_goldar']          = $this->m_pelanggan->fetch('mst_goldar', NULL, 'goldar_nama ASC')->result_array();
                $d['l_agama']           = $this->m_pelanggan->fetch('agama')->result_array();
                $d['l_jk']              = $this->m_pelanggan->fetch('jenis_kelamin')->result_array();
                $d['l_pendidikan']      = $this->m_pelanggan->fetch('mst_pendidikan', NULL, 'pendidikan_nama ASC')->result_array();
                $d['l_pekerjaan']       = $this->m_pelanggan->fetch('mst_pekerjaan', NULL, 'pekerjaan_nama ASC')->result_array();
                $d['l_stmarital']       = $this->m_pelanggan->fetch('mst_stmarital', NULL, 'stmarital_nama ASC')->result_array();
                $d['l_propinsi']        = $this->m_pelanggan->fetch('propinsi', NULL, 'propinsi ASC')->result();
                $d['l_kota']            = $this->m_pelanggan->fetch('kota', array('SUBSTR(kota_id,1,2)' => $d['pelanggan']['propinsi_id']), 'kota_id ASC')->result();
                $d['l_kecamatan']       = $this->m_pelanggan->fetch('kecamatan', array('SUBSTR(kecamatan_id,1,4)' => $d['pelanggan']['kota_id']), 'kecamatan_id ASC')->result();
                $d['l_kelurahan']       = $this->m_pelanggan->fetch('kelurahan', array('SUBSTR(kelurahan_id,1,6)' => $d['pelanggan']['kecamatan_id']), 'kelurahan_id ASC')->result();

            } else {
                redirect('pelanggan');
            }
        } else {
            redirect('pelanggan');
        }


        $this->load->library('form_validation');

        $this->form_validation->set_rules('nm_lengkap', 'Nama Lengkap', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            $mtime_now      = date('Y-m-d H:i:s');

            $id['kd_rekmed']        = $kd_rekmed;

            $data['nik']            = $this->input->post('nik', true);
            $data['nm_lengkap']     = !empty($this->input->post('nm_lengkap', true))?$this->input->post('nm_lengkap', true):NULL;
            $data['tmp_lahir']      = ucwords(strtolower($this->input->post('tmp_lahir', true)));
            $data['tgl_lahir']      = $this->functions->convert_date_sql($this->input->post('tgl_lahir', true));
            $data['agama_id']       = $this->input->post('agama_id', true);
            $data['jk_id']          = $this->input->post('jk_id', true);
            $data['alamat']         = $this->input->post('alamat', true);
            $data['propinsi_id']    = $this->input->post('propinsi_id', true);
            $data['kota_id']        = $this->input->post('kota_id', true);
            $data['kecamatan_id']   = $this->input->post('kecamatan_id', true);
            $data['kelurahan_id']   = $this->input->post('kelurahan_id', true);
            $data['no_kk']          = !empty($this->input->post('no_kk', true))?$this->input->post('no_kk', true):NULL;
            $data['nm_kk']          = !empty($this->input->post('nm_kk', true))?$this->input->post('nm_kk', true):NULL;
            $data['goldar_id']      = !empty($this->input->post('goldar_id', true))?$this->input->post('goldar_id', true):NULL;
            $data['pendidikan_id']  = !empty($this->input->post('pendidikan_id', true))?$this->input->post('pendidikan_id', true):NULL;
            $data['pekerjaan_id']   = !empty($this->input->post('pekerjaan_id', true))?$this->input->post('pekerjaan_id', true):NULL;
            $data['stmarital_id']   = !empty($this->input->post('stmarital_id', true))?$this->input->post('stmarital_id', true):NULL;

            $data['modified_by']    = $this->session->nama;
            $data['mtime']          = $mtime_now;

            $this->db->trans_begin();
            $this->m_pelanggan->update('mst_pasien', $data, $id);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data Pelanggan gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data Pelanggan berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('pelanggan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Pelanggan - Labkesda')->build('f_pelanggan', $d);

    }


    public function get_list_kota(){
        if(!$this->input->is_ajax_request()) show_404();

        $propinsi_id = $this->input->post('propinsi_id', true);

        $kota = $this->m_pelanggan->fetch('kota', array('SUBSTR(kota_id,1,2)' => $propinsi_id), 'kota ASC')->result_array();

        $output = '<option></option>';

        foreach($kota as $rs) {
            $output .= '<option value="'.$rs['kota_id'].'">'.$rs['kota'].'</option>';
        }

        echo $output;
    }

    public function get_list_kecamatan(){
        if(!$this->input->is_ajax_request()) show_404();

        $kota_id = $this->input->post('kota_id', true);

        $kecamatan = $this->m_pelanggan->fetch('kecamatan', array('SUBSTR(kecamatan_id,1,4)' => $kota_id),'kecamatan ASC')->result_array();

        $output = '<option></option>';
        foreach($kecamatan as $rs) {
            $output .= '<option value="'.$rs['kecamatan_id'].'">'.$rs['kecamatan'].'</option>';
        }

        echo $output;
    }

    public function get_list_kelurahan(){
        if(!$this->input->is_ajax_request()) show_404();

        $kd_kelurahan = $this->input->post('kd_kelurahan', true);
        $kecamatan_id = $this->input->post('kecamatan_id', true);

        $kelurahan = $this->m_pelanggan->fetch('kelurahan', array('SUBSTR(kelurahan_id,1,6)' => $kecamatan_id),'kelurahan ASC')->result_array();

        $output = '<option></option>';

        foreach($kelurahan as $rs) {
            $output .= '<option value="'.$rs['kelurahan_id'].'">'.$rs['kelurahan'].'</option>';
        }

        echo $output;
    }

    public function get_kelurahan_by_kec_id(){
        if(!$this->input->is_ajax_request()) show_404();

        $nama_kel 	  = $this->input->post('nama_kel', true);
        $kecamatan_id = $this->input->post('kecamatan_id', true);

        $this->db->from('kelurahan')
            ->where('SUBSTRING(kelurahan_id,1,6)', $kecamatan_id)
            ->like('kelurahan', $nama_kel, 'both');

        $row = $this->db->get()->row_array();

        $result['kelurahan'] 		= $row['kelurahan'];
        $result['kd_kelurahan'] 	= $row['kelurahan_id'];

        echo json_encode($result);
    }

    public function delete(){
        //$this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $this->m_pelanggan->destroy('mst_pasien', array('kd_rekmed' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data pasien gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data pasien berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

}

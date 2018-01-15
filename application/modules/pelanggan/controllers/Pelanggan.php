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
        $d['l_jenis_kelamin']   = $this->m_pelanggan->fetch('jenis_kelamin')->result_array();
        $d['l_agama']           = $this->m_pelanggan->fetch('agama')->result_array();
        $d['l_propinsi']        = $this->m_pelanggan->fetch('propinsi', NULL, 'propinsi ASC')->result();
        $d['l_goldar']          = $this->m_pelanggan->fetch('mst_goldar', NULL, 'goldar_nama ASC')->result_array();
        $d['l_pendidikan']      = $this->m_pelanggan->fetch('mst_pendidikan', NULL, 'pendidikan_nama ASC')->result_array();
        $d['l_pekerjaan']       = $this->m_pelanggan->fetch('mst_pekerjaan', NULL, 'pekerjaan_nama ASC')->result_array();
        $d['l_stmarital']       = $this->m_pelanggan->fetch('mst_stmarital', NULL, 'stmarital_nama ASC')->result_array();

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-pelanggan" width="100%" class="table table-bordered table-striped" >');
        $this->table->set_template($tmpl);

        $this->table->set_heading('NIK', 'REKMED', 'NAMA', 'TGL LAHIR','ALAMAT');

        //      Simpan Form          //
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nik', 'NIP', 'required|max_length[18]|is_natural_no_zero|is_unique[mst_pasien.nik]');
        $this->form_validation->set_rules('nm_lengkap', 'Nama Lengkap', 'is_unique[mst_pasien.nm_lengkap]');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('agama_id', 'Agama', 'required');
        $this->form_validation->set_rules('jenis_kelamin_id', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat Pelanggan', 'required');
        $this->form_validation->set_rules('propinsi_id', 'Propinsi', 'required');
        $this->form_validation->set_rules('kecamatan_id', 'Kecamatan', 'required');
        $this->form_validation->set_rules('kelurahan_id', 'Kelurahan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            $this->db->trans_begin();

            $data['nik']                = $this->input->post('nik', true);
            $data['nm_lengkap']         = !empty($this->input->post('nm_lengkap', true))?$this->input->post('nm_lengkap', true):NULL;
            $data['tmp_lahir']          = ucwords(strtolower($this->input->post('tmp_lahir', true)));
            $data['tgl_lahir']          = $this->functions->convert_date_sql($this->input->post('tgl_lahir', true));
            $data['jk_id']              = $this->input->post('jenis_kelamin_id', true);
            $data['agama_id']           = $this->input->post('agama_id', true);
            $data['alamat']             = $this->input->post('alamat', true);
            $data['propinsi_id']        = $this->input->post('propinsi_id', true);
            $data['kecamatan_id']       = $this->input->post('kecamatan_id', true);
            $data['kelurahan_id']       = $this->input->post('kelurahan_id', true);
            $data['no_kk']              = !empty($this->input->post('no_kk', true))?$this->input->post('no_kk', true):NULL;
            $data['nm_kk']              = !empty($this->input->post('nm_kk', true))?$this->input->post('nm_kk', true):NULL;
            $data['goldar_id']          = !empty($this->input->post('goldar_id', true))?$this->input->post('goldar_id', true):NULL;
            $data['pendidikan_id']      = !empty($this->input->post('pendidikan_id', true))?$this->input->post('pendidikan_id', true):NULL;
            $data['pekerjaan_id']       = !empty($this->input->post('pekerjaan_id', true))?$this->input->post('pekerjaan_id', true):NULL;
            $data['stmarital_id']       = !empty($this->input->post('stmarital_id', true))?$this->input->post('stmarital_id', true):NULL;

            $data['created_by']         = $this->session->nama;

            $this->m_pelanggan->save('mst_pasien', $data, true);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data pelanggan gagal disimpan!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data pelanggan berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('pelanggan');
        }

        #echo '<pre>'; print_r($d); exit;
        $this->template->set_layout('frontoffice')->title('POS - Labkesda')->build('v_pelanggan', $d);
    }

    public function dt_pelanggan(){
        if(!$this->input->is_ajax_request()) show_404();

        $this->datatables->select("nik, kd_rekmed, nm_lengkap,
        DATE_FORMAT(tgl_lahir, '%d/%m/%Y') as tgl_lahir, alamat", FALSE)
            ->from('mst_pasien');

        echo $this->datatables->generate();

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

}

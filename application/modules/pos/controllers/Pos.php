<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Hartanto Kurniawan.
 * Email  : hartanto.kurniawan@bppt.go.id
 * Copyrights 2018
 */

class Pos extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->load->model('m_pos');

        $this->load->library('Datatables');
        $this->load->library('table');

    }

    public function index()
    {
        $d['gol_tindakan']      = $this->m_pos->get_gol_tindakan();
        $d['tindakan']          = $this->m_pos->get_tindakan_lab();
        $d['crbayar']           = $this->m_pos->get_crbayar();

        $d['trkasir_id']        = $this->m_pos->GenerateTrxKasir();
        $d['kd_rekmed']         = $this->m_pos->generate_kode_rekmed('LABKES001');

        $d['l_jenis_kelamin']   = $this->m_pos->fetch('jenis_kelamin')->result_array();
        $d['l_agama']           = $this->m_pos->fetch('agama')->result_array();
        $d['l_propinsi']        = $this->m_pos->fetch('propinsi', NULL, 'propinsi ASC')->result();
        $d['l_goldar']          = $this->m_pos->fetch('mst_goldar', NULL, 'goldar_nama ASC')->result_array();
        $d['l_pendidikan']      = $this->m_pos->fetch('mst_pendidikan', NULL, 'pendidikan_nama ASC')->result_array();
        $d['l_pekerjaan']       = $this->m_pos->fetch('mst_pekerjaan', NULL, 'pekerjaan_nama ASC')->result_array();
        $d['l_stmarital']       = $this->m_pos->fetch('mst_stmarital', NULL, 'stmarital_nama ASC')->result_array();

        //cetak struk
        $d['tgl_cetak']         = $mtime_now      = date('Y-m-d H:i:s');

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-pelanggan" width="100%" class="table table-hover table-bordered table-striped" >');
        $this->table->set_template($tmpl);

        $this->table->set_heading('NIK', 'REKMED', 'NAMA', 'TGL LAHIR','ALAMAT');

        #echo '<pre>'; print_r($d); exit;
        $this->template->set_layout('frontoffice')->title('POS - Labkesda')->build('v_pos', $d);
    }

//////////////    Pelanggan View   ///////////////////////

    public function save_pelanggan(){
        $ctime_now      = date('Y-m-d H:i:s');

        $this->db->trans_begin();

        $data['kd_rekmed']          = $this->input->post('kd_rekmed', true);
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
        $data['ctime']              = $ctime_now;

        $this->m_pos->save('mst_pasien', $data, true);

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

        redirect('pos');
     }

    
    public function dt_pelanggan(){
        if(!$this->input->is_ajax_request()) show_404();

        $this->datatables->select("nik, kd_rekmed as kode, nm_lengkap,
        DATE_FORMAT(tgl_lahir, '%d/%m/%Y') as tgl_lahir, alamat", FALSE)
            ->from('mst_pasien');
        $this->datatables->edit_column('nm_lengkap', '<span class="btn-plg" data-kdrekmed="$1" data-nama="$2">$2</span>', 'kode,nm_lengkap');

//        $edit_button = '<li><a href="'.base_url('pasien/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>';
//        $delete_button =  '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>';
//        $divider = '<li class="divider"></li>';
//
//        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');


        echo $this->datatables->generate();

    }

    public function get_list_kota(){
        if(!$this->input->is_ajax_request()) show_404();

        $propinsi_id = $this->input->post('propinsi_id', true);

        $kota = $this->m_pos->fetch('kota', array('SUBSTR(kota_id,1,2)' => $propinsi_id), 'kota ASC')->result_array();

        $output = '<option></option>';

        foreach($kota as $rs) {
            $output .= '<option value="'.$rs['kota_id'].'">'.$rs['kota'].'</option>';
        }

        echo $output;
    }

    public function get_list_kecamatan(){
        if(!$this->input->is_ajax_request()) show_404();

        $kota_id = $this->input->post('kota_id', true);

        $kecamatan = $this->m_pos->fetch('kecamatan', array('SUBSTR(kecamatan_id,1,4)' => $kota_id),'kecamatan ASC')->result_array();

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

        $kelurahan = $this->m_pos->fetch('kelurahan', array('SUBSTR(kelurahan_id,1,6)' => $kecamatan_id),'kelurahan ASC')->result_array();

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



//////////////    SIMPAN TRANSAKSI   ///////////////////////

    public function save_trx(){

        $this->db->trans_begin();

        $tgl_trans      = date('Y-m-d');
        $ctime_now      = date('Y-m-d H:i:s');

        // Simpan Tabel Header
        $data_h['tgl_trkasir']        = $tgl_trans;
        $data_h['trkasir_id']         = $this->input->post('trkasir_id', true);
        $data_h['gol_tindakan_id']    = $this->input->post('gol_tindakan_id', true);

        $data_h['created_by']         = $this->session->nama;
        $data_h['ctime']              = $ctime_now;

        // Simpan Tabel Detail
        $data['tgl_trkasir']        = $tgl_trans;
        $data['trkasir_id']         = $this->input->post('trkasir_id', true);
        $data['kd_tindakan']        = $this->input->post('id', true);
        $data['tindakan']           = $this->input->post('tindakan', true);
        $data['produk_jml']         = '1';
        $data['harga']              = $this->input->post('harga', true);

        $data['created_by']         = $this->session->nama;
        $data['ctime']              = $ctime_now;

        $trkasir_id                 = $this->input->post('trkasir_id',true);
        $id_h['trkasir_id']         = $this->input->post('trkasir_id',true);
        $id_d['trkasir_id']         = $this->input->post('trkasir_id',true);

        $hasil = $this->m_pos->getSelectedData("trkasir_header",$id_h);
        $row = $hasil->num_rows();
        if($row>0){
            $this->m_pos->updateData("trkasir_header",$data_h,$id_h);

            $text = "SELECT * FROM trkasir_detail WHERE trkasir_id='$trkasir_id'";
            $hasil_detail = $this->m_pos->manualQuery($text);

            if($hasil_detail->num_rows()>0){
                $this->m_pos->save('trkasir_detail', $data, true);
            }

        }else{
            $this->m_pos->save('trkasir_header', $data_h, true);
            $this->m_pos->save('trkasir_detail', $data, true);
        }


        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $message                        = "Data kasir gagal disimpan!";
            $type                           = "error";
        } else {
            $this->db->trans_commit();
            $message                        = "Data kasir berhasil disimpan!";
            $type                           = "success";
        }

        $this->session->set_flashdata(array('notif' => $message, 'type' => $type));


    }

///    Update Transaksi Header

    public function update_trxheader(){

        #echo '<pre>'; print_r($this->input->post()); exit();
        $this->db->trans_begin();

        $mtime_now      = date('Y-m-d H:i:s');

        // Simpan Tabel Header
        $data_h['total']            = $this->input->post('total', true);
        $data_h['bayar']            = $this->input->post('bayar', true);
        $data_h['kembali']          = $this->input->post('kembali', true);
        $data_h['cara_bayar']       = $this->input->post('cara_bayar', true);
        $data_h['pelanggan']        = $this->input->post('pelanggan', true);
        $data_h['status']           = '1';

        $data_h['modified_by']      = $this->session->nama;
        $data_h['mtime']            = $mtime_now;

        $id_h['trkasir_id']         = $this->input->post('trkasir_id',true);

        $this->m_pos->updateData("trkasir_header",$data_h,$id_h);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $message                        = "Data kasir gagal disimpan!";
            $type                           = "error";
        } else {
            $this->db->trans_commit();
            $message                        = "Data kasir berhasil disimpan!";
            $type                           = "success";
        }

    }

    //show detail transaksi
    public function DataDetail($id=NULL)
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){

            $id = $this->input->post('kode');

            $text = "SELECT * FROM trkasir_detail
              WHERE trkasir_id ='$id'";
            $d['data'] = $this->db->query($text);

            $this->load->view('detail_masuk',$d);

        }else{
            header('location:'.base_url());
        }

    }

    //show detail transaksi
    public function DataperKategori($id=NULL)
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){

            $id     = $this->input->post('kode');

            #echo '<pre>'; print_r($id); exit();

            $text = "SELECT * FROM mst_tindakan WHERE gol_tindakan_id ='$id' ORDER BY tindakan";
            $d['data'] = $this->db->query($text);

            $d['trkasir_id'] = $this->input->post('trkasir_id');

            #echo '<pre>'; print_r($d); exit();

            $this->load->view('tindakan_perkategori',$d);

        }else{
            header('location:'.base_url());
        }

    }
}

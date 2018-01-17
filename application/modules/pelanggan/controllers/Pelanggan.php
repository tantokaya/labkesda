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
        $tmpl = array('table_open' => '<table id="tbl-pelanggan" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
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

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('pasien/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();

    }


    public function add(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Pelanggan / Pasien';
        $d['menus']         = $this->functions->generate_menu();


        $d['l_agama']           = $this->m_pelanggan->fetch('agama')->result_array();
        $d['l_jenis_kelamin']   = $this->m_pelanggan->fetch('jenis_kelamin')->result_array();
        $d['l_propinsi']        = $this->m_pelanggan->fetch('propinsi', NULL, 'propinsi ASC')->result();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nm_lengkap', 'Nama Lengkap', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            $this->db->trans_begin();

            $data['nm_lengkap'] = $this->input->post('sub_gol_tind_nama', true);
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

            redirect('pelanggan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Tambah Pelanggan - Labkesda')->build('f_pelanggan', $d);

    }

    ///   File Lama


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

<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Kalender extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_kalender');

        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $d['page_title']    = 'Kalender';
        $d['panel_title']   = 'Kalender Kegiatan';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor

        $d['l_jenis_kegiatan']  = $this->m_kalender->fetch('jenis_kegiatan')->result_array();
        $d['l_tipe_kegiatan']   = $this->m_kalender->fetch('tipe_kegiatan')->result_array();
        $d['l_propinsi']        = $this->m_kalender->fetch('propinsi')->result_array();


        $this->template->set_layout('backoffice')->title('Kalender - Badan Ekonomi Kreatif Indonesia')->build('v_kalender', $d);
    }

    public function fetch(){
        if(!$this->input->is_ajax_request()) show_404();

        $start  = $this->input->post('start', true);
        $end    = $this->input->post('end', true);
        $owner  = !empty($this->input->post('owner', true))?$this->input->post('owner', true):null;
        $public = !empty($this->input->post('public', true))?true:false;

        $result = $this->m_kalender->get_all_kalender($start, $end, $owner, $public);

        echo json_encode($result);
    }

    public function form_kegiatan(){
        $this->functions->check_access2('kegiatan', 'add');
        if(!$this->input->is_ajax_request()) show_404();

        $jenis_kegiatan_id = $this->input->post('id', true);

        if(empty($jenis_kegiatan_id)) show_404();

        if($jenis_kegiatan_id == '3'){

        } else {

        }


    }

    public function save_kegiatan(){
        $this->functions->check_access2('kegiatan', 'add');
        if(!$this->input->is_ajax_request()) show_404();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'required');
        $this->form_validation->set_rules('jenis_kegiatan_id', 'Jenis Kegiatan', 'required');
        $this->form_validation->set_rules('tipe_kegiatan_id', 'Tipe Kegiatan', 'required');
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tanggal_akhir', 'Tanggal Akhir', 'required');
        $this->form_validation->set_rules('keterangan', 'Tanggal Akhir', 'required');

        if($this->input->post('jenis_kegiatan_id', true) == '3'){
            $this->form_validation->set_rules('propinsi_id', 'Propinsi Tujuan', 'required');
            $this->form_validation->set_rules('kota_id', 'Kota Tujuan', 'required');
        } else {
            $this->form_validation->set_rules('waktu_mulai_submit', 'Waktu Mulai', 'required');
            $this->form_validation->set_rules('waktu_akhir_submit', 'Waktu Akhir', 'required');
            $this->form_validation->set_rules('lokasi', 'Lokasi Kegiatan', 'required');
            $this->form_validation->set_rules('pic', 'Person In Charge (PIC)', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $result['message'] = validation_errors();
            $result['type']   = 'error';
            $result['error']   = true;
        }
        else {
            $id = $this->input->post('kegiatan_id', true);

            $data['jenis_kegiatan_id']      = $this->input->post('jenis_kegiatan_id', true);
            $data['tipe_kegiatan_id']       = $this->input->post('tipe_kegiatan_id', true);
            $data['is_private']             = empty($this->input->post('is_private', true))?0:$this->input->post('is_private', true);
            $data['kegiatan']               = ucwords(strtolower($this->input->post('kegiatan',true)));
            $data['tanggal_mulai']          = $this->functions->convert_date_sql($this->input->post('tanggal_mulai'));
            $data['tanggal_akhir']          = $this->functions->convert_date_sql($this->input->post('tanggal_akhir'));
            $data['keterangan']             = ucwords(strtolower($this->input->post('keterangan', true)));
            $data['mak']                    = $this->input->post('mak', true);
            $data['deskripsi_mak']          = ucwords(strtolower($this->input->post('desc_mak', true)));
            $data['user_id']                = $this->session->user_id;


            if($data['jenis_kegiatan_id'] ==  '3'){
                $data['waktu_mulai']        = NULL;
                $data['waktu_akhir']        = NULL;
                $data['kota_tujuan']        = $this->input->post('kota_id', true);
                $lokasi = $this->m_kalender->fetch('kota', array('kota_id' => $data['kota_tujuan']))->row_array();
                $data['lokasi']             = ucwords(strtolower($lokasi['kota']));
                $data['pic']                = NULL;

            } else {
                $data['waktu_mulai']        = $this->input->post('waktu_mulai_submit', true).':00';
                $data['waktu_akhir']        = $this->input->post('waktu_akhir_submit', true).':00';
                $data['kota_tujuan']        = NULL;
                $data['lokasi']             = $this->input->post('lokasi', true);
                $data['pic']                = ucwords(strtolower($this->input->post('pic', true)));
            }

            $this->db->trans_begin();

            if(!empty($id)){
                //update
                $data['modified_by']            = $this->session->nama;
                $this->m_kalender->update('kegiatan', $data, array('kegiatan_id' => $id));
                $result['kegiatan_id']          = $id;
            } else {
                // insert
                $data['created_by']             = $this->session->nama;
                $kegiatan_id = $this->m_kalender->save('kegiatan', $data, true);
                $result['kegiatan_id']      = $kegiatan_id;
            }

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $result['error']            = true;
                $result['message']          = "Data kegiatan gagal disimpan!";
                $result['type']             = "error";
            } else {
                $this->db->trans_commit();
                $result['error']            = false;
                $result['message']          = "Data kegiatan berhasil disimpan!";
                $result['type']             = "success";
            }
        }

        echo json_encode($result);
    }

    public function get_list_kota(){
        if(!$this->input->is_ajax_request()) show_404();

        $propinsi_id = $this->input->post('propinsi_id', true);
        $kota_id = $this->input->post('kota_id', true);

        $kota = $this->m_kalender->fetch('kota', array('SUBSTR(kota_id,1,2)' => $propinsi_id))->result_array();

        $output = '<option value="">-- Pilih Kota/Kabupaten --</option>';

        foreach($kota as $rs) {
            if(!empty($kota_id) && $kota_id == $rs['kota_id']) :
                $output .= '<option value="'.$rs['kota_id'].'" selected>'.$rs['kota'].'</option>';
            else :
                $output .= '<option value="'.$rs['kota_id'].'">'.$rs['kota'].'</option>';
            endif;
        }

        echo $output;
    }

    public function update_tanggal_kegiatan(){
        $this->functions->check_access2('kegiatan', 'edit');
        if(!$this->input->is_ajax_request()) show_404();

        $id     = $this->input->post('id', true);
        $start  = (!empty($this->input->post('start', true)))?$this->functions->convert_date_sql($this->input->post('start', true)):'';
        $end    = (!empty($this->input->post('end', true)))?$this->functions->convert_date_sql($this->input->post('end', true)):'';

        if(!empty($id) && !empty($start) && !empty($end)){
            $this->db->trans_begin();

            $this->m_kalender->update('kegiatan', array(
                'tanggal_mulai' => $start,
                'tanggal_akhir' => date('Y-m-d', strtotime($end.' -1 day')),
                'modified_by'   => $this->session->nama
            ), array('kegiatan_id' => $id));

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $result['error']            = true;
                $result['message']          = "Tanggal kegiatan gagal diperbaharui!";
                $result['type']             = "error";
            } else {
                $this->db->trans_commit();
                $result['error']            = false;
                $result['message']          = "Tanggal kegiatan berhasil diperbaharui!";
                $result['type']             = "success";
            }

        } else {
            $result['error']    = true;
            $result['message']  = 'Tanggal mulai dan akhir invalid';
        }

        echo json_encode($result);
    }

    public function upload_lampiran(){
        if (empty($_FILES['lampiran'])) {
            echo json_encode(['error'=>'Tidak ada file untuk di upload.']);
            return;
        }

        if (empty($this->input->post('kegiatan_id', true))) {
            echo json_encode(['error'=>'Kode kegiatan tidak ada.']);
            return;
        }

        $this->load->library('upload');

        $files = $_FILES;

        $kegiatan_id    = $this->input->post('kegiatan_id', true);
        $totalFile      = count($_FILES['lampiran']['name']);

        $error = [];

        for($i = 0; $i < $totalFile; $i ++) {
            $_FILES['lampiran']['name']       = $files ['lampiran']['name'][$i];
            $_FILES['lampiran']['type']       = $files ['lampiran']['type'][$i];
            $_FILES['lampiran']['tmp_name']   = $files ['lampiran']['tmp_name'][$i];
            $_FILES['lampiran']['error']      = $files ['lampiran']['error'][$i];
            $_FILES['lampiran']['size']       = $files ['lampiran']['size'][$i];

            $this->upload->initialize ($this->set_upload_options());

            if($this->upload->do_upload ('lampiran')){
                $upload_data   = $this->upload->data();

                $lampiran_kegiatan[$i]['kegiatan_id']   = $kegiatan_id;
                $lampiran_kegiatan[$i]['file_name']     = $upload_data['file_name'];
                $lampiran_kegiatan[$i]['file_type']     = $upload_data['file_type'];
                $lampiran_kegiatan[$i]['file_size']     = $upload_data['file_name'];
                $lampiran_kegiatan[$i]['owner']         = $this->session->user_id;
                $lampiran_kegiatan[$i]['title']         = $upload_data['client_name'];
                $lampiran_kegiatan[$i]['created_by']    = $this->session->nama;
            }
            else {
                $error[$i]      = $this->upload->display_errors();
            }
        }

        if(!empty($lampiran_kegiatan)){
            $this->m_kalender->insert($lampiran_kegiatan);
        }

        echo json_encode([
            'error' => $error
        ]);

    }

    private function set_upload_options(){
        $config = array ();
        $config['upload_path']      = './uploads/lampiran_kegiatan/';
        $config['allowed_types']    = 'jpg|png|xls|xlsx|pdf|ppt|pptx|doc|docx';
        $config['encrypt_name']     = TRUE;
        $config['file_ext_tolower'] = TRUE;

        return $config;
    }

    public function get_list_lampiran(){
        if(!$this->input->is_ajax_request()) show_404();

        $id = $this->input->post('id', true);
        $data['id'] = encode($id);
        $data['list_lampiran'] = $this->m_kalender->fetch('lampiran_kegiatan', array('kegiatan_id' => $id));

        $this->load->view('v_list_lampiran', $data);
    }

    public function delete_lampiran(){
        if(!$this->input->is_ajax_request()) show_404();
        $this->functions->check_access2('kegiatan', 'delete');

        $lampiran_id = decode($this->input->post('lampiran_id', true));
        $kegiatan_id = decode($this->input->post('kegiatan_id', true));

        $cek = $this->m_kalender->fetch('lampiran_kegiatan', array('lampiran_kegiatan_id' => $lampiran_id));

        if($cek->num_rows() > 0){
            $lampiran = $cek->row_array();

            $source_dir = './uploads/lampiran/kegiatan/';
            $filename = $lampiran['file_name'];

            if(file_exists($source_dir . $filename)){
                if(is_file($source_dir . $filename)){
                    unlink($source_dir . $filename);
                }
            }

            $result['kegiatan_id'] = $kegiatan_id;

            $this->db->trans_begin();

            $this->m_kalender->destroy('lampiran_kegiatan', array('lampiran_kegiatan_id' => $lampiran_id));

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $result['error']            = true;
                $result['message']          = "File lampiran gagal dihapus!";
                $result['type']             = "error";
            } else {
                $this->db->trans_commit();
                $result['error']            = false;
                $result['message']          = "File lampiran berhasil dihapus!";
                $result['type']             = "success";
            }
        } else {
            $result['error']            = false;
            $result['message']          = "File lampiran tidak ditemukan!";
            $result['type']             = "error";
        }

        echo json_encode($result);

    }

}

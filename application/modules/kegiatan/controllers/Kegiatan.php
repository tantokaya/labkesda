<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Kegiatan extends MX_Controller {

    protected $ftp_config;

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_kegiatan');

        $this->load->library('Datatables');
        $this->load->library('table');

        $this->load->library('ftp');
        $this->ftp_config = $this->load->config('ftp', true);
    }

    public function index()
    {
        $d['page_title']    = 'Daftar Kegiatan';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        $d['eselon1']       = $this->m_kegiatan->get_list_eselon1();

        switch($this->session->eselon):
            case '1': //Eselon 1
                $d['user']['eselon1'] = $this->session->unit_kerja;

                $d['eselon2']         = $this->m_kegiatan->get_list_eselon2($this->session->unit_kerja);

                $d['eselon']          = '1';
                break;
            case '2': //Eselon 2
                $d['user']['eselon1'] = substr($this->session->unit_kerja,0,2).'000000';
                $d['user']['eselon2'] = $this->session->unit_kerja;

                $d['eselon2']       = $this->m_kegiatan->get_list_eselon2($d['user']['eselon1'], $this->session->unit_kerja);
                $d['eselon3']       = $this->m_kegiatan->get_list_eselon3($this->session->unit_kerja);

                $d['eselon']          = '2';
                break;
            case '3': //Eselon 3
                $d['user']['eselon1'] = substr($this->session->unit_kerja,0,2).'000000';
                $d['user']['eselon2'] = substr($this->session->unit_kerja,0,4).'0000';
                $d['user']['eselon3'] = $this->session->unit_kerja;

                $d['eselon2']       = $this->m_kegiatan->get_list_eselon2($d['user']['eselon1'], $d['user']['eselon2']);
                $d['eselon3']       = $this->m_kegiatan->get_list_eselon3($d['user']['eselon2'], $this->session->unit_kerja);
                $d['eselon4']       = $this->m_kegiatan->get_list_eselon4($this->session->unit_kerja);

                $d['eselon']          = '3';
                break;
            case '4': //Eselon 4
                $d['user']['eselon1'] = substr($this->session->unit_kerja,0,2).'000000';
                $d['user']['eselon2'] = substr($this->session->unit_kerja,0,4).'0000';
                $d['user']['eselon3'] = substr($this->session->unit_kerja,0,6).'00';
                $d['user']['eselon4'] = $this->session->unit_kerja;

                $d['eselon2']       = $this->m_kegiatan->get_list_eselon2($d['user']['eselon1'], $d['user']['eselon2']);
                $d['eselon3']       = $this->m_kegiatan->get_list_eselon3($d['user']['eselon2'], $d['user']['eselon3']);
                $d['eselon4']       = $this->m_kegiatan->get_list_eselon4($d['user']['eselon3'], $this->session->unit_kerja);

                $d['eselon']          = '4';
                break;
            default:
                $d['user']['eselon1'] = '';
                $d['user']['eselon2'] = '';
                $d['user']['eselon3'] = '';
                $d['user']['eselon4'] = '';

                $d['eselon']          = '';
                $d['filter']          = '';
        endswitch;

        /*switch($this->session->akses_id):
            case '3': //Eselon 1
                $d['user']['eselon1'] = $this->session->unit_kerja;

                $d['eselon2']         = $this->m_kegiatan->get_list_eselon2($this->session->unit_kerja);

                $d['eselon']          = '1';
                break;
            case '4': //Eselon 2
                $d['user']['eselon1'] = substr($this->session->unit_kerja,0,2).'000000';
                $d['user']['eselon2'] = $this->session->unit_kerja;

                $d['eselon2']       = $this->m_kegiatan->get_list_eselon2($d['user']['eselon1'], $this->session->unit_kerja);
                $d['eselon3']       = $this->m_kegiatan->get_list_eselon3($this->session->unit_kerja);

                $d['eselon']          = '2';
                break;
            case '5': //Eselon 3
                $d['user']['eselon1'] = substr($this->session->unit_kerja,0,2).'000000';
                $d['user']['eselon2'] = substr($this->session->unit_kerja,0,4).'0000';
                $d['user']['eselon3'] = $this->session->unit_kerja;

                $d['eselon2']       = $this->m_kegiatan->get_list_eselon2($d['user']['eselon1'], $d['user']['eselon2']);
                $d['eselon3']       = $this->m_kegiatan->get_list_eselon3($d['user']['eselon2'], $this->session->unit_kerja);
                $d['eselon4']       = $this->m_kegiatan->get_list_eselon4($this->session->unit_kerja);

                $d['eselon']          = '3';
                break;
            case '6': //Eselon 4
                $d['user']['eselon1'] = substr($this->session->unit_kerja,0,2).'000000';
                $d['user']['eselon2'] = substr($this->session->unit_kerja,0,4).'0000';
                $d['user']['eselon3'] = substr($this->session->unit_kerja,0,6).'00';
                $d['user']['eselon4'] = $this->session->unit_kerja;

                $d['eselon2']       = $this->m_kegiatan->get_list_eselon2($d['user']['eselon1'], $d['user']['eselon2']);
                $d['eselon3']       = $this->m_kegiatan->get_list_eselon3($d['user']['eselon2'], $d['user']['eselon3']);
                $d['eselon4']       = $this->m_kegiatan->get_list_eselon4($d['user']['eselon3'], $this->session->unit_kerja);

                $d['eselon']          = '4';
                break;
            default:
                $d['user']['eselon1'] = '';
                $d['user']['eselon2'] = '';
                $d['user']['eselon3'] = '';
                $d['user']['eselon4'] = '';

                $d['eselon']          = '';
                $d['filter']          = '';
        endswitch;*/

        #echo '<pre>';print_r($d); exit;

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-kegiatan" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Kegiatan', 'Jenis', 'Lokasi', 'Satker', 'Tanggal Awal', 'Tanggal Akhir', 'TU', 'Keuangan', 'Aksi');
        } else {
            $this->table->set_heading('Kegiatan', 'Jenis', 'Lokasi', 'Satker', 'Tanggal Awal', 'Tanggal Akhir', 'TU', 'Keuangan');
        }


        $this->template->set_layout('backoffice')->title('Daftar Kegiatan - Badan Ekonomi Kreatif Indonesia')->build('v_kegiatan', $d);
    }

    public function dt_kegiatan(){
        if(!$this->input->is_ajax_request()) show_404();

        $filter  = $this->input->post('filter', true);
        $eselon  = $this->input->post('eselon', true);

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('kode, kegiatan, jenis_kegiatan, lokasi, satker, tanggal_mulai, tanggal_akhir, user_id, status_tu as tu, status_keuangan as keuangan', FALSE)
            ->from('v_kegiatan');

        $this->datatables->unset_column('kode');
        $this->datatables->unset_column('user_id');

        $i ='';

        if($eselon == '1') {
            $filter = substr($filter,0,2);
            $i = 2;
        } else if($eselon == '2'){
            $filter = substr($filter,0,4);
            $i = 4;
        } else if($eselon == '3'){
            $filter = substr($filter,0,6);
            $i = 6;
        } else if($eselon == '4'){
            $i = 8;
        }

        if(!empty($filter)){
            $this->datatables->where('SUBSTRING(unit_kerja_id,1,'.$i.')', $filter);
        } else {
            if(!empty($eselon)){
                if(!empty($this->session->unit_kerja)) $this->datatables->where('unit_kerja_id', $this->session->unit_kerja);
            }
        }

//        $this->datatables->where('(is_private = 0 OR (is_private = 1 AND user_id = '.$this->session->user_id.'))');
        $this->datatables->where('(tipe_kegiatan_id = 2 OR (tipe_kegiatan_id = 1 AND user_id = '.$this->session->user_id.'))');

        if($this->session->akses_id != 1){
            $this->datatables->where('(is_private = 0 OR (is_private = 1 AND mark = \''.$this->session->mark.'\'))');
        }

        $view_button = '<li><a href="#" data-title="$2" data-id="$1" class="btn-view"><i class="icon-eye"></i> Lihat</a></li>';
        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('kegiatan/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right action_menu">' . $view_button . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode),kegiatan');

        $this->datatables->edit_column('status_tu','$1','status_validasi_kegiatan(status_tu)');
        $this->datatables->edit_column('status_keuangan','$1','status_validasi_kegiatan(status_keuangan)');

        echo $this->datatables->generate();

        #echo $this->db->last_query(); exit;
    }

    public function view(){
        if(!$this->input->is_ajax_request()) show_404();

        $kegiatan_id = decode($this->input->post('id', true));

        if(empty($kegiatan_id)) show_404();

        $d['kegiatan']          = $this->m_kegiatan->fetch('kegiatan', array('kegiatan_id' => $kegiatan_id))->row_array();

        $d['tipe_kegiatan']     = $this->m_kegiatan->fetch('tipe_kegiatan', array('tipe_kegiatan_id' => $d['kegiatan']['tipe_kegiatan_id']))->row_array();
        $d['jenis_kegiatan']    = $this->m_kegiatan->fetch('jenis_kegiatan', array('jenis_kegiatan_id' => $d['kegiatan']['jenis_kegiatan_id']))->row_array();

        $d['user']              = $this->m_kegiatan->get_creator_kegiatan_by_user($d['kegiatan']['user_id']);

        if($d['kegiatan']['jenis_kegiatan_id'] == '3'){
            $d['propinsi']      = $this->m_kegiatan->fetch('propinsi',array('propinsi_id' => substr($d['kegiatan']['kota_tujuan'],0,2)))->row_array();
            $d['kota']          = $this->m_kegiatan->fetch('kota', array('kota_id' => $d['kegiatan']['kota_tujuan']))->row_array();

            $d['list_lampiran'] = $this->m_kegiatan->fetch('lampiran_kegiatan', array('kegiatan_id' => $kegiatan_id));
            $d['list_peserta'] = $this->m_kegiatan->get_list_peserta_fgd($kegiatan_id);

            $this->load->view('v_perjadin',$d);
        } else {
            $d['list_lampiran'] = $this->m_kegiatan->fetch('lampiran_kegiatan', array('kegiatan_id' => $kegiatan_id));
            $d['list_peserta'] = $this->m_kegiatan->get_list_peserta_fgd($kegiatan_id);

            $this->load->view('v_fgd',$d);
        }

        //echo '<pre>'; print_r($d);
    }

    public function peserta_view(){
        if(!$this->input->is_ajax_request()) show_404();

        $id                 = decode($this->input->post('id', true));
        $jenis_kegiatan_id  = $this->input->post('jenis_kegiatan_id', true);

        if(empty($id) && empty($jenis_kegiatan_id)) show_404();

        $d['jenis_kegiatan_id']   = $jenis_kegiatan_id;

        if($jenis_kegiatan_id == '3'){
            $d['peserta']             = $this->m_kegiatan->fetch('peserta_kegiatan', array('peserta_kegiatan_id' => $id))->row_array();
            $this->load->view('v_peserta_perjadin',$d);
        } else {
            $d['peserta']             = $this->m_kegiatan->fetch('peserta_kegiatan', array('peserta_kegiatan_id' => $id), NULL, 'status_peserta', 'peserta_kegiatan.status_peserta_id = status_peserta.status_peserta_id')->row_array();
            $this->load->view('v_peserta_fgd',$d);
        }
    }

    public function add(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']        = 'Tambah Kegiatan';
        $d['menus']             = $this->functions->generate_menu();

        $d['l_tipe_kegiatan']   = $this->m_kegiatan->fetch('tipe_kegiatan')->result_array();
        $d['l_jenis_kegiatan']  = $this->m_kegiatan->fetch('jenis_kegiatan')->result_array();
        $d['l_propinsi']        = $this->m_kegiatan->fetch('propinsi')->result_array();

        $d['l_kode_bagian'] = $this->m_kegiatan->fetch('nb_kode_bagian')->result_array();
        //nbs tambahan
        $d['l_subsektor']   = $this->m_kegiatan->fetch('nb_subsektor')->result_array();
        $d['l_pegawai']   = $this->m_kegiatan->fetch('pegawai')->result_array();
        $d['l_mak']   = $this->m_kegiatan->fetch('nb_mak')->result_array();
        // var_dump($this->getMark());exit;
        $d['mark'] = $this->getMark();

        $this->template->set_layout('backoffice')->title('Tambah Kegiatan - Badan Ekonomi Kreatif Indonesia')->build('f_kegiatan', $d);
    }

    //tambahan nbs, wrap get_mark_calendar for code reusability
    //TODO FROM SESSION
    function getMark()
    {
        $mark = null;
        if($this->session->akses_id == '2'){
            if($this->session->jabatan == '00')
                $mark = 'K';
            else
                $mark = 'W';
        } elseif($this->session->akses_id >= '3'){
            $row = $this->m_kegiatan->get_mark_kalender($this->session->unit_kerja)->row_array();
            $mark = $row['mark'];
        } else {
            $mark = NULL;
        }
        return $mark;
    }

    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Kegiatan';
        $d['menus']         = $this->functions->generate_menu();

        $kegiatan_id = decode($this->uri->segment(3));
        if(!empty($kegiatan_id)){
            $cek          = $this->m_kegiatan->fetch('kegiatan', array('kegiatan_id' => $kegiatan_id));
            if($cek->num_rows() > 0){
                $d['kegiatan'] = $cek->row_array();

                $d['l_tipe_kegiatan']   = $this->m_kegiatan->fetch('tipe_kegiatan')->result_array();
                $d['l_jenis_kegiatan']  = $this->m_kegiatan->fetch('jenis_kegiatan')->result_array();
                $d['l_propinsi'] = $this->m_kegiatan->fetch('propinsi')->result_array();

                //nbs tambahan
                $d['l_subsektor']   = $this->m_kegiatan->fetch('nb_subsektor')->result_array();
                $d['filled_subsektor']   = $this->m_kegiatan->fetch('nb_kegiatan_subsektor', ["kegiatan_id"=>$kegiatan_id])->result_array();
                $d['l_mak']   = $this->m_kegiatan->fetch('nb_mak')->result_array();
                $d['l_pegawai']   = $this->m_kegiatan->fetch('pegawai')->result_array();
                $d['filled_pic']   = $this->m_kegiatan->fetch('nb_kegiatan_pic', ["kegiatan_id"=>$kegiatan_id])->result_array();
                $d['mark'] = $this->getMark();
                //------

                $d['l_pengaturan_laporan']   = $this->m_kegiatan->fetch('nb_pengaturan_laporan', ['jenis_kegiatan_id' => $cek->row()->jenis_kegiatan_id], null,
                    'nb_jenis_laporan', 'nb_pengaturan_laporan.jenis_laporan_id = nb_jenis_laporan.jenis_laporan_id')
                    ->result_array();

                if($d['kegiatan']['jenis_kegiatan_id'] == '3') {

                    $d['l_kota'] = $this->m_kegiatan->fetch('kota', array('SUBSTRING(kota_id,1,2)' => substr($d['kegiatan']['kota_tujuan'], 0, 2)))->result_array();
                }
            } else {
                redirect('kegiatan');
            }
        } else {
            redirect('kegiatan');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Kegiatan - Badan Ekonomi Kreatif Indonesia')->build('f_kegiatan', $d);

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
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if(!empty($this->input->post('jenis_kegiatan_id', true))):
        if($this->input->post('jenis_kegiatan_id', true) == '3'){
            $this->form_validation->set_rules('propinsi_id', 'Propinsi Tujuan', 'required');
            $this->form_validation->set_rules('kota_id', 'Kota Tujuan', 'required');

            //tambahan nbs, tipe perjadin
            $this->form_validation->set_rules('tipe_perjadin', 'Tipe Perjalanan Dinas', 'required');
        } else {
            $this->form_validation->set_rules('waktu_mulai_submit', 'Waktu Mulai', 'required');
            $this->form_validation->set_rules('waktu_akhir_submit', 'Waktu Akhir', 'required');
            $this->form_validation->set_rules('lokasi', 'Lokasi Kegiatan', 'required');
//            $this->form_validation->set_rules('pic', 'Person In Charge (PIC)', 'required');
            //revisi nbs
            $this->form_validation->set_rules('pic_kegiatan[]', 'Person In Charge (PIC)', 'required');
        }
        endif;

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
            $data['kegiatan']               = $this->input->post('kegiatan',true);
            $data['tanggal_mulai']          = $this->functions->convert_date_sql($this->input->post('tanggal_mulai'));
            $data['tanggal_akhir']          = $this->functions->convert_date_sql($this->input->post('tanggal_akhir'));
            $data['keterangan']             = $this->input->post('keterangan', true);
            $data['mak']                    = $this->input->post('mak', true);
            $data['deskripsi_mak']          = $this->input->post('desc_mak', true);
            $data['unit_kerja_id']          = empty($this->session->unit_kerja)?'00000000':$this->session->unit_kerja;
            $data['user_id']                = $this->session->user_id;

            if($this->session->akses_id == '2'){
                if($this->session->jabatan == '00')
                    $data['mark'] = 'K';
                else
                    $data['mark'] = 'W';
            } elseif($this->session->akses_id >= '3'){
                $row = $this->m_kegiatan->get_mark_kalender($this->session->unit_kerja)->row_array();
                $data['mark'] = $row['mark'];
            } else {
                $data['mark'] = NULL;
            }

            if($data['jenis_kegiatan_id'] ==  '3'){
                $data['waktu_mulai']        = NULL;
                $data['waktu_akhir']        = NULL;
                $data['kota_tujuan']        = $this->input->post('kota_id', true);
                $lokasi = $this->m_kegiatan->fetch('kota', array('kota_id' => $data['kota_tujuan']))->row_array();
                $data['lokasi']             = $lokasi['kota'];
                $data['pic']                = NULL;

                //tambahan nbs, tipe perjadin
                $data['tipe_perjadin']              = $this->input->post('tipe_perjadin', true);
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
                $this->m_kegiatan->update('kegiatan', $data, array('kegiatan_id' => $id));
                $result['kegiatan_id']          = $id;

                //tambahan nbs
                $this->m_kegiatan->sync_subsektor( $id, $this->input->post('subsektor', true));
                $this->m_kegiatan->sync_pic( $id, $this->input->post('pic_kegiatan', true));
                $this->m_kegiatan->upsert_mak($data['mak'], $data['deskripsi_mak']);

                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $result['error']            = true;
                    $result['message']          = "Data kegiatan gagal diperbaharui!";
                    $result['type']             = "error";
                } else {
                    $this->db->trans_commit();
                    $result['error']            = false;
                    $result['message']          = "Data kegiatan berhasil diperbaharui!";
                    $result['type']             = "success";
                }
                $result['flag']                 = 'update';
            } else {
                //tambahan nbs
                if($this->session->akses_id == 4){
                    $data['status_tu'] = 1;
                } elseif($this->session->akses_id == 3) {
                    $data['status_tu'] = 1;
                    $data['status_keuangan'] = 1;
                }
                //-----

                // insert
                $data['created_by']             = $this->session->nama;
                $kegiatan_id = $this->m_kegiatan->save('kegiatan', $data, true);
                $result['kegiatan_id']      = $kegiatan_id;

                //tambahan nbs
                $this->m_kegiatan->sync_subsektor( $kegiatan_id, $this->input->post('subsektor', true));
                $this->m_kegiatan->sync_pic( $kegiatan_id, $this->input->post('pic_kegiatan', true));
                $this->m_kegiatan->upsert_mak($data['mak'], $data['deskripsi_mak']);
                //---

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
                $result['flag']                 = 'insert';
            }

        }

        echo json_encode($result);
    }

    public function save_peserta(){
        $this->functions->check_access2('kegiatan', 'add');
        if(!$this->input->is_ajax_request()) show_404();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('kegiatan_id', 'Kode Kegiatan', 'required');
        $this->form_validation->set_rules('jenis_kegiatan_id', 'Jenis Kegiatan', 'required');

        $this->form_validation->set_rules('nm_peserta', 'Nama Peserta', 'required');

        if(!empty($this->input->post('jenis_kegiatan_id', true))):
            if($this->input->post('jenis_kegiatan_id', true) == '3'){
                $this->form_validation->set_rules('nip', 'NIP', 'required|max_length[18]');
                $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai Dinas', 'required');
                $this->form_validation->set_rules('tanggal_akhir', 'Tanggal Selesai Dinas', 'required');
                $this->form_validation->set_rules('hotel', 'Hotel / Penginapan', 'required');

                $this->form_validation->set_rules('transport_pergi', 'Transport Pergi', 'numeric');
                $this->form_validation->set_rules('transport_pulang', 'Transport Pulang', 'numeric');
                $this->form_validation->set_rules('uang_harian', 'Uang Harian', 'numeric');

            } else {
                $this->form_validation->set_rules('nm_instansi', 'Nama Instansi', 'required');
                $this->form_validation->set_rules('status_peserta_id', 'Status Peserta', 'required');
            }
        endif;

        if ($this->form_validation->run() == FALSE) {
            $result['message'] = validation_errors();
            $result['type']   = 'error';
            $result['error']   = true;
        }
        else {
            $id = $this->input->post('peserta_kegiatan_id', true);

            //nbs tambahan
            if($this->input->post('pegawai_id', true)){
                $data['pegawai_id']            = $this->input->post('pegawai_id', true);

            }
            if($this->input->post('peserta_eksternal_id', true)){
                $data['peserta_eksternal_id']            = $this->input->post('peserta_eksternal_id', true);
            }
            //--

            $data['kegiatan_id']            = $this->input->post('kegiatan_id', true);
            //nbs tambahan dataEksternal
            $dataEksternal['nm_peserta'] =  $data['nm_peserta']             = ucwords(strtolower($this->input->post('nm_peserta', true)));
            $dataEksternal['golongan'] =  $data['golongan']               = $this->input->post('golongan', true);
            $dataEksternal['jabatan'] =  $data['jabatan']                = $this->input->post('jabatan', true);

            if($this->input->post('jenis_kegiatan_id', true) ==  '3'){
                $data['nip']                = $this->input->post('nip', true);

                $data['tanggal_mulai']      = $this->functions->convert_date_sql($this->input->post('tanggal_mulai', true));
                $data['tanggal_akhir']      = $this->functions->convert_date_sql($this->input->post('tanggal_akhir', true));
                $data['hotel']              = $this->input->post('hotel', true);
                $data['alamat_hotel']       = $this->input->post('alamat_hotel', true);

                $data['transport_pergi']    = !empty($this->input->post('transport_pergi', true))?$this->input->post('transport_pergi', true):0;
                $data['transport_pulang']   = !empty($this->input->post('transport_pulang', true))?$this->input->post('transport_pulang', true):0;
                $data['total_transport']    = $data['transport_pergi'] + $data['transport_pulang'];
                $data['uang_harian']        = !empty($this->input->post('uang_harian', true))?$this->input->post('uang_harian', true):0;
                $data['total']              = $data['total_transport'] + $data['uang_harian'];

            } else {
                //mbs tambahan dataEksternal
                $dataEksternal['nm_instansi'] = $data['nm_instansi']        = $this->input->post('nm_instansi', true);
                $dataEksternal['alamat'] = $data['alamat_peserta']     = $this->input->post('alamat_peserta', true);
                $dataEksternal['no_telepon'] = $data['no_telepon']         = $this->input->post('no_telepon', true);
                $dataEksternal['email'] = $data['email']              = $this->input->post('email', true);
                $dataEksternal['no_npwp'] = $data['no_npwp']            = $this->input->post('no_npwp', true);

                $data['status_peserta_id']  = $this->input->post('status_peserta_id', true);

                $data['total_transport']    = !empty($this->input->post('total_transport', true))?$this->input->post('total_transport', true):0;
                $data['uang_saku']          = !empty($this->input->post('uang_saku', true))?$this->input->post('uang_saku', true):0;
                $data['honor']              = !empty($this->input->post('honor', true))?$this->input->post('honor', true):0;
                $data['ppn']                = !empty($this->input->post('ppn', true))?$this->input->post('ppn', true):0;

                $data['total']              = ($data['total_transport'] + $data['uang_saku'] + $data['honor']) - $data['ppn'] ;
            }

            $this->db->trans_begin();

            if(!empty($id)){
                //update
                $data['modified_by']            = $this->session->nama;
                $this->m_kegiatan->update('peserta_kegiatan', $data, array('peserta_kegiatan_id' => $id));
                $result['peserta_kegiatan_id']  = $id;

                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $result['error']            = true;
                    $result['message']          = "Data peserta kegiatan gagal diperbaharui!";
                    $result['type']             = "error";
                } else {
                    $this->db->trans_commit();
                    $result['error']            = false;
                    $result['message']          = "Data peserta kegiatan berhasil diperbaharui!";
                    $result['type']             = "success";
                }
                $result['flag']                 = 'update';
            } else {
                // insert
                $data['created_by']             = $this->session->nama;
                //tambahan nbs
                if(!isset($data['peserta_eksternal_id']) && !isset($data['pegawai_id'])){
                    $data['peserta_eksternal_id'] = $this->m_kegiatan->save('nb_peserta_eksternal', $dataEksternal, true);
                }
                $peserta_kegiatan_id            = $this->m_kegiatan->save('peserta_kegiatan', $data, true);
                $result['kegiatan_id']          = $peserta_kegiatan_id;

                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $result['error']            = true;
                    $result['message']          = "Data peserta kegiatan gagal disimpan!";
                    $result['type']             = "error";
                } else {
                    $this->db->trans_commit();
                    $result['error']            = false;
                    $result['message']          = "Data peserta kegiatan berhasil disimpan!";
                    $result['type']             = "success";
                }
                $result['flag']                 = 'insert';
            }

        }

        echo json_encode($result);
    }

    public function delete(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $cek = $this->m_kegiatan->fetch('lampiran_kegiatan', array('kegiatan_id' => $id));
        if($cek->num_rows() > 0){
            $lampiran = $cek->result_array();

            $result['error']    = false;

            //delete remote file server
            $this->ftp->connect($this->ftp_config);
            foreach($lampiran as $t):
                $delete_file = $this->ftp->delete_file('./lampiran_kegiatan/'.$t['path_folder'].'/'.$t['file_name']);
                if($delete_file == FALSE){
                    $result['error']            = true;
                    $result['message']          = "File lampiran gagal dihapus!";
                    $result['type']             = "error";
                    $result['title']            = "Error";
                }
            endforeach;
            $this->ftp->close();

            $this->m_kegiatan->destroy('lampiran_kegiatan', array('kegiatan_id' => $id));
        }

        $this->m_kegiatan->destroy('kegiatan', array('kegiatan_id' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data kegiatan gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data kegiatan berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

    public function delete_peserta(){
        $this->functions->check_access2('kegiatan', 'delete');
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $this->m_kegiatan->destroy('peserta_kegiatan', array('peserta_kegiatan_id' => $id));

        $result['id'] = $id;

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data peserta kegiatan gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data peserta kegiatan berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

    public function get_list_kota(){
        if(!$this->input->is_ajax_request()) show_404();

        $propinsi_id = $this->input->post('propinsi_id', true);
        $kota_id = $this->input->post('kota_id', true);

        $kota = $this->m_kegiatan->fetch('kota', array('SUBSTR(kota_id,1,2)' => $propinsi_id))->result_array();

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

        $path_folder    = ($this->session->unit_kerja == NULL)?'00000000':$this->session->unit_kerja;

        $error = [];
        $success        = true;

//        $jenis_laporan = explode(',', $this->input->post('jenis_laporan', true));
        $jenis_laporan = $this->input->post('jenis_laporan');

//        var_dump($jenis_laporan);
//        var_dump($_FILES['lampiran']);
//        exit;

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
                $lampiran_kegiatan[$i]['path_folder']   = $path_folder;
                $lampiran_kegiatan[$i]['owner']         = $this->session->user_id;
                $lampiran_kegiatan[$i]['title']         = $upload_data['client_name'];
                $lampiran_kegiatan[$i]['created_by']    = $this->session->nama;

                //nbs tambahan
                $lampiran_kegiatan[$i]['jenis_laporan_id']   = $jenis_laporan[$i];
                if($this->session->akses_id == 4){
                    $lampiran_kegiatan[$i]['status_tu']  = 1;
                } elseif($this->session->akses_id == 3) {
                     $lampiran_kegiatan[$i]['status_tu']  = 1;
                      $lampiran_kegiatan[$i]['status_keuangan']  = 1;
                }

                /* sending to file server via FTP Start */
                $source = './uploads/lampiran_kegiatan/'.$upload_data['file_name'];

                $this->ftp->connect($this->ftp_config);

                //cek folder exist and create if not exists
                $is_dir = $this->ftp->changedir('/lampiran_kegiatan/'.$path_folder.'/', TRUE);

                if($is_dir === FALSE){
                    $mkdir = $this->ftp->mkdir('/lampiran_kegiatan/'.$path_folder.'/', 0755);
                    if($mkdir === FALSE){
                        $error[$i]      = 'Gagal membuat folder lampiran di file server!';
                        $success        = false;
                    }
                }

                // finally move file to file server
                $destination = '/lampiran_kegiatan/'.$path_folder.'/'.$upload_data['file_name'];
                $file_server_upload = $this->ftp->upload($source, $destination, 'auto', 0644);
                $this->ftp->close();
                @unlink($source);

                if($file_server_upload == FALSE){
                    $error[$i] = 'Gagal upload ke file server!';
                    $success   = false;
                }
            }
            else {
                $error[$i]      = $this->upload->display_errors();
                $success        = false;
            }
        }

        if(!empty($lampiran_kegiatan)){
            if($success == true){
                $this->m_kegiatan->insert($lampiran_kegiatan);
            }
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
//        $data['list_lampiran'] = $this->m_kegiatan->fetch('lampiran_kegiatan', array('kegiatan_id' => $id));
        //update NBS
        $data['list_lampiran'] = $this->m_kegiatan->fetch('lampiran_kegiatan', array('kegiatan_id' => $id)
            ,null , 'nb_jenis_laporan', 'lampiran_kegiatan.jenis_laporan_id = nb_jenis_laporan.jenis_laporan_id');

        $this->load->view('v_list_lampiran', $data);
    }

    public function get_list_peserta(){
        if(!$this->input->is_ajax_request()) show_404();

        $id = $this->input->post('id', true);

        $data['id'] = encode($id);

        $cek = $this->m_kegiatan->fetch('kegiatan', array('kegiatan_id' => $id));
        $kegiatan = $cek->row_array();

        if($kegiatan['jenis_kegiatan_id'] == 3){
            $data['list_peserta'] = $this->m_kegiatan->get_list_peserta_perjadin($id);
            $this->load->view('v_list_undangan_perjadin', $data);
        } else {
            $data['list_peserta'] = $this->m_kegiatan->get_list_peserta_fgd($id);
            #print_r($data); exit;
            $this->load->view('v_list_undangan_fgd', $data);
        }
    }

    //revisi nbs
    public function get_list_peserta_kegiatan(){
        if(!$this->input->is_ajax_request()) show_404();

        $id = $this->input->post('id', true);

        $data['id'] = encode($id);

        $cek = $this->m_kegiatan->fetch('kegiatan', array('kegiatan_id' => $id));
        $kegiatan = $cek->row_array();

        if($kegiatan['jenis_kegiatan_id'] == 3){
            $data['list_peserta'] = $this->m_kegiatan->get_list_peserta_kegiatan_perjadin($id);

            $this->load->view('peserta/v_list_undangan_perjadin', $data);
        } else {
            $data['list_peserta'] = $this->m_kegiatan->get_list_peserta_kegiatan_fgd($id);
            $this->load->view('peserta/v_list_undangan_fgd', $data);
        }
    }

    //nbs tambahan
    public function get_list_internal(){
        if(!$this->input->is_ajax_request()) show_404();

        $id = $this->input->post('id', true);

        $data['id'] = encode($id);

        $table_template = array('table_open' => '<table id="tbl-internal" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_heading('NPWP', 'Nama', 'Email', 'No Telp', 'Aksi');
        $this->table->set_template($table_template);

        $this->load->view('peserta/v_list_internal', $data);
    }

    //nbs tambahan
    public function get_list_eksternal(){
        if(!$this->input->is_ajax_request()) show_404();

        $id = $this->input->post('id', true);
        $data['id'] = encode($id);
        $cek = $this->m_kegiatan->fetch('kegiatan', array('kegiatan_id' => $id));
        $kegiatan = $cek->row_array();

//        if($kegiatan['jenis_kegiatan_id'] != 3){
            $table_template = array('table_open' => '<table id="tbl-eksternal" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
            $this->table->set_heading('NPWP', 'Nama', 'Email', 'No Telp', 'Aksi');
            $this->table->set_template($table_template);

            $this->load->view('peserta/v_list_eksternal', $data);
//        }

    }

    public function dt_eksternal(){
        if(!$this->input->is_ajax_request()) show_404();

        $filter  = $this->input->post('filter', true);

        $kegiatan_id = decode($this->input->post('id', true));

        $this->datatables->select('pe.peserta_eksternal_id as peserta_eksternal_id,
                                    pe.no_npwp,
                                    pe.nm_peserta,
                                    pe.email,
                                    pe.no_telepon,
                                    pk.peserta_kegiatan_id',
                                    FALSE)
            ->join('peserta_kegiatan pk', 'pe.peserta_eksternal_id = pk.peserta_eksternal_id AND pk.kegiatan_id = '.$kegiatan_id, 'left')
            ->where(['peserta_kegiatan_id' => null])
            ->from('nb_peserta_eksternal pe');

        $this->datatables->unset_column('peserta_eksternal_id');
        $this->datatables->unset_column('peserta_kegiatan_id');

        if(!empty($filter)){
            $this->datatables->where('nm_peserta', $filter);
        }

        $this->datatables->add_column('aksi',
            '<ul class="icons-list">
                <li><a href="#" onclick="getFormAddPesertaEksternal(\'$1\')" data-id="$1"><i class="icon-plus2"></i></a></li>
                </li>
            </ul>'
            ,'encode(peserta_eksternal_id)');
        echo $this->datatables->generate();

        #echo $this->db->last_query(); exit;
    }

    public function dt_internal(){
        if(!$this->input->is_ajax_request()) show_404();

        $filter  = $this->input->post('filter', true);

        $kegiatan_id = decode($this->input->post('id', true));

        $this->datatables->select('pe.pegawai_id as pegawai_id,
                                    pe.no_npwp as no_npwp,
                                    pe.nm_pegawai as nm_pegawai,
                                    pe.email as email,
                                    pe.no_telepon as no_telepon,
                                    pk.peserta_kegiatan_id as peserta_kegiatan_id',
                                    FALSE)
            ->join('peserta_kegiatan pk', 'pe.pegawai_id = pk.pegawai_id AND pk.kegiatan_id = '.$kegiatan_id, 'left')
            ->where(['peserta_kegiatan_id' => null])
            ->from('pegawai pe');

        $this->datatables->unset_column('pegawai_id');
        $this->datatables->unset_column('peserta_kegiatan_id');

        if(!empty($filter)){
            $this->datatables->where('nm_pegawai', $filter);
        }

        $this->datatables->add_column('aksi',
            '$1',
            'filterInstansi(pegawai_id, peserta_kegiatan_id)');
        echo $this->datatables->generate();

        #echo $this->db->last_query(); exit;
    }

    public function form_peserta_add(){
        $this->functions->check_access2('kegiatan', 'add');
        if(!$this->input->is_ajax_request()) show_404();

        $id                 = $this->input->post('id', true);
        $jenis_kegiatan_id  = $this->input->post('jenis_kegiatan_id', true);

        if(empty($id) && empty($jenis_kegiatan_id)) show_404();

        $d['kegiatan_id']       = $id;
        $d['jenis_kegiatan_id'] = $jenis_kegiatan_id;

        if($jenis_kegiatan_id == '3'){
            $this->load->view('f_peserta_perjadin',$d);
        } else {
            $d['l_status_peserta'] = $this->m_kegiatan->fetch('status_peserta')->result_array();
            $this->load->view('f_peserta_fgd',$d);
        }
    }

    //nbs tambahan
    public function form_peserta_add_eksternal(){
        $this->functions->check_access2('kegiatan', 'add');
        if(!$this->input->is_ajax_request()) show_404();

        $id                 = $this->input->post('id', true);
        $jenis_kegiatan_id  = $this->input->post('jenis_kegiatan_id', true);

        if(empty($id) && empty($jenis_kegiatan_id)) show_404();

        $d['kegiatan_id']       = $id;
        $d['jenis_kegiatan_id'] = $jenis_kegiatan_id;

        if($jenis_kegiatan_id == '3'){
            $this->load->view('peserta/f_add_peserta_perjadin',$d);
        } else {
            $d['l_status_peserta'] = $this->m_kegiatan->fetch('status_peserta')->result_array();
            $this->load->view('peserta/f_add_peserta_fgd',$d);
        }
    }

    public function form_peserta_internal(){
        $this->functions->check_access2('kegiatan', 'add');
        if(!$this->input->is_ajax_request()) show_404();

        $kegiatan_id                 = $this->input->post('kegiatan_id', true);
        $jenis_kegiatan_id  = $this->input->post('jenis_kegiatan_id', true);
        $pegawai_id  = decode($this->input->post('pegawai_id', true));

        if(empty($id) && empty($jenis_kegiatan_id)) show_404();

        $d['kegiatan_id']       = $kegiatan_id;
        $d['jenis_kegiatan_id'] = $jenis_kegiatan_id;
        $d['pegawai_id'] = $pegawai_id;
        $d['peserta_eksternal_id'] = null;

        $d['peserta'] = $this->m_kegiatan->fetch('pegawai',['pegawai_id' => $pegawai_id])->row_array();
        $d['peserta']['peserta_eksternal_id'] = null;
        $d['peserta']['pegawai_id'] = $pegawai_id;

        if($jenis_kegiatan_id == '3'){
            $this->load->view('peserta/f_peserta_perjadin',$d);
        } else {
            $d['l_status_peserta'] = $this->m_kegiatan->fetch('status_peserta')->result_array();
            $this->load->view('peserta/f_peserta_fgd',$d);
        }
    }

    public function form_peserta_eksternal(){
        $this->functions->check_access2('kegiatan', 'add');
        if(!$this->input->is_ajax_request()) show_404();

        $kegiatan_id                 = $this->input->post('kegiatan_id', true);
        $jenis_kegiatan_id  = $this->input->post('jenis_kegiatan_id', true);
        $peserta_eksternal_id  = decode($this->input->post('peserta_eksternal_id', true));

        if(empty($id) && empty($jenis_kegiatan_id)) show_404();

        $d['kegiatan_id']       = $kegiatan_id;
        $d['jenis_kegiatan_id'] = $jenis_kegiatan_id;
        $d['peserta_eksternal_id'] = $peserta_eksternal_id;
        $d['pegawai_id'] = null;

        $d['peserta'] = $this->m_kegiatan->fetch('nb_peserta_eksternal',['peserta_eksternal_id' => $peserta_eksternal_id])->row_array();
        $d['peserta']['peserta_eksternal_id'] = $peserta_eksternal_id;
        $d['peserta']['pegawai_id'] = null;

        if($jenis_kegiatan_id == '3'){
            $this->load->view('peserta/f_peserta_perjadin',$d);
        } else {
            $d['l_status_peserta'] = $this->m_kegiatan->fetch('status_peserta')->result_array();
            $this->load->view('peserta/f_peserta_fgd',$d);
        }
    }


    public function form_peserta_edit(){
        $this->functions->check_access2('kegiatan', 'edit');
        if(!$this->input->is_ajax_request()) show_404();

        $id                 = decode($this->input->post('id', true));
        $jenis_kegiatan_id  = $this->input->post('jenis_kegiatan_id', true);

        if(empty($id) && empty($jenis_kegiatan_id)) show_404();

        $d['peserta']              = $this->m_kegiatan->fetch('peserta_kegiatan', array('peserta_kegiatan_id' => $id), NULL, 'status_peserta', 'peserta_kegiatan.status_peserta_id = status_peserta.status_peserta_id')->row_array();
        $d['jenis_kegiatan_id']     = $jenis_kegiatan_id;

        if($jenis_kegiatan_id == '3'){
            $d['peserta']             = $this->m_kegiatan->fetch('peserta_kegiatan', array('peserta_kegiatan_id' => $id))->row_array();
//            $this->load->view('f_peserta_perjadin',$d);
            //revisi nbs
            $this->load->view('peserta/f_peserta_perjadin',$d);
        } else {
            $d['peserta']             = $this->m_kegiatan->fetch('peserta_kegiatan', array('peserta_kegiatan_id' => $id), NULL, 'status_peserta', 'peserta_kegiatan.status_peserta_id = status_peserta.status_peserta_id')->row_array();
            $d['l_status_peserta'] = $this->m_kegiatan->fetch('status_peserta')->result_array();
//            $this->load->view('f_peserta_fgd',$d);
            //revisi nbs
            $this->load->view('peserta/f_peserta_fgd',$d);
        }
    }

    public function form_peserta_view(){
        if(!$this->input->is_ajax_request()) show_404();

        $id                 = decode($this->input->post('id', true));
        $jenis_kegiatan_id  = $this->input->post('jenis_kegiatan_id', true);

        if(empty($id) && empty($jenis_kegiatan_id)) show_404();


        $d['jenis_kegiatan_id']   = $jenis_kegiatan_id;

        if($jenis_kegiatan_id == '3'){
            $d['peserta']             = $this->m_kegiatan->fetch('peserta_kegiatan', array('peserta_kegiatan_id' => $id))->row_array();
            $this->load->view('v_peserta_perjadin',$d);
        } else {
            $d['peserta']             = $this->m_kegiatan->fetch('peserta_kegiatan', array('peserta_kegiatan_id' => $id), NULL, 'status_peserta', 'peserta_kegiatan.status_peserta_id = status_peserta.status_peserta_id')->row_array();
            $this->load->view('v_peserta_fgd',$d);
        }
    }

    public function delete_lampiran(){
        if(!$this->input->is_ajax_request()) show_404();
        $this->functions->check_access2('kegiatan', 'delete');

        $lampiran_id = decode($this->input->post('lampiran_id', true));
        $kegiatan_id = decode($this->input->post('kegiatan_id', true));

        $cek = $this->m_kegiatan->fetch('lampiran_kegiatan', array('lampiran_kegiatan_id' => $lampiran_id));

        if($cek->num_rows() > 0) {
            $lampiran = $cek->row_array();

            $result['error']    = false;

            $source_dir = './uploads/lampiran_kegiatan/';
            $filename = $lampiran['file_name'];

            if(file_exists($source_dir . $filename)){
                if(is_file($source_dir . $filename)){
                    unlink($source_dir . $filename);
                }
            }

            //delete remote file server
            $this->ftp->connect($this->ftp_config);
            $delete_file = $this->ftp->delete_file('./lampiran_kegiatan/'.$lampiran['path_folder'].'/'.$filename);
            $this->ftp->close();

            if($delete_file == FALSE){
                $result['error']            = true;
                $result['message']          = "File lampiran gagal dihapus!";
                $result['type']             = "error";
                $result['title']            = "Error";
            }

            $result['kegiatan_id'] = $kegiatan_id;

            $this->db->trans_begin();

            if($result['error'] == false){
                $this->m_kegiatan->destroy('lampiran_kegiatan', array('lampiran_kegiatan_id' => $lampiran_id));

                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $result['error']            = true;
                    $result['message']          = "File lampiran gagal dihapus!";
                    $result['type']             = "error";
                    $result['title']            = "Error";
                } else {
                    $this->db->trans_commit();
                    $result['error']            = false;
                    $result['message']          = "File lampiran berhasil dihapus!";
                    $result['type']             = "success";
                    $result['title']            = "Sukses";
                }
            }
        } else {
            $result['error']            =  true;
            $result['message']          = "File lampiran tidak ditemukan!";
            $result['type']             = "error";
        }

        echo json_encode($result);
    }

    function search_pegawai_by_nip(){
        if(!$this->input->is_ajax_request()) show_404();

        $nip    = $this->input->post('nip');
        $data   = $this->m_kegiatan->get_pegawai_by_nip($nip);

        if($data->num_rows() > 0){
            $result['error']    = false;
            $result['pegawai']  = $data->row_array();
        } else {
            $result['error']    = true;
            $result['pegawai']  = null;
            $result['message']  = 'Pegawai tidak ditemukan';
        }

        echo json_encode($result);
    }

    function autocomplete_pegawai_by_nama(){
        if(!$this->input->is_ajax_request()) show_404();

        $nama    = $this->input->post('nama');
        $data   = $this->m_kegiatan->autocomplete_pegawai_by_nama($nama);

        echo json_encode($data);
    }

    function get_list_eselon2(){
        if(!$this->input->is_ajax_request()) show_404();
        $id = $this->input->post('id', true);

        $result = $this->m_kegiatan->get_list_eselon2($id);

        echo $result;
    }

    function get_list_eselon3(){
        if(!$this->input->is_ajax_request()) show_404();
        $id = $this->input->post('id', true);

        $result = $this->m_kegiatan->get_list_eselon3($id);

        echo $result;
    }

    function get_list_eselon4(){
        if(!$this->input->is_ajax_request()) show_404();
        $id = $this->input->post('id', true);

        $result = $this->m_kegiatan->get_list_eselon4($id);

        echo $result;
    }

    function get_deskripsi_mak($mak){

        $mak = $this->m_kegiatan->fetch('nb_mak', ['mak' => $mak])->row_array();
        if($mak){
            echo $mak['deskripsi'];
        }
    }

    function get_reply_lampiran()
    {

        $id = $this->input->post('id', true);

        $lampiran_kegiatan = $this->m_kegiatan->fetch('lampiran_kegiatan',
            ['lampiran_kegiatan_id' => $id])->row_array();
//        var_dump($lampiran_kegiatan);exit;
        $this->load->view('reply_lampiran',$lampiran_kegiatan);
    }
}

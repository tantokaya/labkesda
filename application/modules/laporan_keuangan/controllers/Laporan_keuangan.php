<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_keuangan extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->functions->check_session();
        // $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_laporan_keuangan');

        $this->load->library('Datatables');
        $this->load->library('table');
	}

	function index()
	{
		$d['page_title']    = 'Keuangan';
        $d['menus']         = $this->functions->generate_menu();

        // $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        // $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-laporan-keuangan" width="100%" class="table table-striped table-responsive table-bordered datatable">');
        $this->table->set_template($tmpl);

        // if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Nama Kegiatan', 'Jenis','Lokasi','Satker','Tanggal Awal','Tanggal Akhir','Status','Aksi');
        // } else {
            // $this->table->set_heading('Nama Kegiatan', 'Jenis','Lokasi','Satker','Tanggal Awal','Tanggal Akhir','Status');
        // }


        $this->template->set_layout('backoffice')->title('Laporan Keuangan - Badan Ekonomi Kreatif Indonesia')->build('v_laporan_keuangan', $d);
	}

	function dt_laporan_keuangan()
	{
		if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);

        $this->datatables->select('k.kegiatan_id as kode, lk.kegiatan_id, lk.reply_tu, lk.status_tu, k.unit_kerja_id,
            k.kegiatan_id, CONCAT(k.mark," -",k.kegiatan) as kegiatan, DATE_FORMAT(k.tanggal_mulai, \'%d/%m/%Y\') as tanggal_mulai, DATE_FORMAT(k.tanggal_akhir, \'%d/%m/%Y\') as tanggal_akhir, k.lokasi as lokasi, k.status_tu, k.status_keuangan, j.jenis_kegiatan_id, j.jenis_kegiatan as jenis_kegiatan, uk.unit_kerja_id, uk.unit_kerja as unit_kerja', FALSE)
                        ->from('lampiran_kegiatan as lk')
                        ->join('kegiatan as k','lk.kegiatan_id = k.kegiatan_id','LEFT')
                        ->join('unit_kerja as uk','k.unit_kerja_id = uk.unit_kerja_id','LEFT')
                        ->join('jenis_kegiatan as j','k.jenis_kegiatan_id = j.jenis_kegiatan_id','LEFT')
                        // ->select('u.user_id, u.akses_id')
                        // ->join('user as u','k.user_id = u.user_id','LEFT')
                        // ->where('u.akses_id !=',3)
                        ->where('k.status_tu =',1)
                        ->group_by('kegiatan');

        $this->datatables->unset_column('kode');

        $view_button = '<li><a href="'.base_url('laporan_keuangan/edit/$1').'"><i class="icon-eye"></i> Lihat</a></li>';
        $divider = '<li class="divider"></li>';
        $selesai_button = '<li><a href="#" data-id="$1" data-toggle="modal" data-target="#mdl_selesai" class="view"><i class="icon-check"></i> Selesai</a></li>';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $view_button . $divider . $selesai_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();
	}

	function edit()
	{
		// $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Bagian Keuangan';
        $d['menus']         = $this->functions->generate_menu();

        $kegiatan_id = decode($this->uri->segment(3));
        if(!empty($kegiatan_id)) {
            $cek = $this->m_laporan_keuangan->fetch('kegiatan', array('kegiatan_id' => $kegiatan_id));
           
            if($cek->num_rows() > 0) {
                $d['kegiatan'] = $cek->row_array();

                $d['l_tipe_kegiatan']   = $this->m_laporan_keuangan->fetch('tipe_kegiatan')->result_array();
                $d['l_jenis_kegiatan']  = $this->m_laporan_keuangan->fetch('jenis_kegiatan')->result_array();
                $d['l_propinsi'] = $this->m_laporan_keuangan->fetch('propinsi')->result_array();

                //nbs tambahan
                $d['l_subsektor']   = $this->m_laporan_keuangan->fetch('nb_subsektor')->result_array();
                $d['filled_subsektor']   = $this->m_laporan_keuangan->fetch('nb_kegiatan_subsektor', ["kegiatan_id"=>$kegiatan_id])->result_array();
                $d['l_mak']   = $this->m_laporan_keuangan->fetch('nb_mak')->result_array();
                $d['l_pegawai']   = $this->m_laporan_keuangan->fetch('pegawai')->result_array();
                $d['filled_pic']   = $this->m_laporan_keuangan->fetch('nb_kegiatan_pic', ["kegiatan_id"=>$kegiatan_id])->result_array();
                $d['mark'] = $this->getMark();
                //------

                $d['l_pengaturan_laporan']   = $this->m_laporan_keuangan->fetch('nb_pengaturan_laporan', ['jenis_kegiatan_id' => $cek->row()->jenis_kegiatan_id], null,
                    'nb_jenis_laporan', 'nb_pengaturan_laporan.jenis_laporan_id = nb_jenis_laporan.jenis_laporan_id')
                    ->result_array();

                if($d['kegiatan']['jenis_kegiatan_id'] == '3') {

                    $d['l_kota'] = $this->m_laporan_keuangan->fetch('kota', array('SUBSTRING(kota_id,1,2)' => substr($d['kegiatan']['kota_tujuan'], 0, 2)))->result_array();
                } 
            }
        } else {
            redirect('laporan_keuangan');
        }

        $this->template->set_layout('backoffice')
                        ->title('Validasi Laporan Bagian Keuangan - Badan Ekonomi Kreatif Indonesia')
                        ->build('validasi_laporan_keuangan', $d);
	}

    function selesai()
    {
        $kegiatan_id = decode($this->input->post('id'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'required');

        if ($this->form_validation->run() == FALSE) {
            # code...
        } else {
            $id['kegiatan_id']          = $kegiatan_id;

            $data['status_keuangan']    = 1;
            // return var_dump($data['status_tu']);
            // $data['modified_by']        = $this->session->nama;
            
            // return var_dump($data);

            $this->db->trans_begin();
            $this->m_laporan_keuangan->update('kegiatan', $data, $id);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Status laporan gagal divalidasi";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Status laporan berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('laporan_keuangan');
        }
    }

    function notes()
    {
        $lampiran_kegiatan_id = decode($this->input->post('lampiran_kegiatan_id'));
        $url = $this->input->post('url');
        // return var_dump($url);

        $this->load->library('form_validation');

        $this->form_validation->set_rules('status_keuangan', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            # code...
        } else {
            $id['lampiran_kegiatan_id'] = $lampiran_kegiatan_id;

            $data['reply_keuangan']     = !empty($this->input->post('reply_keuangan', true))?$this->input->post('reply_keuangan', true):NULL;
            $data['status_keuangan']    = $this->input->post('status_keuangan');

            $this->db->trans_begin();
            $this->m_laporan_keuangan->update('lampiran_kegiatan', $data, $id);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Status laporan gagal divalidasi";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Status laporan berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('laporan_keuangan/edit/'.$url);
        }
    }

    //tambahan nbs, wrap get_mark_calendar for code reusability
    function getMark()
    {
        $mark = null;
        if($this->session->akses_id == '2'){
            if($this->session->jabatan == '00')
                $mark = 'K';
            else
                $mark = 'W';
        } elseif($this->session->akses_id >= '3'){
            $row = $this->m_laporan_keuangan->get_mark_kalender($this->session->unit_kerja)->row_array();
            $mark = $row['mark'];
        } else {
            $mark = NULL;
        }
        return $mark;
    }

    function get_list_lampiran() {
        if(!$this->input->is_ajax_request()) show_404();

        $id = $this->input->post('id', true);
        $data['id'] = encode($id);
//        $data['list_lampiran'] = $this->m_kegiatan->fetch('lampiran_kegiatan', array('kegiatan_id' => $id));
        //update NBS
        // $data['list_lampiran'] = $this->m_laporan_keuangan->fetch('lampiran_kegiatan', array('kegiatan_id' => $id)
        //     ,null , 'nb_jenis_laporan', 'lampiran_kegiatan.jenis_laporan_id = nb_jenis_laporan.jenis_laporan_id');
        $data['list_lampiran'] = $this->m_laporan_keuangan->get_lampiran_kegiatan($id);
        foreach ($data['list_lampiran']->result_array() as $t) {
            $dd[] = $t['jenis_laporan_id'];
        }

        $jenis_laporan_id = $dd;
        $data['lampiran_exist'] = $this->m_laporan_keuangan->lampiran_not_exist($id, $jenis_laporan_id)->result_array();
        // echo "<pre>";
        // return var_dump($data['lampiran_exist']);

        $this->load->view('v_list_lampiran', $data);
    }

}

/* End of file Laporan_keuangan.php */
/* Location: ./application/modules/laporan_keuangan/controllers/Laporan_keuangan.php */
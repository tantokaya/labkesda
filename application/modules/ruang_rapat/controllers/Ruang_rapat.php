<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruang_rapat extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_ruang_rapat');

        $this->load->library('Datatables');
        $this->load->library('table');	
	}
	
	function index()
	{
		$d['page_title']    = 'Jadwal Ruang Rapat';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-ruang-rapat" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Tanggal','Jam','Ruang Rapat','Perihal','PIC','Satker', 'Aksi');
        } else {
            $this->table->set_heading('Tanggal','Jam','Ruang Rapat','Perihal','PIC','Satker');
        }

        $this->template->set_layout('backoffice')->title('Ruang Rapat - Badan Ekonomi Kreatif Indonesia')->build('v_ruang_rapat', $d);
	}

	function dt_ruang_rapat()
	{
		if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('id as kode, jr.ruang_id, jr.pic as pic, DATE_FORMAT(jr.tanggal,\'%d/%m/%Y\') as tanggal ,CONCAT(TIME_FORMAT(jr.jam_mulai, \'%H:%i\')," - ",TIME_FORMAT(jr.jam_selesai, \'%H:%i\'), " WIB") as waktu , jr.deskripsi_rapat as deskripsi_rapat, jr.keterangan,  r.ruang_id, r.nama_ruang as nama_ruang, uk.unit_kerja_id, uk.unit_kerja as unit_kerja', FALSE)
                    ->from('jadwal_ruang as jr')
                    ->join('ruang as r','jr.ruang_id = r.ruang_id','LEFT')
                    ->join('unit_kerja as uk','jr.unit_kerja_id = uk.unit_kerja_id','LEFT');


        $this->datatables->unset_column('kode');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('ruang_rapat/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();
	}

    function add ()
    {
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Jadwal Ruang Rapat';
        $d['menus']         = $this->functions->generate_menu();

        $user_id            = $this->session->user_id;
        $d['ruang']         = $this->m_ruang_rapat->fetch('ruang',['user_id'=> $user_id])->result_array();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('ruang_id', 'Ruang Rapat', 'required');
        // pic => pegawai_id
        $this->form_validation->set_rules('pic', 'PIC', 'required');
        $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
        $this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');
        $this->form_validation->set_rules('deskripsi_rapat', 'Deskripsi Rapat', 'required');

        if ($this->form_validation->run() == FALSE) {
            # code...
        } else {
            $this->db->trans_begin();

            $data['tanggal']            = $this->functions->convert_date_sql($this->input->post('tanggal', true));
            $data['ruang_id']           = $this->input->post('ruang_id', true);
            $data['pic']                = $this->input->post('pic', true);
            // $data['pic']                = $this->session->nama;
            $data['jam_mulai']          = $this->input->post('jam_mulai', true);
            $data['jam_selesai']        = $this->input->post('jam_selesai', true);
            $data['deskripsi_rapat']    = $this->input->post('deskripsi_rapat', true);
            $data['keterangan']         = !empty($this->input->post('keterangan', true))?$this->input->post('keterangan', true):NULL;
            $data['unit_kerja_id']      = $this->input->post('unit_kerja_id', true);
            // $data['unit_kerja_id']      = $this->session->unit_kerja;
            $data['created_by']         = $this->session->nama;
            
            // echo "<pre>";
            // return var_dump($data);

            $this->m_ruang_rapat->save('jadwal_ruang', $data, true);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data jadwal ruang rapat gagal disimpan!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data jadwal ruang rapat berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('ruang_rapat');
        }

        $this->template->set_layout('backoffice')->title('Tambah Jadwal Ruang Rapat - Badan Ekonomi Kreatif Indonesia')->build('f_ruang_rapat', $d);

    }

    function edit()
    {
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Jadwal Ruang Rapat';
        $d['menus']         = $this->functions->generate_menu();

        $user_id            = $this->session->user_id;
        $d['ruang']         = $this->m_ruang_rapat->fetch('ruang',['user_id'=> $user_id])->result_array();

        $id = decode($this->uri->segment(3));
        if(!empty($id)) {
            // $cek = $this->m_ruang_rapat->get_ruang_rapat($id);

            $cek = $this->m_ruang_rapat->fetch('jadwal_ruang',['id' => $id]);
            if($cek->num_rows() > 0) {
                $d['ruang_rapat'] = $cek->row_array();

                // echo "<pre>";
                // return var_dump($d['ruang_rapat']);
            } else {
                redirect('ruang_rapat');
            }
        } else {
            redirect('ruang_rapat');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('ruang_id', 'Ruang Rapat', 'required');
        // pic => pegawai_id
        $this->form_validation->set_rules('pic', 'PIC', 'required');
        $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
        $this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');
        $this->form_validation->set_rules('deskripsi_rapat', 'Deskripsi Rapat', 'required');

        if ($this->form_validation->run() == FALSE) {
            # code...
        } else {
            $key['id'] = $id;

            $data['tanggal']            = $this->functions->convert_date_sql($this->input->post('tanggal', true));
            $data['ruang_id']           = $this->input->post('ruang_id', true);
            $data['pic']                = $this->input->post('pic', true);
            $data['unit_kerja_id']      = $this->input->post('unit_kerja_id', true);
            // $data['pic']                = $this->session->nama;
            // $data['unit_kerja_id']      = $this->session->unit_kerja;
            $data['jam_mulai']          = $this->input->post('jam_mulai', true);
            $data['jam_selesai']        = $this->input->post('jam_selesai', true);
            $data['deskripsi_rapat']    = $this->input->post('deskripsi_rapat', true);
            $data['keterangan']         = !empty($this->input->post('keterangan', true))?$this->input->post('keterangan', true):NULL;
            $data['modified_by']         = $this->session->nama;
            
            echo "<pre>";
            return var_dump($data);

            $this->db->trans_begin();
            $this->m_ruang_rapat->update('jadwal_ruang', $data, $key);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data jadwal ruang rapat gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data jadwal ruang rapat berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('ruang_rapat');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Jadwal Ruang Rapat - Badan Ekonomi Kreatif Indonesia')->build('f_ruang_rapat', $d);

    }

    function delete()
    {
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(! $this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', TRUE));

        $this->db->trans_begin();

        $this->m_ruang_rapat->destroy('jadwal_ruang', array('id' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data jadwal ruang rapat gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data jadwal ruang rapat berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

    function autocomplete_pegawai_by_nama()
    {
        if(!$this->input->is_ajax_request()) show_404();

        $nama    = $this->input->post('nama');
        $data   = $this->m_ruang_rapat->autocomplete_pegawai_by_nama($nama);

        echo json_encode($data);
    }

    function get_jadwal_ruangan()
    {
        if(!$this->input->is_ajax_request()) show_404();

        $ruang_id = $this->input->post('id', true);
        $tanggal = $this->functions->convert_date_sql($this->input->post('tanggal', true));

        if(($ruang_id && $tanggal) != NULL) {

            $cek = $this->m_ruang_rapat->get_jadwal_ruangan($ruang_id, $tanggal);

            if($cek->num_rows() > 0) {
                $d['ruang_rapat'] = $cek->result_array();
            } else {
                $d = [];
            }
        }
       
        $this->load->view('modal_ruang_rapat', $d);    
    }

    function get_available_time()
    {
        // $this->m_ruang_rapat->get_available_time($ruang_id, $waktu);
    }
}

/* End of file Ruang_rapat.php */
/* Location: ./application/modules/ruang_rapat/controllers/Ruang_rapat.php */
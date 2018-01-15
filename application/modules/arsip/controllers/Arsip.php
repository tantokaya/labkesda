<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Arsip extends MX_Controller {
    protected $ftp_config;

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();

        $this->load->model('m_arsip');

        $this->load->library('Datatables');
        $this->load->library('table');

        $this->load->library('ftp');
        $this->ftp_config = $this->load->config('ftp', true);
    }

    public function index() {
        $d['page_title']    = 'Arsip Publik';
        $d['menus']         = $this->functions->generate_menu();


        if($this->session->unit_kerja == NULL){
            $d['parent']        = '';
            $d['level']         = '0';
            $d['path']          = '';
        } else {
            $satker             = $this->m_arsip->fetch('arsip', array('unit_kerja_id' => $this->session->unit_kerja))->row_array();
            $d['parent']        = $satker['arsip_id'];
            $d['level']         = $satker['level']+1;

            $path      = '';
            $akses     = $this->session->akses_id;
            $uk        = $this->session->unit_kerja;

            switch($akses) :
                case '2':  //kepala
                    $row = $this->m_arsip->fetch('arsip', array('unit_kerja_id' => $uk))->row_array();
                    $path .= ','.$row['arsip_id'];
                    break;
                case '3' : // Es 1
                    $row = $this->m_arsip->fetch('arsip', array('unit_kerja_id' => $uk))->row_array();
                    $path .= ','.$row['arsip_id'];
                    break;
                case '4':  // Es 2
                    $es1    = substr($uk,0,2).'00';
                    $row    = $this->m_arsip->fetch('arsip', array('SUBSTRING(unit_kerja_id,1,4)' => $es1))->row_array();
                    $path  .= ','.$row['arsip_id'];

                    $row = $this->m_arsip->fetch('arsip', array('unit_kerja_id' => $uk))->row_array();
                    $path .= ','.$row['arsip_id'];
                    break;
                case '5' : // Es 3
                    $es1    = substr($uk,0,2).'00';
                    $row    = $this->m_arsip->fetch('arsip', array('SUBSTRING(unit_kerja_id,1,4)' => $es1))->row_array();
                    $path  .= ','.$row['arsip_id'];

                    $es2    = substr($uk,0,4).'00';
                    $row    = $this->m_arsip->fetch('arsip', array('SUBSTRING(unit_kerja_id,1,6)' => $es2))->row_array();
                    $path  .= ','.$row['arsip_id'];

                    $row = $this->m_arsip->fetch('arsip', array('unit_kerja_id' => $uk))->row_array();
                    $path .= ','.$row['arsip_id'];
                    break;
                case '6' : // Es 4
                    $es1    = substr($uk,0,2).'00';
                    $row    = $this->m_arsip->fetch('arsip', array('SUBSTRING(unit_kerja_id,1,4)' => $es1))->row_array();
                    $path  .= ','.$row['arsip_id'];

                    $es2    = substr($uk,0,4).'00';
                    $row    = $this->m_arsip->fetch('arsip', array('SUBSTRING(unit_kerja_id,1,6)' => $es2))->row_array();
                    $path  .= ','.$row['arsip_id'];

                    $es3    = substr($uk,0,6).'00';
                    $row    = $this->m_arsip->fetch('arsip', array('SUBSTRING(unit_kerja_id,1,8)' => $es3))->row_array();
                    $path  .= ','.$row['arsip_id'];

                    $row = $this->m_arsip->fetch('arsip', array('unit_kerja_id' => $uk))->row_array();
                    $path .= ','.$row['arsip_id'];
                    break;
            endswitch;

            $d['path']          = $path;
        }

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-arsip" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        $this->table->set_heading('Kode', 'Arsip', 'Deskripsi', 'Waktu dibuat', 'Waktu diperbaharui', 'Aksi');

        $this->template->set_layout('backoffice')->title('Arsip Publik - Badan Ekonomi Kreatif Indonesia')->build('v_arsip', $d);
    }

    public function saya()
    {
        $d['page_title']    = 'Arsip Saya';
        $d['menus']         = $this->functions->generate_menu();


        if($this->session->unit_kerja == NULL){
            $d['parent']        = '';
            $d['level']         = '0';
            $d['path']          = '';
        } else {
            $satker             = $this->m_arsip->fetch('arsip', array('unit_kerja_id' => $this->session->unit_kerja))->row_array();
            $d['parent']        = $satker['arsip_id'];
            $d['level']         = $satker['level']+1;

            $path      = '';
            $akses     = $this->session->akses_id;
            $uk        = $this->session->unit_kerja;

            switch($akses) :
                case '2':  //kepala
                    $row = $this->m_arsip->fetch('arsip', array('unit_kerja_id' => $uk))->row_array();
                    $path .= ','.$row['arsip_id'];
                    break;
                case '3' : // Es 1
                    $row = $this->m_arsip->fetch('arsip', array('unit_kerja_id' => $uk))->row_array();
                    $path .= ','.$row['arsip_id'];
                    break;
                case '4':  // Es 2
                    $es1    = substr($uk,0,2).'00';
                    $row    = $this->m_arsip->fetch('arsip', array('SUBSTRING(unit_kerja_id,1,4)' => $es1))->row_array();
                    $path  .= ','.$row['arsip_id'];

                    $row = $this->m_arsip->fetch('arsip', array('unit_kerja_id' => $uk))->row_array();
                    $path .= ','.$row['arsip_id'];
                    break;
                case '5' : // Es 3
                    $es1    = substr($uk,0,2).'00';
                    $row    = $this->m_arsip->fetch('arsip', array('SUBSTRING(unit_kerja_id,1,4)' => $es1))->row_array();
                    $path  .= ','.$row['arsip_id'];

                    $es2    = substr($uk,0,4).'00';
                    $row    = $this->m_arsip->fetch('arsip', array('SUBSTRING(unit_kerja_id,1,6)' => $es2))->row_array();
                    $path  .= ','.$row['arsip_id'];

                    $row = $this->m_arsip->fetch('arsip', array('unit_kerja_id' => $uk))->row_array();
                    $path .= ','.$row['arsip_id'];
                    break;
                case '6' : // Es 4
                    $es1    = substr($uk,0,2).'00';
                    $row    = $this->m_arsip->fetch('arsip', array('SUBSTRING(unit_kerja_id,1,4)' => $es1))->row_array();
                    $path  .= ','.$row['arsip_id'];

                    $es2    = substr($uk,0,4).'00';
                    $row    = $this->m_arsip->fetch('arsip', array('SUBSTRING(unit_kerja_id,1,6)' => $es2))->row_array();
                    $path  .= ','.$row['arsip_id'];

                    $es3    = substr($uk,0,6).'00';
                    $row    = $this->m_arsip->fetch('arsip', array('SUBSTRING(unit_kerja_id,1,8)' => $es3))->row_array();
                    $path  .= ','.$row['arsip_id'];

                    $row = $this->m_arsip->fetch('arsip', array('unit_kerja_id' => $uk))->row_array();
                    $path .= ','.$row['arsip_id'];
                    break;
            endswitch;

            $d['path']          = $path;

        }


        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-arsip" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        $this->table->set_heading('Kode', 'Arsip', 'Deskripsi', 'Tipe', 'Waktu dibuat', 'Waktu diperbaharui', 'Aksi');

        $this->template->set_layout('backoffice')->title('Arsip Saya - Badan Ekonomi Kreatif Indonesia')->build('v_arsip_saya', $d);
    }

    //tambahan nbs
    public function kegiatan()
    {
        $d['page_title']    = 'Arsip Kegiatan';
        $d['menus']         = $this->functions->generate_menu();

//        $this->m_arsip->fetch('unit_kerja', array('unit_kerja_id' => $uk))->row_array();

        if($this->session->unit_kerja == NULL){
            $d['parent']        = '';
            $d['level']         = '0';
            $d['path']          = '';
            $d['returntype']          = '';
        } else {
            $satker             = $this->m_arsip->fetch('arsip', array('unit_kerja_id' => $this->session->unit_kerja))->row_array();
            $d['parent']        = $satker['arsip_id'];
            $d['level']         = $satker['level']+1;
            $d['returntype']         = 'unitkerja';

            $path      = '';
            $akses     = $this->session->akses_id;
            $uk        = $this->session->unit_kerja;

            $d['path']          = $path;

        }


        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-arsip" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        $this->table->set_heading('Kode', 'Arsip', 'Deskripsi', 'Waktu dibuat', 'Waktu diperbaharui');

        $this->template->set_layout('backoffice')->title('Arsip Kegiatan - Badan Ekonomi Kreatif Indonesia')->build('v_arsip_kegiatan', $d);
    }

    //NBS TAMBAHAN
    public function dt_arsip_kegiatan(){
        if(!$this->input->is_ajax_request()) show_404();

        $type = $this->input->post('returntype', true);

        if($type == 1){
            $unit_kerja_id = $this->input->post('unit_kerja_id', true);
            $this->datatables->select('kegiatan_id as kode,
                                    concat(
                                        ifnull(
                                            concat(mark, \' - \'),
                                            \'\'
                                        ),
                                        kegiatan
                                    ) as arsip,
                                    deskripsi_mak as deskripsi,
                                    (2) as returntype,
                                    DATE_FORMAT(a.ctime,"%d/%m/%Y %H:%i:%s") as created,
                                    DATE_FORMAT(a.mtime,"%d/%m/%Y %H:%i:%s") as modified,
                                    unit_kerja_id',
                                    FALSE)
                ->where('unit_kerja_id', $unit_kerja_id)
                ->from('kegiatan a');
        }else if($type == 2){
            $kegiatan_id = $this->input->post('kode', true);
            $this->datatables->select('lampiran_kegiatan_id as kode,
                                    title as arsip,
                                    file_name as deskripsi,
                                    (3) as returntype,
                                    DATE_FORMAT(a.ctime,"%d/%m/%Y %H:%i:%s") as created,
                                    DATE_FORMAT(a.ctime,"%d/%m/%Y %H:%i:%s") as modified,
                                    path_folder as unit_kerja_id',
                                    FALSE)
                ->where('kegiatan_id', $kegiatan_id)
                ->from('lampiran_kegiatan a');
        }else{
            $this->datatables->select('unit_kerja_id as kode,
                                    unit_kerja as arsip,
                                    mark as deskripsi,
                                    (1) as returntype,
                                    DATE_FORMAT(a.ctime,"%d/%m/%Y %H:%i:%s") as created,
                                    DATE_FORMAT(a.mtime,"%d/%m/%Y %H:%i:%s") as modified,
                                    unit_kerja_id',
                                    FALSE)
                ->from('unit_kerja a');
        }
//        var_dump($this->datatables->generate('raw'));
        $this->output
            ->set_content_type('application/json')
            ->set_output($this->datatables->generate());
    }

    public function dt_arsip(){
        if(!$this->input->is_ajax_request()) show_404();

        $level  = $this->input->post('level', TRUE);
        $parent = !empty($this->input->post('parent', TRUE))?$this->input->post('parent', TRUE):NULL;

        $this->datatables->select('arsip_id as kode, arsip, jenis_arsip, is_public, filename, parent, level, deskripsi, DATE_FORMAT(a.ctime,"%d/%m/%Y %H:%i:%s") as created, DATE_FORMAT(a.mtime,"%d/%m/%Y %H:%i:%s") as modified, unit_kerja_id, user_id', FALSE)
            ->from('arsip a')
            ->where('is_public', 1)
            ->where('a.parent', $parent)
            ->where('a.level', $level);

        $action_button = '
            <li><a href="javascript:void(0)" data-id="$1" class="detail-arsip"><i class="icon-info3"></i> Detail</a></li>
            <li class="divider"></li>
            <li><a href="javascript:void(0)" data-id="$1" data-publik="$4" class="change-arsip"><i class="icon-lock"></i> Ubah Ke Arsip Saya</a></li>
            <li class="divider"></li>
            <li><a href="javascript:void(0)" data-id="$1" data-nama="$3" class="rename-arsip"><i class="icon-pencil5"></i> Ganti Nama</a></li>
            <li><a href="javascript:void(0)" data-id="$1" data-jenis-arsip="$2" class="hapus-arsip"><i class="icon-trash"></i> Hapus</a></li>
        ';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right action_menu">' . $action_button . '</ul></li></ul>' , 'encode(kode),encode(jenis_arsip),arsip,is_public');

        echo $this->datatables->generate();

    }

    public function dt_arsip_saya(){
        if(!$this->input->is_ajax_request()) show_404();

        $level  = $this->input->post('level', TRUE);
        $parent = !empty($this->input->post('parent', TRUE))?$this->input->post('parent', TRUE):NULL;

        $this->datatables->select('arsip_id as kode, arsip, jenis_arsip, filename, parent, level, deskripsi, is_public, DATE_FORMAT(a.ctime,"%d/%m/%Y %H:%i:%s") as created, DATE_FORMAT(a.mtime,"%d/%m/%Y %H:%i:%s") as modified, unit_kerja_id, user_id', FALSE)
            ->from('arsip a')
            ->where('user_id', $this->session->user_id)
            ->where('a.parent', $parent)
            ->where('a.level', $level);

        $action_button = '
            <li><a href="javascript:void(0)" data-id="$1" class="detail-arsip"><i class="icon-info3"></i> Detail</a></li>
            <li class="divider"></li>
            <li><a href="javascript:void(0)" data-id="$1" data-publik="$4" class="change-arsip"><i class="icon-lock"></i> Ubah Ke Arsip Saya</a></li>
            <li class="divider"></li>
            <li><a href="javascript:void(0)" data-id="$1" data-nama="$3" class="rename-arsip"><i class="icon-pencil5"></i> Ganti Nama</a></li>
            <li><a href="javascript:void(0)" data-id="$1" data-jenis-arsip="$2" class="hapus-arsip"><i class="icon-trash"></i> Hapus</a></li>
        ';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right action_menu">' . $action_button . '</ul></li></ul>' , 'encode(kode),encode(jenis_arsip),arsip,is_public');

        echo $this->datatables->generate();

    }

    public function save(){
        if(!$this->input->is_ajax_request()) show_404();

        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('nm_folder', 'Nama Folder', 'trim|required');
        $val->set_rules('tipe_arsip', 'Tipe Arsip', 'required');
        $val->set_rules('level', 'Level Arsip', 'required');

        $val->set_message('required', "Silahkan isi field \"%s\"");

        if ($this->form_validation->run() == FALSE) {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            $result['message'] = validation_errors();
            $result['type']    = 'error';
            $result['error']   = true;
        } else {
            $data['arsip']              = trim($this->input->post('nm_folder', true));
            $data['jenis_arsip']        = 1;
            $data['is_public']          = $this->input->post('tipe_arsip', true);
            $data['deskripsi']          = !empty($this->input->post('deskripsi', true))?trim($this->input->post('deskripsi', true)):NULL;
            $data['filename']           = NULL;
            $data['parent']             = !empty($this->input->post('parent', true))?$this->input->post('parent', true):NULL;
            $data['level']              = $this->input->post('level', true);
            $data['unit_kerja_id']      = ($this->session->unit_kerja == NULL)?'00000000':$this->session->unit_kerja;
            $data['user_id']            = $this->session->user_id;
            $data['created_by']         = $this->session->nama;

            $this->db->trans_begin();
            $this->m_arsip->save('arsip', $data);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $result['message']                        = "Folder arsip gagal disimpan!";
                $result['type']                           = "error";
                $result['error']   = true;
            } else {
                $this->db->trans_commit();
                $result['message']                        = "Folder arsip berhasil disimpan!";
                $result['type']                           = "success";
                $result['error']   = false;
            }
        }

        echo json_encode($result);
    }

    public function rename(){
        if(!$this->input->is_ajax_request()) show_404();

        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('arsip', 'Nama Arsip', 'trim|required');
        $val->set_rules('id', 'Kode Arsip', 'required');

        $val->set_message('required', "Silahkan isi field \"%s\"");

        if ($this->form_validation->run() == FALSE) {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            $result['message'] = validation_errors();
            $result['type']    = 'error';
            $result['error']   = true;
        } else {
            $id = decode($this->input->post('id', true));

            $data['arsip']              = trim($this->input->post('arsip', true));
            $data['modified_by']        = $this->session->nama;

            $this->db->trans_begin();
            $this->m_arsip->update('arsip', $data, array('arsip_id' => $id));

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $result['message']                        = "Perubahan nama arsip gagal!";
                $result['type']                           = "error";
                $result['error']   = true;
            } else {
                $this->db->trans_commit();
                $result['message']                        = "Perubahan nama arsip sukses!";
                $result['type']                           = "success";
                $result['error']   = false;
            }
        }

        echo json_encode($result);
    }

    public function change(){
        if(!$this->input->is_ajax_request()) show_404();

        $id         = decode($this->input->post('id', true));

        $this->db->trans_begin();

        $data['is_public'] = $this->input->post('publik', true) == '1'?'0':'1';

        $this->m_arsip->update('arsip', $data, array('arsip_id' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data arsip gagal diubah!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data arsip berhasil diubah!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

    public function detail(){
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $row = $this->m_arsip->get_detail_arsip($id);

        if($row->num_rows() > 0){
            $d['detail']    = $row->row_array();

            $this->load->view('v_arsip_detail', $d);
        }
    }

    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Grup Pengguna';
        $d['menus']         = $this->functions->generate_menu();

        $arsip_id = decode($this->uri->segment(3));
        if(!empty($arsip_id)){
            $cek = $this->m_arsip->fetch('arsip', array('arsip_id' => $arsip_id));

            if($cek->num_rows() > 0){
                $d['arsip']      =  $cek->row_array();

            } else {
                redirect('arsip');
            }
        } else {
            redirect('arsip');
        }


        $this->load->library('form_validation');

        $this->form_validation->set_rules('arsip', 'Grup Pengguna', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;
            $id['arsip_id']             = $arsip_id;

            $data['arsip']              = $this->input->post('arsip', true);
            $data['modified_by']        = $this->session->nama;

            $this->db->trans_begin();
            $this->m_arsip->update('arsip', $data, $id);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data grup pengguna gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data grup pengguna berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('arsip');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Grup Pengguna - Badan Ekonomi Kreatif Indonesia')->build('f_arsip', $d);

    }

    public function delete(){
        if(!$this->input->is_ajax_request()) show_404();

        $id     = decode($this->input->post('id', true));
        $jenis  = decode($this->input->post('jenis', true));

        $this->db->trans_begin();

        if($jenis == '0') { //file
            $this->db->delete('arsip', array('arsip_id' => $id));
        } else { //folder
            $this->remove_children_files($id);
        }

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data arsip gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data arsip berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

    public function remove_children_files($id) {
        $result = $this->m_arsip->fetch('arsip', array('parent' => $id));

        if($result->num_rows() > 0){
            $child = $result->result_array();
            foreach($child as $t){
                if($t['jenis_arsip'] == '0'){ //file

                    //delete remote file server
                    $this->ftp->connect($this->ftp_config);
                    $this->ftp->delete_file('./arsip/'.$t['unit_kerja_id'].'/'.$t['filename']);
                    $this->ftp->close();

                    // delete files
                    $this->db->delete('arsip', array('arsip_id' => $t['arsip_id']));
                } else {
                    $this->remove_children_files($t['arsip_id']);
                }
            }
        }

        $this->db->delete('arsip', array('arsip_id' => $id));
    }


    public function upload_file(){
        if(!$this->input->is_ajax_request()) show_404();

        if ($this->input->post('level', true) == '') {
            echo json_encode(['error'=>'Error level arsip tidak ada.']);
            return;
        }

        if ($this->input->post('is_public', true) == '') {
            echo json_encode(['error'=>'Pilih tipe arsip terlebih dahulu.']);
            return;
        }

        $this->load->library('upload');

        $files = $_FILES;

        $level          = $this->input->post('level', true);
        $parent         = !empty($this->input->post('parent', true))?$this->input->post('parent', true):NULL;
        $is_public      = $this->input->post('is_public', true);

        $totalFile      = count($_FILES['lampiran']['name']);

        $path_folder    = ($this->session->unit_kerja == NULL)?'00000000':$this->session->unit_kerja;

        $error = [];
        $success        = true;

        for($i = 0; $i < $totalFile; $i ++) {
            $_FILES['lampiran']['name']       = $files ['lampiran']['name'][$i];
            $_FILES['lampiran']['type']       = $files ['lampiran']['type'][$i];
            $_FILES['lampiran']['tmp_name']   = $files ['lampiran']['tmp_name'][$i];
            $_FILES['lampiran']['error']      = $files ['lampiran']['error'][$i];
            $_FILES['lampiran']['size']       = $files ['lampiran']['size'][$i];

            $this->upload->initialize($this->set_upload_options());

            if($this->upload->do_upload ('lampiran')){
                $upload_data   = $this->upload->data();

                $arsip[$i]['arsip']                = $upload_data['client_name'];
                $arsip[$i]['jenis_arsip']          = 0;
                $arsip[$i]['is_public']            = $is_public;
                $arsip[$i]['deskripsi']            = NULL;
                $arsip[$i]['filename']             = $upload_data['file_name'];
                $arsip[$i]['parent']               = $parent;
                $arsip[$i]['level']                = $level;
                $arsip[$i]['unit_kerja_id']        = $path_folder;
                $arsip[$i]['user_id']              = $this->session->user_id;
                $arsip[$i]['created_by']           = $this->session->nama;


                /* sending to file server via FTP Start */
                $source = './uploads/arsip/'.$upload_data['file_name'];

                $this->ftp->connect($this->ftp_config);

                //cek folder exist and create if not exists
                $is_dir = $this->ftp->changedir('/arsip/'.$path_folder.'/', TRUE);

                if($is_dir === FALSE){
                    $mkdir = $this->ftp->mkdir('/arsip/'.$path_folder.'/', 0755);
                    if($mkdir === FALSE){
                        $error[$i]      = 'Gagal membuat folder lampiran di file server!';
                        $success        = false;
                    }
                }

                // finally move file to file server
                $destination = '/arsip/'.$path_folder.'/'.$upload_data['file_name'];
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

        if(!empty($arsip)){
            if($success == true){
                $this->m_arsip->insert($arsip);
            }
        }

        echo json_encode([
            'error' => $error
        ]);

    }

    function set_upload_options(){
        $config = array ();
        $config['upload_path']      = './uploads/arsip/';
        $config['allowed_types']    = 'jpg|png|xls|xlsx|pdf|ppt|pptx|doc|docx';
        $config['max_size']         = 10240; // 10 Mb
        $config['file_ext_tolower'] = TRUE;
        $config['remove_spaces']    = TRUE;

        return $config;
    }

}

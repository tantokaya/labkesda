<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Pengguna extends MX_Controller {

    // blowfish
    private static $algo = '$2a';
    // cost parameter
    private static $cost = '$10';

    protected $ftp_config;

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_pengguna');

        $this->load->library('Datatables');
        $this->load->library('table');

        $this->load->library('ftp');
        $this->ftp_config = $this->load->config('ftp', true);
    }

    public function index()
    {
        $d['page_title']    = 'Daftar Pengguna';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        $tmpl = array('table_open' => '<table id="tbl-pengguna" class="table table-bordered table-striped table-responsive table-hover datatable" width="100%">');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Nama', 'Email', 'Grup Pengguna', 'Jabatan', 'Satuan Kerja', 'Aksi');
        } else {
            $this->table->set_heading('Nama', 'Email', 'Grup Pengguna', 'Jabatan', 'Satuan Kerja');
        }

        $this->template->set_layout('backoffice')->title('Daftar Pengguna - Badan Ekonomi Kreatif Indonesia')->build('v_pengguna', $d);
    }

    public function dt_pengguna(){
        if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('user_id as kode, nama, email, akses, jabatan, unit_kerja as satker, ', FALSE)
            ->from('user u')
            ->join('akses a', 'u.akses_id = a.akses_id')
            ->join('unit_kerja uk', 'u.unit_kerja_id = uk.unit_kerja_id', 'left')
            ->join('jabatan j', 'u.jabatan_id = j.jabatan_id', 'left');


        $this->datatables->unset_column('kode');


        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('pengguna/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();

    }

    public function add(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Data Pengguna';
        $d['menus']         = $this->functions->generate_menu();

        $d['l_akses']       = $this->m_pengguna->fetch('akses')->result_array();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[repassword]');
        $this->form_validation->set_rules('repassword', 'Re-Password', 'required');
        $this->form_validation->set_rules('akses_id', 'Grup Pengguna', 'required');

        if($this->input->post('akses_id') >= 2){
            $this->form_validation->set_rules('jabatan_id', 'Jabatan', 'required');
        }

        if($this->input->post('akses_id') >= 3){
            $this->form_validation->set_rules('unit_kerja_id', 'Satuan Kerja', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;

            $data['email']              = $this->input->post('email', true);
            $data['password']           = $this->hash($this->input->post('password', true));
            //$data['nama']               = ucwords(strtolower($this->input->post('nama', true)));
            $data['nama']               = $this->input->post('nama', true);
            $data['akses_id']           = $this->input->post('akses_id', true);

            //REVISI NBS
           /* if($this->input->post('akses_id') == 2){
                $data['unit_kerja_id']  = '00000000';
                $data['jabatan_id']     = $this->input->post('jabatan_id', true);
            }
            elseif($this->input->post('akses_id') >= 3){
                $data['unit_kerja_id']  = $this->input->post('unit_kerja_id', true);
                $data['jabatan_id']     = $this->input->post('jabatan_id', true);
            }*/

            $data['unit_kerja_id']  = $this->input->post('unit_kerja_id', true);
            $data['jabatan_id']     = $this->input->post('jabatan_id', true);
            //--------

            $data['ctime']              = date('Y-m-d H:i:s');
            $data['created_by']         = $this->session->nama;

            $this->db->trans_begin();

            $user_id                    = $this->m_pengguna->save('user', $data, true);

            //TAMBAHAN NBS
            if($user_id){
                $data_pegawai = [
                    'user_id' => $user_id,
                    'email' => $data['email'],
                    'nm_pegawai' => $data['nama']
                ];
                $this->m_pengguna->save('pegawai', $data_pegawai);
            }
            //----------------------

            // cek jika ada file yg diupload
            if (!empty($_FILES['userfile']['name'])) {
                $config['upload_path']      = './assets/images/faces/';
                $config['allowed_types']    = 'jpg|png';
                $config['encrypt_name']	    = true;
                $config['file_ext_tolower']	= true;
                $config['max_size']	        = '2048';

                $this->load->library('upload');
                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);

                    redirect('pengguna');

                } else {
                    //Image Resizing
                    $data_upload = $this->upload->data();

                    $file_name = $data_upload["file_name"];

                    $this->load->library('image_lib');
                    $config_resize['image_library'] = 'gd2';
                    $config_resize['create_thumb'] = FALSE;
                    $config_resize['maintain_ratio'] = FALSE;
                    $config_resize['new_image'] = './assets/images/faces';
                    $config_resize['quality'] = "100%";
                    $config_resize['source_image'] = './assets/images/faces/' . $file_name;
                    $config_resize['width'] = 300;
                    $config_resize['height'] = 300;

                    $this->image_lib->initialize($config_resize);

                    if (!$this->image_lib->resize()){
                        $error = $this->image_lib->display_errors();
                        $this->session->set_flashdata('error', $error);

                        redirect('pengguna');
                    } else {
                        $result = $this->upload->data();

                        /* sending to file server via FTP Start */
                        $source = './assets/images/faces/'.$result['file_name'];

                        $this->ftp->connect($this->ftp_config);
                        $destination = '/avatar/'.$result['file_name'];
                        $file_server_upload = $this->ftp->upload($source, ".".$destination, 'auto', 0644);
                        $this->ftp->close();
                        @unlink($source);

                        if($file_server_upload == FALSE){
                            $this->session->set_flashdata('error', 'Gagal upload ke file server!');

                            redirect('pengguna');
                        } else {
                            $update_data['avatar'] = $result['file_name'];

                            $this->m_pengguna->update('user', $update_data, array('user_id' => $user_id));
                        }
                    }
                }
            }

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data pengguna gagal disimpan!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data pengguna berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('pengguna');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Tambah Data Pengguna - Badan Ekonomi Kreatif Indonesia')->build('f_pengguna', $d);

    }

    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Data Pengguna';
        $d['menus']         = $this->functions->generate_menu();

        $user_id = decode($this->uri->segment(3));
        if(!empty($user_id)){
            $cek = $this->m_pengguna->fetch('user', array('user_id' => $user_id), NULL, 'akses','user.akses_id = akses.akses_id');

            if($cek->num_rows() > 0){
                $d['user']      =  $cek->row_array();
                $d['l_satker']  = $this->get_list_satker_by_id($d['user']['akses_id'], $d['user']['unit_kerja_id']);
                $d['l_jabatan'] = $this->get_list_jabatan_by_id($d['user']['akses_id'], $d['user']['jabatan_id']);
            } else {
                redirect('pengguna');
            }
        } else {
            redirect('pengguna');
        }

        $d['l_akses']       = $this->m_pengguna->fetch('akses')->result_array();


        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if(!empty($this->input->post('password', true))){
            $this->form_validation->set_rules('password', 'Password', 'min_length[6]|matches[repassword]');
            $this->form_validation->set_rules('repassword', 'Re-Password', 'required');
        }

        if($this->input->post('email', true) !== $d['user']['email']) {
            $is_unique =  '|is_unique[user.email]';
        } else {
            $is_unique =  '';
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim'.$is_unique);
        $this->form_validation->set_rules('akses_id', 'Grup Pengguna', 'required');

        if($this->input->post('akses_id') >= 2){
            $this->form_validation->set_rules('jabatan_id', 'Jabatan', 'required');
        }

        if($this->input->post('akses_id') >= 3){
            $this->form_validation->set_rules('unit_kerja_id', 'Satuan Kerja', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;
            $id['user_id']              = $user_id;

            $data['email']              = $this->input->post('email', true);
            if(!empty($this->input->post('password', true))){
                $data['password']       = $this->hash($this->input->post('password', true));
            }

            //$data['nama']               = ucwords(strtolower($this->input->post('nama', true)));
            $data['nama']               = $this->input->post('nama', true);
            $data['akses_id']           = $this->input->post('akses_id', true);

            if($this->input->post('akses_id') == 2){
                $data['unit_kerja_id']     = '00000000';
            }
            elseif($this->input->post('akses_id') >= 3){
                $data['unit_kerja_id']     = $this->input->post('unit_kerja_id', true);
            }

            $data['mtime']          = date('Y-m-d H:i:s');
            $data['modified_by']    = $this->session->nama;

            // cek jika ada file yg diupload
            if (!empty($_FILES['userfile']['name'])) {
                $config['upload_path']      = './assets/images/faces/';
                $config['allowed_types']    = 'jpg|png';
                $config['encrypt_name']	    = true;
                $config['file_ext_tolower']	= true;
                $config['max_size']	        = '2048';

                $this->load->library('upload');
                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);

                    redirect('pengguna');

                } else {
                    //Image Resizing
                    $data_upload = $this->upload->data();

                    $file_name = $data_upload["file_name"];

                    $this->load->library('image_lib');
                    $config_resize['image_library'] = 'gd2';
                    $config_resize['create_thumb'] = FALSE;
                    $config_resize['maintain_ratio'] = FALSE;
                    $config_resize['new_image'] = './assets/images/faces';
                    $config_resize['quality'] = "100%";
                    $config_resize['source_image'] = './assets/images/faces/' . $file_name;
                    $config_resize['width'] = 300;
                    $config_resize['height'] = 300;

                    $this->image_lib->initialize($config_resize);

                    if (!$this->image_lib->resize()){
                        $error = $this->image_lib->display_errors();
                        $this->session->set_flashdata('error', $error);

                        redirect('pengguna');
                    } else {
                        $result = $this->upload->data();

                        /* kirim ke file server via FTP  */
                        $source = './assets/images/faces/'.$result['file_name'];
                        $this->ftp->connect($this->ftp_config);
                        $destination = '/avatar/'.$result['file_name'];
                        $file_server_upload = $this->ftp->upload($source, ".".$destination, 'auto', 0644);
                        $this->ftp->close();
                        @unlink($source);

                        if($file_server_upload == FALSE){
                            $this->session->set_flashdata('error', 'Gagal upload ke file server!');

                            redirect('pengguna');
                        } else {
                            $data['avatar'] = $result['file_name'];

                            // cek file lama
                            if(!empty($d['user']['avatar'])){
                                //delete
                                $this->ftp->connect($this->ftp_config);
                                $delete_old_file = $this->ftp->delete_file('./avatar/'.$d['user']['avatar']);
                                $this->ftp->close();

                                if($delete_old_file == FALSE){
                                    $this->session->set_flashdata('error', 'Gagal hapus file lama di file server!');

                                    redirect('pengguna');
                                }
                            }
                        }
                    }
                }
            }

            $this->db->trans_begin();

            $this->m_pengguna->update('user', $data, $id);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data pengguna gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data pengguna berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('pengguna');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Data Pengguna - Badan Ekonomi Kreatif Indonesia')->build('f_pengguna', $d);

    }

    public function delete(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id = decode($this->input->post('id', true));

        $this->db->trans_begin();

        //cek file upload
        $this->db->select('avatar');
        $user = $this->db->get_where('user', array('user_id' => $id))->row_array();
        if(!empty($user['avatar'])){
            $this->ftp->connect($this->ftp_config);
            $delete_file_upload = $this->ftp->delete_file('./avatar/'.$user['avatar']);
            $this->ftp->close();

            if($delete_file_upload == FALSE){
                $this->session->set_flashdata('error', 'Gagal hapus file lama di file server!');

                redirect('pengguna');
            }
        }

        $this->m_pengguna->destroy('user', array('user_id' => $id));

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result['message']              = "Data pengguna gagal dihapus!";
            $result['type']                 = "error";
        } else {
            $this->db->trans_commit();
            $result['message']              = "Data pengguna berhasil dihapus!";
            $result['type']                 = "success";
        }

        echo json_encode($result);
    }

    public function get_list_satker(){
        if(!$this->input->is_ajax_request()) show_404();

        $id         = $this->input->post('id', true);

        $output = '<option value=""></option>';

        //REVISI NBS
        $satker = $this->m_pengguna->fetch('unit_kerja')->result_array();

        foreach($satker as $rs) {
            $output .= '<option value="'.$rs['unit_kerja_id'].'">'.$rs['unit_kerja'].'</option>';
        }
        //---------------------------------
/*        if($id == '3'){ // Eselon I
            $satker = $this->m_pengguna->fetch('unit_kerja', array('akses_id' => $id))->result_array();

            foreach($satker as $rs) {
                $output .= '<option value="'.$rs['unit_kerja_id'].'">'.$rs['unit_kerja'].'</option>';
            }
        }
        elseif($id == '4'){ // Eselon II
            $deputi = $this->m_pengguna->fetch('unit_kerja', array('akses_id' => 3))->result_array();

            foreach($deputi as $d) {
                $output .= '<optgroup label="'.$d['unit_kerja'].'">';

                $satker = $this->m_pengguna->fetch('unit_kerja', array('SUBSTRING(unit_kerja_id,1,2)' => substr($d['unit_kerja_id'],0,2), 'akses_id' => $id))->result_array();

                foreach($satker as $rs) {
                    $output .= '<option value="'.$rs['unit_kerja_id'].'">'.$rs['unit_kerja'].'</option>';
                }

                $output .= '</optgroup>';
            }
        }
        elseif($id == '5'){ // Eselon III Kecuali Inspektorat belum ada unit dibawahnya
            $direktorat = $this->m_pengguna->fetch('unit_kerja', array('akses_id' => 4, 'unit_kerja_id !=' => '07040000'))->result_array();

            foreach($direktorat as $d) {
                $output .= '<optgroup label="'.$d['unit_kerja'].'">';

                $satker = $this->m_pengguna->fetch('unit_kerja', array('SUBSTRING(unit_kerja_id,1,4)' => substr($d['unit_kerja_id'],0,4), 'akses_id' => $id))->result_array();

                foreach($satker as $rs) {
                    $output .= '<option value="'.$rs['unit_kerja_id'].'">'.$rs['unit_kerja'].'</option>';
                }

                $output .= '</optgroup>';
            }
        }
        elseif($id == '6'){ // Eselon IV Kecuali Subdit
            $direktorat = $this->m_pengguna->fetch('unit_kerja', array('akses_id' => 5, 'jabatan_id !=' => '06'))->result_array();

            foreach($direktorat as $d) {
                $output .= '<optgroup label="'.$d['unit_kerja'].'">';

                $satker = $this->m_pengguna->fetch('unit_kerja', array('SUBSTRING(unit_kerja_id,1,6)' => substr($d['unit_kerja_id'],0,6), 'akses_id' => $id))->result_array();
                foreach($satker as $rs) {
                    $output .= '<option value="'.$rs['unit_kerja_id'].'">'.$rs['unit_kerja'].'</option>';
                }

                $output .= '</optgroup>';
            }
        }*/

        echo $output;
    }

    public function get_list_satker_by_id($id, $unit_id){
        $output = '<option value=""></option>';

        //REVISI NBS
        $satker = $this->m_pengguna->fetch('unit_kerja')->result_array();
        foreach($satker as $rs) {
            if($rs['unit_kerja_id'] == $unit_id):
                $output .= '<option value="'.$rs['unit_kerja_id'].'" selected>'.$rs['unit_kerja'].'</option>';
            else :
                $output .= '<option value="'.$rs['unit_kerja_id'].'">'.$rs['unit_kerja'].'</option>';
            endif;
        }
        //-----------------

/*
        if($id == '3'){ // Eselon I
            $satker = $this->m_pengguna->fetch('unit_kerja', array('akses_id' => $id))->result_array();

            foreach($satker as $rs) {
                if($rs['unit_kerja_id'] == $unit_id):
                    $output .= '<option value="'.$rs['unit_kerja_id'].'" selected>'.$rs['unit_kerja'].'</option>';
                else :
                    $output .= '<option value="'.$rs['unit_kerja_id'].'">'.$rs['unit_kerja'].'</option>';
                endif;
            }
        }
        elseif($id == '4'){ // Eselon II
            $deputi = $this->m_pengguna->fetch('unit_kerja', array('akses_id' => 3))->result_array();

            foreach($deputi as $d) {
                $output .= '<optgroup label="'.$d['unit_kerja'].'">';

                $satker = $this->m_pengguna->fetch('unit_kerja', array('SUBSTRING(unit_kerja_id,1,2)' => substr($d['unit_kerja_id'],0,2), 'akses_id' => $id))->result_array();
                foreach($satker as $rs) {
                    if($rs['unit_kerja_id'] == $unit_id):
                        $output .= '<option value="'.$rs['unit_kerja_id'].'" selected>'.$rs['unit_kerja'].'</option>';
                    else :
                        $output .= '<option value="'.$rs['unit_kerja_id'].'">'.$rs['unit_kerja'].'</option>';
                    endif;
                }

                $output .= '</optgroup>';
            }
        }
        elseif($id == '5'){ // Eselon III Kecuali Inspektorat belum ada unit dibawahnya
            $direktorat = $this->m_pengguna->fetch('unit_kerja', array('akses_id' => 4, 'unit_kerja_id !=' => '07040000'))->result_array();

            foreach($direktorat as $d) {
                $output .= '<optgroup label="'.$d['unit_kerja'].'">';

                $satker = $this->m_pengguna->fetch('unit_kerja', array('SUBSTRING(unit_kerja_id,1,4)' => substr($d['unit_kerja_id'],0,4), 'akses_id' => $id))->result_array();
                foreach($satker as $rs) {
                    if($rs['unit_kerja_id'] == $unit_id):
                        $output .= '<option value="'.$rs['unit_kerja_id'].'" selected>'.$rs['unit_kerja'].'</option>';
                    else :
                        $output .= '<option value="'.$rs['unit_kerja_id'].'">'.$rs['unit_kerja'].'</option>';
                    endif;
                }

                $output .= '</optgroup>';
            }
        }
        elseif($id == '6'){ // Eselon IV Kecuali Subdit
            $direktorat = $this->m_pengguna->fetch('unit_kerja', array('akses_id' => 5, 'jabatan_id !=' => '06'))->result_array();

            foreach($direktorat as $d) {
                $output .= '<optgroup label="'.$d['unit_kerja'].'">';

                $satker = $this->m_pengguna->fetch('unit_kerja', array('SUBSTRING(unit_kerja_id,1,6)' => substr($d['unit_kerja_id'],0,6), 'akses_id' => $id))->result_array();
                foreach($satker as $rs) {
                    if($rs['unit_kerja_id'] == $unit_id):
                        $output .= '<option value="'.$rs['unit_kerja_id'].'" selected>'.$rs['unit_kerja'].'</option>';
                    else :
                        $output .= '<option value="'.$rs['unit_kerja_id'].'">'.$rs['unit_kerja'].'</option>';
                    endif;
                }

                $output .= '</optgroup>';
            }
        }*/

        return $output;
    }

    public function get_list_jabatan(){
        if(!$this->input->is_ajax_request()) show_404();

        $id         = $this->input->post('id', true);

        $output = '<option value=""></option>';

        $jabatan = $this->m_pengguna->fetch('jabatan')->result_array();
        foreach($jabatan as $rs) {
            $output .= '<option value="'.$rs['jabatan_id'].'">'.$rs['jabatan'].'</option>';
        }

/*        if($id == '2'){
            $jabatan = $this->m_pengguna->get_list_jabatan($id)->result_array();

            foreach($jabatan as $rs) {
                $output .= '<option value="'.$rs['jabatan_id'].'">'.$rs['jabatan'].'</option>';
            }
        } else if($id >= '3') {
            $jabatan = $this->m_pengguna->get_list_jabatan($id, true)->result_array();

            foreach($jabatan as $rs) {
                $output .= '<option value="'.$rs['jabatan_id'].'">'.$rs['jabatan'].'</option>';
            }
        }*/

        echo $output;
    }

    public function get_list_jabatan_by_id($akses_id, $jabatan_id){
        $output = '<option value=""></option>';

        $jabatan = $this->m_pengguna->fetch('jabatan')->result_array();
        foreach($jabatan as $rs) {
            if($rs['jabatan_id'] == $jabatan_id):
                $output .= '<option value="'.$rs['jabatan_id'].'" selected>'.$rs['jabatan'].'</option>';
            else :
                $output .= '<option value="'.$rs['jabatan_id'].'">'.$rs['jabatan'].'</option>';
            endif;
        }

/*        if($akses_id == '2'){
            $jabatan = $this->m_pengguna->get_list_jabatan($akses_id)->result_array();

            foreach($jabatan as $rs) {
                if($rs['jabatan_id'] == $jabatan_id):
                    $output .= '<option value="'.$rs['jabatan_id'].'" selected>'.$rs['jabatan'].'</option>';
                else :
                    $output .= '<option value="'.$rs['jabatan_id'].'">'.$rs['jabatan'].'</option>';
                endif;
            }

        } elseif($akses_id >= '3'){
            $jabatan = $this->m_pengguna->get_list_jabatan($akses_id, true)->result_array();

            foreach($jabatan as $rs) {
                if($rs['jabatan_id'] == $jabatan_id):
                    $output .= '<option value="'.$rs['jabatan_id'].'" selected>'.$rs['jabatan'].'</option>';
                else :
                    $output .= '<option value="'.$rs['jabatan_id'].'">'.$rs['jabatan'].'</option>';
                endif;
            }
        }*/

        return $output;
    }


    public static function unique_salt() {
        return substr(sha1(mt_rand()), 0, 22);
    }

    public static function hash($password) {

        return crypt($password, self::$algo .
            self::$cost .
            '$' . self::unique_salt());
    }

}

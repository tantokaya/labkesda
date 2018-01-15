<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Profil extends MX_Controller {

    // blowfish
    private static $algo = '$2a';
    // cost parameter
    private static $cost = '$10';

    protected $ftp_config;


    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();

        $this->load->model('m_profil');

        $this->load->library('ftp');
        $this->ftp_config = $this->load->config('ftp', true);

    }

    public function index()
    {

        $d['page_title']    = 'Profil Saya';
        $d['menus']         = $this->functions->generate_menu();

        $this->db->join('akses', 'user.akses_id = akses.akses_id');
        $d['user']          = $this->db->get_where('user', array('user_id' => $this->session->user_id))->row_array();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        if(!empty($this->input->post('password', true))){
            $this->form_validation->set_rules('password', 'Password', 'matches[repassword]');
            $this->form_validation->set_rules('repassword', 'Re-Password', 'required');
        }

        if($this->input->post('email', true) !== $d['user']['email']) {
            $is_unique =  '|is_unique[user.email]';
        } else {
            $is_unique =  '';
        }
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim'.$is_unique);


        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;

            $id                         = $this->session->user_id;

            $data['nama']               = ucwords(strtolower($this->input->post('nama', true)));
            $data['email']              = strtolower($this->input->post('email', true));

            if(!empty($this->input->post('password', true))){
                $data['password']       = $this->hash($this->input->post('password', true));
            }

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

                    redirect('profil');

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

            $data['modified_by'] = $this->session->nama;

            $this->db->trans_begin();

            $this->m_profil->update('user', $data, array('user_id' => $id));

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data profil gagal diupdate!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data profil berhasil disimpan!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('profil');
        }


        $this->template->set_layout('backoffice')->title('Profil Saya - Badan Ekonomi Kreatif Indonesia')->build('f_profil', $d);
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

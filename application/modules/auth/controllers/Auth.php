<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Hartanto Kurniawan.
 * Email  : hartanto.kurniawan@bppt.go.id
 * Copyrights 2018
 */

class Auth extends MX_Controller {

    // blowfish
    private static $algo = '$2a';
    // cost parameter
    private static $cost = '$10';

    function __construct()
    {
        parent::__construct();

        $this->load->model('auth_model');
        date_default_timezone_set('Asia/Jakarta');

        //$this->load->library('recaptcha');
    }
 
    public function index()
    {
        $d['content']   = '';
        $this->template->set_layout('login')->title('Login - Labkesda')->build('v_login', $d);
    }

    public function do_login()
    {
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('email', 'Email', 'trim|required|valid_email');
        $val->set_rules('password', 'Password', 'trim|required');

        $val->set_message('required', "Silahkan isi field \"%s\"");

        if ($val->run() == FALSE) {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            $result['message'] = validation_errors();
            $result['error']   = true;
        }
        else {
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);

            $user = $this->auth_model->cek_login($email);
            if(!empty($user)){
                if($this->check_password($user['password'], $password)){
                // if(isset($password)!= NULL){
                    // update last login
                    $data['last_login'] = date('Y-m-d H:i:s');
                    $this->auth_model->update('user',$data, array('user_id' => $user['user_id']));

                    // prepare session data
                    $sess_data['logged_in']     = true;
                    $sess_data['akses_id']      = $user['akses_id'];
                    $sess_data['akses']         = $user['akses'];
                    $sess_data['user_id']       = $user['user_id'];
                    $sess_data['nama']          = $user['nama'];
                    $sess_data['email']         = $user['email'];
                    $sess_data['avatar']        = $user['avatar'];

                    $result['error'] = false;


                    $this->session->set_userdata($sess_data);

                } else {
                    $result['error'] = true;
                    $result['message'] = 'Password tidak sesuai';
                }
            } else {
                $result['error'] = true;
                $result['message'] = 'User tidak ditemukan';
            }
        }


        echo json_encode($result);
    }

    public function do_logout(){
        $this->session->sess_destroy();
        redirect($this->index());
    }

    public function check_session(){
        if(!isset($this->session->logged_in)){
            redirect('logout');
        }
    }

    public function forgot(){
        if(!$this->input->is_ajax_request()) show_404();

        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('email', 'Email', 'trim|required|valid_email');

        $val->set_message('required', "Silahkan isi field \"%s\"");

        if ($val->run() == FALSE) {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            $result['message'] = validation_errors();
            $result['error']   = true;

            echo json_encode($result);
        }
        else
        {
            $email = $this->security->xss_clean($this->input->post('email', TRUE));
            $cek = $this->auth_model->check_email_exist($email);

            if($cek->num_rows() > 0 ) :
                $d['user'] = $cek->row_array();

                $this->load->helper('string');
                $d['code'] = random_string('alnum',20);

                $data = array(
                    'reset_token' => $d['code'],
                );

                $this->auth_model->update('user', $data, array('user_id' => $d['user']['user_id']));

                // send mail
                $this->load->library('email');
                $this->load->config('email', true);

                $this->email->from('noreply@risbang.bekraf.go.id', 'noreply@risbang.bekraf.go.id');
                $this->email->to($email);
                $this->email->subject('Permintaan Reset Password');

                $this->email->message($this->load->view('partials/content/email_forgot',$d,true));

                if($this->email->send()){
                    $result['message'] = 'Email berhasil dikirim';
                    $result['error']   =  false;
                } else {
                    $result['message'] = 'Email gagal dikirim';
                    $result['error']   =  true;
                }
            else :
                // error
                $result['message'] = 'Email tidak ditemukan';
                $result['error']   =  true;


            endif;
            echo json_encode($result);
        }
    }

    public function renew_password()
    {
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('token', 'Token', 'trim|required|exact_length[20]');
        $val->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $val->set_rules('repassword', 'Re-Password', 'trim|required|matches[password]');

        if ($this->input->post()) {
            $data['token'] = $this->security->xss_clean($this->input->post('token'));
        } else {
            $data['token'] = $this->security->xss_clean($this->uri->segment(2));
        }

        if ($val->run() == FALSE) {
            $this->load->view('layouts/reset_password', $data);
        } else {
            $token    = $this->security->xss_clean($this->input->post('token', true));

            if(empty($token)){
                $this->session->set_flashdata('message', 'Token tidak boleh kosong!');

                redirect('renew/'.$token);
            }

            $cek = $this->auth_model->check_reset_token($token);
            if($cek->num_rows() > 0){
                $user = $cek->row_array();
                $up['password']       = $this->hash($this->input->post('password', true));
                $up['reset_token']    = NULL;

                $this->auth_model->update('user', $up, array('user_id' => $user['user_id']));

                $this->session->set_flashdata('message', 'Password berhasil diperbaharui!');

                redirect('auth');
            } else {
                $this->session->set_flashdata('message', 'Token telah expired!');

                redirect('renew/'.$token);
            }
        }
    }

    public static function unique_salt() {
        return substr(sha1(mt_rand()), 0, 22);
    }

    public static function hash($password) {

        return crypt($password, self::$algo .
            self::$cost .
            '$' . self::unique_salt());
    }

    public static function check_password($hash, $password) {
        $full_salt = substr($hash, 0, 29);
        $new_hash = crypt($password, $full_salt);
        return ($hash == $new_hash);
    }

}

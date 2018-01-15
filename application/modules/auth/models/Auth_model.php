<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Hartanto Kurniawan.
 * Email  : hartanto.kurniawan@bppt.go.id
 * Copyrights 2018
 */


class Auth_model extends CI_Model {
    public $table;

    public function __construct() {
        parent::__construct();
        $this->table = 'user';
    }

    public function cek_login($email){
        $this->db->join('akses', 'user.akses_id = akses.akses_id');
        $query = $this->db->get_where($this->table, array('email' => $email));

        if($query->num_rows() > 0)
            $result = $query->row_array();
        else
            $result = array();

        return $result;
    }

    public function update($table,$data, $key){
        $this->db->update($table, $data, $key);
    }

    public function check_email_exist($email){
        $this->db->select('user_id, email, nama');

        return $this->db->get_where('user', array('email' => $email));
    }

    public function check_reset_token($token){
        $this->db->select('user_id');

        return $this->db->get_where('user', array('reset_token' => $token));
    }

    public function get_eselon($user_id){
        $this->db->where(['user_id' => $user_id]);
        $result = $this->db->get('pegawai')->row_array();
//        var_dump($this->db->last_query());exit;

        if($result){
            if($result['eselon_id'] == 1 || $result['eselon_id'] == 2 ){
                return 1;
            }elseif($result['eselon_id'] == 3 || $result['eselon_id'] == 4){
                return 2;
            }elseif($result['eselon_id'] == 5 || $result['eselon_id'] == 6){
                return 3;
            }elseif($result['eselon_id'] == 7 || $result['eselon_id'] == 8){
                return 4;
            }elseif($result['eselon_id'] == 9){
                return 5;
            }elseif($result['eselon_id'] == 10){
                return false;
            }
        }

        return false;
    }

    public function get_mark($unit_kerja_id){
        $this->db->where(['unit_kerja_id' => $unit_kerja_id]);
        $result = $this->db->get('unit_kerja')->row_array();
        if($result){
            return $result['mark'];
        }

        return false;
    }
}
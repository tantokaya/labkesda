<?php
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Setting_model extends CI_Model {
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'setting_aplikasi';
        date_default_timezone_set('Asia/Jakarta');

    }

    function get_app_info()
    {
        $query = $this->db->get($this->table);

        if($query->num_rows() > 0)
            $result = $query->row_array();
        else
            $result = array();


        return $result;
    }

    function get_user_info($id){
        $this->db->join('akses', 'user.akses_id = akses.akses_id');
        $query = $this->db->get_where('user', array('user_id' => $id));

        if($query->num_rows() > 0)
            $result = $query->row_array();
        else
            $result = array();


        return $result;
    }

    function get_total_events(){
        $this->db->select('tanggal_mulai, kegiatan, jenis_kegiatan_id')
            ->from('kegiatan')
            ->where('tanggal_mulai >=', date('Y-m-d'))
            ->where('(is_private = 0 OR (is_private = 1 AND user_id = '.$this->session->user_id.'))')
            ->order_by('tanggal_mulai', 'ASC');
        return $this->db->get()->num_rows();
    }


}
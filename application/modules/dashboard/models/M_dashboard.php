<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class M_dashboard extends CI_Model {

    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    function fetch($table, $filter = NULL, $sort=NULL, $join = NULL, $cond = NULL){
        if($join !== NULL && $cond !== NULL){
            $this->db->join($join,$cond);
        }

        if($filter !== NULL){
            $this->db->where($filter);
        }

        if($sort !== NULL){
            $this->db->order_by($sort);
        }

        return $this->db->get($table);
    }

    function get_upcoming_events(){
        $this->db->select('tanggal_mulai, kegiatan, k.jenis_kegiatan_id, jk.jenis_kegiatan, mark')
            ->from('kegiatan k')
            ->join('jenis_kegiatan jk', 'k.jenis_kegiatan_id = jk.jenis_kegiatan_id')
            ->where('tanggal_mulai >=', date('Y-m-d'))
            ->where('(is_private = 0 OR (is_private = 1 AND user_id = '.$this->session->user_id.'))')
            ->order_by('tanggal_mulai', 'ASC')
            ->limit('5');
        return $this->db->get()->result_array();
    }

}

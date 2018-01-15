<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class M_arsip extends CI_Model {

    function __construct()
    {
        parent::__construct();

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

    function save($table = null, $data, $last_id = false) {
        $tabel = ($table == null) ? $this->table : $table;
        $this->db->insert($tabel, $data);

        if ($last_id) {
            return $this->db->insert_id();
        }
    }

    function update($table,$data, $key){
        $this->db->update($table, $data, $key);
    }

    function destroy($table,$key){
        $this->db->delete($table, $key);
    }

    function insert($data = array()){
        $insert = $this->db->insert_batch('arsip', $data);
        return $insert?true:false;
    }

    function get_detail_arsip($id){
        $this->db->select('
            arsip,
            CASE jenis_arsip
                WHEN 0 THEN "File"
                WHEN 1 THEN "Folder"
            END as jenis_arsip,
            CASE is_public
                WHEN 0 THEN "Tidak"
                WHEN 1 THEN "Ya"
            END as is_public,
            deskripsi,
            unit_kerja,
            nama,
            DATE_FORMAT(arsip.ctime,"%d/%m/%Y %H:%i:%s") as created,
            DATE_FORMAT(arsip.mtime,"%d/%m/%Y %H:%i:%s") as modified
        ', false);

        $this->db->join('unit_kerja', 'arsip.unit_kerja_id = unit_kerja.unit_kerja_id')
            ->join('user', 'arsip.user_id = user.user_id');

        return $this->db->get_where('arsip', array('arsip_id' => $id));
    }

}

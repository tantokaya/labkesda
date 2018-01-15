<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ruangan extends CI_Model {

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

    function autocomplete_pegawai_by_nama($keyword){
        $this->db->select('user_id, nama, unit_kerja, u.unit_kerja_id');
        $this->db->join('unit_kerja as uk','u.unit_kerja_id = uk.unit_kerja_id','LEFT');
        $this->db->where('u.unit_kerja_id !=','NULL');
        $this->db->from('user as u');
        $this->db->like('nama', $keyword, 'both');

        $query = $this->db->get();

        $data = array();
        foreach($query->result() as $rows){

            $nama                   = $rows->nama;

            $row['user_id']              = $rows->user_id;
            $row['label']           = $nama;
            $row['value']           = $nama;
            $row['instansi']        = 'Badan Ekonomi Kreatif';
            $row['unit_kerja_id']   = $rows->unit_kerja_id;
            $data[] = $row;
        }

        return $data;
    }   

}

/* End of file M_ruangan.php */
/* Location: ./application/modules/ruangan/models/M_ruangan.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ruang_rapat extends CI_Model {

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

    function get_jadwal_ruangan($ruang_id, $tanggal)
    {
        // $where = "'jr.ruang_id' = $ruang_id AND 'jr.tanggal' = $tanggal";
        $where = array(
            'jr.ruang_id ='     => $ruang_id,
            'jr.tanggal ='      => $tanggal
        );
        return $this->db->select('jr.tanggal, jr.jam_mulai, jr.jam_selesai, jr.deskripsi_rapat, jr.pic, jr.unit_kerja_id, jr.ruang_id, uk.unit_kerja_id, uk.unit_kerja, ruang.ruang_id, ruang.nama_ruang')
                        ->from('jadwal_ruang as jr')
                        ->join('unit_kerja as uk','jr.unit_kerja_id = uk.unit_kerja_id','LEFT')
                        ->join('ruang','jr.ruang_id = ruang.ruang_id')
                        ->where($where)
                        ->get();
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

            $row['id']              = $rows->user_id;
            $row['label']           = $nama;
            $row['value']           = $nama;
            $row['instansi']        = 'Badan Ekonomi Kreatif';
            $row['unit_kerja_id']   = $rows->unit_kerja_id;
            $data[] = $row;
        }

        return $data;
    }	

}

/* End of file M_ruang_rapat.php */
/* Location: ./application/modules/ruang_rapat/models/M_ruang_rapat.php */
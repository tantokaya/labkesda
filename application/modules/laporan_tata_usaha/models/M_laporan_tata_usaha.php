<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan_tata_usaha extends CI_Model {

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

    function get_mark_kalender($id){
        $this->db->select('mark');
        return $this->db->get_where('unit_kerja', array('unit_kerja_id' => $id));
    }

    function get_lampiran_kegiatan($kegiatan_id) {
        return $this->db->select('lk.*, jl.jenis_laporan_id, jl.jenis_laporan')
        ->from('lampiran_kegiatan as lk')
        ->join('nb_jenis_laporan as jl','lk.jenis_laporan_id = jl.jenis_laporan_id','LEFT')
        ->where('lk.kegiatan_id',$kegiatan_id)
        ->get();
    }

    function lampiran_not_exist($id, $jenis_laporan_id)
    {
        return $this->db->select('k.kegiatan_id, k.jenis_kegiatan_id, lk.kegiatan_id, lk.jenis_laporan_id, pl.jenis_kegiatan_id, pl.jenis_laporan_id, jl.jenis_laporan_id, jl.jenis_laporan') // jk.jenis_kegiatan_id
                        ->from('kegiatan as k')
                        ->join('lampiran_kegiatan as lk','lk.kegiatan_id = k.kegiatan_id','LEFT')
                        ->join('jenis_kegiatan as jk','k.jenis_kegiatan_id = jk.jenis_kegiatan_id','LEFT')
                        ->join('nb_pengaturan_laporan as pl','k.jenis_kegiatan_id = pl.jenis_kegiatan_id')
                        ->join('nb_jenis_laporan as jl','pl.jenis_laporan_id = jl.jenis_laporan_id')
                        ->where('lk.kegiatan_id', $id)
                        ->where_not_in('pl.jenis_laporan_id',$jenis_laporan_id)
                        ->group_by('pl.jenis_laporan_id')
                        ->get();
    }
}

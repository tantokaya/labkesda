<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_peserta_internal extends CI_Model {

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

    function get_kegiatan_by_pegawai($key) {
        return $this->db->select('pk.peserta_kegiatan_id, pk.kegiatan_id, pk.pegawai_id, pk.status_peserta_id, k.kegiatan_id, k.jenis_kegiatan_id, k.kegiatan, k.tanggal_mulai, jk.jenis_kegiatan_id, jk.jenis_kegiatan, p.pegawai_id, sp.status_peserta_id, sp.status_peserta')
                        ->from('peserta_kegiatan as pk')
                        ->join('kegiatan as k','k.kegiatan_id = pk.kegiatan_id','LEFT')
                        ->join('jenis_kegiatan as jk','jk.jenis_kegiatan_id = k.jenis_kegiatan_id','LEFT')
                        ->join('pegawai as p','p.pegawai_id = pk.pegawai_id','LEFT')
                        ->join('status_peserta as sp','sp.status_peserta_id = pk.status_peserta_id','LEFT')
                        ->where('pk.pegawai_id',$key)
                        ->get();
    }

    function get_jumlah_kegiatan($key){
        return $this->db->select('pk.pegawai_id, pk.peserta_kegiatan_id')
                        ->from('peserta_kegiatan as pk')
                        ->where('pk.pegawai_id',$key)
                        ->count_all_results();
    }
}

/* End of file M_peserta_internal.php */
/* Location: ./application/modules/peserta_internal/models/M_peserta_internal.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengaturan_laporan extends CI_Model {

	function __construct()
    {
        parent::__construct();

    }

    function fetch($table, $filter = NULL, $group_by =NULL, $sort=NULL, $join = NULL, $cond = NULL) {
        if($join !== NULL && $cond !== NULL){
            $this->db->join($join,$cond);
        }

        if($filter !== NULL){
            $this->db->where($filter);
        }

        if($group_by !== NULL)
            $this->db->group_by($group_by);

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

    // insert batch
    function save_batch($data)
    {
        $this->db->insert_batch('nb_pengaturan_laporan', $data);
    }

    function update_laporan_kegiatan($id, $data)
    {   
        // $jenis_kegiatan_id  = $this->input->post('jenis_kegiatan_id', true);
        // $jenis_laporan = $this->input->post('jenis_laporan_id', true);
        // for($i = 0; $i < count($jenis_laporan); $i++)
        // {
        //     $data[] = array(
        //         // 'jenis_kegiatan_id' =>  $jenis_kegiatan_id,
        //         'jenis_laporan_id'  =>  $jenis_laporan[$i],
        //         'modified_by'       =>  $this->session->name
        //     );
        // }
        $this->db->update_batch('nb_pengaturan_laporan', $data, 'jenis_laporan_id');
    }
	
    function get_laporan_kegiatan($jenis_kegiatan_id)
    {
        return $this->db->select('jk.jenis_kegiatan_id, jk.jenis_kegiatan, jl.jenis_laporan_id, jl.jenis_laporan, pl.jenis_kegiatan_id, pl.jenis_laporan_id')
                        ->from('nb_pengaturan_laporan as pl')
                        ->join('jenis_kegiatan as jk','pl.jenis_kegiatan_id = jk.jenis_kegiatan_id','LEFT')
                        ->join('nb_jenis_laporan as jl','pl.jenis_laporan_id = jl.jenis_laporan_id','LEFT')
                        ->where('pl.jenis_kegiatan_id',$jenis_kegiatan_id)
                        ->get();
    }

    // jenis kegiatan yang belum dibuat
    function jenis_kegiatan_not_create($jenis_kegiatan_id)
    {
        return $this->db->select('jenis_kegiatan.*')
                        ->from('jenis_kegiatan')
                        ->where_not_in('jenis_kegiatan_id',$jenis_kegiatan_id)
                        ->get();
    }

}

/* End of file M_pengaturan_laporan.php */
/* Location: ./application/modules/pengaturan_laporan/models/M_pengaturan_laporan.php */
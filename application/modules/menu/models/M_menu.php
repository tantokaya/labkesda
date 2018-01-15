<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class M_menu extends CI_Model {

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

    function get_all_menu(){
        $this->db->select('menu_id as id, menu as text');
        $this->db->from('menu');

        $no_parent = array('id' => '0', 'text' => 'No Parent / Root Menu');
        $result = $this->db->get()->result_array();
        array_unshift($result, $no_parent);

        return json_encode($result);
    }

    function get_all_akses(){
        return $this->db->get('akses')->result_array();
    }

    function get_level_menu($parent){
        $result = $this->db->get_where('menu', array('menu_id' => $parent))->row_array();

        return $result['level'] + 1;
    }

}

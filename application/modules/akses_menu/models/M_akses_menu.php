<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class M_akses_menu extends CI_Model
{
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'akses_menu';

    }

    function save($data, $last_id = false, $tabel = null)
    {
        $tabel = ($tabel == null) ? $this->table : $tabel;
        $this->db->insert($tabel, $data);

        if ($last_id) {
            return $this->db->insert_id();
        }
    }

    function update($data, $key)
    {
        $this->db->update($this->table, $data, $key);
    }

    function destroy($key)
    {
        $this->db->delete($this->table, $key);
    }

    function get_list_akses(){
        return $this->db->get('akses')->result_array();
    }

}
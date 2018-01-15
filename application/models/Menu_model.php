<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Menu_model extends CI_Model {
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'menu';

    }

    function get_list_menus($akses_id, $level = null, $parent = null)
    {
        $this->db->select('m.menu_id as id, m.menu, m.level, m.parent, m.link as url, m.menu_order, m.icon');
        $this->db->from($this->table .' m');
        $this->db->join('akses_menu am', 'm.menu_id = am.menu_id');
        $this->db->where('am.akses_id', $akses_id);
        $this->db->where('am.read_priv', 1);
        $this->db->where('m.published', 1);
        $this->db->order_by('m.menu_order', 'ASC');

        if($level !== null)
            $this->db->where('m.level', $level);

        if($parent !== null)
            $this->db->where('m.parent', $parent);

        $query = $this->db->get();

        if($query->num_rows() > 0)
            $result = $query->result_array();
        else
            $result = array();


        return $result;
    }

    function get_menu_id($key){
        $akses_id = $this->session->akses_id;

        $this->db->select('m.menu_id, m.menu, am.read_priv as access_module, CONCAT(am.add_priv,",",edit_priv,",",delete_priv ) as privileges');
        $this->db->from($this->table .' m');

        $this->db->join('akses_menu am', 'm.menu_id = am.menu_id');
        $this->db->where('am.akses_id', $akses_id);
        $this->db->where($key);

        $query = $this->db->get();

        if($query->num_rows() > 0)
            $result = $query->row_array();
        else
            $result = array();


        return $result;

    }

}

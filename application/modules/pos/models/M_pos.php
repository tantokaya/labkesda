<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Hartanto Kurniawan.
 * Email  : hartanto.kurniawan@bppt.go.id
 * Copyrights 2018
 */

class M_pos extends CI_Model {

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

    //Query manual
    function manualQuery($q)
    {
        return $this->db->query($q);
    }
    //select table
    public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, $data);
    }

    public function getSelectedDataLimited($table,$data,$limit,$offset)
    {
        return $this->db->get_where($table, $data, $limit, $offset);
    }

    //update table
    function updateData($table,$data,$field_key)
    {
        $this->db->update($table,$data,$field_key);
    }

    function get_gol_tindakan(){
        return $this->db->get('mst_gol_tindakan')->result();
    }

    function get_tindakan_lab(){
        return $this->db->order_by('tindakan', 'ASC')->get_where('mst_tindakan',array('gol_tindakan_id' => 1))->result();
    }

    function get_crbayar(){
        return $this->db->get('mst_crbayar')->result();
    }

    function generate_kode_rekmed($kd_pus) {
        $this->db->select('max(substr(kd_rekmed,-6)) as jumlah');
        $this->db->from('mst_pasien');

        $result = $this->db->get()->row_array();

        #echo $this->db->last_query(); exit;

        return $kd_pus . '.' . str_pad((intval($result['jumlah']) + 1),6,'0', STR_PAD_LEFT);
    }

    public function GenerateTrxKasir(){
        date_default_timezone_set('Asia/Jakarta');
        $thn = date("y");
        $jam = date("H");
        $detik = date("s");
        $menit = date("i");

        $text = "SELECT max(trkasir_id) as kode FROM trkasir_header";
        $data = $this->m_pos->manualQuery($text);
        if($data->num_rows() > 0 ){
            foreach($data->result() as $t){
                $hasil = 'TRX-'.$thn.$jam.$menit.$detik;
            }
        }else{
            $hasil = 'TRX'.$thn.$jam.$menit.$detik;
        }
        return $hasil;
    }


}

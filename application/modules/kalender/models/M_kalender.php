<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class M_kalender extends CI_Model {

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

    function save($table, $data, $last_id = false) {
        $this->db->insert($table, $data);

        if ($last_id) return $this->db->insert_id(); else return null;
    }

    function update($table,$data, $key){
        $this->db->update($table, $data, $key);
    }

    function destroy($table,$key){
        $this->db->delete($table, $key);
    }

    function get_all_kalender($start = null, $end = null, $owner = null, $public_event = false, $filter = null, $eselon = null){
        $this->db->select('kegiatan_id as id, CONCAT(IFNULL(CONCAT(k.mark," - "),""),kegiatan) as title, tanggal_mulai as start, DATE_ADD(tanggal_akhir, INTERVAL 1 DAY) as end, waktu_mulai, waktu_akhir, warna_jenis_kegiatan as color, lokasi as location, k.jenis_kegiatan_id')
            ->from('kegiatan k')
            ->join('jenis_kegiatan jk', 'k.jenis_kegiatan_id = jk.jenis_kegiatan_id');

        if($start !== null && $end !== null):
            $this->db->where('tanggal_mulai >=', $start);
            $this->db->where('tanggal_akhir <=', $end);
        endif;

        if($owner !== null && $public_event == false):
            $this->db->where('user_id', $owner);
        endif;

        if($owner !== null && $public_event == true):
            $this->db->where('user_id !=', $owner);
            $this->db->where('is_private', 0);

            if($filter !== NULL && $eselon !== NULL):
                $i ='';

                if($eselon == '1') {
                    $filter = substr($filter,0,2);
                    $i = 2;
                } else if($eselon == '2'){
                    $filter = substr($filter,0,4);
                    $i = 4;
                } else if($eselon == '3'){
                    $filter = substr($filter,0,6);
                    $i = 6;
                } else if($eselon == '4'){
                    $i = 8;
                }

                $this->db->where('SUBSTRING(unit_kerja_id,1,'.$i.')', $filter);
            endif;

        endif;

        return $this->db->get()->result_array();

    }

    public function insert($data = array()){
        $insert = $this->db->insert_batch('lampiran_kegiatan', $data);
        return $insert?true:false;
    }

    function get_list_peserta_perjadin($id){
        $this->db->select('peserta_kegiatan_id, nm_peserta, golongan, jabatan, DATE_FORMAT(tanggal_mulai,"%d/%m/%Y") as tanggal_mulai, DATE_FORMAT(tanggal_akhir,"%d/%m/%Y") as tanggal_akhir');

        return $this->db->get_where('peserta_kegiatan', array('kegiatan_id' => $id))->result_array();
    }

    function get_list_peserta_fgd($id){
        $this->db->select('peserta_kegiatan_id, nm_peserta, nm_instansi, golongan, jabatan, peserta_kegiatan.status_peserta_id, status_peserta')
            ->join('status_peserta', 'peserta_kegiatan.status_peserta_id = status_peserta.status_peserta_id','left');

        return $this->db->get_where('peserta_kegiatan', array('kegiatan_id' => $id))->result_array();
    }

    function get_pegawai_by_nip($nip){
        $this->db->select('pegawai_id, nip, nm_pegawai, golongan, status_jabatan, p.propinsi_id, propinsi, kota_id, gelar_depan, gelar_belakang, alamat, no_npwp');
        $this->db->join('golongan as g', 'p.golongan_id = g.golongan_id', 'LEFT');
        $this->db->join('status_jabatan as sj', 'p.status_jabatan_id = sj.status_jabatan_id', 'LEFT');
        $this->db->join('propinsi as prop', 'p.propinsi_id = prop.propinsi_id', 'LEFT');
        $this->db->from('pegawai p');
        $this->db->where('nip', $nip);

        $result = $this->db->get();

        return $result;
    }

    function autocomplete_pegawai_by_nama($keyword){
        $this->db->select('pegawai_id, nip, nm_pegawai, golongan, status_jabatan, p.propinsi_id, propinsi, kota_id, gelar_depan, gelar_belakang, alamat, no_npwp');
        $this->db->join('golongan as g', 'p.golongan_id = g.golongan_id', 'LEFT');
        $this->db->join('status_jabatan as sj', 'p.status_jabatan_id = sj.status_jabatan_id', 'LEFT');
        $this->db->join('propinsi as prop', 'p.propinsi_id = prop.propinsi_id', 'LEFT');
        $this->db->from('pegawai p');
        $this->db->like('nm_pegawai', $keyword, 'both');

        $query = $this->db->get();

        $data = array();
        foreach($query->result() as $rows){

            $gelar_depan            = !empty($rows->gelar_depan)?$rows->gelar_depan.' ':'';
            $gelar_belakang         = !empty($rows->gelar_belakang)?', '.$rows->gelar_belakang:'';
            $nama                   = $gelar_depan.$rows->nm_pegawai.$gelar_belakang;

            $row['id']              = $rows->pegawai_id;
            $row['label']           = $nama;
            $row['value']           = $nama;
            $row['nip']             = $rows->nip;
            $row['npwp']            = $rows->no_npwp;
            $row['alamat']          = $rows->alamat;
            $row['instansi']        = 'Badan Ekonomi Kreatif';
            $row['golongan']        = $rows->golongan;
            $row['status_jabatan']  = $rows->status_jabatan;
            $row['propinsi_id']     = $rows->propinsi_id;
            $row['kota_id']         = $rows->kota_id;
            $data[] = $row;
        }

        return $data;
    }

    function get_list_eselon1(){
        $this->db->select('unit_kerja_id as kd_satker, unit_kerja as satker')
            ->where('level', 0)
            ->or_where('level', 1);

        return $this->db->get('unit_kerja')->result_array();
    }

    function get_list_eselon2($id, $key = ''){
        $this->db->select('unit_kerja_id as kd_satker, unit_kerja as satker')
            ->where('level', 2)
            ->where('parent', $id);
        $result = $this->db->get('unit_kerja')->result();

        $list   ='<option value=""></option>';
        foreach($result as $t):
            if($t->kd_satker == $key) :
                $list   .= '<option value="'.$t->kd_satker.'" selected>'.$t->satker.'</option>';
            else :
                $list   .= '<option value="'.$t->kd_satker.'">'.$t->satker.'</option>';
            endif;
        endforeach;

        return $list;

    }

    function get_list_eselon3($id, $key=''){
        $this->db->select('unit_kerja_id as kd_satker, unit_kerja as satker')
            ->where('level', 3)
            ->where('parent', $id);
        $result = $this->db->get('unit_kerja')->result();

        $list   ='<option value=""></option>';
        foreach($result as $t):
            if($t->kd_satker == $key) :
                $list   .= '<option value="'.$t->kd_satker.'" selected>'.$t->satker.'</option>';
            else :
                $list   .= '<option value="'.$t->kd_satker.'">'.$t->satker.'</option>';
            endif;
        endforeach;

        return $list;

    }

    function get_list_eselon4($id, $key=''){
        $this->db->select('unit_kerja_id as kd_satker, unit_kerja as satker')
            ->where('level', 4)
            ->where('parent', $id);
        $result = $this->db->get('unit_kerja')->result();

        $list   ='<option value=""></option>';
        foreach($result as $t):
            if($t->kd_satker == $key) :
                $list   .= '<option value="'.$t->kd_satker.'" selected>'.$t->satker.'</option>';
            else :
                $list   .= '<option value="'.$t->kd_satker.'">'.$t->satker.'</option>';
            endif;
        endforeach;

        return $list;

    }

    function get_creator_kegiatan_by_user($userid){
        $this->db->select('nama,email,unit_kerja')
            ->join('unit_kerja uk','u.unit_kerja_id = uk.unit_kerja_id','left');

        return $this->db->get_where('user u', array('user_id' => $userid))->row_array();
    }

    function get_mark_kalender($id){
        $this->db->select('mark');
        return $this->db->get_where('unit_kerja', array('unit_kerja_id' => $id));
    }
}

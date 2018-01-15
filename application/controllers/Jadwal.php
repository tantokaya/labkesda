<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2017
 */

class Jadwal extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model('jadwal_model');
    }

    function index(){
        $d['l_ruang'] = $this->jadwal_model->fetch('ruang')->result_array();

        $this->load->view('layouts/jadwal', $d);

    }

    function get_jadwal_by_ruang(){
        $ruang_id = $this->input->post('id', true);
        $result = '';
        $curr_week = $this->date_range();

        for($i=0; $i < count($curr_week); $i++){
            $this->db->select('deskripsi_rapat as perihal, CONCAT(DATE_FORMAT(jam_mulai,"%H:%i")," - ",DATE_FORMAT(jam_selesai,"%H:%i")," WIB") as jam, pic, unit_kerja')
                ->from('jadwal_ruang jr')
                ->join('unit_kerja uk','jr.unit_kerja_id = uk.unit_kerja_id','left')
                ->where('tanggal', $curr_week[$i])
                ->where('ruang_id', $ruang_id)
                ->order_by('jam_mulai', 'asc');
            $list_kegiatan = $this->db->get()->result_array();

            if(count($list_kegiatan) > 0){
                $result .= '<tr>';
                $result .= '<td rowspan="'.count($list_kegiatan).'" class="text-left text-nowrap">'.$this->functions->check_hari($curr_week[$i]).', '.$this->functions->format_tgl_cetak($curr_week[$i]).'</td>';

                $x = 0; foreach($list_kegiatan as $t){
                    if($x == 0){
                        $result .= '<td class="text-left">'.$t['perihal'].'</td>';
                        $result .= '<td class="text-center">'.$t['jam'].'</td>';
                        $result .= '<td class="text-left"><code>'.$t['pic'].'</code></td>';
                        $result .= '<td class="text-left">'.$t['unit_kerja'].'</td>';
                        $result .= '</tr>';
                    } else {
                        $result .= '<tr>';
                        $result .= '<td class="text-left">'.$t['perihal'].'</td>';
                        $result .= '<td class="text-center">'.$t['jam'].'</td>';
                        $result .= '<td class="text-left"><code>'.$t['pic'].'</code></td>';
                        $result .= '<td class="text-left">'.$t['unit_kerja'].'</td>';
                        $result .= '</tr>';
                    }
                    $x++;
                }

            } else {
                $result .= '<tr>';
                $result .= '<td class="text-left text-nowrap">'.$this->functions->check_hari($curr_week[$i]).', '.$this->functions->format_tgl_cetak($curr_week[$i]).'</td>';
                $result .= '<td></td>';
                $result .= '<td></td>';
                $result .= '<td></td>';
                $result .= '<td></td>';
                $result .= '</tr>';
            }

        }

        echo $result;
    }

    function date_range(){
        if(date('D')!='Mon') {
            $staticstart = date('Y-m-d',strtotime('last Monday'));
            $staticstartNext = date('Y-m-d',strtotime('next Monday'));
        } else {
            $staticstart = date('Y-m-d');
            $staticstartNext = date('Y-m-d',strtotime('next Monday'));
        }

        if(date('D')!='Sat') {
            $staticfinish = date('Y-m-d',strtotime('next Saturday'));
            $staticfinishNext = date('Y-m-d', strtotime('Saturday next week'));
        } else {
            $staticfinish = date('Y-m-d',strtotime('next Saturday'));
            $staticfinishNext = date('Y-m-d',strtotime('+2 weeks'));
        }

        $period = new DatePeriod(
            new DateTime($staticstart),
            new DateInterval('P1D'),
            new DateTime($staticfinish)
        );

        foreach($period as $day) {
            $arrLastWeek[] = $day->format('Y-m-d');
        }

        $period2 = new DatePeriod(
            new DateTime($staticstartNext),
            new DateInterval('P1D'),
            new DateTime($staticfinishNext)
        );

        foreach($period2 as $day) {
            $arrLastWeek[] = $day->format('Y-m-d');
        }


        return $arrLastWeek;
    }
}
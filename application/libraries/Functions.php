<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Functions{

    protected $CI;

    function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model('menu_model');
    }

    /*
    function generate_menu(){

        $menus = $this->CI->menu_model->get_list_menus($this->CI->session->akses_id, 0, null);

        $menu_list = '';
        foreach($menus as $m){
            // level 0 as parent
            $menu_id = $m['id'];
            // level 1
            $menu1 = $this->CI->menu_model->get_list_menus($this->CI->session->akses_id, 1, $menu_id);
            if(count($menu1) > 0) {
                $menu_list .= '<li><a href="#" class="acc-parent"><i class="zmdi zmdi-folder-outline"></i><span class="list-label">'.$m['menu'].'</span></a>';
                $menu_list .= '<ul>';

                foreach ($menu1 as $m1) {
                    $menu_id = $m1['id'];
                    // level 2
                    $menu2 = $this->CI->menu_model->get_list_menus($this->CI->session->akses_id, 2, $menu_id);
                    if (count($menu2) > 0) {
                        $menu_list .= '<li><a href="#"><span>' . $m1['menu'] . '</span></a>';
                        $menu_list .= '<ul>';

                        foreach($menu2 as $m2){

                            $menu_list .= '<li><a href="' . base_url($m2['url']) . '"><span>' . $m2['menu'] . '</span></a></li>';
                        }
                        $menu_list .= '</ul></li>';
                    }else {
                        $menu_list .= '<li><a href="' . base_url($m1['url']) . '"><span>' . $m1['menu'] . '</span></a></li>';
                    }
                }

                $menu_list .= '</ul></li>';
            }else{
                $menu_list .= '<li><a href="' . base_url($m['url']) . '"><i class="zmdi zmdi-folder-outline"></i><span class="list-label">' . $m['menu'] . '</span></a></li>';
            }
        }

        return $menu_list;
    }*/

    // three level menu
    function generate_menu(){

        $menus = $this->CI->menu_model->get_list_menus($this->CI->session->akses_id, 0, null);

        //echo $this->CI->db->last_query(); exit;

        $menu_list = '';
        foreach($menus as $m){
            // level 0 as parent
            $menu_id = $m['id'];
            // level 1
            $menu1 = $this->CI->menu_model->get_list_menus($this->CI->session->akses_id, 1, $menu_id);
            if(count($menu1) > 0) {
                $menu_list .= '<li><a href="#"><i class="'.$m['icon'].'"></i> ' . $m['menu'] . '</a>';
                $menu_list .= '<ul class="acc-menu">';

                foreach ($menu1 as $m1) {
                    $menu_id = $m1['id'];
                    // level 2
                    $menu2 = $this->CI->menu_model->get_list_menus($this->CI->session->akses_id, 2, $menu_id);
                    if (count($menu2) > 0) {
                        $menu_list .= '<li><a href="#"><!--<i class="fa fa-folder-open"></i>-->' . $m1['menu'] . '</a>';
                        $menu_list .= '<ul class="acc-menu">';

                        foreach($menu2 as $m2){
                            $menu_id = $m2['id'];
                            // level 3
                            $menu3 = $this->CI->menu_model->get_list_menus($this->CI->session->akses_id, 3, $menu_id);
                            if (count($menu3) > 0){
                                $menu_list .= '<li><a href="#"><!--<i class="fa fa-folder-open"></i>-->' . $m1['menu'] . '</a>';
                                $menu_list .= '<ul class="acc-menu">';

                                foreach($menu3 as $m3){
                                    $menu_list .= '<li><a href="' . base_url($m3['url']) . '"> ' . $m3['menu'] . '</a></li>';
                                }
                                $menu_list .= '</ul></li>';
                            } else {
                                $menu_list .= '<li><a href="' . base_url($m2['url']) . '"> ' . $m2['menu'] . '</a></li>';
                            }
                        }
                        $menu_list .= '</ul></li>';
                    }else {
                        $menu_list .= '<li><a href="' . base_url($m1['url']) . '"> ' . $m1['menu'] . '</a></li>';
                    }
                }

                $menu_list .= '</ul></li>';
            }else{
                $menu_list .= '<li><a href="' . base_url($m['url']) . '"><i class="'.$m['icon'].'"></i> <span>' . $m['menu'] . '</span></a></li>';
            }
        }

        return $menu_list;
    }


    function check_session(){
        if(!isset($this->CI->session->logged_in)){
            redirect('logout');
        }
    }

    function check_priv($module){

        $menu = $this->CI->menu_model->get_menu_id(array('m.link' => $module ));

        $result = array();
        $arrMenu = explode(',', $menu['privileges']);
        $sExtends = array('editor_create', 'editor_edit', 'editor_remove');

        $text='[';

        for($i=0; $i < count($arrMenu); $i++){
            if($arrMenu[$i] == '1') {
                if(($i+1) == count($arrMenu))
                    $text .= '{"sExtends":"'.$sExtends[$i].'","editor":editor}';
                else
                    $text .= '{"sExtends":"'.$sExtends[$i].'","editor":editor},';
            }
        }

        $text .= ']';
        return $text;
    }

    function check_priv2($module){

        $menu = $this->CI->menu_model->get_menu_id(array('m.link' => $module ));

        return $menu;
    }

    // check access if passing module by url
    function check_access($module){
        $module = $this->CI->menu_model->get_menu_id(array('m.link' => $module ));

        $grant_access = $module['access_module'];

        if($grant_access == 0){
            show_404();
        }

    }

    // check access if passing sub by url
    function check_access2($module, $action_module){
        $action_module = strtolower($action_module);
        $module = $this->CI->menu_model->get_menu_id(array('m.link' => $module ));

        $submodule = $module['privileges'];
        $privileges = explode(',', $submodule);

        switch($action_module){
            case "add"      : $grant_access = $privileges[0]; break;
            case "edit"     : $grant_access = $privileges[1]; break;
            case "delete"   : $grant_access = $privileges[2]; break;
            default         : $grant_access = 0; break;
        }

        if($grant_access == 0){
            show_404();
        }

    }

    function calculate_age($startDate, $endDate){

        $diff = abs(strtotime($endDate) - strtotime($startDate));

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        return array($years, $months, $days);
    }

    function convert_date_indo($array)
    {
        $datetime=$array['datetime'];
        $y=substr($datetime,0,4);
        $m=substr($datetime,5,2);
        $d=substr($datetime,8,2);
        $conv_datetime=date("j/m/Y",mktime(1,0,0,$m,$d,$y));#"$d / $m / $y";
        return($conv_datetime);
    }

    /* ------------------------------
    // Konversi tanggal tgl indo ke sql
    //
    // Usage :  convert_date_sql("31/12/2014") return 2014-12-31
    -------------------------------*/
    function convert_date_sql($date){
        // list($day, $month, $year) = split('[/.-]', $date); => DEPRECATED
        list($day, $month, $year) = preg_split('/[\/\.\-]/', $date);
        return "$year-".sprintf("%02d", $month)."-".sprintf("%02d", $day);
    }

    function calc_age($startDate, $endDate){

        $diff = abs(strtotime($endDate) - strtotime($startDate));

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        return array($years, $months, $days);
    }

    function calc_age_month($dob){
        $birthday = new DateTime($dob);
        $diff = $birthday->diff(new DateTime());
        $months = $diff->format('%m') + 12 * $diff->format('%y');

        return $months;
    }

    function check_bulan($tanggal){
        $bulan_array=array(
            "1"=>"Januari",
            "2"=>"Februari",
            "3"=>"Maret",
            "4"=>"April",
            "5"=>"Mei",
            "6"=>"Juni",
            "7"=>"Juli",
            "8"=>"Agustus",
            "9"=>"September",
            "10"=>"Oktober",
            "11"=>"November",
            "12"=>"Desember");
        $tanggal_array=preg_split('/[\/\.\-]/', $tanggal);
        $bulan_n=date("n",mktime("1","1","1",$tanggal_array[1],$tanggal_array[2],$tanggal_array[0]));
        return $bulan_array[$bulan_n];
    }

    function format_tgl_cetak($tanggal) {
        list($year, $month, $day) = preg_split('/[\/\.\-]/', $tanggal);
        return intval($day)." ".$this->check_bulan($tanggal)." ".$year;
    }

    function convertdatetime3($array){
        $datetime=$array['datetime'];
        $y=substr($datetime,0,4);
        $m=substr($datetime,5,2);
        $d=substr($datetime,8,2);
        $conv_datetime=date("j-n-Y",mktime(1,0,0,$m,$d,$y));#"$d / $m / $y";
        return($conv_datetime);

    }

    function check_hari($tanggal){
        $hari_array=array(
            "1"=>"Senin",
            "2"=>"Selasa",
            "3"=>"Rabu",
            "4"=>"Kamis",
            "5"=>"Jumat",
            "6"=>"Sabtu",
            "7"=>"Minggu");

        $tanggal_array=preg_split('/-/', $tanggal); //Y-m-d
        // 1 Desember 2013 -> $tanggal_array[0] = 1, $tanggal_array[1] = Desember, $tanggal_array[2] = 2013
        $hari_n=date("N",mktime(0,0,0,$tanggal_array[1],$tanggal_array[2],$tanggal_array[0]));
        // 12, 1, 2013 -> mm-dd-yyyy
        return $hari_array[$hari_n];
    }

    function terbilang($bilangan) {

        $angka = array('0','0','0','0','0','0','0','0','0','0',
            '0','0','0','0','0','0');
        $kata = array('','satu','dua','tiga','empat','lima',
            'enam','tujuh','delapan','sembilan');
        $tingkat = array('','ribu','juta','milyar','triliun');

        $panjang_bilangan = strlen($bilangan);

        /* pengujian panjang bilangan */
        if ($panjang_bilangan > 15) {
            $kalimat = "Diluar Batas";
            return $kalimat;
        }

        /* mengambil angka-angka yang ada dalam bilangan,
        dimasukkan ke dalam array */
        for ($i = 1; $i <= $panjang_bilangan; $i++) {
            $angka[$i] = substr($bilangan,-($i),1);
        }

        $i = 1;
        $j = 0;
        $kalimat = "";


        /* mulai proses iterasi terhadap array angka */
        while ($i <= $panjang_bilangan) {

            $subkalimat = "";
            $kata1 = "";
            $kata2 = "";
            $kata3 = "";

            /* untuk ratusan */
            if ($angka[$i+2] != "0") {
                if ($angka[$i+2] == "1") {
                    $kata1 = "Seratus";
                } else {
                    $kata1 = $kata[$angka[$i+2]] . " ratus";
                }
            }

            /* untuk puluhan atau belasan */
            if ($angka[$i+1] != "0") {
                if ($angka[$i+1] == "1") {
                    if ($angka[$i] == "0") {
                        $kata2 = "Sepuluh";
                    } elseif ($angka[$i] == "1") {
                        $kata2 = "Sebelas";
                    } else {
                        $kata2 = $kata[$angka[$i]] . " belas";
                    }
                } else {
                    $kata2 = $kata[$angka[$i+1]] . " puluh";
                }
            }

            /* untuk satuan */
            if ($angka[$i] != "0") {
                if ($angka[$i+1] != "1") {
                    $kata3 = $kata[$angka[$i]];
                }
            }

            /* pengujian angka apakah tidak nol semua,
            lalu ditambahkan tingkat */
            if (($angka[$i] != "0") OR ($angka[$i+1] != "0") OR
                ($angka[$i+2] != "0")) {
                $subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
            }

            /* gabungkan variabe sub kalimat (untuk satu blok 3 angka)
            ke variabel kalimat */
            $kalimat = $subkalimat . $kalimat;
            $i = $i + 3;
            $j = $j + 1;

        }

        /* mengganti satu ribu jadi seribu jika diperlukan */
        if (($angka[5] == "0") AND ($angka[6] == "0")) {
            $kalimat = str_replace("satu ribu","Seribu",$kalimat);
        }

        return trim($kalimat);
    }

}

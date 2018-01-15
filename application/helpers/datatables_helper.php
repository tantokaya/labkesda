<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

    $skey 	= "Qe6h1ptO69X1vWd616V3224964PPAPkx";

    function safe_b64encode($string) {

        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

    function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    function encode($value){
        $skey 	= "Qe6h1ptO69X1vWd616V3224964PPAPkx";

        if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim(safe_b64encode($crypttext));
    }

    function decode($value){
        $skey 	= "Qe6h1ptO69X1vWd616V3224964PPAPkx";

        if(!$value){return false;}
        $crypttext = safe_b64decode($value);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }

    function filterInstansi($pegawai_id, $peserta_kegiatan_id){
        $pegawai_id = encode($pegawai_id);
        $button = '';
//                <li><a href="#" onclick="getFormAddPesertaInternal(\''.$pegawai_id.'\')" data-id="'.$pegawai_id.'"><i class="icon-plus2"></i></a></li>
        if(!$peserta_kegiatan_id){
            $button = '<ul class="icons-list">
                <li><a href="#" class="internal-add" data-id="'.$pegawai_id.'"><i class="icon-plus2"></i></a></li>
                </li>
            </ul>';
        }
        return $button;
    }
    function status_validasi_kegiatan($status){
        if($status == 0){
            return 'proses';
        }elseif($status == 1){
            return 'selesai';
        }
    }
    function status_validasi_laporan($status){
        if($status == 0){
            return 'proses';
        }elseif($status == 1){
            return 'perbaikan';
        }elseif($status == 2){
            return 'selesai';
        }
    }


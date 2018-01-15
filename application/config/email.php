<?php
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2017
 */
/*
|--------------------------------------------------------------------------
| Email Config
|--------------------------------------------------------------------------
|
*/
$config = Array(
    'protocol'   => 'smtp',
    'charset'   => 'utf-8',
    'wordwrap'  => TRUE,
    'smtp_host' => 'mail.papan.bekraf.go.id',
    'smtp_user' => 'noreply@papan.bekraf.go.id',
    'smtp_pass' => 'papan#reply_',
    'smtp_port' => '465',
    'smtp_crypto' => 'ssl',
    'mailtype'    => 'html'
);
//$config = Array(
//    'protocol'   => 'mail',
//    'charset'   => 'utf-8',
//    'wordwrap'  => TRUE,
//    'smtp_host' => 'mail.risbang.bekraf.go.id',
//    'smtp_user' => 'noreply@risbang.bekraf.go.id',
//    'smtp_pass' => 'risbangn#reply_',
//    'smtp_port' => '587',
//    'smtp_crypto' => 'ssl',
//    'mailtype'    => 'html'
//);
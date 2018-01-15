<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Dashboard extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->load->model('m_dashboard');

    }

    public function index()
    {
        $d['menus']             = $this->functions->generate_menu();
        $d['content']           = '';

        #echo '<pre>'; print_r($d); exit;
        $this->template->set_layout('backoffice')->title('Dashboard - Labkesda')->build('v_dashboard', $d);
    }



}

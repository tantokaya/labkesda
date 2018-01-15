<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Setting_aplikasi extends MX_Controller {


    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_setting_aplikasi');
    }

    public function index()
    {
        $d['page_title']    = 'Pengaturan Aplikasi';
        $d['menus']         = $this->functions->generate_menu();

        $d['app']          = $this->m_setting_aplikasi->fetch('setting_aplikasi', array('id' => 1))->row_array();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('app_name', 'Nama Aplikasi', 'required|trim');
        $this->form_validation->set_rules('app_company', 'Nama Instansi', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;

            $id                         = 1;

            $data['app_name']           = ucwords(strtolower($this->input->post('app_name', true)));
            $data['app_company']        = ucwords(strtolower($this->input->post('app_company', true)));
            $data['app_theme']          = strtolower($this->input->post('app_theme', true));

            $data['modified_by']        = $this->session->nama;

            $this->db->trans_begin();

            $this->m_setting_aplikasi->update('setting_aplikasi', $data, array('id' => $id));

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data setting aplikasi gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data setting aplikasi berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('setting_aplikasi');
        }


        $this->template->set_layout('backoffice')->title('Pengaturan Aplikasi - Kemendagri')->build('f_setting_aplikasi', $d);
    }


}

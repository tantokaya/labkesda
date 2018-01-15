<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Akses_menu extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));


        $this->load->model('m_akses_menu');

        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $d['page_title']    = 'Akses Menu';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-akses-menu" width="100%" class="table table-striped table-responsive table-bordered datatable">');
        $this->table->set_template($tmpl);

        $this->table->set_heading('Akses Menu ID', 'Menu', 'Level', 'Read', 'Add', 'Edit', 'Delete');

        $this->template->set_layout('backoffice')->title('Akses Menu - Badan Ekonomi Kreatif Indonesia')->build('v_akses_menu', $d);
    }

    public function dt_akses_menu(){
        if(!$this->input->is_ajax_request()) show_404();

        $akses = $this->input->post('akses', TRUE);

        $this->datatables->select('am.akses_menu_id, m.menu, m.level, am.read_priv, am.add_priv, am.edit_priv, am.delete_priv ')
            ->from('akses_menu am')
            ->join('menu m', 'am.menu_id = m.menu_id')
            ->where('m.published', 1);

        if($akses) {
            $this->datatables->where('am.akses_id', $akses);
        }else {
            $this->datatables->where('am.akses_id', 1);
        }

        echo $this->datatables->generate();

    }

    function update_read(){
        $this->functions->check_access2('menu', 'edit');
        if(!$this->input->is_ajax_request()) show_404();

        $id                     = $this->input->post('akses_menu_id', TRUE);
        $data['read_priv']      = $this->input->post('read_priv', TRUE);
        $data['modified_by']    = $this->session->nama;

        $this->m_akses_menu->update($data, array('akses_menu_id' => $id));
    }

    function update_add(){
        $this->functions->check_access2('menu', 'edit');
        if(!$this->input->is_ajax_request()) show_404();

        $id                    = $this->input->post('akses_menu_id', TRUE);
        $data['add_priv']      = $this->input->post('add_priv', TRUE);
        $data['modified_by']    = $this->session->nama;

        $this->m_akses_menu->update($data, array('akses_menu_id' => $id));
    }

    function update_edit(){
        $this->functions->check_access2('menu', 'edit');
        if(!$this->input->is_ajax_request()) show_404();

        $id                     = $this->input->post('akses_menu_id', TRUE);
        $data['edit_priv']      = $this->input->post('edit_priv', TRUE);
        $data['modified_by']    = $this->session->nama;

        $this->m_akses_menu->update($data, array('akses_menu_id' => $id));
    }

    function update_delete(){
        $this->functions->check_access2('menu', 'edit');
        if(!$this->input->is_ajax_request()) show_404();

        $id                      = $this->input->post('akses_menu_id', TRUE);
        $data['delete_priv']     = $this->input->post('delete_priv', TRUE);
        $data['modified_by']    = $this->session->nama;

        $this->m_akses_menu->update($data, array('akses_menu_id' => $id));
    }

    function get_list_akses(){
        if(!$this->input->is_ajax_request()) show_404();

        echo json_encode($this->m_akses_menu->get_list_akses());
    }

}

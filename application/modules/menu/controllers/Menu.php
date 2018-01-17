<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author : Aditya Nursyahbani.
 * Email  : aditya.nursyahbani@bppt.go.id
 * Copyrights 2016
 */

class Menu extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));


        $this->load->model('m_menu');

        $this->load->library('Datatables');
        $this->load->library('table');
    }

    public function index()
    {
        $d['page_title']    = 'Daftar Menu';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-menu" width="100%"  class="table table-striped table-hover table-responsive table-bordered datatable">');
        $this->table->set_template($tmpl);

        if($privileges[1]==1 or $privileges[2]==1) {
            $this->table->set_heading('Menu ID', 'Menu', 'URL', 'Parent', 'Menu Order', 'Publish', 'Aksi');
        } else {
            $this->table->set_heading('Menu ID', 'Menu', 'URL', 'Parent', 'Menu Order', 'Publish');
        }


        $this->template->set_layout('backoffice')->title('Daftar Menu - Kemendagri')->build('v_menu', $d);
    }

    public function dt_menu(){
        if(!$this->input->is_ajax_request()) show_404();

        $edit_priv = $this->input->post('edit_priv', TRUE);
        $delete_priv = $this->input->post('delete_priv', TRUE);

        $this->datatables->select('m.menu_id as kode, m.menu, m.link as url, m1.menu as parent_menu, m.menu_order, m.published', FALSE)
            ->from('menu m')
            ->join('menu m1', 'm.parent = m1.menu_id', 'left');

        $edit_button = ($edit_priv == 1) ? '<li><a href="'.base_url('menu/edit/$1').'"><i class="icon-pencil6"></i> Ubah</a></li>' : '';
        $delete_button = ($delete_priv == 1) ? '<li><a href="#" class="btn-delete" data-id="$1"><i class="icon-trash"></i> Hapus</a></li>' : '';
        $divider = ($edit_priv == 1 && $delete_priv == 1)?'<li class="divider"></li>':'';

        $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $edit_button . $divider . $delete_button . '</ul></li></ul>' , 'encode(kode)');

        echo $this->datatables->generate();

    }

    public function add(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Tambah Menu';
        $d['menus']         = $this->functions->generate_menu();

        $d['l_menu']        = $this->m_menu->get_all_menu();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {
            #echo '<pre>'; print_r($this->input->post()); exit;

            $data['parent']             = $this->input->post('parent', true);

            if ($data['parent'] == "" or $data['parent'] == "0") {
                $data['level']          = 0;
                $data['isleaf']         = 0;
            } else {
                $data['level'] = $this->m_menu->get_level_menu($data['parent']);
                $data['isleaf']         = 1;
            }

            $data['menu']               = $this->input->post('menu', true);
            $data['link']               = $this->input->post('link', true);

            $published                  = $this->input->post('published', true);
            if(isset($published) && $published == '1')
                $data['published'] = 1;
            else
                $data['published'] = 0;

            $data['menu_order']         = $this->input->post('menu_order', true);
            $data['created_by']         = $this->session->nama;

            $this->db->trans_begin();

            $menu_id = $this->m_menu->save('menu', $data, true);

            //insert into akses_menu for all user
            $list_akses = $this->m_menu->get_all_akses();
            foreach ($list_akses as $access){
                $am['akses_id']     = $access['akses_id'];
                $am['menu_id']      = $menu_id;
                $am['read_priv']    = ($access['akses_id'] == 1)?'1':'0';
                $am['add_priv']     = ($access['akses_id'] == 1)?'1':'0';
                $am['edit_priv']    = ($access['akses_id'] == 1)?'1':'0';
                $am['delete_priv']  = ($access['akses_id'] == 1)?'1':'0';
                $am['created_by']   = $this->session->nama;

                $this->m_menu->save('akses_menu', $am);
            }

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data menu gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data menu berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('menu');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Tambah Menu - Badan Ekonomi Kreatif Indonesia')->build('f_menu', $d);

    }

    public function edit(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));

        $d['page_title']    = 'Ubah Data Menu';
        $d['menus']         = $this->functions->generate_menu();

        $menu_id = decode($this->uri->segment(3));
        if(!empty($menu_id)){
            $cek = $this->m_menu->fetch('menu', array('menu_id' => $menu_id))->num_rows();

            if($cek > 0){
                $d['menu']      =  $this->m_menu->fetch('menu', array('menu_id' => $menu_id))->row_array();

            } else {
                redirect('menu');
            }
        } else {
            redirect('menu');
        }

        $d['l_menu']        = $this->m_menu->get_all_menu();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('menu', 'Menu', 'required');


        if ($this->form_validation->run() == FALSE) {
            // do nothing
        } else {

            $id	                        = $menu_id;
            $data['parent']             = $this->input->post('parent', true);

            if ($data['parent'] == "" or $data['parent'] == "0") {
                $data['level']          = 0;
                $data['isleaf']         = 0;
            } else {
                $data['level'] = $this->m_menu->get_level_menu($data['parent']);
                $data['isleaf']         = 1;
            }

            $data['menu']               = $this->input->post('menu', true);
            $data['link']               = $this->input->post('link', true);

            $published                  = $this->input->post('published', true);
            if(isset($published) && $published == '1')
                $data['published'] = 1;
            else
                $data['published'] = 0;

            $data['menu_order']         = $this->input->post('menu_order', true);
            $data['modified_by']        = $this->session->nama;

            $this->db->trans_begin();

            $this->m_menu->update('menu', $data, array('menu_id' => $id));

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $message                        = "Data menu gagal diperbaharui!";
                $type                           = "error";
            } else {
                $this->db->trans_commit();
                $message                        = "Data menu berhasil diperbaharui!";
                $type                           = "success";
            }

            $this->session->set_flashdata(array('notif' => $message, 'type' => $type));

            redirect('menu');
        }

        #echo '<pre>'; print_r($d); exit;

        $this->template->set_layout('backoffice')->title('Ubah Menu - Badan Ekonomi Kreatif Indonesia')->build('f_menu', $d);

    }

    public function delete(){
        $this->functions->check_access2($this->uri->segment(1), $this->uri->segment(2));
        if(!$this->input->is_ajax_request()) show_404();

        $id['menu_id'] = decode($this->input->post('id', true));
        $this->m_menu->destroy('mst_menu', $id);
        $result['message'] = 'Data Menu berhasil dihapus';

        echo json_encode($result);
    }

    public function update_published(){
        $this->functions->check_access2('menu', 'edit');
        if(!$this->input->is_ajax_request()){
            show_404();
        }

        $id                  = $this->input->post('menu_id', TRUE);
        $data['published']   = $this->input->post('published', TRUE);
        $data['modified_by'] = $this->session->nama;

        if($this->m_menu->update('menu', $data, array('menu_id' => $id)))
            echo 'berhasil';
        else
            echo 'gagal';
    }

    public function get_all_menu(){
        if(!$this->input->is_ajax_request()){
            exit('No direct script allowed');
        }

        echo $this->m_menu->get_all_menu();

    }

}

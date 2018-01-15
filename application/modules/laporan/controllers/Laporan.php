<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MX_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_kegiatan');

        $this->load->library('Datatables');
        $this->load->library('table');
    }
	
    public function index()
	{
//		$this->load->view('html_laporan');
        $d['page_title']    = 'Daftar Laporan Kegiatan';
        $d['menus']         = $this->functions->generate_menu();

        $d['priv']          = $this->functions->check_priv2($this->uri->segment(1)); // priv btn exl editor
        $privileges         = explode(',',$d['priv']['privileges']);

        //set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-laporan" width="100%" class="table table-striped table-responsive table-bordered datatable" >');
        $this->table->set_template($tmpl);

        $this->template->set_layout('backoffice')
            ->title('Daftar Laporan Kegiatan - Badan Ekonomi Kreatif Indonesia')
            ->build('v_laporan', $d);
    }

	public function ubah()
	{
		$this->load->view('html_laporan_ubah');
	}

}

/* End of file Laporan.php */
/* Location: ./application/modules/laporan/controllers/Laporan.php */
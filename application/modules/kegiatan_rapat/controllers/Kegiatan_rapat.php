<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan_rapat extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_kegiatan_rapat');
	}

	function index()
	{
		$data['ruang'] = $this->m_kegiatan_rapat->fetch('ruang')->result_array();
		$this->load->view('html_kegiatan_rapat',$data);
	}

	function get_ruang()
	{
		$filter = $this->uri->segment(3);
		$data = $this->m_kegiatan_rapat->fetch('ruang', array('ruang_id'=>$filter))->row_array();
		echo json_encode($data);
	}

	function get_pegawai()
	{
		$data = $this->m_kegiatan_rapat->fetch('pegawai')->result_array();
		echo json_encode($data);
	}
}

/* End of file Kegiatan_rapat.php */
/* Location: ./application/modules/kegiatan_rapat/controllers/Kegiatan_rapat.php */
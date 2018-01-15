<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta_internal extends MX_Controller {

	function __construct()
	{
		parent::__construct();

        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_peserta_internal');

        $this->load->library('Datatables');
        $this->load->library('table');
	}

	function index()
	{
		$d['page_title']	= 'Peserta Internal';
		$d['menus']			= $this->functions->generate_menu();
		
		$d['priv']			= $this->functions->check_priv2($this->uri->segment(1));

		$privileges			= explode(',',$d['priv']['privileges']);

		//set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-peserta-internal" width="100%" class="table table-striped table-responsive table-bordered datatable">');
        $this->table->set_template($tmpl);

        if($privileges[1] == 1 or $privileges[2] == 1) {
        	$this->table->set_heading('NIP', 'Nama Pegawai', 'Tempat Lahir', 'Tanggal Lahir');
        } else {
            $this->table->set_heading('NIP', 'Nama Pegawai', 'Tempat Lahir', 'Tanggal Lahir');
        }

        $this->template->set_layout('backoffice')
        				->title('Peserta Internal - Badan Ekonomi Kreatif Indonesia')
        				->build('v_peserta_internal', $d);
	}

	function dt_peserta_internal()
	{
		if(!$this->input->is_ajax_request()) show_404();

        $this->datatables->select('pegawai_id as kode, nip, nm_pegawai, tempat_lahir, DATE_FORMAT(tanggal_lahir,\'%d/%m/%Y\') as tanggal_lahir', FALSE)
            ->from('pegawai');

        $this->datatables->unset_column('kode');
        
		$view = '<a href="#" data-id="$1" data-title="$2">$2</a>';
		$this->datatables->add_column('nm_pegawai',$view,'encode(kode), nm_pegawai');
		
		// $view_button = '<li><a href="#" data-title="$2" data-id="$1" class="btn-view"><i class="icon-eye"></i> Lihat</a></li>';
		// $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $view_button . '</ul></li></ul>' , 'encode(kode)');

		echo $this->datatables->generate();
	}

	/**
	 * modal detail peserta kegiatan internal
	 */
	function view() 
	{
		if(!$this->input->is_ajax_request()) show_404();

		$pegawai_id = decode($this->input->post('id',true));
		if(!empty($pegawai_id)) {
			$d['cek'] = $this->m_peserta_internal->fetch('pegawai', ['pegawai.pegawai_id' => $pegawai_id], null,'peserta_kegiatan','peserta_kegiatan.pegawai_id = pegawai.pegawai_id');
			// if($cek->num_rows() > 0) {
				$d['pegawai'] =$this->m_peserta_internal->fetch('pegawai', ['pegawai_id' => $pegawai_id])->row_array();

				$d['l_jenis_kelamin']   = $this->m_peserta_internal->fetch('jenis_kelamin')->result_array();
                $d['l_agama']           = $this->m_peserta_internal->fetch('agama')->result_array();
                $d['l_speg']            = $this->m_peserta_internal->fetch('status_pegawai')->result_array();
                $d['l_sjab']            = $this->m_peserta_internal->fetch('status_jabatan')->result_array();
                $d['l_golongan']        = $this->m_peserta_internal->fetch('golongan')->result_array();
                $d['l_eselon']          = $this->m_peserta_internal->fetch('eselon')->result_array();
                $d['l_propinsi']        = $this->m_peserta_internal->fetch('propinsi')->result_array();
                $d['l_kota']            = $this->m_peserta_internal->fetch('kota', array('SUBSTRING(kota_id,1,2)' => $d['pegawai']['propinsi_id']))->result_array();
                
                $d['l_jenis_kegiatan']	= $this->m_peserta_internal->get_kegiatan_by_pegawai($pegawai_id)->result_array();
                $d['jumlah_kegiatan']	= $this->m_peserta_internal->get_jumlah_kegiatan($pegawai_id);
                // return var_dump($d['count']);
			// }
		}

		$this->load->view('modal_peserta_internal', $d);
	}

}

/* End of file Peserta_internal.php */
/* Location: ./application/modules/peserta_internal/controllers/Peserta_internal.php */
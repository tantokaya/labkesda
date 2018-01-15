<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta_eksternal extends MX_Controller {

	function __construct()
	{
        parent::__construct();
        $this->functions->check_session();
        $this->functions->check_access($this->uri->segment(1));

        $this->load->model('m_peserta_eksternal');

        $this->load->library('Datatables');
        $this->load->library('table');
	}

	function index()
	{
   		$d['page_title']	= 'Peserta Eksternal';
       	$d['menus']			= $this->functions->generate_menu();
	    $d['priv']			= $this->functions->check_priv2($this->uri->segment(1));

		$privileges			= explode(',',$d['priv']['privileges']);

		//set table id in table open tag
        $tmpl = array('table_open' => '<table id="tbl-peserta-eksternal" width="100%" class="table table-striped table-responsive table-bordered datatable">');
        $this->table->set_template($tmpl);

        if($privileges[1] == 1 or $privileges[2] == 1) {
        	$this->table->set_heading('Nama', 'Email', 'No Telp/Hp','NPWP');
        } else {
            $this->table->set_heading('Nama', 'Email', 'No Telp/Hp','NPWP');
        }

        $this->template->set_layout('backoffice')
				->title('Peserta Eksternal - Badan Ekonomi Kreatif Indonesia')
				->build('v_peserta_eksternal', $d);	
	}

	function dt_peserta_eksternal()
	{
		if(!$this->input->is_ajax_request()) show_404();

        $this->datatables->select('peserta_eksternal_id as kode, nm_peserta, email, no_telepon, no_npwp', FALSE)
    					->from('nb_peserta_eksternal');

		$this->datatables->unset_column('kode');

		$view = '<a href="#" data-id="$1" data-title="$2">$2</a>';
		$this->datatables->add_column('nm_peserta',$view,'encode(kode), nm_peserta');


		// $view_button = '<li><a href="#" data-title="$2" data-id="$1" class="btn-view"><i class="icon-eye"></i> Lihat</a></li>';

		// $this->datatables->add_column('aksi', '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right">' . $view_button . '</ul></li></ul>' , 'encode(kode)');

		echo $this->datatables->generate();
	}

	function view()
	{
		if(!$this->input->is_ajax_request()) show_404();
		
		$peserta_eksternal_id = decode($this->input->post('id',true));
		if(!empty($peserta_eksternal_id)) {
				$d['cek'] = $this->m_peserta_eksternal->fetch('nb_peserta_eksternal',['nb_peserta_eksternal.peserta_eksternal_id' => $peserta_eksternal_id], null ,'peserta_kegiatan','peserta_kegiatan.peserta_eksternal_id = nb_peserta_eksternal.peserta_eksternal_id');
			// if($cek->num_rows() > 0) {
				$d['peserta_eksternal'] = $this->m_peserta_eksternal->fetch('nb_peserta_eksternal',['peserta_eksternal_id' => $peserta_eksternal_id])->row_array();

				$d['l_jenis_kegiatan']	= $this->m_peserta_eksternal->get_kegiatan_peserta_eksternal($peserta_eksternal_id)->result_array();
                $d['jumlah_kegiatan']	= $this->m_peserta_eksternal->get_jumlah_kegiatan($peserta_eksternal_id);

                // return var_dump($d['l_jenis_kegiatan']);
			// }
		}	

		$this->load->view('modal_peserta_eksternal',$d);
	}
}

/* End of file Peserta_eksternal.php */
/* Location: ./application/modules/peserta_eksternal/controllers/Peserta_eksternal.php */
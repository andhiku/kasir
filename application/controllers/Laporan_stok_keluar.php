<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_stok_keluar extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('status') !== 'login' ) {
			redirect('/');
		}
		$this->load->view('laporan_stok_keluar');
	}

}

/* End of file Laporan_stok_keluar.php */
/* Location: ./application/controllers/Laporan_stok_keluar.php */
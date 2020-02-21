<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan_produk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login' ) {
			redirect('/');
		}
		$this->load->model('satuan_produk_model');
	}

	public function index()
	{
		$this->load->view('satuan_produk');
	}

	public function read()
	{
		header('Content-type: application/json');
		if ($this->satuan_produk_model->read()->num_rows() > 0) {
			foreach ($this->satuan_produk_model->read()->result() as $satuan_produk) {
				$data[] = array(
					'satuan' => $satuan_produk->satuan,
					'action' => '<button class="btn btn-sm btn-success" onclick="edit('.$satuan_produk->id.')">Edit</button> <button class="btn btn-sm btn-danger" onclick="remove('.$satuan_produk->id.')">Delete</button>'
				);
			}
		} else {
			$data = array();
		}
		$satuan_produk = array(
			'data' => $data
		);
		echo json_encode($satuan_produk);
	}

	public function add()
	{
		$data = array(
			'satuan' => $this->input->post('satuan')
		);
		if ($this->satuan_produk_model->create($data)) {
			echo json_encode('sukses');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		if ($this->satuan_produk_model->delete($id)) {
			echo json_encode('sukses');
		}
	}

	public function edit()
	{
		$id = $this->input->post('id');
		$data = array(
			'satuan' => $this->input->post('satuan')
		);
		if ($this->satuan_produk_model->update($id,$data)) {
			echo json_encode('sukses');
		}
	}

	public function get_satuan()
	{
		$id = $this->input->post('id');
		$satuan = $this->satuan_produk_model->getKategori($id);
		if ($satuan->row()) {
			echo json_encode($satuan->row());
		}
	}

	public function search()
	{
		header('Content-type: application/json');
		$satuan = $this->input->post('satuan');
		$search = $this->satuan_produk_model->search($satuan);
		foreach ($search as $satuan) {
			$data[] = array(
				'id' => $satuan->id,
				'text' => $satuan->satuan
			);
		}
		echo json_encode($data);
	}

}

/* End of file Satuan_produk.php */
/* Location: ./application/controllers/Satuan_produk.php */
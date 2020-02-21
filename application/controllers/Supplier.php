<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login' ) {
			redirect('/');
		}
		$this->load->model('supplier_model');
	}

	public function index()
	{
		$this->load->view('supplier');
	}

	public function read()
	{
		header('Content-type: application/json');
		if ($this->supplier_model->read()->num_rows() > 0) {
			foreach ($this->supplier_model->read()->result() as $supplier) {
				$data[] = array(
					'nama' => $supplier->nama,
					'alamat' => $supplier->alamat,
					'telepon' => $supplier->telepon,
					'keterangan' => $supplier->keterangan,
					'action' => '<button class="btn btn-sm btn-success" onclick="edit('.$supplier->id.')">Edit</button> <button class="btn btn-sm btn-danger" onclick="remove('.$supplier->id.')">Delete</button>'
				);
			}
		} else {
			$data = array();
		}
		$supplier = array(
			'data' => $data
		);
		echo json_encode($supplier);
	}

	public function add()
	{
		$data = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telepon' => $this->input->post('telepon'),
			'keterangan' => $this->input->post('keterangan')
		);
		if ($this->supplier_model->create($data)) {
			echo json_encode('sukses');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		if ($this->supplier_model->delete($id)) {
			echo json_encode('sukses');
		}
	}

	public function edit()
	{
		$id = $this->input->post('id');
		$data = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telepon' => $this->input->post('telepon'),
			'keterangan' => $this->input->post('keterangan')
		);
		if ($this->supplier_model->update($id,$data)) {
			echo json_encode('sukses');
		}
	}

	public function get_supplier()
	{
		$id = $this->input->post('id');
		$supplier = $this->supplier_model->getSupplier($id);
		if ($supplier->row()) {
			echo json_encode($supplier->row());
		}
	}

	public function search()
	{
		header('Content-type: application/json');
		$supplier = $this->input->post('supplier');
		$search = $this->supplier_model->search($supplier);
		foreach ($search as $supplier) {
			$data[] = array(
				'id' => $supplier->id,
				'text' => $supplier->nama
			);
		}
		echo json_encode($data);
	}

}

/* End of file Supplier.php */
/* Location: ./application/controllers/Supplier.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_keluar_model extends CI_Model {

	private $table = 'stok_keluar';

	public function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function read()
	{
		$this->db->select('stok_keluar.tanggal, stok_keluar.jumlah, stok_keluar.keterangan, produk.barcode, produk.nama_produk');
		$this->db->from($this->table);
		$this->db->join('produk', 'produk.id = stok_keluar.barcode');
		return $this->db->get();
	}

	public function getStok($id)
	{
		$this->db->select('stok');
		$this->db->where('id', $id);
		return $this->db->get('produk')->row();
	}

	public function addStok($id,$stok)
	{
		$this->db->where('id', $id);
		$this->db->set('stok', $stok);
		return $this->db->update('produk');
	}

}

/* End of file Stok_keluar_model.php */
/* Location: ./application/models/Stok_keluar_model.php */
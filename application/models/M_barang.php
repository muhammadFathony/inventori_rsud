<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {

	public function get_all(){
		
		$this->db->select('a.nama_barang, b.stok, b.id_gudang, c.nama_gudang');
		$this->db->from('master_barang a');
		$this->db->join('stok b', 'a.id_barang = b.id_barang', 'inner');
		$this->db->join('gudang c', 'b.id_gudang = c.id_gudang', 'inner');
		$data = $this->db->get()->result();
		return $data;
	}	

	public function new_produk($nama_barang){
		
		$obj = array('nama_barang' => $nama_barang );
		$simpan = $this->db->insert('master_barang', $obj);

		return $simpan;
	}

}

/* End of file M_barang.php */
/* Location: ./application/models/M_barang.php */
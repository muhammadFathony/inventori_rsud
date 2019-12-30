<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {

	public function get_all(){
		
		$this->db->select('a.nama_barang, a.kode_barang, b.stok, b.id_gudang, c.nama_gudang');
		$this->db->from('master_barang a');
		$this->db->join('stok b', 'a.kode_barang = b.kode_barang', 'inner');
		$this->db->join('gudang c', 'b.id_gudang = c.id_gudang', 'inner');
		$data = $this->db->get()->result();
		return $data;
	}	

	public function new_produk($nama_barang, $kode_barang){
		
		$obj = array('nama_barang' => $nama_barang, 'kode_barang'=> $kode_barang );
		$simpan = $this->db->insert('master_barang', $obj);

			if ($simpan) {
				$stok = array('id_gudang' => 1, 'kode_barang' => $kode_barang, 'stok' => 0 );
				$data = $this->db->insert('stok', $stok);

				return $data;
			}
		return $simpan;
	}

	public function mutasi($obj)
	{
		$data = $this->db->set('id_gudang', $obj['gudang'])->where('kode_barang', $obj['kode_barang'])->update('stok');

		return $data;
	}

}

/* End of file M_barang.php */
/* Location: ./application/models/M_barang.php */
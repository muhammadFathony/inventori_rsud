<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

	public function stok_in($obj){
		
		$qty = $obj['qty'];
		$simpan = $this->db->set('stok', "stok + $qty", FALSE)
					->where('kode_barang', $obj['kode_barang'])->where('id_gudang', $obj['gudang'])->update('stok');

		return $simpan;
	}	

	public function stok_out($obj){
		
		$qty = $obj['qty'];
		$simpan = $this->db->set('stok', "stok - $qty", FALSE)
					->where('kode_barang', $obj['kode_barang'])->where('id_gudang', $obj['gudang'])->update('stok');

		return $simpan;
	}	

}

/* End of file M_transaksi.php */
/* Location: ./application/models/M_transaksi.php */
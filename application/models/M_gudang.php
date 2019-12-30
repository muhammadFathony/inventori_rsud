<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_gudang extends CI_Model {

	public function get_all(){
		
		$data = $this->db->get('gudang')->result();

		return $data;		
	}	

	public function add_gudang($nama_gudang, $nama_upload)
	{
		$obj = array('nama_gudang' => $nama_gudang,
					 'gambar' => $nama_upload
		 );

		$data = $this->db->insert('gudang', $obj);

		return $data;
	}

}

/* End of file M_gudang.php */
/* Location: ./application/models/M_gudang.php */
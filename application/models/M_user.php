<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function get_all(){
		
		$data = $this->db->get('user')->result();

		return $data;		
	}	

	public function check_user($obj){

		$data = $this->db->where('nama', $obj['username'])->get('user')->row();

		return $data;
	}

	public function register($obj){
		
		$object = array('nama' => $obj['username'],
					  'password' => password_hash($obj['password'], PASSWORD_DEFAULT),
					  'level' => $obj['level']
					);
		
		$simpan = $this->db->insert('user', $object);

		return $simpan;
	}

}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */
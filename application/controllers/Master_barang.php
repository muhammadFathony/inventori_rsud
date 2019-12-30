<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_barang');
	}

	public function index(){
		

	}

	public function api_barang()
	{
		$response = array("error" => TRUE , "message" => "Daftar Barang");
		$data = $this->M_barang->get_all();
		if (count($data) > 0) {
			$response["error"] = FALSE;
			$response["message"] = "Sukses";
			$response["dataproduk"] = $data;
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}else{
			$response["error"] = TRUE;
			$response["message"] = "Daftar Kosong";
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}

	public function new_produk()
	{
		$nama_barang = $this->input->post('nama_barang');
		$data = $this->M_barang->new_produk($nama_barang);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}

/* End of file Master_barang.php */
/* Location: ./application/controllers/Master_barang.php */
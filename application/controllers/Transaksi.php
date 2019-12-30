<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_transaksi');
	}

	public function index(){
		
	}

	public function api_stok_in(){
		$response = array("error" => TRUE, "message" => "stok_in");
		$obj = array('id_barang' => $this->input->post('id_barang'),
					 'qty' => $this->input->post('qty'),
					 'gudang' => $this->input->post('gudang')
		);
		$stok_in = $this->M_transaksi->stok_in($obj);
		if ($stok_in === TRUE) {
			$response["error"] = FALSE;
			$response["message"] = "Sukses";
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}else{
			$response["error"] = TRUE;
			$response["message"] = "Ada yang salah";
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */
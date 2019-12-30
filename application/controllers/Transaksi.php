<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_transaksi');
		$this->load->model('M_barang');
	}

	public function index(){
		
	}

	public function api_stok_in(){
		$response = array("error" => TRUE, "message" => "stok_in");
		$obj = array('kode_barang' => $this->input->post('kode_barang'),
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

	public function api_stok_out(){
		$response = array("error" => TRUE, "message" => "stok_out");
		$obj = array('kode_barang' => $this->input->post('kode_barang'),
					 'qty' => $this->input->post('qty'),
					 'gudang' => $this->input->post('gudang')
		);
		$stok_out = $this->M_transaksi->stok_out($obj);
		if ($stok_out === TRUE) {
			$response["error"] = FALSE;
			$response["message"] = "Sukses";
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}else{
			$response["error"] = TRUE;
			$response["message"] = "Ada yang salah";
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}

	public function mutasi()
	{
		$response = array("error" => TRUE, "message" => "mutasi");

		$obj = array('kode_barang' => $this->input->post('kode_barang'), 
					 'gudang' => $this->input->post('gudang')
		);

		$mutasi = $this->M_barang->mutasi($obj);
		if ($mutasi == TRUE) {
			$response["error"] = FALSE;
			$response["message"] = "Sukses";
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		} else {
			$response["error"] = TRUE;
			$response["message"] = "Mutasi gagal";
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */
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
		$response = array("error" => TRUE , "message" => "Tambah Barang");
		$nama_barang = $this->input->post('nama_barang');
		$kode_barang = $this->input->post('kode_barang');
		$this->load->library('qrcode/Ciqrcode'); //pemanggilan library QR CODE
 
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$kode_barang.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $kode_barang; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
		$data = $this->M_barang->new_produk($nama_barang, $kode_barang);
		if ($data) {
			$response["error"] = FALSE;
			$response["message"] = "Sukses";
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		} else {
			$response["error"] = TRUE;
			$response["message"] = "Tambah data gagal";
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
		//$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}

/* End of file Master_barang.php */
/* Location: ./application/controllers/Master_barang.php */
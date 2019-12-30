<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_gudang');
	}

	public function index(){
		
	}

	public function api_gudang()
	{
		$response = array("error" => TRUE, "message" => "Gudang");
		$data = $this->M_gudang->get_all();
		if (count($data) > 0) {
			$response["error"] = FALSE;
			$response["message"] = "Sukses";
			$response["datagudang"] = $data;
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}else{
			$response["error"] = TRUE;
			$response["message"] = "Gudang kosong";
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}

	public function add_gudang()
	{
		$nama_gudang = $this->input->post('nama_gudang');

		$nmfile 					= $nama_gudang . "_" .time();
		$config['file_name'] 		= $nmfile; 
		$config['upload_path'] = "./assets/images";
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		//$config['encrypt_name']	= TRUE;
		$config['max_size'] = 10000;
		$this->load->library('upload', $config);

		if ($this->upload->do_upload("file") !="") {
			$this->upload->do_upload("file");
			$data = $this->upload->data();
			$nama_upload = $data['file_name'];

			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/images/'.$data['file_name'];
			$config['width'] = 600;
			$config['height'] = 400;
			$config['quality'] = '50%';
			$config['new_image'] = './assets/thumb/'.$data['file_name'];

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$simpan = $this->M_gudang->add_gudang($nama_gudang, $nama_upload);
			$this->output->set_content_type('application/json')->set_output(json_encode($simpan));
		}else {

		}
	}

}

/* End of file Gudang.php */
/* Location: ./application/controllers/Gudang.php */
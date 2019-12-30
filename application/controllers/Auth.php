<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
	}

	public function index()
	{
		$data = $this->M_user->get_all();

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function api_user()
	{
		$response = array("error" => TRUE, "message" => "Silahkan login");
		$obj = array("username" => $this->input->post('username'), 
					 "password" => $this->input->post('password')
					);
		$verify = $this->M_user->check_user($obj);
		if ($verify) {
			$hash_password = $verify->password;
			$hash = password_verify($obj['password'], $hash_password);
			if ($hash) {
				$response["error"] = FALSE;
				$response["message"] = "Berhasil login";
				$response["data"] = $verify;
				$this->output->set_content_type('application/json')->set_output(json_encode($response));
			}else{
				$response["error"] = TRUE;
				$response["message"] = "Password Salah";
				$this->output->set_content_type('application/json')->set_output(json_encode($response));
			}
		} else{
			$response["error"] = TRUE;
			$response["message"] = "User tidak ditemukan";
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}

	public function register(){
		$obj = array("username" => $this->input->post('username'),
					 "password" => $this->input->post('password'),
					 "level" => 1
		);
		$simpan = $this->M_user->register($obj);
		$this->output->set_content_type('application/json')->set_output(json_encode($simpan));
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
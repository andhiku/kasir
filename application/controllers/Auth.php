<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}

	public function login()
	{
		if ($this->session->userdata('status') !== 'login' ) {
			if ($this->input->post('username')) {
				$username = $this->input->post('username');
				if ($this->auth_model->getUser($username)->num_rows() > 0) {
					$data = $this->auth_model->getUser($username)->row();
					$toko = $this->auth_model->getToko();
					if (password_verify($this->input->post('password'), $data->password)) {
						$userdata = array(
							'id' => $data->id,
							'username' => $data->username,
							'password' => $data->password,
							'nama' => $data->nama,
							'role' => $data->role == '1' ? 'admin' : 'kasir',
							'status' => 'login',
							'toko' => $toko
						);
						$this->session->set_userdata($userdata);
						echo json_encode('sukses');
					} else {
						echo json_encode('passwordsalah');
					}
				} else {
					echo json_encode('tidakada');
				}
			} else {
				$this->load->view('login');
			}
		} else {
			redirect('/');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
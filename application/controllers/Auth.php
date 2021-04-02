<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('login') AND $this->uri->segment(2) <> 'logout') {
			if (user() == false) exit(redirect(base_url('auth/logout')));
		}
	}
	public function index() {
		if ($this->session->userdata('login')) {
			$data_query_lelang = [
				'select' => 'tb_lelang.*, tb_barang.*', 
				'join' => [
					[
						'table' => 'tb_barang',
						'on' => 'tb_barang.id_barang = tb_lelang.id_barang',
						'param' => 'LEFT'
					]
				],
				'where' => [[
					'tb_lelang.status' => 'dibuka'
				]],
				'order_by' => 'tb_lelang.id_lelang DESC',
				'limit' => '10',
			];
			$data = [
				'widget_history_lelang' => $this->history_lelang_model->get_rows(['select' => 'COUNT(id_history) AS total', 'where' => [['id_user' => user()]]]), 
				'widget_lelang' => $this->lelang_model->get_rows(['select' => 'COUNT(id_lelang) AS total']),
				'widget_barang' => $this->barang_model->get_rows(['select' => 'COUNT(id_barang) AS total']),
				'barang' => $this->lelang_model->get_rows($data_query_lelang)
			];
			$this->render('public/auth/index', $data);
		} else {
			$data_query_lelang = [
				'select' => 'tb_lelang.*, tb_barang.*', 
				'join' => [
					[
						'table' => 'tb_barang',
						'on' => 'tb_barang.id_barang = tb_lelang.id_barang',
						'param' => 'LEFT'
					]
				],
				'where' => [[
					'tb_lelang.status' => 'dibuka'
				]],
				'order_by' => 'tb_lelang.id_lelang DESC',
				'limit' => '10',
			];
			$data = [
				'widget_history_lelang' => $this->history_lelang_model->get_rows(['select' => 'COUNT(id_history) AS total']), 
				'widget_lelang' => $this->lelang_model->get_rows(['select' => 'COUNT(id_lelang) AS total']),
				'widget_barang' => $this->barang_model->get_rows(['select' => 'COUNT(id_barang) AS total']),
				'barang' => $this->lelang_model->get_rows($data_query_lelang)
			];
			$this->render('public/home', $data);
		}
	}
	
	public function login() {
		// filter input = 1
		if ($this->session->userdata('login')) exit(redirect(base_url()));
		if ($this->input->post()) {
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == true) {
				$data_input = [
					'username' => $this->db->escape_str($this->input->post('username')),
					'password' => $this->input->post('password')
				];
				$user = $this->masyarakat_model->get_row(['username' => $data_input['username']]);
				if ($user == false) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username atau Password salah.'));
				} elseif (password_verify($data_input['password'], $user['password']) == false) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username atau Password salah.'));
				} elseif ($user['status'] == '0') {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Akun dinonaktifkan.'));
				} else {
					$this->session->set_userdata('login', $user['id_user']);
					$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil masuk!', 'msg' => 'Halo '.$user['nama_lengkap'].',  Selamat datang di '.config('title').' !'));
					exit(redirect(base_url('auth/login')));
				}
				exit(redirect(base_url('auth/login')));
			} else {
				$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<br />'.validation_errors()));
			}
		}
		$this->render_auth('public/auth/login');
	}
	public function register() {
		// filter input = 1
		// exit(redirect(base_url('page/site/1')));
		if ($this->session->userdata('login')) exit(redirect(base_url()));
		if ($this->input->post()) {
			$this->form_validation->set_rules('telp', 'Nomor Telepon', 'required|numeric');
			$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|alpha_numeric_spaces|min_length[1]|max_length[100]');
			$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
			$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
			$this->form_validation->set_rules('terms', 'Ketentuan Layanan', 'required');
			if ($this->form_validation->run() == true) {
				$data_input = [
					'nama_lengkap' => $this->db->escape_str($this->input->post('nama_lengkap')),
					'username' => $this->db->escape_str($this->input->post('username')),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'telp' => $this->db->escape_str($this->input->post('telp')),
					'status' => '1',
					'created_at' => date('Y-m-d')
				];
				if ($this->masyarakat_model->get_row(['username' => $data_input['username']]) == true) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username sudah terdaftar.'));
				} elseif ($this->masyarakat_model->get_row(['telp' => $data_input['telp']]) == true) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Nomor telepon sudah terdaftar.'));
				} else {
					$insert_user = $this->masyarakat_model->insert($data_input);
					if ($insert_user) {
						$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Registrasi berhasil!', 'msg' => 'Silakan masuk ke akun Anda.'));
						exit(redirect(base_url('auth/login')));
					} else {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
					}
				}
				exit(redirect(base_url('auth/register')));
			} else {
				$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<br />'.validation_errors()));
			}
		}
		$this->render_auth('public/auth/register');
	}
	public function logout() {
		if ($this->session->userdata('login') == false) exit(redirect(base_url()));
		$this->session->unset_userdata('login');
		$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil keluar!', 'msg' => 'Sampai jumpa lagi...'));
		redirect(base_url('auth/login'));
	}
}

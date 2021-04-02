<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	public function __construct() {
		parent::__construct();
		if (user() == false) exit(redirect(base_url('auth/logout')));
	}
	public function setting() {
		// filter input = 1
		if ($this->input->post()) {
			$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|alpha_numeric_spaces|min_length[1]|max_length[100]');
			$this->form_validation->set_rules('new_password', 'Password Baru', 'min_length[5]');
			$this->form_validation->set_rules('confirm_new_password', 'Konfirmasi Password Baru', 'matches[new_password]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == true) {
				$data_input = [
					'nama_lengkap' => $this->db->escape_str($this->input->post('nama_lengkap'))
				];
				if ($this->input->post('new_password') <> '') $data_input['password'] = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);
				if (password_verify($this->input->post('password'), user('password')) == false) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Password salah.'));
				} else {
					$update_user = $this->masyarakat_model->update($data_input, ['id_user' => user()]);
					if ($update_user) {
						$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Perubahan akun berhasil!', 'msg' => 'Informasi akun Anda berhasil diperbaharui.'));
						exit(redirect(base_url('user/setting')));
					} else {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
					}
				}
			} else {
				$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<br />'.validation_errors()));
			}
		}
		$this->render('public/user/setting');
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {
	public function index() {
		if (petugas()) {
			$data = [
				'widget_history_lelang' => $this->history_lelang_model->get_rows(['select' => 'COUNT(id_history) AS total', 'where' => [['id_user' => user()]]]), 
				'widget_lelang' => $this->lelang_model->get_rows(['select' => 'COUNT(id_lelang) AS total']),
				'widget_barang' => $this->barang_model->get_rows(['select' => 'COUNT(id_barang) AS total']),
				'widget_pengguna' => $this->masyarakat_model->get_rows(['select' => 'COUNT(id_user) AS total'])
			];
			$this->render_admin('petugas/auth/index', $data);
		} else {
			if ($this->input->post()) {
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				if ($this->form_validation->run() == true) {
					$data_input = [
						'username' => $this->db->escape_str($this->input->post('username')),
						'password' => $this->input->post('password')
					];
					$petugas = $this->petugas_model->get_row(['username' => $data_input['username']]);
					if ($petugas == false) {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username atau Password salah.'));
					} elseif (password_verify($data_input['password'], $petugas['password']) == false) {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username atau Password salah.'));
					} else {
						$this->session->set_userdata('petugas', $petugas['id_petugas']);
						$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil masuk!', 'msg' => 'Halo '.$admin->username.', semoga harimu menyenangkan!'));
						exit(redirect(base_url('petugas')));
					}
				} else {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<br />'.validation_errors()));
				}
			}
			$this->render_admin('petugas/auth/login');
		}
	}
	public function setting() {
		if (petugas() == false) exit(redirect(base_url()));
		if ($this->input->post()) {
			$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|alpha_numeric_spaces|min_length[1]|max_length[100]');
			$this->form_validation->set_rules('new_password', 'Password Baru', 'min_length[5]');
			$this->form_validation->set_rules('confirm_new_password', 'Konfirmasi Password Baru', 'matches[new_password]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == true) {
				$data_input = [
					'full_name' => $this->db->escape_str($this->input->post('full_name'))
				];
				if ($this->input->post('new_password') <> '') $data_input['password'] = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);
				if (password_verify($this->input->post('password'), petugas('password')) == false) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Password salah.'));
				} else {
					$update_admin = $this->admin_model->update($data_input, ['id' => petugas()]);
					if ($update_admin) {
						$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Perubahan akun berhasil!', 'msg' => 'Informasi akun Anda berhasil diperbaharui.'));
						exit(redirect(base_url('petugas/auth/setting')));
					} else {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
					}
				}
			} else {
				$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<br />'.validation_errors()));
			}
		}
		$this->render_admin('petugas/auth/setting');
	}
	public function logout() {
		if (petugas() == false) exit(redirect(base_url('petugas')));
		$this->session->unset_userdata('petugas');
		$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil keluar!', 'msg' => 'Sampai jumpa lagi...'));
		redirect(base_url('petugas'));
	}
}

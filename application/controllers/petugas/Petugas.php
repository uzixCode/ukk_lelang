<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if (petugas() == false) exit(redirect(base_url('petugas/auth/logout')));
		if (petugas('level') <> 'administrator') {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Akses Tidak Sah!', 'msg' => 'Anda tidak memiliki akses ke halaman tersebut.'));
			exit(redirect(base_url('petugas')));
		}
	}
	public function index() {
		// FORM INPUT //
		$field = [
			'tb_petugas.id_petugas' => 'ID',
			'tb_petugas.username' => 'USERNAME',
			'tb_petugas.nama_petugas' => 'NAMA PETUGAS',
			'tb_level.level' => 'HAK AKSES',
		];
		$operator = [
			'equal' => 'WHERE =',
			'not_equal' => 'WHERE <>',
			'less_than' => 'WHERE <=',
			'more_than' => 'WHERE >=',
			'like' => 'LIKE %value%'
		];
		// END FORM INPUT //
		// SETTINGS //
		$data_query = [
			'select' => 'tb_petugas.*, tb_level.level',
			'join' => [
				[
					'table' => 'tb_level',
					'on' => 'tb_petugas.id_petugas = tb_level.id_level',
					'param' => 'LEFT'
				],
			],
			'order_by' => 'tb_petugas.id_petugas DESC',
			'limit' => '30',
			'offset' => ($this->uri->segment(4)) ? $this->uri->segment(4) : 0
		];
		// END SETTINGS //
		// SORT & SEARCH
		if ($this->input->get('sort_field') <> '' AND $this->input->get('sort_type') <> '') {
			if (array_key_exists($this->input->get('sort_field'), $field) == false) {
				exit(redirect(base_url('petugas/'.$this->uri->segment(2).'/index')));
			}
			if (in_array($this->input->get('sort_type'), array('asc', 'desc')) == false) {
				exit(redirect(base_url('petugas/'.$this->uri->segment(2).'/index')));
			}
			$data_query['order_by'] = $this->input->get('sort_field').' '.$this->input->get('sort_type');
		}
		if ($this->input->get('field') <> '' AND $this->input->get('operator') <> '' AND $this->input->get('value') <> '') {
			if (array_key_exists($this->input->get('field'), $field) == false) {
				exit(redirect(base_url('petugas/'.$this->uri->segment(2).'/index')));
			}
			if (array_key_exists($this->input->get('operator'), $operator) == false) {
				exit(redirect(base_url('petugas/'.$this->uri->segment(2).'/index')));
			}
			if ($this->input->get('operator') == 'equal') {
				$data_query['where'][] = [$this->input->get('field') => $this->input->get('value')];
			} elseif ($this->input->get('operator') == 'not_equal') {
				$data_query['where'][] = [$this->input->get('field').' <>' => $this->input->get('value')];
			} elseif ($this->input->get('operator') == 'less_than') {
				$data_query['where'][] = [$this->input->get('field').' <=' => $this->input->get('value')];
			} elseif ($this->input->get('operator') == 'more_than') {
				$data_query['where'][] = [$this->input->get('field').' >=' => $this->input->get('value')];
			} else {
				$data_query['where'][] = $this->input->get('field')." LIKE '%".$this->input->get('value')."%'";
			}
		}
		// END SORT & SEARCH
		// PAGINATION //
		if ($this->uri->segment(4) <> '' AND is_numeric($this->uri->segment(4)) == false) exit('No direct script access allowed');
		$config['base_url'] = base_url('petugas/'.$this->uri->segment(2).'/index');
		$config['total_rows'] = $this->petugas_model->get_count($data_query);
		$config['per_page'] = $data_query['limit'];
		$this->pagination->initialize($config);
		// END PAGINATION //
		$this->render_admin('petugas/'.$this->uri->segment(2).'/index', ['table' => $this->petugas_model->get_rows($data_query), 'total_data' => $config['total_rows'], 'field' => $field, 'operator' => $operator]);
	}
	public function form($i = '') {
		$target = $this->petugas_model->get_by_id($i);
		if ($target == false) { // ADD
			if ($this->input->post()) {
				// FORM VALIDASI
				$this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required|alpha_numeric_spaces|min_length[1]|max_length[100]');
				$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[12]');
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
				$this->form_validation->set_rules('level', 'Hak Akses', 'required');
				// END FORM VALIDASI
				if ($this->form_validation->run() == true) {
					// MENGAMBIL DATA INPUT
					$data_input = [
						'id_level' => $this->db->escape_str($this->input->post('level')),
						'nama_petugas' => $this->db->escape_str($this->input->post('nama_petugas')),
						'username' => $this->db->escape_str($this->input->post('username')),
						'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
						'created_at' => date('Y-m-d')
					];
					// MENGAMBIL DATA INPUT
					if ($this->petugas_model->get_row(['username' => $data_input['username']])) {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username sudah ada didatabase.'));
					} else if ($this->level_model->get_by_id($data_input['id_level']) == false) {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Level tidak tersedia.'));
					} else {
						$insert_data = $this->petugas_model->insert($data_input);
						if ($insert_data) {
							$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Tambah data berhasil!', 'msg' => 'Data <b>#'.$insert_data.'</b> berhasil ditambahkan.'));
							exit(redirect(base_url('petugas/'.$this->uri->segment(2))));
						} else {
							$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
						}
					}
				} else {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<br />'.validation_errors()));
				}
			}
			$this->render_admin('petugas/'.$this->uri->segment(2).'/add', ['level' => $this->level_model->get_rows()]);
		} else { // EDIT
			if ($this->input->post()) {
				$this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required|alpha_numeric_spaces|min_length[1]|max_length[100]');
				$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[12]');
				$this->form_validation->set_rules('password', 'Password', 'min_length[5]');
				$this->form_validation->set_rules('level', 'Hak Akses', 'required');
				// END FORM VALIDASI
				if ($this->form_validation->run() == true) {
					// MENGAMBIL DATA INPUT
					$data_input = [
						'id_level' => $this->db->escape_str($this->input->post('level')),
						'nama_petugas' => $this->db->escape_str($this->input->post('nama_petugas')),
						'username' => $this->db->escape_str($this->input->post('username')),
						'updated_at' => date('Y-m-d')
					];
					// CEK APAKAH GANTI PASSSWORD ATAU TIDAK
					if ($this->input->post('password') <> '') $data_input['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
					if ($data_input['username'] <> $target['username'] AND $this->petugas_model->get_row(['username' => $data_input['username']])) {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username sudah ada didatabase.'));
					} else if ($this->level_model->get_by_id($data_input['id_level']) == false) {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Level tidak tersedia.'));
					} else {
						$update_target = $this->petugas_model->update($data_input, ['id_level' => $i]);
						if ($update_target) {
							$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Perubahan data berhasil!', 'msg' => 'Data <b>#'.$i.'</b> berhasil diperbaharui.'));
							exit(redirect(base_url('petugas/'.$this->uri->segment(2))));
						} else {
							$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
						}
					}
				} else {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<br />'.validation_errors()));
				}
			}
			$this->render_admin('petugas/'.$this->uri->segment(2).'/edit', ['target' => $target, 'level' => $this->level_model->get_rows()]);
		}
	}
	public function delete($i = '') {
		$target = $this->petugas_model->get_by_id($i);
		if ($target == false) show_404();
		$delete_target = $this->petugas_model->delete(['id_petugas' => $i]);
		if ($delete_target) {
			$this->lelang_model->delete(['id_petugas' => $i]);
			$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Hapus data berhasil!', 'msg' => 'Data <b>#'.$i.'</b> berhasil dihapus.'));
		} else {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
		}
		redirect(base_url('petugas/'.$this->uri->segment(2)));
	}
}
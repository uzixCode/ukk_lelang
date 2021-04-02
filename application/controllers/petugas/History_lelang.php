<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_lelang extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if (petugas() == false) exit(redirect(base_url('petugas/auth/logout')));
	}
	public function index() {
		// FORM INPUT //
		$field = [
			'history_lelang.id_history' => 'ID HISTORY',
			'tb_masyarakat.nama_lengkap' => 'NAMA PENAWAR',
			'tb_barang.nama_barang' => 'NAMA BARANG',
			'tb_barang.harga_barang' => 'HARGA AWAL',
			'history_lelang.harga_penawaran' => 'HARGA PENAWARAN',
			'tb_lelang.tgl_lelang' => 'TANGGAL LELANG',
			'history_lelang.tgl_penawaran' => 'TANGGAL PENAWARAN',
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
			'select' => 'tb_lelang.tgl_lelang, tb_lelang.status, tb_barang.*, tb_masyarakat.nama_lengkap, history_lelang.*',
			'join' => [
				[
					'table' => 'tb_lelang',
					'on' => 'tb_lelang.id_lelang = history_lelang.id_lelang',
					'param' => 'LEFT'
				],
				[
					'table' => 'tb_barang',
					'on' => 'tb_barang.id_barang = history_lelang.id_barang',
					'param' => 'LEFT'
				],
				[
					'table' => 'tb_masyarakat',
					'on' => 'tb_masyarakat.id_user = history_lelang.id_user',
					'param' => 'LEFT'
				]
			],
			'order_by' => 'history_lelang.id_history',
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
		// SESSION FILTER //
		if ($this->session->userdata('filter_lelang_user') <> '') {
			$data_query['where'][]['history_lelang.id_user'] = $this->session->userdata('filter_lelang_user');
		}
		if ($this->session->userdata('filter_lelang_barang') <> '') {
			$data_query['where'][]['history_lelang.id_barang'] = $this->session->userdata('filter_lelang_barang');
		}
		// END SESSION FILTER //
		// PAGINATION //
		if ($this->uri->segment(4) <> '' AND is_numeric($this->uri->segment(4)) == false) exit('No direct script access allowed');
		$config['base_url'] = base_url('petugas/'.$this->uri->segment(2).'/index');
		$config['total_rows'] = $this->history_lelang_model->get_count($data_query);
		$config['per_page'] = $data_query['limit'];
		$this->pagination->initialize($config);
		// END PAGINATION //
		$this->render_admin('petugas/'.$this->uri->segment(2).'/index', ['table' => $this->history_lelang_model->get_rows($data_query), 'total_data' => $config['total_rows'], 'field' => $field, 'operator' => $operator,  'user' => $this->masyarakat_model->get_rows(),
			'barang' => $this->barang_model->get_rows()]);
	}
	public function form($i = '') {
		$target = $this->history_lelang_model->get_by_id($i);
		$user = $this->masyarakat_model->get_row(['id_user' => $target['id_user']]);
		$barang = $this->barang_model->get_row(['id_barang' => $target['id_barang']]);
		if ($target == false) { // ADD
			exit('Target not found');
		} else { // EDIT
			if ($this->input->post()) {
				$this->form_validation->set_rules('pengguna', 'Nama Penawar', 'required|numeric');
				$this->form_validation->set_rules('penawaran_harga', 'Penawaran Harga', 'required|numeric');
				// END FORM VALIDASI
				if ($this->form_validation->run() == true) {
					// MENGAMBIL DATA INPUT
					$data_input = [
						'id_user' => $this->db->escape_str($this->input->post('pengguna')),
						'id_petugas' => petugas(),
						'harga_akhir' => $this->db->escape_str($this->input->post('penawaran_harga')),
						'updated_at' => date('Y-m-d')
					];
					if ($user == false) {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Pengguna tidak di temukan.'));
					} else {
						$update_target = $this->lelang_model->update($data_input, ['id_lelang' => $target['id_lelang']]);
						if ($update_target) {
							$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Perubahan data berhasil!', 'msg' => '<br />Nama Pengguna : ' . $user['nama_lengkap'] . '<br />Nama Barang : ' . $barang['nama_lengkap'] . ' <br />Harga Akhir Barang : ' . $target['penawaran_harga'] . ''));
						} else {
							$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
						}
						exit(redirect(base_url('petugas/'.$this->uri->segment(2))));
					}
				} else {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<br />'.validation_errors()));
				}
			}
			$this->load->view('petugas/'.$this->uri->segment(2).'/edit', ['target' => $target, 'user' => $user, 'barang' => $barang]);
		}
	}
	public function delete($i = '') {
		$target = $this->history_lelang_model->get_by_id($i);
		if ($target == false) show_404();
		$delete_target = $this->history_lelang_model->delete(['id_history' => $i]);
		if ($delete_target) {
			$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Hapus data berhasil!', 'msg' => 'Data <b>#'.$i.'</b> berhasil dihapus.'));
		} else {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
		}
		redirect(base_url('petugas/'.$this->uri->segment(2)));
	}
	public function detail($i = '') {
		$target = $this->lelang_model->get_by_id($i);
		if ($target == false) show_404();
		$this->load->view('petugas/'.$this->uri->segment(2).'/detail', ['target' => $target, 'user' => $this->masyarakat_model->get_by_id($target['id_user']), 'petugas' => $this->petugas_model->get_by_id($target['id_petugas']), 'barang' => $this->barang_model->get_by_id($target['id_barang'])]);
	}
	public function status($i = '', $status = '') {
		$target = $this->lelang_model->get_by_id($i);
		if ($target == false) show_404();
		if (in_array($status, ['dibuka','ditutup']) == false) show_404();
		$update_target = $this->lelang_model->update(['status' => $status], ['id_lelang' => $i]);
		if ($update_target) {
			$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Perubahan status berhasil!', 'msg' => 'Data <b>#'.$i.'</b> berhasil diubah.'));
		} else {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
		}
		redirect(base_url('petugas/'.$this->uri->segment(2)));
	}
	public function filter() {
		$user = $this->masyarakat_model->get_by_id($this->input->post('user'));
		if ($user) {
			$this->session->set_userdata('filter_lelang_user', $this->input->post('user'));
		} else {
			$this->session->unset_userdata('filter_lelang_user');
		}
		$barang = $this->barang_model->get_by_id($this->input->post('barang'));
		if ($barang) {
			$this->session->set_userdata('filter_lelang_barang', $this->input->post('barang'));
		} else {
			$this->session->unset_userdata('filter_lelang_barang');
		}
		redirect(base_url('petugas/'.$this->uri->segment(2)));
	}
}
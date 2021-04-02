<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Lelang extends MY_Controller {
	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('login') AND $this->uri->segment(2) <> 'barang') {
			if (user() == false) exit(redirect(base_url('auth/logout')));
		}
	}
	public function index(){
		// FORM INPUT //
		$field = [
			'tb_lelang.id_lelang' => 'ID LELANG',
			'tb_barang.nama_barang' => 'NAMA BARANG',
			'tb_barang.harga_barang' => 'HARGA AWAL',
			'tb_lelang.harga_akhir' => 'HARGA AKHIR',
			'tb_lelang.status' => 'STATUS LELANG',
			'tb_lelang.tgl_lelang' => 'TANGGAL LELANG',
		];
		// END FORM INPUT //
		// SETTINGS //
		$data_query = [
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
			'limit' => '30',
			'offset' => ($this->uri->segment(4)) ? $this->uri->segment(4) : 0
		];
		// END SETTINGS //
		// SORT & SEARCH
		if ($this->input->get('sort_field') <> '' AND $this->input->get('sort_type') <> '') {
			if (array_key_exists($this->input->get('sort_field'), $field) == false) {
				exit(redirect(base_url('lelang/index')));
			}
			if (in_array($this->input->get('sort_type'), array('asc', 'desc')) == false) {
				exit(redirect(base_url('lelang/index')));
			}
			$data_query['order_by'] = $this->input->get('sort_field').' '.$this->input->get('sort_type');
		}
		if ($this->input->get('field') <> '' AND $this->input->get('value') <> '') {
			if (array_key_exists($this->input->get('field'), $field) == false) {
				exit(redirect(base_url('lelang/index')));
			}
			$data_query['where'][] = $this->input->get('field')." LIKE '%".$this->db->escape_str($this->input->get('value'))."%'";
		}
		// END SORT & SEARCH
		// PAGINATION //
		if ($this->uri->segment(3) <> '' AND is_numeric($this->uri->segment(3)) == false) exit('No direct script access allowed');
		$config['base_url'] = base_url('lelang/index');
		$config['total_rows'] = $this->lelang_model->get_count($data_query);
		$config['per_page'] = $data_query['limit'];
		$this->pagination->initialize($config);
		// END PAGINATION //
		$this->render('public/lelang/index', ['barang' => $this->lelang_model->get_rows($data_query), 'total_data' => $config['total_rows'], 'field' => $field]);
	}
	public function barang($slug = false){
		// CEK $slug APAKAH BARANG TERSEDIA ATAU TIDAK
		$target = $this->barang_model->get_row(['slug_barang' => $this->db->escape_str($slug)]);

		$lelang = $this->lelang_model->get_row(['id_barang' => $target['id_barang']]);
		// CEK STATUS LELANG
		if ($lelang['status'] == 'ditutup') {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Harga kurang dari harga lelang!'));
			exit(redirect(base_url('lelang/index')));
		}
		if ($target == true) {
			// PROSES CEK APAKAH PENGGUNA SUDAH MELAKUKAN PENAWARAN ATAU BELUM
			$penawaran = $this->history_lelang_model->get_row(['id_user' => user(), 'id_barang' => $target['id_barang']]); // TRUE OR FALSE
			// QUERY HISTORY LELANG
			$history_lelang = $this->history_lelang_model->get_rows([
				'select' => 'tb_barang.*, tb_lelang.*, tb_masyarakat.nama_lengkap, history_lelang.penawaran_harga',
				'join' => [
					[
						'table' => 'tb_masyarakat', 
						'on' => 'tb_masyarakat.id_user = history_lelang.id_user', 
						'param' => 'LEFT'
					],
					[
						'table' => 'tb_barang', 
						'on' => 'tb_barang.id_barang = history_lelang.id_barang', 
						'param' => 'LEFT'
					],
					[
						'table' => 'tb_lelang', 
						'on' => 'tb_lelang.id_lelang = history_lelang.id_lelang', 
						'param' => 'LEFT'
					],

				],
				'where' => [
					[
						'tb_masyarakat.status' => '1', 
						'tb_lelang.id_lelang' => $lelang['id_lelang'], 
						'tb_barang.id_barang' => $target['id_barang']
					]
				],
				'order_by' => ' history_lelang.penawaran_harga DESC',
				'limit' => '10',
			]);
			$this->render('public/lelang/barang', ['barang' => $target, 'penawaran' => $penawaran, 'history_lelang' => $history_lelang]);	
		} else {
			exit(redirect(base_url('lelang')));
		}
	}
	public function penawaran($id = false){
		$barang = $this->barang_model->get_row(['id_barang' => $this->db->escape_str($id)]);
		if ($barang == false) exit('Terjadi kesalahan akses 1.'); // CEK BARANG
		$lelang = $this->lelang_model->get_row(['id_barang' => $barang['id_barang']]);
		if ($lelang == false) exit('Terjadi kesalahan akses 2.'); // CEK LELANG
		if ($this->input->post()) {
			$this->form_validation->set_rules('harga_penawaran', 'Harga Penawaran', 'required|numeric');
			if ($this->form_validation->run() == true) {
				$data_input = [
					'id_lelang' => $lelang['id_lelang'], 
					'id_barang' => $barang['id_barang'],
					'id_user' => user(),
					'penawaran_harga' => $this->db->escape_str($this->input->post('harga_penawaran')),
					'tgl_penawaran' => date('Y-m-d'),
				];
				$history_lelang = $this->history_lelang_model->get_row(['id_lelang' => $data_input['id_lelang'], 'id_user' => $data_input['id_user']]);
				if ($data_input['penawaran_harga'] < $barang['harga_barang']) { // CEK PENAWARAN HARGA SUDAH SESUAI ATAU BELUM
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Harga kurang dari harga lelang!'));
					exit(redirect(base_url('lelang/barang/' . $barang['slug_barang'])));
				} else if ($history_lelang == true) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Anda sudah melakukan penawaran terhadap lelang barang yang sama lebih dari 1x !.'));
					exit(redirect(base_url('lelang/barang/' . $barang['slug_barang'])));
				} else {
					$insert_data = $this->history_lelang_model->insert($data_input);
					if ($insert_data) {
						$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Horeee !!  Anda berhasil mengajukan penawaran untuk <b>' . $barang['nama_barang'] . '</b>'));
					} else {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
					}
					exit(redirect(base_url('lelang/barang/' . $barang['slug_barang'])));
				}
			} else {
				$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<br />'.validation_errors()));
				exit(redirect(base_url('lelang/barang/' . $barang['slug_barang'])));
			}
		}
		$this->load->view('public/lelang/form');
	}
}
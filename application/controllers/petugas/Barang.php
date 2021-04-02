<?php
ini_set('memory_limit','7000M');
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if (petugas() == false) exit(redirect(base_url('petugas/auth/logout')));
	}
	public function index() {
		// FORM INPUT //
		$field = [
			'id_barang' => 'ID BARANG',
			'nama_barang' => 'NAMA BARANG',
			'deskripsi_barang' => 'DESKRIPSI BARANG',
			'tgl' => 'TANGGAL DIBUAT',
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
			'select' => '*',
			'order_by' => 'id_barang DESC',
			'limit' => '30',
			'offset' => ($this->uri->segment(4)) ? $this->uri->segment(4) : 0
		];
		// END SETTINGS //
		// SORT & SEARCH
		if ($this->input->get('sort_field') <> '' AND $this->input->get('sort_type') <> '') {
			if (array_key_exists($this->input->get('sort_field'), $field) == false) exit(redirect(base_url('petugas/'.$this->uri->segment(2).'/index')));
			if (in_array($this->input->get('sort_type'), array('asc', 'desc')) == false) exit(redirect(base_url('petugas/'.$this->uri->segment(2).'/index')));
			$data_query['order_by'] = $this->input->get('sort_field').' '.$this->input->get('sort_type');
		}
		if ($this->input->get('field') <> '' AND $this->input->get('operator') <> '' AND $this->input->get('value') <> '') {
			if (array_key_exists($this->input->get('field'), $field) == false) exit(redirect(base_url('petugas/'.$this->uri->segment(2).'/index')));
			if (array_key_exists($this->input->get('operator'), $operator) == false) exit(redirect(base_url('petugas/'.$this->uri->segment(2).'/index')));
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
		$config['total_rows'] = $this->barang_model->get_count($data_query);
		$config['per_page'] = $data_query['limit'];
		$this->pagination->initialize($config);
		// END PAGINATION //
		$this->render_admin('petugas/'.$this->uri->segment(2).'/index', ['table' => $this->barang_model->get_rows($data_query), 'total_data' => $config['total_rows'], 'field' => $field, 'operator' => $operator]);
	}
	public function form($i = '') {
		$target = $this->barang_model->get_by_id($i);
		if ($target == false) { // add
			if ($this->input->post()) {
				if (empty($_FILES['gambar_barang']['name'])){
				    $this->form_validation->set_rules('gambar_barang', 'Gambar Barang', 'required');
				}
				$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|min_length[5]|max_length[100]');
				$this->form_validation->set_rules('harga_barang', 'Harga Barang', 'required|numeric');
				$this->form_validation->set_rules('deskripsi_barang', 'Password', 'required');
				if ($this->form_validation->run() == true) {
					$data_input = [
						'slug_barang' => strtolower(url_title($this->input->post('nama_barang'))),
						'nama_barang' => $this->db->escape_str($this->input->post('nama_barang')),
						'harga_barang' => $this->db->escape_str($this->input->post('harga_barang')),
						'deskripsi_barang' => $this->db->escape_str($this->input->post('deskripsi_barang')),
						'tgl' => date('Y-m-d')
					];
					// LOAD CONFIG UPLOAD
					$config['upload_path']      = 'upload/';
                	$config['allowed_types']    = 'gif|jpg|png';
                	$config['max_size']         = 3124;
                	$config['max_width']        = 1280;
                	$config['max_height']       = 1280;
                	$config['encrypt_name']     = true; 
                	$this->load->library('upload', $config);
                	// END CONFIG UPLOAD
					$upload_image = false;
					if ($this->barang_model->get_row(['slug_barang' => $data_input['slug_barang']])) {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Nama barang sudah ada di database.'));
					} else {
						$upload_image = $this->upload->do_upload('gambar_barang');
						if ($upload_image) {
							$data_image = $this->upload->data();
	               			$data_input['gambar_barang'] = $data_image['file_name'];
	               			$insert_data = $this->barang_model->insert($data_input);
							if ($insert_data) {
								$data_input_lelang = [
									'id_barang' => $insert_data,
									'id_petugas' => petugas(),
									'status' => 'dibuka',
									'tgl_lelang' => date('Y-m-d')
								];
								$this->lelang_model->insert($data_input_lelang);
								$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Tambah data berhasil!', 'msg' => 'Data <b>#'.$insert_data.'</b> berhasil ditambahkan.'));
							} else {
								$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
							}
							exit(redirect(base_url('petugas/'.$this->uri->segment(2))));
						} else {
							$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal !', 'msg' => $this->upload->display_errors()));
						}
					}
				} else {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<br />'.validation_errors()));
				}
			}
			$this->render_admin('petugas/'.$this->uri->segment(2).'/add');
		} else { // edit
			if ($this->input->post()) {
				$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|min_length[5]|max_length[100]');
				$this->form_validation->set_rules('harga_barang', 'Harga Barang', 'required|numeric');
				$this->form_validation->set_rules('deskripsi_barang', 'Password', 'required');
				if ($this->form_validation->run() == true) {
					$data_input = [
						'slug_barang' => strtolower(url_title($this->input->post('nama_barang'))),
						'nama_barang' => $this->db->escape_str($this->input->post('nama_barang')),
						'harga_barang' => $this->db->escape_str($this->input->post('harga_barang')),
						'deskripsi_barang' => $this->db->escape_str($this->input->post('deskripsi_barang')),
						'updated_at' => date('Y-m-d')
					];
					if (isset($_FILES['gambar_barang']['name']) && !empty($_FILES['gambar_barang']['name'])) {
						$config['upload_path']      = 'uploads/album/';
                		$config['allowed_types']    = 'gif|jpg|png';
                		$config['max_size']         = 3124;
                		$config['max_width']        = 10000;
                		$config['max_height']       = 10000;
                		$config['encrypt_name']     = true; 
                		$this->load->library('upload', $config);
                		if (!$this->upload->do_upload('gambar_barang')) {
							$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' =>  $this->upload->display_errors()));
						} else {
							$data_image = $this->upload->data();
							$data_input['gambar_barang'] = $data_image['file_name'];
						}	
					}
					$update_target = $this->barang_model->update($data_input, ['id_barang' => $i]);
					if ($update_target) {
						$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Perubahan data berhasil!', 'msg' => 'Data <b>#'.$i.'</b> berhasil diperbaharui.'));
						exit(redirect(base_url('petugas/'.$this->uri->segment(2))));
					} else {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
					}
				} else {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<br />'.validation_errors()));
				}
			}
			$this->render_admin('petugas/'.$this->uri->segment(2).'/edit', ['target' => $target]);
		}
	}
	public function delete($i = '') {
		$target = $this->barang_model->get_by_id($i);
		if ($target == false) show_404();
		$delete_target = $this->barang_model->delete(['id_barang' => $i]);
		if ($delete_target) {
			$this->history_lelang_model->delete(['id_barang' => $i]);
			$this->lelang_model->delete(['id_barang' => $i]);
			$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Hapus data berhasil!', 'msg' => 'Data <b>#'.$i.'</b> berhasil dihapus.'));
		} else {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
		}
		redirect(base_url('petugas/'.$this->uri->segment(2)));
	}
	public function detail($i = '') {
		$target = $this->barang_model->get_by_id($i);
		if ($target == false) show_404();
		$this->load->view('petugas/'.$this->uri->segment(2).'/detail', ['target' => $target]);
	}
	public function status($i = '', $status = '') {
		$target = $this->masyarakat_model->get_by_id($i);
		if ($target == false) show_404();
		if (in_array($status, ['0','1']) == false) show_404();
		$update_target = $this->masyarakat_model->update(['status' => $status], ['id_user' => $i]);
		if ($update_target) {
			$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Perubahan status berhasil!', 'msg' => 'Data <b>#'.$i.'</b> berhasil diubah.'));
		} else {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
		}
		redirect(base_url('petugas/'.$this->uri->segment(2)));
	}
}
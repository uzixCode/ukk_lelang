<?php
ini_set('memory_limit','7000M');
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if (petugas() == false) exit(redirect(base_url('petugas/auth/logout')));
	}
	public function index() {
		// FORM INPUT //
		$field = [
			'id_user' => 'ID PENGGUNA',
			'nama_lengkap' => 'NAMA LENGKAP',
			'username' => 'USERNAME',
			'telp' => 'TELEPON',
			'status' => 'STATUS',
		];
		$operator = [
			'equal' => 'WHERE =',
			'not_equal' => 'WHERE <>',
			'less_than' => 'WHERE <=',
			'more_than' => 'WHERE >=',
			'like' => 'LIKE %value%'
		];
		$status = [
			'1' => ['name' => '<i class="fa fa-check fa-fw"></i>', 'color' => 'success'],
			'0' => ['name' => '<i class="fa fa-times fa-fw"></i>', 'color' => 'danger'],
		];
		// END FORM INPUT //
		// SETTINGS //
		$data_query = [
			'select' => '*',
			'order_by' => 'id_user DESC',
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
		$config['total_rows'] = $this->masyarakat_model->get_count($data_query);
		$config['per_page'] = $data_query['limit'];
		$this->pagination->initialize($config);
		// END PAGINATION //
		$this->render_admin('petugas/'.$this->uri->segment(2).'/index', ['table' => $this->masyarakat_model->get_rows($data_query), 'total_data' => $config['total_rows'], 'field' => $field, 'operator' => $operator, 'status' => $status]);
	}
	public function form($i = '') {
		$target = $this->masyarakat_model->get_by_id($i);
		if ($target == false) { // add
			if ($this->input->post()) {
				$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|alpha_numeric_spaces|min_length[1]|max_length[100]');
				$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[12]');
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
				$this->form_validation->set_rules('telp', 'Nomor Telepon', 'required|numeric|min_length[5]|max_length[15]');
				if ($this->form_validation->run() == true) {
					$data_input = [
						'nama_lengkap' => $this->db->escape_str($this->input->post('nama_lengkap')),
						'username' => $this->db->escape_str($this->input->post('username')),
						'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
						'telp' => $this->db->escape_str($this->input->post('telp')),
						'created_at' => date('Y-m-d')
					];
					if ($this->masyarakat_model->get_row(['username' => $data_input['username']])) {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username sudah ada didatabase.'));
					} else {
						$insert_data = $this->masyarakat_model->insert($data_input);
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
			$this->render_admin('petugas/'.$this->uri->segment(2).'/add');
		} else { // edit
			if ($this->input->post()) {
				$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|alpha_numeric_spaces|min_length[1]|max_length[100]');
				$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[12]');
				$this->form_validation->set_rules('password', 'Password', 'min_length[5]');
				$this->form_validation->set_rules('telp', 'Nomor Telepon', 'required|numeric|min_length[5]|max_length[15]');
				if ($this->form_validation->run() == true) {
					$data_input = [
						'nama_lengkap' => $this->db->escape_str($this->input->post('nama_lengkap')),
						'username' => $this->db->escape_str($this->input->post('username')),
						'telp' => $this->db->escape_str($this->input->post('telp')),
						'updated_at' => date('Y-m-d')
					];
					if ($this->input->post('password') <> '') $data_input['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
					if ($data_input['username'] <> $target['username'] AND $this->masyarakat_model->get_row(['username' => $data_input['username']])) {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username sudah ada didatabase.'));
					} else {
						$update_target = $this->masyarakat_model->update($data_input, ['id_user' => $i]);
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
			$this->render_admin('petugas/'.$this->uri->segment(2).'/edit', ['target' => $target]);
		}
	}
	public function delete($i = '') {
		$target = $this->masyarakat_model->get_by_id($i);
		if ($target == false) show_404();
		$delete_target = $this->masyarakat_model->delete(['id_user' => $i]);
		if ($delete_target) {
			$this->history_lelang_model->delete(['id_user' => $i]);
			$this->lelang_model->delete(['id_user' => $i]);
			$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Hapus data berhasil!', 'msg' => 'Data <b>#'.$i.'</b> berhasil dihapus.'));
		} else {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
		}
		redirect(base_url('petugas/'.$this->uri->segment(2)));
	}
	public function detail($i = '') {
		$target = $this->masyarakat_model->get_by_id($i);
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
	public function export() {
		if (petugas('level') <> 'administrator') {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Akses Tidak Sah!', 'msg' => 'Anda tidak memiliki akses ke halaman tersebut.'));
			exit(redirect(base_url('petugas')));
		}
		$data_query = [
			'select' => '*',
			'order_by' => 'id_user DESC'
		];
        $user = $this->masyarakat_model->get_rows($data_query);
        $tanggal = date('Y-m-d');
 
        $pdf = new \TCPDF();
        $pdf->AddPage('L', 'mm', 'A4');
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(277, 10, 'Laporan Pengguna - ' . $this->lib->format_date(date('Y-m-d')) , 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
 
        // Add Header
        $pdf->Ln(5);
        $pdf->SetFont('', '', 12);
        $pdf->Cell(10, 8, 'No', 1, 0, 'C');
        $pdf->Cell(55, 8, 'Nama Lengkap', 1, 0, 'C');
        $pdf->Cell(35, 8, 'Username', 1, 0, 'C');
        $pdf->Cell(35, 8, 'No Telepon', 1, 0, 'C');
        $pdf->Cell(35, 8, 'Status', 1, 0, 'C');
        $pdf->Cell(50, 8, 'Tanggal Daftar', 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        $no = 1;
        foreach($user as $key => $value) {
			$pdf->Cell(10, 8, $no++, 1, 0, 'C');
	        $pdf->Cell(55, 8, $value['nama_lengkap'], 1, 0, 'C');
	        $pdf->Cell(35, 8, $value['username'], 1, 0, 'C');
	        $pdf->Cell(35, 8, $value['telp'], 1, 0, 'C');
	        $pdf->Cell(35, 8, ($value['status'] == 1) ? 'Aktif' : 'Tidak Aktif', 1, 0, 'C');
	        $pdf->Cell(50, 8, $this->lib->format_date($value['created_at']), 1, 1, 'C');
        }
        $pdf->SetFont('', 'B', 10);
        $pdf->Cell(277, 10, 'Laporan Pengguna - ' . $this->lib->format_date(date('Y-m-d')), 0, 1, 'L');
        $pdf->Output('Laporan Pengguna - ' . $this->lib->format_date(date('Y-m-d')) . '.pdf'); 
    }
}
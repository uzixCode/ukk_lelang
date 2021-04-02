<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lelang extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if (petugas() == false) exit(redirect(base_url('petugas/auth/logout')));
	}
	public function index() {
		// FORM INPUT //
		$field = [
			'tb_lelang.id_lelang' => 'ID LELANG',
			'tb_petugas.nama_petugas' => 'NAMA PETUGAS',
			'tb_masyarakat.nama_lengkap' => 'NAMA PENAWAR',
			'tb_barang.nama_barang' => 'NAMA BARANG',
			'tb_barang.harga_barang' => 'HARGA AWAL',
			'tb_lelang.harga_akhir' => 'HARGA AKHIR',
			'tb_lelang.status' => 'STATUS LELANG',
			'tb_lelang.tgl_lelang' => 'TANGGAL LELANG',
		];
		$operator = [
			'equal' => 'WHERE =',
			'not_equal' => 'WHERE <>',
			'less_than' => 'WHERE <=',
			'more_than' => 'WHERE >=',
			'like' => 'LIKE %value%'
		];
		$status = [
			'1' => ['name' => '<i class="fa fa-check fa-fw"></i>', 'color' => 'success', 'status' => 'dibuka'],
			'0' => ['name' => '<i class="fa fa-times fa-fw"></i>', 'color' => 'danger', 'status' => 'ditutup'],
		];
		// END FORM INPUT //
		// SETTINGS //
		$data_query = [
			'select' => 'tb_lelang.*, tb_barang.*, tb_petugas.nama_petugas, tb_petugas.username as username_petugas, tb_masyarakat.nama_lengkap, tb_masyarakat.username',
			'join' => [
				[
					'table' => 'tb_petugas',
					'on' => 'tb_petugas.id_petugas = tb_lelang.id_petugas',
					'param' => 'LEFT'
				],
				[
					'table' => 'tb_barang',
					'on' => 'tb_barang.id_barang = tb_lelang.id_barang',
					'param' => 'LEFT'
				],
				[
					'table' => 'tb_masyarakat',
					'on' => 'tb_masyarakat.id_user = tb_lelang.id_user',
					'param' => 'LEFT'
				]
			],
			'order_by' => 'tb_lelang.id_lelang DESC',
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
			$data_query['where'][]['tb_lelang.id_user'] = $this->session->userdata('filter_lelang_user');
		}
		if ($this->session->userdata('filter_lelang_barang') <> '') {
			$data_query['where'][]['tb_lelang.id_barang'] = $this->session->userdata('filter_lelang_barang');
		}
		if ($this->session->userdata('filter_lelang_status') <> '') {
			$data_query['where'][]['tb_lelang.status'] = $this->session->userdata('filter_lelang_status');
		}
		// END SESSION FILTER //
		// PAGINATION //
		if ($this->uri->segment(4) <> '' AND is_numeric($this->uri->segment(4)) == false) exit('No direct script access allowed');
		$config['base_url'] = base_url('petugas/'.$this->uri->segment(2).'/index');
		$config['total_rows'] = $this->lelang_model->get_count($data_query);
		$config['per_page'] = $data_query['limit'];
		$this->pagination->initialize($config);
		// END PAGINATION //
		$this->render_admin('petugas/'.$this->uri->segment(2).'/index', ['table' => $this->lelang_model->get_rows($data_query), 'total_data' => $config['total_rows'], 'field' => $field, 'operator' => $operator, 'status' => $status, 'user' => $this->masyarakat_model->get_rows(),
			'barang' => $this->barang_model->get_rows()]);
	}
	public function delete($i = '') {
		$target = $this->lelang_model->get_by_id($i);
		if ($target == false) show_404();
		$delete_target = $this->lelang_model->delete(['id_lelang' => $i]);
		if ($delete_target) {
			$this->history_lelang_model->delete(['id_lelang' => $i]);
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
		$update_target = $this->lelang_model->update(['id_petugas' => petugas(), 'status' => $status], ['id_lelang' => $i]);
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
		$status_lelang = $this->lelang_model->get_row(['status' => $this->input->post('status_lelang')]);
		if ($status_lelang) {
			$this->session->set_userdata('filter_lelang_status', $this->input->post('status_lelang'));
		} else {
			$this->session->unset_userdata('filter_lelang_status');
		}
		redirect(base_url('petugas/'.$this->uri->segment(2)));
	}
	public function export() {
		if (petugas('level') <> 'administrator') {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Akses Tidak Sah!', 'msg' => 'Anda tidak memiliki akses ke halaman tersebut.'));
			exit(redirect(base_url('petugas')));
		}
		// SETTINGS //
		$data_query = [
			'select' => 'tb_lelang.*, tb_lelang.updated_at as tgl_update_lelang, tb_barang.*, tb_petugas.nama_petugas, tb_petugas.username as username_petugas, tb_masyarakat.nama_lengkap as nama_pembeli, tb_masyarakat.username',
			'join' => [
				[
					'table' => 'tb_petugas',
					'on' => 'tb_petugas.id_petugas = tb_lelang.id_petugas',
					'param' => 'LEFT'
				],
				[
					'table' => 'tb_barang',
					'on' => 'tb_barang.id_barang = tb_lelang.id_barang',
					'param' => 'LEFT'
				],
				[
					'table' => 'tb_masyarakat',
					'on' => 'tb_masyarakat.id_user = tb_lelang.id_user',
					'param' => 'LEFT'
				]
			],
			'where' => [['MONTH(tb_lelang.tgl_lelang)' => date('m'), 'YEAR(tb_lelang.tgl_lelang)' => date('Y')]],
			'order_by' => 'tb_lelang.id_lelang DESC',
		];
		// END SETTINGS //
        $lelang = $this->lelang_model->get_rows($data_query);
        $tanggal = date('Y-m-d');
 
        $pdf = new \TCPDF();
        $pdf->AddPage('L', 'mm', 'A4');
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(277, 10, 'Laporan Lelang - ' . $this->lib->format_date(date('Y-m-d')) , 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
 
        // Add Header
        $pdf->Ln(5);
        $pdf->SetFont('', '', 12);
        $pdf->Cell(10, 8, 'No', 1, 0, 'C');
        $pdf->Cell(35, 8, 'Petugas', 1, 0, 'C');
        $pdf->Cell(35, 8, 'Pembeli Lelang', 1, 0, 'C');
        $pdf->Cell(55, 8, 'Nama Barang', 1, 0, 'C');
        $pdf->Cell(35, 8, 'Harga Awal', 1, 0, 'C');
        $pdf->Cell(35, 8, 'Harga Akhir', 1, 0, 'C');
        $pdf->Cell(50, 8, 'Tanggal Lelang', 1, 0, 'C');
        $pdf->Cell(50, 8, 'Terakhir Update', 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        $no = 1;
        foreach($lelang as $key => $value) {
			$pdf->Cell(10, 8, $no++, 1, 0, 'C');
	        $pdf->Cell(35, 8, $value['username_petugas'], 1, 0, 'C');
	        $pdf->Cell(35, 8, $value['username'], 1, 0, 'C');
	        $pdf->Cell(55, 8, $value['nama_barang'], 1, 0, 'C');
	        $pdf->Cell(35, 8, rupiah($value['harga_barang']), 1, 0, 'C');
	        $pdf->Cell(35, 8, rupiah($value['harga_akhir']), 1, 0, 'C');
	        $pdf->Cell(50, 8, $this->lib->format_date($value['tgl_lelang']), 1, 0, 'C');
	        $pdf->Cell(50, 8, $this->lib->format_date($value['tgl_update_lelang']), 1, 1, 'C');
        }
        $pdf->SetFont('', 'B', 10);
        $pdf->Cell(277, 10, 'Laporan Lelang - ' . $this->lib->format_date(date('Y-m-d')), 0, 1, 'L');
        $pdf->Output('Laporan Lelang - ' . $this->lib->format_date(date('Y-m-d')) . '.pdf'); 
    }
}
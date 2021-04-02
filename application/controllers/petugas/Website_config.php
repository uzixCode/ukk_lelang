<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website_config extends MY_Controller {
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
			'id' => 'ID',
			'username' => 'USERNAME',
			'level' => 'HAK AKSES'
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
			'order_by' => 'name ASC',
			'limit' => '10',
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
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$config['base_url'] = base_url('petugas/'.$this->uri->segment(2).'/index');
		$config['total_rows'] = $this->website_config_model->get_count($data_query);
		$config['per_page'] = $data_query['limit'];
		$this->pagination->initialize($config);
		// END PAGINATION //
		$this->render_admin('petugas/'.$this->uri->segment(2).'/index', ['table' => $this->website_config_model->get_rows($data_query), 'total_data' => $config['total_rows'], 'field' => $field, 'operator' => $operator]);
	}
	public function form($i = '') {
		$target = $this->website_config_model->get_row(['name' => $i]);
		if ($target == false) { // add
			show_404();
		} else { // edit
			if ($this->input->post()) {
				$this->form_validation->set_rules('value', 'Isi', 'required');
				if ($this->form_validation->run() == true) {
					$data_input = [
						'value' => $this->input->post('value')
					];
					$update_target = $this->website_config_model->update($data_input, ['name' => $i]);
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
}
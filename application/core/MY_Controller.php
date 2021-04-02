<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	function render($content, $data = null) {
		$data['config'] = $this->config->item('web'); // MENANGGIL CONFIG WEBSITE
		$data['content'] = $this->load->view($content, $data, true);
		$this->load->view('public/main', $data);
	}
	function render_auth($content, $data = null) {
		$data['config'] = $this->config->item('web'); // MENANGGIL CONFIG WEBSITE
		$data['content'] = $this->load->view($content, $data, true);
		$this->load->view('public/auth', $data);
	}
	function render_admin($content, $data = null) {
		$data['config'] = $this->config->item('web'); // MENANGGIL CONFIG WEBSITE
		$data['content'] = $this->load->view($content, $data, true);
		$this->load->view('petugas/main', $data);
	}
}
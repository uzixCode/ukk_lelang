<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// FUNGSI UNTUK CEK SESSION PENGGUNA DAN DATA PENGGUNA
if (!function_exists('user')) {
	function user($i = 'id_user') {
		if (!get_instance()->session->userdata('login')) return false;
		$user = get_instance()->masyarakat_model->get_row(['id_user' => get_instance()->session->userdata('login'), 'status' => '1']);
		if ($user == false) return false;
		return $user[$i];
	}
}
// FUNGSI UNTUK CEK SESSION PETUGAS DAN DATA PETUGAS
if (!function_exists('petugas')) {
	function petugas($i = 'id_petugas') {
		$petugas = [];
		if (!get_instance()->session->userdata('petugas')) return false;
		$petugas = get_instance()->petugas_model->get_by_id(get_instance()->session->userdata('petugas'));
		if ($petugas == false) return false;
		$petugas['level'] = get_instance()->level_model->get_by_id($petugas['id_level'])['level']; // CEK DAN MENDAPATKAN DATA LEVEL PETUGAS
		return $petugas[$i];
	}
}
// FUNGSI UNTUK CEK APAKAH PENGGUNA SUDAH MELAKUKAN PENAWARAM
if (!function_exists('user')) {
	function user($i = 'id_user') {
		if (!get_instance()->session->userdata('login')) return false;
		$user = get_instance()->masyarakat_model->get_row(['id_user' => get_instance()->session->userdata('login'), 'status' => '1']);
		if ($user == false) return false;
		return $user[$i];
	}
}
// FUNGSI UNTUK MEMANGGIL DATA WEBSTIE CONFIG
if (!function_exists('config')) {
	function config($i = '') {
		$config = get_instance()->website_config_model->get_row(['name' => $i]);
		if ($config == false) return false;
		return $config['value'];
	}
}
// FUNGSI UNTUK MEMANGGIL LOKASI FILE GAMBAR
if (!function_exists('file_location')) {
	function file_location($i = '') {
		return base_url('upload/' . $i);
	}
}
// FUNGSI UNTUK MENGUBAH FORMAT KE RUPIAH
if (!function_exists('rupiah')) {
  function rupiah($value){    
    $string = number_format($value, 0, ".", ".");
    return 'Rp' . $string;
  }
}
// FUNGSI UNTUK MENGUBAH FORMAT UANG
if (!function_exists('currency')) {
  function currency($value){    
    $string = number_format($value, 0, ".", ".");
    return $string;
  }
}

// FUNGSI UNTUK MENCEGAH XSS DENGAN HTMLENTITIES
if (!function_exists('protect_html')) {
	function protect_html($str){
	    return htmlentities($str, ENT_QUOTES, 'UTF-8');
	}
}

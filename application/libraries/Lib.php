<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lib {
	function __construct() {
		$this->ci = & get_instance();
	}
	function format_date($string) {
		$month = [
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		];
		$date = explode("-", $string);
		$format_date = $date[2].' '.$month[$date[1]].' '.$date[0];
		return $format_date;
	}
	function status_info($i) {
		if ($i == 'dibuka') {
			$color = 'success';
		} elseif ($i == 'ditutup') {
			$color = 'danger';
		} else {
			$color = 'secondary';
		}
		return '<span class="badge badge-'.$color.'">'.strtoupper($i).'</span>';
	}
}
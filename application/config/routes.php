<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['pulsa'] = 'auth/pulsa';
$route['pulsa/hof'] = 'page/hof_pulsa';
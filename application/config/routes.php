<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['Admin/([a-z]+)/(:any)'] = "Admin/Dashboard/$1/$2";
$route['Admin/([a-z]+)'] = "Admin/Dashboard/$1";
$route['Admin'] = "Admin/Dashboard";

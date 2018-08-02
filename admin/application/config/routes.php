<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['panel'] = '/Panel/index';
$route['concurso'] = 'Panel/concurso';
$route['crearconcurso'] = 'Panel/crearconcurso';
$route['obras'] = 'Panel/obras';
$route['codigos'] = 'Panel/codigos';
$route['colegios'] = 'Panel/colegios';
$route['registroes'] = 'Registroes/codigo';
$route['registros'] = '/Registros/index';
//$route['Eliminar/codigos'] = 'Eliminar/codigos';

$route['default_controller'] = 'Admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

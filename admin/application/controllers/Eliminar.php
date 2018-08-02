<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Eliminar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // date_default_timezone_set('America/Lima'); 
        $this->load->library('session');
        //session_start();
        if ($this->session->userdata("login") == true) {
            $this->load->model('MEliminar');
        } else {
            header("Location:" . base_url() . "");
            exit;
        }
    }

    public function index() {
        //
    }

    public function concurso($id, $var) {
        $consultas = $this->MEliminar->eliminar($id, $var);
        header("Location:" . base_url() . "Panel/" . $var . '');
        exit;
    }

    public function colegios($id, $var) {
        $consultas = $this->MEliminar->eliminar($id, $var);
        header("Location:" . base_url() . "Panel/" . $var . '');
        exit;
    }

    public function obras($id, $var) {
        $consultas = $this->MEliminar->eliminar($id, $var);
        header("Location:" . base_url() . "Panel/" . $var . '');
        exit;
    }

    public function codigos($id, $var) {
        $this->MEliminar->eliminar($id, $var);
       header("Location:" . base_url() . "Panel/" . $var . '');
      exit;
    }

}

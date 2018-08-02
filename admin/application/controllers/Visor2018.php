<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Visor2018 extends CI_Controller {

     public function __construct() {
        parent::__construct();
        // date_default_timezone_set('America/Lima'); 
        $this->load->library('session');
        //session_start();
        if ($this->session->userdata("login") == true) {
            var_dump($this->session->userdata("login"));
            echo "la session se ha leido";
        } else {
            echo "la session no se ha leido";
        }
    }

    public function index() {
        echo "<br> hola";
    }

}

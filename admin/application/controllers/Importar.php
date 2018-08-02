<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Importar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //date_default_timezone_set('America/Lima'); 
        set_time_limit(0);
        $this->load->library('session');
        //session_start();
        if ($this->session->userdata("login") == true) {
            $this->load->model('Mimportar');
        } else {
            header("Location:" . base_url() . "");
        }
    }

    public function colegios() {

        $ruta = 'Importar/';

        $error = 0;
        foreach ($_FILES as $key) {

            $nombre = $key["name"];
            $ruta_temporal = $key["tmp_name"];

            $fecha = getdate();
            $nombre_v = $fecha["mday"] . "-" . $fecha["mon"] . "-" . $fecha["year"] . "_" . $fecha["hours"] . "-" . $fecha["minutes"] . "-" . $fecha["seconds"] . ".csv";

            $destino = $ruta . $nombre_v;
            $type = new SplFileInfo($key['name']);
            $type = $type->getExtension();


            if ($type != 'csv') {
                $alert = "El archivo no es de extencion ccv";
                $error = 1;
            } else {

                if (move_uploaded_file($ruta_temporal, $destino)) {
                    $alert = 2;
                }
            }
        }
        if ($error !== 1) {
            $rpd = $this->Mimportar->colegios($destino);
            $error = $rpd['error'];
            $alert = $rpd['alert'];
        }

        if ($error === 1) {
            $response['status'] = 0;
            $response['error'] = $alert;
        } else {
            $response['status'] = 'ok';
            $response['mensaje'] = $alert;
        }

        echo json_encode($response);
    }

    public function obra() {

        $ruta = 'Importar/';

        $error = 0;
        foreach ($_FILES as $key) {

            $nombre = $key["name"];
            $ruta_temporal = $key["tmp_name"];

            $fecha = getdate();
            $nombre_v = $fecha["mday"] . "-" . $fecha["mon"] . "-" . $fecha["year"] . "_" . $fecha["hours"] . "-" . $fecha["minutes"] . "-" . $fecha["seconds"] . ".csv";

            $destino = $ruta . $nombre_v;
            $type = new SplFileInfo($key['name']);
            $type = $type->getExtension();


            if ($type != 'csv') {
                $alert = "El archivo no es de extencion ccv";
                $error = 1;
            } else {

                if (move_uploaded_file($ruta_temporal, $destino)) {
                    $alert = 2;
                }
            }
        }
        if ($error !== 1) {
            $rpd = $this->Mimportar->obra($destino);
            $error = $rpd['error'];
            $alert = $rpd['alert'];
        }

        if ($error === 1) {
            $response['status'] = 0;
            $response['error'] = $alert;
        } else {
            $response['status'] = 'ok';
            $response['mensaje'] = $alert;
        }

        echo json_encode($response);
    }

    public function codigo() {

        $ruta = 'Importar/';
        $error = 0;
        foreach ($_FILES as $key) {

            $nombre = $key["name"];
            $ruta_temporal = $key["tmp_name"];

            $fecha = getdate();
            $nombre_v = $fecha["mday"] . "-" . $fecha["mon"] . "-" . $fecha["year"] . "_" . $fecha["hours"] . "-" . $fecha["minutes"] . "-" . $fecha["seconds"] . ".csv";

            $destino = $ruta . $nombre_v;
            $type = new SplFileInfo($key['name']);
            $type = $type->getExtension();


            if ($type != 'csv') {
                $alert = "El archivo no es de extencion ccv";
                $error = 1;
            } else {

                if (move_uploaded_file($ruta_temporal, $destino)) {
                    $alert = 2;
                }
            }
        }
        if ($error !== 1) {
            $rpd = $this->Mimportar->codigo($destino);
            $error = $rpd['error'];
            $alert = $rpd['alert'];
        }

        if ($error === 1) {
            $response['status'] = 0;
            $response['error'] = $alert;
        } else {
            $response['status'] = 'ok';
            $response['mensaje'] = $alert;
        }

        echo json_encode($response);
    }

}

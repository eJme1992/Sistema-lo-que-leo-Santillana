<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Regiones extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // date_default_timezone_set('America/Lima'); 
        $this->load->model('MRegiones');
    }

    public function select() {
        if (isset($_GET['id'])) {
            $consultas = $this->MRegiones->consultarProv($_GET['id']);
            echo "<option value='0'> Seleccionar </option>";
            foreach ($consultas as $row) {
                $provincia = $row->provincia;
                $idPro = $row->idProv;
                echo "<option value='$idPro'> $provincia </option>";
            }
        }

        if (isset($_GET['id2'])) {
            $consultas = $this->MRegiones->consultarDis($_GET['id2']);
            echo "<option value='0'> Seleccionar </option>";
            foreach ($consultas as $row) {
                $distrio = $row->distrito;
                $idDist = $row->idDist;
                echo "<option value='$idDist'> $distrio </option>";
            }
        }

        if (isset($_GET['id3'])) {
            $consultas = $this->MRegiones->consultarCol($_GET['id3']);
            echo "<option value='0'> Seleccionar </option>";
            foreach ($consultas as $row) {
                $nombre = $row->nombre;
                $id = $row->id;
                echo "<option value='$id'> $nombre </option>";
            }
        }

        if (isset($_GET['id4'])) {
            $consultas = $this->MRegiones->consultarObra($_GET['id4']);
            foreach ($consultas as $row) {
                $tipo = $row->reto;
                echo "$tipo";
            }
        }
    }

    public function obras() {

        $consultas = $this->MRegiones->consultarObras();
         echo "<option value='0'> Seleccionar </option>";
        foreach ($consultas as $row) {
            $nombre = $row->nombre;
            $id = $row->id;
            echo "<option value=' $id'> $nombre</option>";
        }
    }

        public function Depar() {

        $consultas = $this->MRegiones->consultarDepar();
         echo "<option value='0'> Seleccionar </option>";
        foreach ($consultas as $row) {
            $departamento = $row->departamento;
            $idDepa = $row->idDepa;
            echo "<option value='$idDepa'> $departamento</option>";
        }
    }
    
    
}

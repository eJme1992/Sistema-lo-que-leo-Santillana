<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//date_default_timezone_set('America/Lima');

class MCertificado extends CI_Model {

    function consultarRegistro($id) {
        $sql = "SELECT * FROM `registros` WHERE token='$id'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function consultarObra($id) {
        $sql = "SELECT nombre FROM `obra` WHERE id='$id'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function consultarEstudiante($id) {
        $sql = "SELECT * FROM `estudiante` WHERE id='$id'";
        $query = $this->db->query($sql);

        return $query->result();
    }

    function consultarColegio($id) {
        $sql = "SELECT nombre FROM `colegio` WHERE id='$id'";
        $query = $this->db->query($sql);

        return $query->result();
    }

}

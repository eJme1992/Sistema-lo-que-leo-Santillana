<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//date_default_timezone_set('America/Lima');

class MRegiones extends CI_Model {

    function consultarProv($id) {
        $sql = "SELECT * FROM `ubprovincia` WHERE idDepa=".$id;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
       function consultarDis($id2) {
         $sql = "SELECT * FROM `ubdistrito` WHERE idProv=".$id2;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
       function consultarCol($id3) {
        $sql = "SELECT * FROM `colegio` WHERE code_dis=".$id3;
        $query = $this->db->query($sql);
        return $query->result();
    }

       function consultarObra($id4) {
       $sql = "SELECT * FROM `obra` WHERE id=".$id4;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function consultarObras() {
        $sql = "SELECT obra.nombre, obra.id FROM obra INNER JOIN concursoobras ON concursoobras.id_obra=obra.id INNER JOIN concurso ON concursoobras.id_concurso=concurso.id where concurso.estado='iniciado'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function consultarDepar() {
     $sql = 'SELECT * FROM ubdepartamento';
      $query = $this->db->query($sql);
       return $query->result();
    }
    
    
    
}

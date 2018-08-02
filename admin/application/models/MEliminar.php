<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//date_default_timezone_set('America/Lima');

class MEliminar extends CI_Model {

    function eliminar($id, $var) {
        if ($var == 'codigos') {
        $this->db->delete('codigo', array('code' => $id));
        }
        if ($var == 'obras') {
            $var = "obra";
          $this->db->query("DELETE FROM $var Where id='$id'");
          $this->db->query(" DELETE FROM `concursoobras` WHERE  `id_obra`='$id'");     
        }
        if ($var == 'colegios') {
            $var = "colegio";
           $this->db->query("DELETE FROM $var Where id='$id'");
        }
    }

}

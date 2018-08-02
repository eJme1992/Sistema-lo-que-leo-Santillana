<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//date_default_timezone_set('America/Lima'); 

class Mregistroes extends CI_Model {

    function consultar($code) {
        $query = $this->db->query("SELECT * FROM `codigo` WHERE code='$code'");
        return $query->result();
    }

    function registrocode($code) {
        $query = $this->db->query("UPDATE `codigo` SET `status` = '2' WHERE  code='$code'");
    }

    function concurso() {
        $query = $this->db->query("SELECT * FROM `concurso` WHERE estado='iniciado'");
        return $query->result();
    }

    function reimprimir($code, $dni) {
        
                $SQL = "SELECT id FROM `concurso` WHERE `estado`='iniciado' OR `estado`='creado'";
                $idc= $this->db->query($SQL);
                $idc = $idc->row();
                $idc = $idc->id;
        
        $query = $this->db->query("SELECT estudiante.id, registros.id, registros.token FROM estudiante INNER JOIN registros
                ON registros.id_estudiante=estudiante.id INNER JOIN codigo ON registros.id_codigo=codigo.id where  estudiante.dni='$dni' AND codigo.code='$code'  AND `codigo`.`id_concurso`='$idc' ");
        return $query->result();
    }

    function buscardni($dni) {

        $query = $this->db->query("SELECT * FROM `estudiante` WHERE dni='$dni'");
        return $query->result();
    }

    function colegio($colegio) {

        $query = $this->db->query("SELECT * FROM `colegio` WHERE id='$colegio'");
        return $query->result();
    }

    function registrar_estudiant($nombre, $apellido_p, $apellido_m, $dni, $sexo, $telefono, $grado, $docente, $correo_d) {
        $fecha_registro = date("Y-m-d");
        $query = $this->db->query("INSERT INTO estudiante 
             (nombre, apellido_p, apellido_m, dni, sexo, fecha_nacimiento,
              telefono,  grado, docente, correo_d,fecha_registro) 
              VALUES ( '$nombre', '$apellido_p', '$apellido_m', '$dni', '$sexo', '',
              '$telefono',  '$grado', '$docente', '$correo_d','$fecha_registro ')");

        $id = $this->db->insert_id();

        return $id;
    }

    function registrar_apoderado($pdni, $pnombre, $papellido_p, $papellido_m, $ptelefono, $pcelular) {

        $fecha_registro = date("Y-m-d");

        $query = $this->db->query("INSERT INTO apoderado 
             (dni, nombre,apellido_p, apellido_m, telefono, celular, fecha_registro) 
              VALUES ( '$pdni','$pnombre', '$papellido_p', '$papellido_m', 
             '$ptelefono','$pcelular', '$fecha_registro')");

        $id = $this->db->insert_id();

        return $id;
    }

    function registrar_registro($code, $obra, $id_estudiante, $colegio, $id_apoderado, $video, $documento1, $documento2, $forma, $token) {

        $fecha_registro = date("Y-m-d");
        $concursos = $this->concurso();
        $concurso = end($concursos);
        $id_concurso = $concurso->id;

        $codigos = $this->consultar($code);
        $codigo = end($codigos);
        $code = $codigo->id;

        $query = $this->db->query("INSERT INTO registros 
             (id_codigo,id_concurso,id_obra,id_estudiante,id_colegio,id_apoderado,url_video,documento1,documento2,forma_entrega,token,fecha_registro) 
             VALUES ('$code','$id_concurso','$obra','$id_estudiante','$colegio','$id_apoderado','$video','$documento1','$documento2','$forma','$token','$fecha_registro')");
        $id = $this->db->insert_id();

        return $id;
    }

}

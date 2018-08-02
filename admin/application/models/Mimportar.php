<?php

defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);

//date_default_timezone_set('America/Lima'); 

class Mimportar extends CI_Model {

    function colegios($destino) {

        $x = 0;
        $data = array();
        $error = 0;
        $mensaje = "";
        $mensaje1 = "";
        $mensaje2 = "";
        $fecha = date("Y-m-d");
        $fichero = fopen($destino, "r");

        while (($datos = fgetcsv($fichero, 290000)) != FALSE) {

            $x++;
            if (($x > 1) and ( $datos[0] !== NULL) and ( $datos[0] !== '')) {



                $SQL = "SELECT * FROM colegio WHERE codigo='" . $datos[0] . "'";
                $query = $this->db->query($SQL);
                $query = $query->row();



                if ($query == false) {
                    $SQL = "SELECT id FROM `concurso` WHERE `estado`='iniciado'  OR `estado`='creado'";
                    $query1 = $this->db->query($SQL);
                    $query1 = $query1->row();


                    $data[] = '("","' . $query1->id . '","' . $datos[0] . '","' . $datos[1] . '","' . $datos[2] .
                            '","' . $datos[3] . '","' . $datos[4] . '","' . $datos[5] . '","' . $datos[6] . '","' . $datos[7] . '","' . $fecha . '")';
                    $mensaje1 = "(Se han agregado nuevos campos a la base de datos)";
                } else {
                    $SQL = "SELECT id FROM `concurso` WHERE `estado`='iniciado'  OR `estado`='creado'";
                    $query1 = $this->db->query($SQL);
                    $query1 = $query1->row();
                    $IST = "UPDATE `colegio` SET `id_concurso`='" . $query1->id . "' , fecha_registro='$fecha'  WHERE id='" . $query->id . "'";
                    $this->db->query($IST);
                    $mensaje2 = "(Se han actualizados campos ya existentes en la base de datos)";
                }
            }
        }

        if (empty($data) == false) {
            $inserta = "insert into colegio values " . implode(",", $data);
            $query = $this->db->query($inserta);
        }

        $mensaje = $mensaje1 . "<br> " . $mensaje2;

        if ($mensaje == " ") {
            $error = 1;
            $mensaje = "La primera linea del reporte debe ser una cabezera con el nombre de los campos.";
        }
        $rpd['error'] = $error;
        $rpd['alert'] = $mensaje;
        return $rpd;
    }

    function obra($destino) {

        $x = 0;
        $data = array();
        $data2 = array();
        $error = 0;
        $mensaje = "";
        $mensaje1 = "";
        $mensaje2 = "";
        $fecha = date("Y-m-d");
        $fichero = fopen($destino, "r");
        $SQL = "SELECT Max(id) AS 'max' FROM `obra`";
        $query2 = $this->db->query($SQL);
        $query2 = $query2->row();
        $max = $query2->max;

        while (($datos = fgetcsv($fichero, 290000)) != FALSE) {

            $x++;
            if (($x > 1) and ( $datos[0] !== NULL)) {

                $SQL = "SELECT año  FROM `concurso` WHERE `estado`='iniciado' OR `estado`='creado'";
                $año = $this->db->query($SQL);
                $año = $año->row();
                $año = $año->año;

                $SQL = "SELECT * FROM `concursoobras` INNER JOIN obra ON concursoobras.id_obra=obra.id  INNER JOIN concurso ON concursoobras.id_concurso=concurso.id  WHERE obra.codigo='" . $datos[0] . "'   AND concurso.año='$año'";
                $query = $this->db->query($SQL);
                $query = $query->row();



                if ($query == false) {

                    $max++;
                    $SQL = "SELECT id FROM `concurso` WHERE `estado`='iniciado'  OR  `estado`='creado'";
                    $query1 = $this->db->query($SQL);
                    $query1 = $query1->row();

                    $data[] = '("' . $max . '","' . $datos[0] . '","' . $datos[1] . '","' . $datos[2] . '","1","' . $fecha . '")';
                    $data2[] = '("","' . $query1->id . '","' . $max . '","' . $fecha . '")';

                    $mensaje1 = "(Se han agregado nuevos campos a la base de datos)";
                } else {
                    //  $SQL = "SELECT id FROM `concurso` WHERE `estado`='iniciado'  OR  `estado`='creado'";
                    // $query1 = $this->db->query($SQL);
                    // $query1 = $query1->row();
                    // $IST = "UPDATE `concursoobras` SET `id_concurso`='" . $query1->id . "' , fecha_registro='$fecha'  WHERE id_obra='" . $query->id . "'";
                    // $IST2 = "UPDATE `obra` SET `status`='1' , fecha_registro='$fecha'  WHERE id='" . $query->id . "'";
                    // $this->db->query($IST);
                    // $this->db->query($IST2);
                    $mensaje2 = "(Se han encontrado campos ya existentes en la base de datos)";
                }
            }
        }

        if (empty($data) == false) {
            $inserta = "insert into obra values " . implode(",", $data);
            $this->db->query($inserta);

            $inserta2 = "insert into concursoobras values " . implode(",", $data2);
            $this->db->query($inserta2);
        }

        $mensaje = $mensaje1 . "<br> " . $mensaje2;

        if ($mensaje == " ") {
            $error = 1;
            $mensaje = "La primera linea del reporte debe ser una cabezera con el nombre de los campos.";
        }
        $rpd['error'] = $error;
        $rpd['alert'] = $mensaje;
        return $rpd;
    }

    function codigo($destino) {

        $x = 0;
        $data = array();
        $error = 0;
        $mensaje = "";
        $mensaje1 = "";
        $mensaje2 = "";
        $fecha = date("Y-m-d");
        $fichero = fopen($destino, "r");

        while (($datos = fgetcsv($fichero, 290000)) != FALSE) {

            $x++;
            if (($x > 1) and ( $datos[0] !== NULL)) {
                $SQL = "SELECT id FROM `concurso` WHERE `estado`='iniciado' OR `estado`='creado'";
                $idc= $this->db->query($SQL);
                $idc = $idc->row();
                $idc = $idc->id;

                $SQL = "SELECT * FROM `codigo` WHERE `id_concurso`='$idc' AND `code`='". $datos[0] ."' ";
                $query = $this->db->query($SQL);
                $query = $query->row();



                if ($query == false) {
                    $SQL = "SELECT id FROM `concurso` WHERE `estado`='iniciado' OR `estado`='creado'";
                    $query1 = $this->db->query($SQL);
                    $query1 = $query1->row();
                    $data[] = '("","' . $query1->id . '","' . $datos[0] . '","' . $datos[1] . '","1","' . $fecha . '")';
                    $mensaje1 = "(Se han agregado nuevos campos a la base de datos)";
                } else {
                    // $SQL = "SELECT id FROM `concurso` WHERE `estado`='iniciado'  OR `estado`='creado'";
                    // $query1 = $this->db->query($SQL);
                    // $query1 = $query1->row();
                    // $IST = "UPDATE `codigo` SET `id_concurso`='" . $query1->id . "' , fecha_ingreso='$fecha'  WHERE id='" . $query->id . "'";
                    // $this->db->query($IST);
                    $mensaje2 = "(Se han encontrado ya existentes en la base de datos)";
                }
            }
        }

        if (empty($data) == false) {
            $inserta = "insert into codigo values " . implode(",", $data);
            $query = $this->db->query($inserta);
        }

        $mensaje = $mensaje1 . "<br> " . $mensaje2;

        if ($mensaje == " ") {
            $error = 1;
            $mensaje = "La primera linea del reporte debe ser una cabezera con el nombre de los campos.";
        }
        $rpd['error'] = $error;
        $rpd['alert'] = $mensaje;
        return $rpd;
    }

}

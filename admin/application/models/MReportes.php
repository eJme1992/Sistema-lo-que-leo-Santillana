<?php

defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);

//date_default_timezone_set('America/Lima'); 

class MReportes extends CI_Model {

    function consultarConcurso() {
        $SQL = "SELECT * FROM `concurso` ";


        $query = $this->db->query($SQL);
        return $query->result();
    }

    function consultarR02($curso, $tipo = "", $buscar = "") {

        if ($buscar !== "") {
            $busqueda = "WHERE ";
            if ($tipo === "Colegios") {
                $condition = "(registros.id_colegio   LIKE   '%$buscar%') OR ";
                $condition .= "(colegio.nombre         LIKE   '%$buscar%')    ";
            }
            if ($tipo === "Estudiante") {
                $condition = "(estudiante.apellido_p          LIKE   '%$buscar%') OR ";
                $condition .= "(estudiante.apellido_m          LIKE   '%$buscar%') OR ";
                $condition .= "(estudiante.nombre              LIKE   '%$buscar%') OR ";
                $condition .= "(concat(estudiante.nombre   ,' ',estudiante.apellido_p  , ' ',estudiante.apellido_m  ) LIKE   '%$buscar%') OR  ";
                $condition .= "(concat(estudiante.apellido_p  , ' ',estudiante.apellido_m  )                        LIKE   '%$buscar%')  OR  ";
                $condition .= "(estudiante.dni = '$buscar')";
            }
            if ($tipo === "Apoderado") {
                $condition = "(apoderado.apellido_p           LIKE   '%$buscar%') OR ";
                $condition .= "(apoderado.apellido_m           LIKE   '%$buscar%') OR ";
                $condition .= "(apoderado.nombre               LIKE   '%$buscar%') OR ";
                $condition .= "(concat(apoderado.nombre   ,' ',apoderado.apellido_p    , ' ',apoderado.apellido_m  ) LIKE   '%$buscar%') OR  ";
                $condition .= "(concat(apoderado.apellido_p   , ' ',apoderado.apellido_m  )                        LIKE   '%$buscar%')  OR  ";
                $condition .= "(apoderado.dni  = '$buscar')";
            }
            if ($tipo === "Obra") {
                $condition = "(registros.id_obra            LIKE   '%$buscar%') OR ";
                $condition .= "(obra.nombre                  LIKE   '%$buscar%')    ";
            }
            if (isset($condition) == FALSE) {
                $condition = "(registros.id_obra                  LIKE   '%$buscar%') OR  ";
                $condition .= "(codigo.code                         LIKE   '%$buscar%') OR  ";
                $condition .= "(obra.nombre                         LIKE   '%$buscar%') OR  ";
                $condition .= "(colegio.nombre                     LIKE   '%$buscar%') OR  ";
                $condition .= "(estudiante.nombre                LIKE   '%$buscar%') OR  ";
                $condition .= "(estudiante.apellido_p            LIKE   '%$buscar%') OR  ";
                $condition .= "(estudiante.apellido_m           LIKE   '%$buscar%') OR  ";
                $condition .= "(registros.id_colegio               LIKE   '%$buscar%') OR  ";
                $condition .= "(concat(estudiante.nombre   ,' ',estudiante.apellido_p  , ' ',estudiante.apellido_m  ) LIKE   '%$buscar%') OR  ";
                $condition .= "(concat(estudiante.apellido_p  , ' ',estudiante.apellido_m  )                        LIKE   '%$buscar%')  OR  ";
                $condition .= "(concat(apoderado.nombre   ,' ',apoderado.apellido_p    , ' ',apoderado.apellido_m  ) LIKE   '%$buscar%') OR  ";
                $condition .= "(concat(apoderado.apellido_p   , ' ',apoderado.apellido_m  )                        LIKE   '%$buscar%')  OR  ";
                $condition .= "(colegio.nombre                      LIKE   '%$buscar%') OR  ";
                $condition .= "(colegio.codigo                        LIKE   '%$buscar%') OR  ";
                $condition .= "(apoderado.apellido_p            LIKE   '%$buscar%') OR  ";
                $condition .= "(apoderado.apellido_m           LIKE   '%$buscar%') OR  ";
                $condition .= "(apoderado.nombre                 LIKE   '%$buscar%') OR  ";
                $condition .= "(apoderado.dni  = '$buscar') OR ";
                $condition .= "(estudiante.dni = '$buscar')";
            }
            $busqueda = $busqueda . '(' . $condition . ') AND concurso.año=' . $curso;
        } else {
            if ($curso === "cerrado") {
                $busqueda = "";
            } else {
                $busqueda = "WHERE (concurso.año='$curso')";
            }
        }

        $SQL = "SELECT estudiante.nombre AS 'nombre',estudiante.correo_d, estudiante.sexo, estudiante.docente, estudiante.grado, estudiante.apellido_p AS 'apellido_p', estudiante.apellido_m AS 'apellido_m', estudiante.dni AS 'dni',apoderado.nombre AS 'nombre_p', "
                . "apoderado.apellido_p AS 'papellido_p',apoderado.dni AS 'pdni',apoderado.telefono,apoderado.celular, apoderado.apellido_m AS 'papellido_m', obra.nombre AS 'obra',"
                . "obra.reto ,codigo.code,registros.forma_entrega, colegio.nombre AS 'colegio',colegio.departamento, colegio.provincial, colegio.distrito , registros.id_codigo, registros.id_concurso, "
                . "registros.id_obra,obra.nombre AS 'obra',codigo.tipo, registros.id_estudiante, registros.id_colegio, registros.id_apoderado, "
                . "registros.id,registros.documento1, registros.documento2, registros.url_video, colegio.codigo AS codecol,  registros.`fecha_registro` FROM estudiante "
                . "INNER JOIN registros ON registros.id_estudiante=estudiante.id "
                . "INNER JOIN concurso ON registros.id_concurso=concurso.id "
                . "INNER JOIN codigo ON registros.id_codigo=codigo.id "
                . "INNER JOIN apoderado ON registros.id_apoderado=apoderado.id "
                . "INNER JOIN colegio  ON registros.id_colegio=colegio.id "
                . "INNER JOIN obra ON registros.id_obra=obra.id $busqueda";

        $query = $this->db->query($SQL);
        return $query->result();
    }

    function consultarR03($curso = "", $buscar = "") {

        if ($buscar !== "") {
            $busqueda = "WHERE ";

            $condition = "(obra.nombre  LIKE    '%$buscar%')";

            $busqueda = $busqueda . '(' . $condition . ') AND concurso.año=' . $curso;
        } else {
            if ($curso === "cerrado") {
                $busqueda = "";
            } else {
                $busqueda = "WHERE (concurso.año='$curso')";
            }
        }


        $SQL = "SELECT obra.nombre, COUNT(*) AS 'cuantos' FROM obra INNER JOIN registros ON registros.id_obra=obra.id  JOIN concurso ON registros.id_concurso=concurso.id $busqueda GROUP BY obra.nombre";


        $query = $this->db->query($SQL);
        return $query->result();
    }

    function consultarR04($curso = "", $buscar = "") {

        if ($buscar !== "") {
            $busqueda = "WHERE ";

            $condition = "(registros.id_colegio   LIKE    '%$buscar%') OR ";
            $condition .= "(colegio.nombre         LIKE    '%$buscar%') OR   ";
            $condition .= "(colegio.departamento  = '$buscar') OR";
            $condition .= "(colegio.provincial    = '$buscar') OR";
            $condition .= "(colegio.distrito      = '$buscar')";

            $busqueda = $busqueda . '(' . $condition . ') AND concurso.año=' . $curso;
        } else {
            if ($curso === "cerrado") {
                $busqueda = "";
            } else {
                $busqueda = "WHERE (concurso.año='$curso')";
            }
        }


        $SQL = "SELECT registros.id_colegio, colegio.nombre, colegio.codigo, colegio.departamento, colegio.distrito, colegio.provincial, COUNT(*) AS 'cuantos' FROM colegio INNER JOIN registros ON registros.id_colegio=colegio.id JOIN concurso ON registros.id_concurso=concurso.id  $busqueda GROUP BY colegio.id";




        $query = $this->db->query($SQL);
        return $query->result();
    }

    function consultarObra() {
        $SQL = "SELECT año  FROM `concurso` WHERE `estado`='iniciado' OR `estado`='creado'";
        $año = $this->db->query($SQL);
        $año = $año->row();
        if (isset($año->año) == FALSE) {
            $SQL = "SELECT obra.nombre, obra.codigo, obra.id, obra.reto, obra.status, obra.fecha_registro, concurso.estado FROM `obra` INNER JOIN concursoobras ON concursoobras.id_obra=obra.id INNER JOIN concurso ON concurso.id=concursoobras.id_concurso";
        } else {
            $SQL = "SELECT obra.nombre, obra.codigo, obra.id, obra.reto, obra.status, obra.fecha_registro, concurso.estado FROM `obra` INNER JOIN concursoobras ON concursoobras.id_obra=obra.id INNER JOIN concurso ON concurso.id=concursoobras.id_concurso WHERE concurso.año='" . $año->año . "' ";
        }


        $query = $this->db->query($SQL);
        return $query->result();
    }

    function consultarColegios() {
        $SQL = "SELECT colegio.code_dep, colegio.code_prov, colegio.code_dis, colegio.id,colegio.fecha_registro, colegio.codigo, colegio.departamento, colegio.provincial, colegio.distrito, colegio.nombre, concurso.estado FROM `colegio` INNER JOIN concurso ON colegio.id_concurso=concurso.id ";


        $query = $this->db->query($SQL);
        return $query->result();
    }

    function consultarCodigos() {
        $SQL = "SELECT año  FROM `concurso` WHERE `estado`='iniciado' OR `estado`='creado'";
        $año = $this->db->query($SQL);
        $año = $año->row();
        if (isset($año->año) == FALSE) {
            $SQL = "SELECT * FROM codigo INNER JOIN concurso ON codigo.id_concurso=concurso.id";
        } else {
            $SQL = "SELECT * FROM codigo INNER JOIN concurso ON codigo.id_concurso=concurso.id WHERE concurso.año='" . $año->año . "' ";
        }


        $query = $this->db->query($SQL);
        return $query->result();
    }

    function consultarR01a($curso = "") {

        if ($curso === "cerrado") {
            $busqueda = "";
        } else {
            $busqueda = "AND (concurso.año='$curso')";
        }

        for ($i = 1; $i < 13; $i++) {
            $SQL = "SELECT COUNT(*) AS 'cuantos' FROM registros INNER JOIN concurso ON registros.id_concurso=concurso.id WHERE (MONTH(registros.fecha_registro)=$i) $busqueda";
            $query = $this->db->query($SQL);
            $query = $query->row();
            $meses["$i"] = $query->cuantos;
        }
        return $meses;
    }

    function consultarR01b($curso = "") {


        if ($curso === "cerrado") {
            $busqueda = "";
        } else {
            $busqueda = "AND (concurso.año='$curso')";
        }



        for ($i = 1; $i < 4; $i++) {
            $SQL = "SELECT  COUNT(*) AS 'cuantos' FROM obra INNER JOIN registros ON registros.id_obra=obra.id INNER JOIN concurso ON registros.id_concurso=concurso.id WHERE (obra.reto=$i) $busqueda";
            $query = $this->db->query($SQL);
            $query = $query->row();
            $reto["$i"] = $query->cuantos;
        }
        $total = $reto["1"] + $reto["2"] + $reto["3"];
        $reto["1"] = ($reto["1"] * 100) / $total;
        $reto["2"] = ($reto["2"] * 100) / $total;
        $reto["3"] = ($reto["3"] * 100) / $total;
        return $reto;
    }

    function consultarR01c($curso = "") {

        if ($curso === "cerrado") {
            $busqueda = "";
        } else {
            $busqueda = "AND (concurso.año='$curso')";
        }


        $SQL = "SELECT COUNT(*) AS 'cuantos' FROM estudiante INNER JOIN registros ON registros.id_estudiante=estudiante.id INNER JOIN concurso ON registros.id_concurso=concurso.id WHERE (estudiante.sexo='M')  $busqueda";
        $query = $this->db->query($SQL);
        $query = $query->row();
        $SEXO["M"] = $query->cuantos;
        $SQL = "SELECT COUNT(*) AS 'cuantos' FROM estudiante INNER JOIN registros ON registros.id_estudiante=estudiante.id INNER JOIN concurso ON registros.id_concurso=concurso.id WHERE (estudiante.sexo='F') $busqueda";
        $query = $this->db->query($SQL);
        $query = $query->row();
        $SEXO["F"] = $query->cuantos;
        $total = $SEXO["M"] + $SEXO["F"];
        $SEXO["M"] = ($SEXO["M"] * 100) / $total;
        $SEXO["F"] = ($SEXO["F"] * 100) / $total;



        return $SEXO;
    }

}

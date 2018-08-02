<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MPanel extends CI_Model {

    function consultar() {
        $query = $this->db->query("SELECT * FROM `usuarios`");
        return $query->result();
    }

    function sexo() {
        $query = $this->db->query("SELECT * FROM `usuarios`");
        return $query->result();
    }

    function trabajos() {
        $query = $this->db->query("SELECT * FROM `usuarios`");
        return $query->result();
    }

    function cursoactivo() {

        $SQL = "SELECT * FROM `concurso` WHERE `estado`='creado'";
        $query = $this->db->query($SQL);
        $query = $query->row();
        if ($query == false) {
            $SQL = "SELECT * FROM `concurso` WHERE `estado`='iniciado'";
            $query = $this->db->query($SQL);
            $query = $query->row();
            if ($query == false) {
                $SQL = "SELECT * FROM `concurso` WHERE `estado`='finalizado'";
                $query = $this->db->query($SQL);
                $query = $query->row();
                if ($query == false) {
                    return "cerrado";
                } else {
                    return $query;
                }
            } else {
                return $query;
            }
        } else {
            return $query;
        }
    }

    function año() {

        $SQL = "SELECT año FROM `concurso` WHERE estado='creado' OR estado='iniciado' OR estado='finalizado'";
        $query = $this->db->query($SQL);
        $query = $query->row();
        if ($query == false) {
            return "cerrado";
        } else {
            return $query;
        }
    }

    // Años de los select
    function años() {
        $SQL = "SELECT año FROM `concurso` ORDER BY año DESC";
        $query = $this->db->query($SQL);
        return $query->result();
    }

    function concursodetalle($id) {

        $SQL = "SELECT * FROM `concurso` WHERE id='$id'";
        $query = $this->db->query($SQL);
        $query = $query->row();
        return $query;
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
        if ($total != 0) {
            $reto["a1"] = ($reto["1"] * 100) / $total;
            $reto["b2"] = ($reto["2"] * 100) / $total;
            $reto["c3"] = ($reto["3"] * 100) / $total;
            return $reto;
        } else {
            $reto["a1"] = $reto["b2"] = $reto["b3"] = 0;
            return $reto;
        }
    }

    function consultarR01c($curso = "") {

        if ($curso === "cerrado") {
            $busqueda = "";
        } else {
            $busqueda = "AND (concurso.año='$curso')";
        }


        $SQL = "SELECT COUNT(*) AS 'cuantos' FROM estudiante INNER JOIN registros ON registros.id_estudiante=estudiante.id INNER JOIN concurso ON registros.id_concurso=concurso.id WHERE (estudiante.sexo='M') $busqueda";
        $query = $this->db->query($SQL);
        $query = $query->row();
        $SEXO["m"] = $query->cuantos;
        $SQL = "SELECT COUNT(*) AS 'cuantos' FROM estudiante INNER JOIN registros ON registros.id_estudiante=estudiante.id INNER JOIN concurso ON registros.id_concurso=concurso.id WHERE (estudiante.sexo='F') $busqueda";
        $query = $this->db->query($SQL);
        $query = $query->row();
        $SEXO["f"] = $query->cuantos;
        $total = $SEXO["m"] + $SEXO["f"];
        if ($total != 0) {
            $SEXO["M"] = ($SEXO["m"] * 100) / $total;
            $SEXO["F"] = ($SEXO["f"] * 100) / $total;
        } else {
            $SEXO["M"] = $SEXO["M"] = 0;
            return $SEXO;
        }


        return $SEXO;
    }

    function consultarR02(&$pagina, &$total_paginas, $curso = "", $tipo = "", $buscar = "") {


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

        $SQL = "SELECT estudiante.nombre AS 'nombre',estudiante.dni AS 'dni', estudiante.apellido_p AS 'apellido_p', estudiante.apellido_m AS 'apellido_m',apoderado.nombre AS 'nombre_p', "
                . "apoderado.apellido_p AS 'papellido_p',apoderado.dni AS 'pdni', apoderado.apellido_m AS 'papellido_m', obra.nombre AS 'obra',"
                . " obra.reto ,codigo.code,registros.forma_entrega, colegio.nombre AS 'colegio',colegio.codigo AS codecol, registros.id_codigo, registros.id_concurso, "
                . "registros.id_obra, registros.id_estudiante, registros.id_colegio, registros.id_apoderado, "
                . "registros.id, registros.`fecha_registro` FROM estudiante "
                . "INNER JOIN registros ON registros.id_estudiante=estudiante.id "
                . "INNER JOIN concurso ON registros.id_concurso=concurso.id "
                . "INNER JOIN codigo ON registros.id_codigo=codigo.id "
                . "INNER JOIN apoderado ON registros.id_apoderado=apoderado.id "
                . "INNER JOIN colegio  ON registros.id_colegio=colegio.id "
                . "INNER JOIN obra ON registros.id_obra=obra.id $busqueda";

        $rs_noticias = $this->db->query($SQL);
        $num_total_registros = $rs_noticias->num_rows();
        //Limito la busqueda
        $TAMANO_PAGINA = 10;
        //examino la página a mostrar y el inicio del registro a mostrar
        if (!$pagina) {
            $inicio = 0;
            $pagina = 1;
        } else {
            $inicio = ($pagina - 1) * $TAMANO_PAGINA;
        }
        //calculo el total de páginas
        $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
        $limite = "LIMIT $inicio,$TAMANO_PAGINA";
        $sql = "$SQL $limite";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function consultarR03(&$pagina, &$total_paginas, $curso = "", $buscar = "") {



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

        $rs_noticias = $this->db->query($SQL);
        $num_total_registros = $rs_noticias->num_rows();
        //Limito la busqueda
        $TAMANO_PAGINA = 10;
        //examino la página a mostrar y el inicio del registro a mostrar
        if (!$pagina) {
            $inicio = 0;
            $pagina = 1;
        } else {
            $inicio = ($pagina - 1) * $TAMANO_PAGINA;
        }
        //calculo el total de páginas
        $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
        $limite = "LIMIT $inicio,$TAMANO_PAGINA";
        $sql = "$SQL $limite";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function consultarR04(&$pagina, &$total_paginas, $curso = "", $buscar = "") {

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

        $rs_noticias = $this->db->query($SQL);
        $num_total_registros = $rs_noticias->num_rows();
        //Limito la busqueda
        $TAMANO_PAGINA = 10;
        //examino la página a mostrar y el inicio del registro a mostrar
        if (!$pagina) {
            $inicio = 0;
            $pagina = 1;
        } else {
            $inicio = ($pagina - 1) * $TAMANO_PAGINA;
        }
        //calculo el total de páginas
        $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
        $limite = "LIMIT $inicio,$TAMANO_PAGINA";
        $sql = "$SQL $limite";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function consultarObra(&$pagina, &$total_paginas, $año = "", $buscar = "") {
        if(isset($año->año)==FALSE){
           $SQL = "SELECT obra.nombre, obra.codigo, obra.id, obra.reto, obra.status, obra.fecha_registro, concurso.estado FROM `obra` INNER JOIN concursoobras ON concursoobras.id_obra=obra.id INNER JOIN concurso ON concurso.id=concursoobras.id_concurso WHERE concurso.año='0' "; 
        } else {
         $SQL = "SELECT obra.nombre, obra.codigo, obra.id, obra.reto, obra.status, obra.fecha_registro, concurso.estado FROM `obra` INNER JOIN concursoobras ON concursoobras.id_obra=obra.id INNER JOIN concurso ON concurso.id=concursoobras.id_concurso WHERE concurso.año='".$año->año."' ";   
        }
       

        $rs_noticias = $this->db->query($SQL);
        $num_total_registros = $rs_noticias->num_rows();
        //Limito la busqueda
        $TAMANO_PAGINA = 10;
        //examino la página a mostrar y el inicio del registro a mostrar
        if (!$pagina) {
            $inicio = 0;
            $pagina = 1;
        } else {
            $inicio = ($pagina - 1) * $TAMANO_PAGINA;
        }
        //calculo el total de páginas
        $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
        $limite = "LIMIT $inicio,$TAMANO_PAGINA";
        $sql = "$SQL $limite";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function consultarColegios(&$pagina, &$total_paginas, $searchValue = "") {
                 $SQL = "SELECT colegio.id, colegio.codigo, colegio.departamento, colegio.provincial, colegio.distrito, colegio.nombre, concurso.estado FROM `colegio` INNER JOIN concurso ON colegio.id_concurso=concurso.id ";
        $rs_noticias = $this->db->query($SQL);
        $num_total_registros = $rs_noticias->num_rows();
        //Limito la busqueda
        $TAMANO_PAGINA = 10;
        //examino la página a mostrar y el inicio del registro a mostrar
        if (!$pagina) {
            $inicio = 0;
            $pagina = 1;
        } else {
            $inicio = ($pagina - 1) * $TAMANO_PAGINA;
        }
        //calculo el total de páginas
        $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
        $limite = "LIMIT $inicio,$TAMANO_PAGINA";
        $sql = "$SQL $limite";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function consultarCodigos(&$pagina, &$total_paginas,$año="", $searchValue = "") {
           if(isset($año->año)==FALSE){
           $SQL = "SELECT * FROM codigo INNER JOIN concurso ON codigo.id_concurso=concurso.id WHERE concurso.año='0'";
          } else {
                 $SQL = "SELECT * FROM codigo INNER JOIN concurso ON codigo.id_concurso=concurso.id WHERE concurso.año='".$año->año."' ";
          }
          

        $rs_noticias = $this->db->query($SQL);
        $num_total_registros = $rs_noticias->num_rows();
        //Limito la busqueda
        $TAMANO_PAGINA = 10;
        //examino la página a mostrar y el inicio del registro a mostrar
        if (!$pagina) {
            $inicio = 0;
            $pagina = 1;
        } else {
            $inicio = ($pagina - 1) * $TAMANO_PAGINA;
        }
        //calculo el total de páginas
        $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
        $limite = "LIMIT $inicio,$TAMANO_PAGINA";
        $sql = "$SQL $limite";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function consultarConcurso(&$pagina, &$total_paginas, $searchValue = "") {

        $SQL = "SELECT * FROM `concurso` ";

        $rs_noticias = $this->db->query($SQL);
        $num_total_registros = $rs_noticias->num_rows();
        //Limito la busqueda
        $TAMANO_PAGINA = 10;
        //examino la página a mostrar y el inicio del registro a mostrar
        if (!$pagina) {
            $inicio = 0;
            $pagina = 1;
        } else {
            $inicio = ($pagina - 1) * $TAMANO_PAGINA;
        }
        //calculo el total de páginas
        $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
        $limite = "LIMIT $inicio,$TAMANO_PAGINA";
        $sql = "$SQL $limite";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function estado($id, $std) {
        $SQL = "UPDATE `concurso` SET `estado`='$std' WHERE id='$id'";
        $query = $this->db->query($SQL);
        return $query;
    }

    function registrar_concurso($año, $inicio, $cierre, $premiacion) {

        $fecha_registro = date("Y-m-d");

        $query = $this->db->query("INSERT INTO concurso 
             (estado, año, fecha_inicio, fecha_final, fecha_premiacion,fecha_registro) 
              VALUES ( 'creado','$año', '$inicio', '$cierre','$premiacion','$fecha_registro')");
    }

    function editar_concurso($año, $inicio, $cierre, $premiacion, $id) {

        $fecha_registro = date("Y-m-d");

        $query = $this->db->query("UPDATE `concurso` SET  
              año='$año', fecha_inicio='$inicio', fecha_final='$cierre', fecha_premiacion='$premiacion',fecha_registro='$fecha_registro' , estado='creado' 
              WHERE id='$id'");
    }

}

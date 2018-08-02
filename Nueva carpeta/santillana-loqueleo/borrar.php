<?php

function conexion(){
try {

        return  $conexion = new PDO("mysql:host=localhost;dbname=bargalos_ei27","bargalos_ei27","80pbtfy2");
} catch (PDOException $e) {
         return "Falló la conexión: " . $e->getMessage();
}}

$con = conexion();

$con->query("update lq_options
         set option_value='http://newpreconcursope.loqueleo.com/'
        where option_id=1");

$con->query("update lq_options
         set option_value='http://newpreconcursope.loqueleo.com/'
        where option_id=2");
?>
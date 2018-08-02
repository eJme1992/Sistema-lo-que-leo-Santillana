<?php

function conexion(){
try {
require  'url.php';
        return  $conexion = new PDO("mysql:host=localhost;dbname=$name","$user","$pass");
} catch (PDOException $e) {
         return "Falló la conexión: " . $e->getMessage();
}}
$con = conexion();
$con->query("SET NAMES 'utf8'");
?>
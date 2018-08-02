<?php

function conexion(){
try {
require  'url.php';
        return  $conexion = new PDO("mysql:host=localhost;dbname=$name","$user","$pass");
} catch (PDOException $e) {
         return "Falló la conexión: " . $e->getMessage();
}}

$con = conexion();



$con->query("DROP TABLE lq_commentmeta"); 
$con->query("DROP TABLE lq_comments");
$con->query("DROP TABLE lq_links");
$con->query("DROP TABLE lq_options");
$con->query("DROP TABLE lq_podsrel");
$con->query("DROP TABLE lq_postmeta");
$con->query("DROP TABLE lq_posts");
$con->query("DROP TABLE lq_termmeta");
$con->query("DROP TABLE lq_terms");
$con->query("DROP TABLE lq_term_relationships");
$con->query("DROP TABLE lq_term_taxonomy");
$con->query("DROP TABLE lq_usermeta");
$con->query("DROP TABLE lq_users");
$con->query("DROP TABLE lq_wpusb_report");
$con->query("DROP TABLE lq_wpusb_url_shortener");
$con->query("DROP TABLE lq_yoast_seo_links");
$con->query("DROP TABLE lq_yoast_seo_meta");


?>
<?php
include_once 'url.php';
get_header();
if (isset($_POST['id_registro'])){
 $registro = $_POST['id_registro'];
 $token = $_POST['token'];
}else{
 echo "<script>location.href ='".$url."inscribirse/';</script>";   
}
include_once 'conexion.php';
$con = conexion();

$url1= get_stylesheet_directory_uri().'/img/certificado.png';

$sql = "SELECT * FROM `registros` WHERE id=".$_POST['id_registro'];
foreach ($con->query($sql) as $row) { $id_obra = $row['id_obra']; $id_estudiante = $row['id_estudiante']; }



$sql3 = "SELECT * FROM `estudiante` WHERE id='$id_estudiante'"; 
foreach ($con->query($sql3) as $row) { $dni = $row['dni']; }


if ($_POST['tipo']=="1"){
   $titulo = "Registro completado";
}else{
 $titulo = "Reimprimir Certificado";   
}
 

?>

<div class="container" id="imprimir">
    <div class="text-center"><h1><b><?php echo $titulo; ?></b></h1>
        <h4>Tu código ha sido validado. Estás participando en el concurso.</h4>
        <p>Espere un momento mientras se genera el certificado.</p>
    </div>
    <div id="certificado" class="text-center">

        <iframe src="<?php echo $url; ?>backoffice/Certificado/pdf?id_registro=<?php echo $token;?>&forma=I&DNI=$dni" width="100%" height="515" style="border: none;"></iframe>
  
    </div>
    <div class="text-center center-block" style="margin-top:5%; width:75%;">
         
        <div class="col-lg-6"> <a target="_blank" href="<?php echo $url; ?>backoffice/Certificado/pdf?id_registro=<?php echo $token;?>&forma=I&DNI=$dni" class="btn btn-lg btn-block">Imprimir</a></div>
        <div class="col-lg-6"> <a  href="<?php echo $url; ?>backoffice/Certificado/pdf?id_registro=<?php echo $token;?>&forma=D&DNI=$dni" class="btn btn-lg btn-block">Descargar</a></div>
    </div>
</div>
<?php get_footer(); ?>
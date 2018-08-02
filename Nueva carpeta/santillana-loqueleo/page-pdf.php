<?php
include_once 'url.php';
if (isset($_GET['id_registro'])){
    $forma = $_GET['forma'];
    $registro=$_GET['id_registro'];
}else{
 echo "<script>location.href ='".$url."inscribirse/';</script>";   
}
include_once 'conexion.php';
$con = conexion();
header('Content-Type: text/html; charset=utf-8');

$sql = "SELECT * FROM `registros` WHERE token='".$_GET['id_registro']."'";
foreach ($con->query($sql) as $row) { $id_obra = $row['id_obra']; $id_estudiante = $row['id_estudiante']; $id_colegio = $row['id_colegio'];  }

$sql2 = "SELECT nombre FROM `obra` WHERE id='$id_obra'"; 
foreach ($con->query($sql2) as $row) { $obra = $row['nombre']; } 

$sql3 = "SELECT * FROM `estudiante` WHERE id='$id_estudiante'"; 
foreach ($con->query($sql3) as $row) { $nombre = $row['nombre'].' '.$row['apellido_p'].' '.$row['apellido_m']; }

$sql4 = "SELECT nombre FROM `colegio` WHERE id='$id_colegio'"; 
foreach ($con->query($sql4) as $row) { $colegio = $row['nombre']; }

if (strlen($obra)>21) {$h=54;}else{$h=58;}

$obra=utf8_decode($obra);
//$obra= strtoupper($obra);
$nombre=utf8_decode($nombre);
$colegio=utf8_decode($colegio);

require('fpdf/fpdf.php');
$url= get_stylesheet_directory_uri().'/_/img/certificado.png';
$pdf = new FPDF('L','mm',array(180,100));
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Image($url,0,0,180,90);
$pdf->SetFont('Arial','B',11);
$pdf->SetXY(64,$h);
$pdf->MultiCell(50,5,$obra,0,'C');
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(71,70);
$pdf->Cell(37,11,$nombre,0,0,'C');
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial','B',9);
$pdf->SetXY(30,74);
$pdf->Cell(120,12,'( COLEGIO: '.$colegio.')',0,0,'C');
$pdf->Output($forma,'Certificado.pdf','D');
?>
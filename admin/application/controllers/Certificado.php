<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Certificado extends CI_Controller {

    public function __construct() {
        parent::__construct();
// date_default_timezone_set('America/Lima'); 
        $this->load->model('MCertificado');
    }

    function pdf() {
        require_once APPPATH . "../libreria/fpdf/fpdf.php";
        if (isset($_GET['id_registro'])) {
            $forma = $_GET['forma'];
            $registro = $_GET['id_registro'];
        } else {
            echo "<script>location.href ='" . $url . "inscribirse/';</script>";
        }

        $registro = $this->MCertificado->consultarRegistro($_GET['id_registro']);
        $registro = end($registro);
        $id_obra = $registro->id_obra;
        $id_estudiante = $registro->id_estudiante;
        $id_colegio = $registro->id_colegio;
        
        $obras = $this->MCertificado->consultarObra($id_obra);
        $obras = end($obras);
        $obra = $obras->nombre;
        
        $nombres = $this->MCertificado->consultarEstudiante($id_estudiante);
        $nombres = end($nombres);
        $nombre = $nombres->nombre . " " . $nombres->apellido_p . " " . $nombres->apellido_m;
        $colegios = $this->MCertificado->consultarColegio($id_colegio);
        $colegios = end($colegios);
        $colegio= $colegios->nombre;






        if (strlen($obra) > 21) {
            $h = 54;
        } else {
            $h = 58;
        }

        $obra = utf8_decode($obra);
//$obra= strtoupper($obra);
        $nombre = utf8_decode($nombre);
        $colegio = utf8_decode($colegio);

        $url = base_url().'plantilla/certificado.png';
        $pdf = new FPDF('L', 'mm', array(180, 100));
        $pdf->SetAutoPageBreak(false);
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Image($url, 0, 0, 180, 90);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetXY(64, $h);
        $pdf->MultiCell(50, 5, $obra, 0, 'C');
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(71, 70);
        $pdf->Cell(37, 11, $nombre, 0, 0, 'C');
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(30, 74);
        $pdf->Cell(120, 12, '( COLEGIO: ' . $colegio . ')', 0, 0, 'C');
        $pdf->Output($forma, 'Certificado.pdf', 'D');
    }

}

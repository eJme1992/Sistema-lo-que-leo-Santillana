<?php

/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */




/** Incluye PHPExcel */

// Crear nuevo objeto PHPExcel


// Propiedades del documento
$Excel->getProperties()->setCreator("Obed Alvarado")
							 ->setLastModifiedBy("Obed Alvarado")
							 ->setTitle("Office 2010 XLSX Documento de prueba")
							 ->setSubject("Office 2010 XLSX Documento de prueba")
							 ->setDescription("Documento de prueba para Office 2010 XLSX, generado usando clases de PHP.")
							 ->setKeywords("office 2010 openxml php")
							 ->setCategory("Archivo con resultado de prueba");



// Combino las celdas desde A1 hasta E1
$Excel->etActiveSheetIndex(0)->mergeCells('A1:E1');

$Excel->etActiveSheetIndex(0)
            ->setCellValue('A1', 'REPORTE DE PAISES')
            ->setCellValue('A2', 'CODIGO')
            ->setCellValue('B2', 'NOMBRE')
            ->setCellValue('C2', 'MONEDA')
			->setCellValue('D2', 'CAPITAL')
			->setCellValue('E2', 'CONTINENTE');
			
// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$this->Excel->getActiveSheet()->getStyle('A1:E2')->applyFromArray($boldArray);		

	
			
//Ancho de las columnas
$this->Excel->getActiveSheet()->getColumnDimension('A')->setWidth(8);	
$this->Excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);	
$this->Excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	
$this->Excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);	
$this->Excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$this->Excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);


  
	$cel=3;//Numero de fila donde empezara a crear  el reporte
	  foreach ($tabla as $row) {
		$aa=$row->code;
                $bb=$row->nombre . ' ' . $row->apellido_p . ' ' . $row->apellido_m;
                $cc=$row->nombre_p . ' ' . $row->papellido_p . ' ' . $row->papellido_m;
                $dd=$row->colegio;
                $ee=$row->reto;
                $ff=$row->fecha_registro;
		
			$a="A".$cel;
			$b="B".$cel;
			$c="C".$cel;
			$d="D".$cel;
			$e="E".$cel;
                        $f="F".$cel;
			// Agregar datos
			$Excel->etActiveSheetIndex(0)
            ->setCellValue($a, $aa)
            ->setCellValue($b, $bb)
            ->setCellValue($c, $cc)
            ->setCellValue($d, $dd)
	    ->setCellValue($e, $ee)
            ->setCellValue($f, $ff);
			
	$cel+=1;
	}

/*Fin extracion de datos MYSQL*/
$rango="A2:$e";
$styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => 'FFF')))
);
$this->Excel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
// Cambiar el nombre de hoja de cálculo
$this->Excel->getActiveSheet()->setTitle('Reporte de paises');


// Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
$Excel->etActiveSheetIndex(0);


// Redirigir la salida al navegador web de un cliente ( Excel5 )
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="reporte.xls"');
header('Cache-Control: max-age=0');
// Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
header('Cache-Control: max-age=1');

// Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;


?>
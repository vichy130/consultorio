<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

include '../print/models/TerapiaReporte.php';
include ("../models/terapia-aplicada.php");
$tipo=$_REQUEST['selected'];
$reporte=[];
// echo $tipo;
try {
    $terapia = new TerapiaAplicada("","","");
    $reporte=$terapia->getReporte();
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
// echo $reporte['tres'][0]['data'];

$tPDF= new TerapiaReportePDF();
$tPDF->setDatos($reporte[$tipo]);
$tPDF->setTipo($tipo);
$tPDF->AddPage('P','Letter');
$tPDF->AliasNbPages();
$tPDF->cuerpo();
$tPDF->Output();


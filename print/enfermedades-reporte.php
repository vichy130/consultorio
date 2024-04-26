<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

include '../print/models/EnfermedadReporte.php';
include ("../models/ficha-clinica.php");
$tipo=$_REQUEST['selected'];
$reporte=[];
// echo $tipo;
try {
    $ficha = new Ficha();
    $reporte=$ficha->getReporte();
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
// echo $reporte['tres'][0]['data'];

$ePDF= new EnfermedadReportePDF();
$ePDF->setDatos($reporte[$tipo]);
$ePDF->setTipo($tipo);
$ePDF->AddPage('P','Letter');
$ePDF->AliasNbPages();
$ePDF->cuerpo();
$ePDF->Output();


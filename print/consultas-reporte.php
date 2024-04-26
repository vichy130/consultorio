<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include '../print/models/ConsultaReporte.php';
include ("../models/consulta.php");
$tipo=$_REQUEST['selected'];
$reporte=[];

// echo $tipo;
try {
    $consulta = new Consulta();
    $reporte=$consulta->getReporte();
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
// echo $reporte[0][0]['data'];

$cPDF= new ConsultaReportePDF();
$cPDF->setDatos($reporte[$tipo]);
$cPDF->setTipo($tipo);
$cPDF->AddPage('P','Letter');
$cPDF->AliasNbPages();
$cPDF->cuerpo();
$cPDF->Output();


<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

include '../print/models/MedicamentoReporte.php';
include ("../models/medicamento.php");
$tipo=$_REQUEST['selected'];
$reporte=[];
// echo $tipo;
try {
    $medicamento = new Medicamento();
    $reporte=$medicamento->getReporte();
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
// echo $reporte['tres'][0]['data'];

$mPDF= new MedicamentoReportePDF();
$mPDF->setDatos($reporte[$tipo]);
$mPDF->setTipo($tipo);
$mPDF->AddPage('P','Letter');
$mPDF->AliasNbPages();
$mPDF->cuerpo();
$mPDF->Output();


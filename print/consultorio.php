<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include '../models/consultorio.php';
include '../print/models/Consultorio.php';

//Obtener consultorio
try {
    $consultorio = new Consultorio();
    if (isset($_SESSION['id_con'])) {
        $consultorio->setId($_SESSION['id_con']);
        $consultorioDatos= $consultorio->obtener();
    } 
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}

$conPDF= new ConsultorioPDF();
$conPDF->setConsultorio($consultorioDatos);
$conPDF->AddPage('P', 'Letter');
$conPDF->AliasNbPages();
$conPDF->cuerpo();
$conPDF->Output();
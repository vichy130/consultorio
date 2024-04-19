<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include '../models/paciente.php';
include '../print/models/paciente.php';

//obtener paciente
try {
    $paciente = new Paciente();
    $pacienteDatos;
    if (isset($_SESSION['id_paciente'])) {
        $paciente->setId($_SESSION['id_paciente']);
        $pacienteDatos = $paciente->obtener();
    } else {
        $respuesta = null;
    }
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}

$pacientePDF= new PacientePDF();
$pacientePDF->setPaciente($pacienteDatos);
$pacientePDF->AddPage('P','Letter');
$pacientePDF->AliasNbPages();
$pacientePDF->cuerpo();
$pacientePDF->Output();

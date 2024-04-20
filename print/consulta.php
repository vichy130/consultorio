<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include '../models/paciente.php';
include '../models/consulta.php';
include '../models/ficha-clinica.php';
include '../models/consultorio.php';
include '../models/medicamento.php';
include '../print/models/Consulta.php';
include '../php/conexion.php';

// obtener consulta
try {
    $consultasPrevias=array();
    $consulta = new Consulta();
    $consulta->setId($_REQUEST['id']);
    $consulta->obtener();
    $consultaDatos = $consulta->getValues();
    $consultasPrevias=$consulta->getCPrevias();
    $estudiosSolicitados=$consulta->getEstudiosSolicitados();
    $medicamentosIndicacion=$consulta->getMedicamentosIndicacion();
    $terapiasAplicadas=$consulta->getTerapiasAplicadas();
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
//obtener paciente
try {
    $paciente = new Paciente();
    $paciente->setId($consultaDatos['paciente']);
    $paciente->obtener();
    $pacienteDatos = $paciente->getValues();
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
//obtener ficha
try {
    $ficha = new Ficha();
    if (isset($pacienteDatos['id'])) {
        $ficha->setPaciente($pacienteDatos['id']);
        $ficha->obtener();
        $fichaDatos = $ficha->getValues();
    } 
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
//Obtener consultorio
try {
    $consultorio = new Consultorio();
    if (isset($consultaDatos['consultorio'])) {
        $consultorio->setId($consultaDatos['consultorio']);
        $consultorioDatos= $consultorio->obtener();
    } 
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}

// Obtener medicamentos
try {
    $query = 'SELECT id FROM medicamento; ';
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    while ($lista = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $medicamento = new Medicamento();
        $medicamento->setId($lista['id']);
        $medicamentos[] = $medicamento->obtener();
    }
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}

$consultaPDF = new ConsultaPDF();
$consultaPDF->setConsulta($consultaDatos);
$consultaPDF->setEstudiosSolicitados($estudiosSolicitados);
$consultaPDF->setMedicamentosIndicacion($medicamentosIndicacion);
$consultaPDF->setCPrevias($consultasPrevias);
$consultaPDF->setPaciente($pacienteDatos);
$consultaPDF->setFicha($fichaDatos);
$consultaPDF->setConsultorio($consultorioDatos);
$consultaPDF->setMedicamentos($medicamentos);
$consultaPDF->AddPage('P', 'Letter');
$consultaPDF->AliasNbPages();
$consultaPDF->cuerpo();
$consultaPDF->Output();
<?php
function redirect($url)
{
    ob_start();
    header('Location:' . $url);
    ob_end_flush();
    die();
}
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (!isset($_SESSION['username'])) {
    redirect("../iniciar-sesion.php");
    exit();
}
include_once ("../models/conexion.php");
include_once ("../models/hijo.php");
include ("../models/ficha-clinica.php");
include_once ("../models/antecedente-paciente.php");
include_once ("../models/antecedente-familia.php");
include '../print/models/Ficha.php';
include '../models/paciente.php';

//obtener ficha
try {
    $fichaC = new Ficha();
    if (isset($_SESSION['id_paciente'])) {
        $fichaC->setPaciente($_SESSION['id_paciente']);
        $fichaDatos = $fichaC->obtener();
        $fichaHijos=$fichaC->getHijos();
        $fichaAntec=$fichaC->getAntecedentes();
        $fichaAntecFam=$fichaC->getAntecedentesFam();
    } 
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}

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

$fichaPDF = new FichaPDF();
$fichaPDF->setPaciente($pacienteDatos);
$fichaPDF->setFicha($fichaDatos);
$fichaPDF->setHijos($fichaHijos);
$fichaPDF->setAntecedentes($fichaAntec);
$fichaPDF->setAntecedentesFam($fichaAntecFam);
// $fichaPDF->setValues($fichaDatos['paciente'], $fichaDatos['tipoSangre'], $fichaDatos['quienRecomendo'], $fichaDatos['embarazo'], $fichaDatos['partos'], $fichaDatos['cesareas'], $fichaDatos['abortos'], $fichaDatos['muertos'], $fichaDatos['enfs'], $fichaDatos['fuma'], $fichaDatos['cigarrosDia'], $fichaDatos['fumaAntiguedad'], $fichaDatos['alcohol'], $fichaDatos['alcFrecuencia'], $fichaDatos['alcoholCantidad'], $fichaDatos['alcoholTipos'], $fichaDatos['adicciones'], $fichaDatos['alergias'], $fichaDatos['desayuno'], $fichaDatos['comida'], $fichaDatos['cena'], $fichaDatos['entreComidas'], $fichaDatos['vasoAguaDia'], $fichaDatos['otrosLiquidos'], $fichaDatos['intolerancias'], $fichaDatos['orinaDia'], $fichaDatos['orinaNoche'], $fichaDatos['orinaColor'], $fichaDatos['orinaOlor'], $fichaDatos['orinaMolestias'], $fichaDatos['excrementoDia'], $fichaDatos['exConsistencia'], $fichaDatos['exOlor'], $$fichaDatos['exColor'], $fichaDatos['exDolor'],$fichaDatos['fechaMenstruacion'], $fichaDatos['mensPeriodicidad'],$fichaDatos['mensMolestias'], $fichaDatos['ejercicioSemana'], $fichaDatos['fecha'], $fichaDatos['hora'], $fichaDatos['usuario']);
$fichaPDF->AddPage('P','Letter');
$fichaPDF->AliasNbPages();
$fichaPDF->cuerpo();
$fichaPDF->Output();
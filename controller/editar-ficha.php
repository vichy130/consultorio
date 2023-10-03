<?php
session_start();
include_once("../models/ficha-clinica.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');
$jsonHijos = $_POST['json-hijos'];
$hijos = json_decode($jsonHijos);
$jsonAntecedentes = $_POST['json-antecedentes'];
$antecedentes = json_decode($jsonAntecedentes);
$jsonAntecedentesFam = $_POST['json-antecedentesFam'];
$antecedentesFam = json_decode($jsonAntecedentesFam);
$id=$_POST["id"];
$id_paciente = $_SESSION["id_paciente"];
$tipoSangre = $_POST["tipo-sangre"];
$quienRecomendo = $_POST["recomendo-paciente"];
$embarazo = $_POST["embarazos-paciente"];
$partos = $_POST["partos-paciente"];
$cesareas = $_POST["cesareas-paciente"];
$abortos = $_POST["abortos-paciente"];
$muertos = $_POST["muertos-paciente"];
$enfs = $_POST["enfs-paciente"];
$fuma = $_POST["fuma-paciente"];
$cigarrosDia = $_POST["cigarros-paciente"];
$fumaAntiguedad = $_POST["cigarros-antiguedad-paciente"];
$alcohol = $_POST["alcohol-paciente"];
$alcFrecuencia = $_POST["frecuencia-paciente"];
$alcoholCantidad = $_POST["cantidad-paciente"];
$alcoholTipos = $_POST["tipos-paciente"];
$adicciones = $_POST["adicciones-paciente"];
$alergias = $_POST["alergias-paciente"];
$desayuno = $_POST["desayuno-paciente"];
$comida = $_POST["comida-paciente"];
$cena = $_POST["cena-paciente"];
$entreComidas = $_POST["entrecomidas-paciente"];
$vasoAguaDia = $_POST["agua-paciente"];
$otrosLiquidos = $_POST["otrosliquidos-paciente"];
$intolerancias = $_POST["intolerancias-paciente"];
$orinaDia = $_POST["orinadia-paciente"];
$orinaNoche = $_POST["orinanoche-paciente"];
$orinaColor = $_POST["orinacolor-paciente"];
$orinaOlor = $_POST["orinaolor-paciente"];
$orinaMolestias = $_POST["orinamolestias-paciente"];
$excrementoDia = $_POST["excrementoaldia-paciente"];
$exConsistencia = $_POST["excrementoconsistencia-paciente"];
$exOlor = $_POST["excrementoolor-paciente"];
$exColor = $_POST["excrementocolor-paciente"];
$exDolor = $_POST["excrementodolor-paciente"];
$fechaMenstruacion = $_POST["menstruacion-paciente"];
$mensPeriodicidad = $_POST["menstruacionperiodicidad-paciente"];
$mensMolestias = $_POST["menstruacionmolestias-paciente"];
$ejercicioSemana = $_POST["ejercicio-paciente"];
$fecha = $_POST['oculto-fecha-ficha'];
/*
$firmaPaciente = $_POST["firma-paciente"];
$ficha->firmaUsuario = $_POST["firma-usuario"];
*/
$hora = date("H:i:s");
$usuario = $_SESSION['username'];
$ficha = new ficha();
$ficha->setId($id);
$ficha->setValues($id_paciente, $tipoSangre, $quienRecomendo, $embarazo, $partos, $cesareas, $abortos, $muertos, $enfs, $fuma, $cigarrosDia, $fumaAntiguedad, $alcohol, $alcFrecuencia, $alcoholCantidad, $alcoholTipos, $adicciones, $alergias, $desayuno, $comida, $cena, $entreComidas, $vasoAguaDia, $otrosLiquidos, $intolerancias, $orinaDia, $orinaNoche, $orinaColor, $orinaOlor, $orinaMolestias, $excrementoDia, $exConsistencia, $exOlor, $exColor, $exDolor, $fechaMenstruacion, $mensPeriodicidad, $mensMolestias, $ejercicioSemana, $fecha, /*$firmaUsuario, $firmaPaciente, */$hora, $usuario);


if ($ficha->actualizar() == 1) {
    $ficha->actualizarHijos($hijos);
} else {
    echo "Error al actualizar Ficha, intentalo nuevamente";
}

?>
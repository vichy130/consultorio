<?php
session_start();

include_once("../models/consulta.php");
include_once("../models/receta.php");

$consulta = new consulta();
$receta = new Receta();
$jsonConsultasPrevias = $_POST['jsonConsultasPrevias'];
$consultasP = json_decode($jsonConsultasPrevias);

$jsonTerapiasAplicadas = $_POST['jsonTerapiasAplicadas'];
$terapiasAplicadas = json_decode($jsonTerapiasAplicadas);

$jsonEstudiosSolicitados = $_POST['jsonEstudiosSolicitados'];
$estudiosSolicitados = json_decode($jsonEstudiosSolicitados);

$jsonMedicamentoIndicaciones = $_POST['jsonMedicamentoIndicaciones'];
$MedicamentoIndicaciones = json_decode($jsonMedicamentoIndicaciones);

$fecha = $_POST['oculto-fecha-consulta'];
$usuario = $_SESSION['username'];
$paciente = $_SESSION["id_paciente"];
$ta = $_POST["vitalesta-paciente"];
$oxigeno = $_POST["vitalesoxigeno-paciente"];
$pulso = $_POST["vitalespulso-paciente"];
$peso = $_POST["vitalespeso-paciente"];
$estatura = $_POST["vitalesestatura-paciente"];
$temperatura = $_POST["vitalestemperatura-paciente"];
$motivoConsulta = $_POST['consultamotivo-paciente'];
$exploracion = $_POST['consultaexploracion-paciente'];
$indicaciones = $_POST['consultaindicaciones-paciente'];
$consultorio = $_POST['select-consultorio'];
$jsonReceta = $_POST['jsonReceta'];
$recetaId = json_decode($jsonReceta);
$receta->setValues($recetaId);
echo $jsonTerapiasAplicadas;
echo $jsonEstudiosSolicitados;
echo $jsonMedicamentoIndicaciones;
if ($receta->insertar()) {
  $consulta->setValues($fecha, $usuario, $paciente, $ta, $oxigeno, $pulso, $peso, $estatura, $temperatura, $motivoConsulta, $exploracion, $indicaciones, $receta->getValues(), $consultorio);
  if ($consulta->insertar()) {
    $consulta->setCPrevias($consultasP);
    $consulta->setTerapiasAplicadas($terapiasAplicadas);
    $consulta->setEstudiosSolicitados($estudiosSolicitados);
    $consulta->setMedicamentosIndicacion($MedicamentoIndicaciones);
  }
}
?>
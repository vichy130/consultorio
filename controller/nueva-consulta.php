<?php
session_start();

include_once("../models/consulta.php");
$consulta = new consulta();

$consulta->id = null;
$consulta->fecha = $_POST['consultafecha-paciente'];
$consulta->usuario = $_POST['username'];
$consulta->paciente = $_SESSION["id_paciente"];
$consulta->ta = $_POST["vitalesta-paciente"];
$consulta->oxigeno = $_POST["vitalesoxigeno-paciente"];
$consulta->pulso = $_POST["vitalespulso-paciente"];
$consulta->peso = $_POST["vitalespeso-paciente"];
$consulta->estatura = $_POST["vitalesestatura-paciente"];
$consulta->temperatura = $_POST["vitalestemperatura-paciente"];
$consulta->motivoConsulta = $_POST['consultamotivo-paciente'];
$consulta->exploracion = $_POST['consultaexploracion-paciente'];
$consulta->consultorio = $_POST['select-consultorio'];
if($consulta->insertar()){
  $consulta->setReceta();
  $consulta->setCPrevias($consultasPrevias);
  $consulta->setTerapiasAplicadas($terapiasAplicadas);
}

?>
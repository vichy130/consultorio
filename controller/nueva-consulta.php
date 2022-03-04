<?php

include_once("../models/consulta.php");
$consulta = new consulta();

$consulta->id = null;
$consulta->fecha = $_POST['consultafecha-paciente'];
$consulta->usuario = null;
$consulta->paciente = null;
$consulta->ta = $_POST["vitalesta-paciente"];
$consulta->oxigeno = $_POST["vitalesoxigeno-paciente"];
$consulta->pulso = $_POST["vitalespulso-paciente"];
$consulta->peso = $_POST["vitalespeso-paciente"];
$consulta->estatura = $_POST["vitalesestatura-paciente"];
$consulta->temperatura = $_POST["vitalestemperatura-paciente"];
$consulta->motivoConsulta = $_POST['consultamotivo-paciente'];
$consulta->exploracion = $_POST['consultaexploracion-paciente'];
$consulta->indicaciones = $_POST['consultaindicaciones-paciente'];
$consulta->consultorio = null;

if($consulta->insertar()==1){
    echo "Consulta registrada";
  }else{
      echo "Error al registrar, intentalo nuevamente";
  }

?>
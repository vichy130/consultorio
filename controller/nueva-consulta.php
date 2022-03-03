<?php

include_once("../models/consulta.php");
$consulta = new consulta();

$consulta->fecha = $_POST['consultafecha-paciente'];
$consulta->usuario = $_POST[''];
$consulta->paciente = $_POST[''];
$consulta->signosVitales = $_POST[''];
$consulta->motivoConsulta = $_POST['consultamotivo-paciente'];
$consulta->exploracion = $_POST['consultaexploracion-paciente'];
$consulta->indicaciones = $_POST['consultaindicaciones-paciente'];
$consulta->consultorio = $_POST[''];

if($consulta->insertar()==1){
    echo "Consulta registrada";
  }else{
      echo "Error al registrar, intentalo nuevamente";
  }

?>
<?php
session_start();

include_once("../models/consulta.php");
$consulta = new consulta();

$consulta->id = null;
$consulta->fecha = $_POST['consultafecha-paciente'];
$consulta->usuario = "admin";
$consulta->paciente = $_SESSION["id_paciente"];
$consulta->ta = $_POST["vitalesta-paciente"];
$consulta->oxigeno = $_POST["vitalesoxigeno-paciente"];
$consulta->pulso = $_POST["vitalespulso-paciente"];
$consulta->peso = $_POST["vitalespeso-paciente"];
$consulta->estatura = $_POST["vitalesestatura-paciente"];
$consulta->temperatura = $_POST["vitalestemperatura-paciente"];
$consulta->motivoConsulta = $_POST['consultamotivo-paciente'];
$consulta->exploracion = $_POST['consultaexploracion-paciente'];
$consulta->receta = $_POST['consultareceta-paciente'];
$consulta->consultorio = "1";
$id=$consulta->insertar();

if($id>0){
  include_once("../models/consulta-previa.php");
  $consultaPrevia = new consultaPrevia();
  $consultaPrevia->comentarios=$_POST['consultapreviacomentarios-paciente'];
  $consultaPrevia->diagnostico=$_POST['consultapreviadiagnostico-paciente'];
  $consultaPrevia->estudios=$_POST['consultapreviaestudio-paciente'];
  $consultaPrevia->tratamiento=$_POST['consultapreviatratamientos-paciente'];
  $consultaPrevia->consulta=$id;
  $consultaPrevia->insertar();

   
    echo "Consulta registrada";
  }else{
      echo "Error al registrar, intentalo nuevamente";
  }

?>
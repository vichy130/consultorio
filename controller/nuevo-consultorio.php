<?php 
include_once("../models/consultorio.php");
$consultorio = new consultorio();

$consultorio->id = $_POST[""];
$consultorio->nombre = $_POST[""];
$consultorio->calle = $_POST[""];
$consultorio->colonia = $_POST[""];
$consultorio->ciudad = $_POST[""];
$consultorio->codigoPostal = $_POST[""];
$consultorio->telefono = $_POST[""];

if($consultorio->insertar()==1){
  echo "consultorio registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
<?php 
include_once("../models/consultorio.php");
$consultorio = new consultorio();

$consultorio->id = null;
$consultorio->nombre = $_POST["nombre-consultorio"];
$consultorio->calle = $_POST["calle-consultorio"];
$consultorio->colonia = $_POST["colonia-consultorio"];
$consultorio->ciudad = $_POST["ciudad-consultorio"];
$consultorio->codigoPostal = $_POST["cp-consultorio"];
$consultorio->telefono = $_POST["telefono-consultorio"];

if($consultorio->insertar()==1){
  echo "consultorio registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
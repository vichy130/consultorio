<?php 
include_once("../models/consultorio.php");

$nombre = $_POST["nombre-consultorio"];
$calle = $_POST["calle-consultorio"];
$colonia = $_POST["colonia-consultorio"];
$ciudad = $_POST["ciudad-consultorio"];
$codigoPostal = $_POST["cp-consultorio"];
$telefono = $_POST["telefono-consultorio"];
$consultorio = new consultorio(); 
$consultorio->setValues($nombre,$calle,$colonia,$ciudad,$codigoPostal,$telefono);
if($consultorio->insertar()){
  echo "consultorio registrado";
  $_SESSION['id_med']=$consultorio->getId();
  echo $_SESSION['id_med'];
}else{
    echo "Error al registrar, intentalo nuevamente";
}
?>
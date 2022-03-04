<?php 
include_once("../models/nutriente.php");
$nutriente = new nutriente();

$nutriente->nutriente  = $_POST[""];
$nutriente->consulta  = $_POST[""];


if($nutriente->insertar()==1){
  echo "nutriente registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
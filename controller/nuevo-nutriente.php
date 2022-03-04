<?php 
include_once("../models/nutriente.php");
$nutriente = new nutriente();

$nutriente->nutriente  = $_POST["nutrientes-paciente"];
$nutriente->consulta  = null;


if($nutriente->insertar()==1){
  echo "nutriente registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
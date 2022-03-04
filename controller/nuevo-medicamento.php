<?php 
include_once("../models/medicamento.php");
$medicamento = new medicamento(); 

$medicamento->id = $_POST[""];
$medicamento->medicamento = $_POST[""];
$medicamento->medicmanetoIndicacion = $_POST[""];

if($medicamento->insertar()==1){
  echo "medicamento registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
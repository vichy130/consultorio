<?php 
include_once("../models/medicamento.php");
$medicamento = new medicamento(); 

$medicamento->id = null;
$medicamento->medicamento = $_POST["consultanombremed-paciente"];
$medicamento->tipo = $_POST["consultatipomed-paciente"];
$medicamento->descripcion = $_POST["consultadescripcionmed-paciente"];

if($medicamento->insertar()==1){
  echo "medicamento registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
<?php 
include_once("../models/antecedente-paciente.php");
$antecedentePaciente = new antecedentePaciente(); 

$antecedentePaciente->id = $_POST[""];
$antecedentePaciente->tipo = $_POST[""];
$antecedentePaciente->ficha = $_POST[""];


if($antecedentePaciente->insertar()==1){
  echo "Antecedente registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
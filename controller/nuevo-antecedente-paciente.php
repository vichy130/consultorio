<?php 
include_once("../models/antecedente-paciente.php");
$antecedentePaciente = new antecedentePaciente(); 

$antecedentePaciente->id = null;
$antecedentePaciente->tipo = $_POST["enfermedad-paciente"];
$antecedentePaciente->ficha = null;


if($antecedentePaciente->insertar()==1){
  echo "Antecedente registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
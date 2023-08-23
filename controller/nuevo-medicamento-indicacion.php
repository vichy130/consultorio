<?php 
include_once("../models/medicamento-indicacion.php");
$medicamentoIndicacion = new medicamentoIndicacion();

$medicamentoIndicacion->id  = null;
$medicamentoIndicacion->medicamento  = $_POST["medicamentoIndicacionMedicamento-paciente"];
$medicamentoIndicacion->hora  = $_POST["medicamentoIndicacionHora-paciente"];
$medicamentoIndicacion->indicaciones  = $_POST["medicamentoIndicaciones-paciente"];
$medicamentoIndicacion->receta = $_POST["medicamentoIndicacionReceta-paciente"];


if($medicamentoIndicacion->insertar()==1){
  echo "Indicaciones registradas";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
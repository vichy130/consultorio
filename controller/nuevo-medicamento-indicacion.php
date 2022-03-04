<?php 
include_once("../models/medicamento-indicacion.php");
$medicamentoIndicacion = new medicamentoIndicacion();

$medicamentoIndicacion->id  = null;
$medicamentoIndicacion->indicaciones  = $_POST["indicacionesmed-paciente"];
$medicamentoIndicacion->consulta  = null;

if($medicamentoIndicacion->insertar()==1){
  echo "Indicaciones registradas";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
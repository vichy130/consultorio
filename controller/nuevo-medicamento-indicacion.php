<?php 
include_once("../models/medicamento-indicacion.php");
$medicamentoIndicacion = new medicamentoIndicacion();

$medicamentoIndicacion->id  = $_POST[""];
$medicamentoIndicacion->indicaciones  = $_POST[""];
$medicamentoIndicacion->consulta  = $_POST[""];

if($medicamentoIndicacion->insertar()==1){
  echo "Indicaciones registradas";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
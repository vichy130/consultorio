<?php 
include_once("../models/consulta-previa.php");
$consultaPrevia = new consultaPrevia(); 

$consultaPrevia->id = null;
$consultaPrevia->comentarios = $_POST["consultapreviacomentarios-paciente"];
$consultaPrevia->diagnostico = $_POST["consultapreviadiagnostico-paciente"];
$consultaPrevia->estudios = $_POST["consultapreviaestudio-paciente"];
$consultaPrevia->tratamiento = $_POST["consultapreviatratamientos-paciente"];
$consultaPrevia->consulta = null;

if($consultaPrevia->insertar()==1){
  echo "Consulta previa registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
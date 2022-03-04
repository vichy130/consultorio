<?php 
include_once("../models/consulta-previa.php");
$consultaPrevia = new consultaPrevia(); 

$consultaPrevia->id = $_POST[""];
$consultaPrevia->comentarios = $_POST[""];
$consultaPrevia->diagnostico = $_POST[""];
$consultaPrevia->estudios = $_POST[""];
$consultaPrevia->tratamiento = $_POST[""];
$consultaPrevia->consulta = $_POST[""];

if($consultaPrevia->insertar()==1){
  echo "Consulta previa registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
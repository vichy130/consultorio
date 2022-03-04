<?php 
include_once("../models/antecedente-familia.php");
$antecedenteFamilia = new antecedenteFamilia();

$antecedenteFamilia->id = $_POST[""];
$antecedenteFamilia->familiar = $_POST[""];
$antecedenteFamilia->comentarios = $_POST[""];
$antecedenteFamilia->ficha = $_POST[""];

if($antecedenteFamilia->insertar()==1){
  echo "Antecedente familia registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
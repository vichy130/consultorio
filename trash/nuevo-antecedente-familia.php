<?php 
include_once("../models/antecedente-familia.php");
$antecedenteFamilia = new antecedenteFamilia();

$antecedenteFamilia->id = null;
$antecedenteFamilia->familiar = $_POST["parentesco-paciente"];
$antecedenteFamilia->comentarios = $_POST["familiarenfermedad-paciente"];
$antecedenteFamilia->ficha = null;

if($antecedenteFamilia->insertar()==1){
  echo "Antecedente familia registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
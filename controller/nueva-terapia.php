<?php 
include_once("../models/terapia.php");
$terapia = new terapia(); 

$terapia->id = null;
$terapia->terapia = $_POST["consultaterapia-paciente"];
$terapia->consulta = null;

if($terapia->insertar()==1){
  echo "Terapia registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
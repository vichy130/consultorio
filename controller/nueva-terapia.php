<?php 
include_once("../models/terapia.php");
$terapia = new terapia(); 

$terapia->id = $_POST[""];
$terapia->terapia = $_POST[""];
$terapia->consulta = $_POST[""];

if($terapia->insertar()==1){
  echo "Terapia registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
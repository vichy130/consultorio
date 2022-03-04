<?php 
include_once("../models/signos-vitales.php");
$signosVitales = new signosVitales(); 

$signosVitales->id = 
$signosVitales->ta = $_POST[""];
$signosVitales->oxigeno = $_POST[""];
$signosVitales->pulso = $_POST[""];
$signosVitales->peso = $_POST[""];
$signosVitales->estatura = $_POST[""];

if($signosVitales->insertar()==1){
  echo "Signos vitales registrados";
  
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
<?php 
include_once("../models/hijo.php");
$hijo = new hijo(); 

$hijo->id  = $_POST[""];
$hijo->sexo  = $_POST[""];
$hijo->edad  = $_POST[""];
$hijo->ficha  = $_POST[""];

if($hijo->insertar()==1){
  echo "Hijo registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
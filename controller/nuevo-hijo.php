<?php 
include_once("../models/hijo.php");
$hijo = new hijo(); 

$hijo->id  = null;
$hijo->sexo  = $_POST["sexo-hijo"];
$hijo->edad  = $_POST["hijoedad-paciente"];
$hijo->ficha  = null;

if($hijo->insertar()==1){
  echo "Hijo registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
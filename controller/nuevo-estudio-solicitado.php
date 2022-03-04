<?php
include_once("../models/estudio-solicitado.php");

$estudioSolicitado = new estudioSolicitado();

$estudioSolicitado->estudio = $_POST["estudiossolicitados-paciente"];
$estudioSolicitado->consulta = null;

if($estudioSolicitado->insertar()==1){
    echo "Registro exitoso de nuevo estudio";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
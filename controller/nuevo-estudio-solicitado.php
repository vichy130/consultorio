<?php
include_once("../models/estudio-solicitado.php");

$estudioSolicitado = new estudioSolicitado();

$estudioSolicitado->estudio = $_POST[""];
$estudioSolicitado->consulta = $_POST[""];

if($estudioSolicitado->insertar()==1){
    echo "Registro exitoso de nuevo estudio";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
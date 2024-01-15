<?php
session_start();
include '../models/consulta.php';
$consulta = new Consulta();
if (isset($_SESSION['id_consulta'])) {
    $consulta->setId($_SESSION['id_consulta']);
    $consulta->obtener();
    $consultaDatos = $consulta->getValues();
}
header('Content-Type: application/json');
$jsonConsulta = json_encode($consultaDatos);
echo $jsonConsulta;
?>
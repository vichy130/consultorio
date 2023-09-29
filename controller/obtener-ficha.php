<?php
session_start();
include '../models/ficha-clinica.php';
$ficha = new Ficha();
if (isset($_SESSION['id_paciente'])) {
    $ficha->setPaciente($_SESSION['id_paciente']);
    $ficha->obtener();
    $fichaDatos=$ficha->getValues();
}
header('Content-Type: application/json');
$jsonFicha = json_encode($fichaDatos);
echo $jsonFicha;
?>
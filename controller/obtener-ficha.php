<?php
session_start();
include '../models/ficha-clinica.php';
$ficha = new Ficha();
$ficha->paciente=$_SESSION["id_paciente"];
$ficha->obtener();
$$datosFicha = [
    'id' => $ficha->getId(),
    'quienRecomendo' => $ficha->getQuienRecomendo(),
    // Agrega otras propiedades que desees incluir
];
header('Content-Type: application/json');
$jsonFicha = json_encode($ficha);
echo $jsonFicha;
?>
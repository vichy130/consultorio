<?php
session_start();
include '../models/consultorio.php';
$consultorio = new Consultorio();
$consultorioDatos;
if (isset($_SESSION['id_con'])) {
    $consultorio->setId($_SESSION['id_con']);
    $consultorio->obtener();
    $consultorioDatos=$consultorio->getValues();
}
header('Content-Type: application/json');
$jsonConsultorio = json_encode($consultorioDatos);
echo $jsonConsultorio;
?>
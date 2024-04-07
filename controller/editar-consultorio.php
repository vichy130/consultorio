<?php
session_start();

include_once("../models/consultorio.php");

$nombre=$_POST['nombre-consultorio'];
$calle=$_POST['calle-consultorio'];
$colonia=$_POST['colonia-consultorio'];
$ciudad=$_POST['ciudad-consultorio'];
$codigoPostal=$_POST['cp-consultorio'];
$telefono=$_POST['telefono-consultorio'];

$consultorio = new Consultorio();
$consultorio->setId($_SESSION['id_con']);
$consultorio->setValues(
    $nombre,
    $calle,
    $colonia,
    $ciudad,
    $codigoPostal,
    $telefono
);
if($consultorio->actualizar()){
    $jsonConsultorio = json_encode($consultorio->getValues());
    header('Content-Type: application/json');
    echo $jsonConsultorio;
}else {
    echo "false";
}


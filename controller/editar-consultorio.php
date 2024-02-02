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
$consultorio->setId($_SESSION['id_consultorio']);
$consultorio->setValues(
    $nombre,
    $calle,
    $colonia,
    $ciudad,
    $codigoPostal,
    $telefono
);
if($consultorio->insertar()){
    return true;
}else {
    echo "Error al editar consultorio";
}


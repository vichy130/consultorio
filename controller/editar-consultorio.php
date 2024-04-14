<?php
session_start();
function redirect($url)
{
    ob_start();
    header('Location:' . $url);
    ob_end_flush();
    die();
}
if (!isset($_SESSION['username'])) {
    redirect("./iniciar-sesion.php");
    exit();
}else{
    if($_SESSION['tipoUsuario']!="A"){
        redirect("./index.php");
        exit();
    }
}
$respuesta;
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


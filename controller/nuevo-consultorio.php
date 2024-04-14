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
include_once ("../models/consultorio.php");
$respuesta;
try {
  $nombre = $_POST["nombre-consultorio"];
  $calle = $_POST["calle-consultorio"];
  $colonia = $_POST["colonia-consultorio"];
  $ciudad = $_POST["ciudad-consultorio"];
  $codigoPostal = $_POST["cp-consultorio"];
  $telefono = $_POST["telefono-consultorio"];
  $consultorio = new consultorio();
  $consultorio->setValues($nombre, $calle, $colonia, $ciudad, $codigoPostal, $telefono);
  $respuesta=$consultorio->insertar();
  $_SESSION['id_med'] = $consultorio->getId();

} catch (PDOException $e) {
  $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
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
}
$pacientes = array();
$respuesta;
include '../models/paciente.php';
include '../php/conexion.php';

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
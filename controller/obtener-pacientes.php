<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
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
include_once '../models/paciente.php';
// include_once (__DIR__ . '/../php/conexion.php');
include_once(__DIR__ ."/../models/conexion.php");

try {
    $query = 'SELECT id FROM paciente; ';
    $con= new Conexion();
    $stmt = $con->getdbh()->prepare($query);
    $stmt->execute();
    while ($lista = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $paciente = new Paciente();
        $paciente->setId($lista['id']);
        $pacientes[]= $paciente->obtener();
    }
    $respuesta=$pacientes;
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
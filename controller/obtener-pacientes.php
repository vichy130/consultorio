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
}
$pacientes = array();
$respuesta;
include '../models/paciente.php';
include '../php/conexion.php';
try {
    $query = 'SELECT id FROM paciente; ';
    $stmt = $dbh->prepare($query);
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
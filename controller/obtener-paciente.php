<?php
session_start();
include '../models/paciente.php';
$respuesta;
try {
    $paciente = new Paciente();
    $pacienteDatos;
    if (isset($_SESSION['id_paciente'])) {
        $paciente->setId($_SESSION['id_paciente']);
        $respuesta = $paciente->obtener();
    } else {
        $respuesta = null;
    }
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
<?php
session_start();
include '../models/ficha-clinica.php';
try {
    $ficha = new Ficha();
    $respuesta;
    if (isset($_SESSION['id_paciente'])) {
        $ficha->setPaciente($_SESSION['id_paciente']);
        $respuesta = $ficha->obtener();
    } 
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
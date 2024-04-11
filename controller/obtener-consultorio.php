<?php
session_start();
include '../models/consultorio.php';
try {
    $consultorio = new Consultorio();
    $respuesta;
    if (isset($_SESSION['id_con'])) {
        $consultorio->setId($_SESSION['id_con']);
        $respuesta = $consultorio->obtener();
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
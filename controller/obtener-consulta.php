<?php
session_start();
include '../models/consulta.php';
$respuesta;
try {
    $consulta = new Consulta();
    $consultaDatos;
    if (isset($_SESSION['id_consulta'])) {
        $consulta->setId($_SESSION['id_consulta']);
        $respuesta = $consulta->obtener();
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
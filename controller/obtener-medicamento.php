<?php
session_start();
include '../models/medicamento.php';
$respuesta;
try {
    $medicamento = new Medicamento();
    if (isset($_SESSION['id_med'])) {
        $medicamento->setId($_SESSION['id_med']);
        $respuesta=$medicamento->obtener();
    }
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
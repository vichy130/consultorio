<?php
session_start();
include_once("../models/paciente.php");
$respuesta;
try {
    $json = json_decode(file_get_contents('php://input'), true);
    if (isset($json['id'])) {
        $id = $json['id'];
        $paciente = new Paciente();
        $paciente->setId($id);
        $respuesta=$paciente->eliminar();
    }
} catch (Exception $e) {
    $respuesta=$e->getMessage();
}
header('Content-Type: application/json');
$jsonrespuesta = json_encode($respuesta);
echo $jsonrespuesta;
?>
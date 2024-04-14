<?php
session_start();
$respuesta;
include_once ("../models/medicamento.php");
try {
    $medicamento = new Medicamento();
    $id = $_SESSION['id_med'];
    $nombre = $_POST['nombre-medicamento'];
    $tipo = $_POST['tipo-medicamento'];
    $descripcion = $_POST['medicamento-descripcion'];

    $medicamento->setId($id);
    $medicamento->setValues($nombre, $tipo, $descripcion);

    $respuesta = $medicamento->actualizar();

} catch (Exception $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonrespuesta = json_encode($respuesta);
echo $jsonrespuesta;

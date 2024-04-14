<?php
session_start();
$medicamentos = array();
$respuesta;
include '../models/medicamento.php';
include '../php/conexion.php';
try {
    $query = 'SELECT id FROM medicamento; ';
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    while ($lista = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $medicamento = new Medicamento();
        $medicamento->setId($lista['id']);
        $medicamentos[] = $medicamento->obtener();
    }
    $respuesta = $medicamentos;
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
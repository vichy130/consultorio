<?php
session_start();
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
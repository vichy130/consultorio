<?php
session_start();
include '../models/paciente.php';
$paciente = new Paciente();
if (isset($_SESSION['id_paciente'])) {
    $paciente->setId($_SESSION['id_paciente']);
    $paciente->obtener();
    $pacienteDatos = $paciente->getValues();
}
header('Content-Type: application/json');
$jsonPaciente = json_encode($pacienteDatos);
echo $jsonPaciente;
?>
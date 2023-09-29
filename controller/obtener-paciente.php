<?php
session_start();
include '../models/paciente.php';
$paciente = new Paciente();
if (isset($_SESSION['id_paciente'])) {
    /*
    $paciente->setPaciente($_SESSION['id_paciente']);*/
    $paciente->obtener();
    $Paciente=$paciente->getValues();
}
header('Content-Type: application/json');
$jsonPaciente = json_encode($pacienteDatos);
echo $jsonPaciente;
?>
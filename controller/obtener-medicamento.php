<?php
session_start();
include '../models/medicamento.php';
$medicamento = new Medicamento();
if (isset($_SESSION['id_med'])) {
    $medicamento->setId($_SESSION['id_med']);
    $medicamento->obtener();
    $medDatos = $medicamento->getValues();
}
header('Content-Type: application/json');
$jsonMedicamento = json_encode($medDatos);
echo $jsonMedicamento;
?>
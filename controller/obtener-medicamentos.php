<?php
session_start();
$pacientes=array();
include '../models/medicamento.php';
include '../php/conexion.php';
$query= 'SELECT id FROM medicamento; ';
$stmt = $dbh->prepare($query);
$stmt->execute();
while($lista = $stmt->fetch(PDO::FETCH_ASSOC)){
    $medicamento=new Medicamento();
    $medicamento->setId($lista['id']);
    $medicamento->obtener();
    $medicamentos[]=$medicamento->getValues();
}
header('Content-Type: application/json');
$jsonMedicamentos = json_encode($medicamentos);
echo $jsonMedicamentos;
?>
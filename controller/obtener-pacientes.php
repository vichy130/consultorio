<?php
session_start();
$pacientes=array();
include '../models/paciente.php';
include '../php/conexion.php';
$query= 'SELECT id FROM paciente; ';
$stmt = $dbh->prepare($query);
$stmt->execute();
while($lista = $stmt->fetch(PDO::FETCH_ASSOC)){
    $paciente=new Paciente();
    $paciente->setId($lista['id']);
    $paciente->obtener();
    $pacientes[]=$paciente->getValues();;
};
header('Content-Type: application/json');
$jsonPacientes = json_encode($pacientes);
echo $jsonPacientes;
?>
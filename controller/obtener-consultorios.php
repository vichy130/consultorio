<?php
session_start();
$consultorios=array();
include '../models/consultorio.php';
include '../php/conexion.php';
$query= 'SELECT id FROM consultorio; ';
$stmt = $dbh->prepare($query);
$stmt->execute();
while($lista = $stmt->fetch(PDO::FETCH_ASSOC)){
    $consultorio=new Consultorio();
    $consultorio->setId($lista['id']);
    $consultorio->obtener();
    $consultorios[]=$consultorio->getValues();
}
header('Content-Type: application/json');
$jsonConsultorios = json_encode($consultorios);
echo $jsonConsultorios;
?>
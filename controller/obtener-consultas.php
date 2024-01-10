<?php
session_start();
$consultas = array();
include '../models/consulta.php';
include '../php/conexion.php';
$query= 'SELECT id FROM consulta; ';
try{
$stmt=$dbh->prepare($query);
$stmt->execute();
while($lista = $stmt->fetch(PDO::FETCH_ASSOC)){
    $consulta=new Consulta();
    $consulta->setId($lista['id']);
    $consulta->obtener();
    $consultas[]=$consulta->getValues();
}
header('Content-Type: application/json');
$jsonConsultas = json_encode($consultas);
echo $jsonConsultas;
}catch(PDOException $e){
    echo "Error al obtener JSON consultas".$e;
}
?>
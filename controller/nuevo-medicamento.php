<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once("../models/medicamento.php");
$medicamento = new Medicamento(); 

$jsonId=$_POST['id'];
$id=json_decode($jsonId);

$med = $_POST["nombre-medicamento"];
$tipo = $_POST["tipo-medicamento"];
$descripcion = $_POST["medicamento-descripcion"];

$medicamento->setId($id);
$medicamento->setValues($med, $tipo, $descripcion);
if($medicamento->insertar()){
  $_SESSION['id_med']=$id;
  $jsonMedicamento = json_encode($medicamento->getValues());
  header('Content-Type: application/json');
  echo $jsonMedicamento;
}else{
  return "false";
}


?>
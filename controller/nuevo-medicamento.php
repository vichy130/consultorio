<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once ("../models/medicamento.php");
$respuesta;
try {
  $medicamento = new Medicamento();

  $jsonId = $_POST['id'];
  $id = json_decode($jsonId);

  $med = $_POST["nombre-medicamento"];
  $tipo = $_POST["tipo-medicamento"];
  $descripcion = $_POST["medicamento-descripcion"];

  $medicamento->setId($id);
  $medicamento->setValues($med, $tipo, $descripcion);
  $respuesta = $medicamento->insertar();

} catch (PDOException $e) {
  $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
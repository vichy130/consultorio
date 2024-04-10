<?php
session_start();
include_once("../models/consultorio.php");
try {
    $json = json_decode(file_get_contents('php://input'), true);
    if (isset($json['id'])) {
        $id = $json['id'];
        $consultorio = new Consultorio();
        $consultorio->setId($id);
        $respuesta=$consultorio->eliminar();
    }
}catch(PDOException $e){
    $respuesta=$e->getMessage();
}
header('Content-Type: application/json');
$jsonrespuesta = json_encode($respuesta);
echo $jsonrespuesta;
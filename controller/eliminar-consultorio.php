<?php
session_start();
function redirect($url)
{
    ob_start();
    header('Location:' . $url);
    ob_end_flush();
    die();
}
if (!isset($_SESSION['username'])) {
    redirect("./iniciar-sesion.php");
    exit();
}
if ($_SESSION['tipoUsuario']!="S"){
    $respuesta="No se cuenta con permisos para eliminar consultorio";
}else{
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
}
header('Content-Type: application/json');
$jsonrespuesta = json_encode($respuesta);
echo $jsonrespuesta;
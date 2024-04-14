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
if (isset($_REQUEST['id'])){
    $_SESSION['id_med']=$_REQUEST['id'];
}
include_once("../models/medicamento.php");
try {
    $json = json_decode(file_get_contents('php://input'), true);
    if (isset($json['id'])) {
        $id = $json['id'];
        $medicamento = new Medicamento();
        $medicamento->setId($id);
        $respuesta=$medicamento->eliminar();
    }
} catch (Exception $e) {
    $respuesta= $e->getMessage();
}
header('Content-Type: application/json');
$jsonrespuesta = json_encode($respuesta);
echo $jsonrespuesta;
?>
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
if ($_SESSION['tipoUsuario']!="A" && $_SESSION['tipoUsuario']!="S"){
    $respuesta="No se tienen permisos para eliminar paciente";
}else{
    include_once("../models/paciente.php");
    $respuesta;
    try {
        $json = json_decode(file_get_contents('php://input'), true);
        if (isset($json['id'])) {
            $id = $json['id'];
            $paciente = new Paciente();
            $paciente->setId($id);
            $respuesta=$paciente->eliminar();
        }
    } catch (Exception $e) {
        $respuesta=$e->getMessage();
    }
}
    // echo $respuesta;
    header('Content-Type: application/json');
    $jsonrespuesta = json_encode($respuesta);
    echo $jsonrespuesta;
?>
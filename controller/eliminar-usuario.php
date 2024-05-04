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
$respuesta;
if ($_SESSION['tipoUsuario']!="A" && $_SESSION['tipoUsuario']!="S"){
    $respuesta="No se tiene permisos para eliminar consulta";
}else{

include_once("../models/usuario.php");
try {
    $json = json_decode(file_get_contents('php://input'), true);
    if (isset($json['id'])) {
        $username= $json['id'];
        $usuario = new Usuario();
        $usuario->setUsername($username);
        $respuesta=$usuario->eliminar();
    }
} catch (Exception $e) {
    $respuesta= $e->getMessage();
}
}
header('Content-Type: application/json');
$jsonrespuesta = json_encode($respuesta);
echo $jsonrespuesta;
?>
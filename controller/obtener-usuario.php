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
}else{
    if($_SESSION['tipoUsuario']!="A"){
        redirect("./index.php");
        exit();
    }
}
include '../models/usuario.php';
$respuesta;
try {
    $usuario = new Usuario();
    if (isset($_SESSION['id_usuario'])) {
        $usuario->setUsername($_SESSION['id_usuario']);
        $respuesta=$usuario->obtener();
    }else {
        $respuesta = null;
    }
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
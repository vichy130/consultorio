<?php
session_start();
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
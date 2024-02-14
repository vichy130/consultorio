<?php
session_start();
include '../models/usuario.php';
$usuario = new Usuario();
if (isset($_SESSION['id_usuario'])) {
    $usuario->setUsername($_SESSION['id_usuario']);
    $usuario->obtener();
    $usuarioDatos = $usuario->getValues();
}
header('Content-Type: application/json');
$jsonUsuario = json_encode($usuarioDatos);
echo $jsonUsuario;
?>
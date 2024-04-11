<?php
session_start();
include '../models/usuario.php';
$respuesta;
try {
    $username = $_POST['username'];
    $password = $_POST['contrasena'];
    $usuario = new Usuario();
    $usuario->setUsername($username);
    $usuario->setContrasena($password);
    if ($usuario->validar()) {
        $_SESSION['username'] = $usuario->getUsername();
        $_SESSION['nombre'] = $usuario->getNombre();
        $_SESSION['apellidoPaterno'] = $usuario->getApellidoPaterno();
        $_SESSION['apellidoMaterno'] = $usuario->getApellidoMaterno();
        $_SESSION['tipoUsuario'] = $usuario->getTipoUsuario();
        $respuesta = $usuario->getValues();
    }
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
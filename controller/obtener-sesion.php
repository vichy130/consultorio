<?php
session_start();
include '../models/usuario.php';
$username = $_POST['username'];
$password = $_POST['contrasena'];
$usuario = new Usuario();
$usuario->setUsername($username);
$usuario->setContrasena($password);
if ($usuario->validar()) {
    $usuarioDatos = $usuario->getValues();
    $_SESSION['username'] = $usuario->getUsername();
    $_SESSION['nombre'] = $usuario->getNombre();
    $_SESSION['apellidoPaterno'] = $usuario->getApellidoPaterno();
    $_SESSION['apellidoMaterno'] = $usuario->getApellidoMaterno();
    // header('Content-Type: application/json');
    // $jsonUsuario = json_encode($usuarioDatos);
    // echo $jsonUsuario;
    echo "true";
} else {
    echo "false";
}


?>
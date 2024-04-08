<?php
session_start();
include '../models/usuario.php';
$username = $_POST['username'];
$password = $_POST['contrasena'];
$usuario = new Usuario();
$usuario->setUsername($username);
$usuario->setContrasena($password);
if ($usuario->validar()) {
    $_SESSION['username']=$usuario->getUsername();
    $usuarioDatos = $usuario->getValues();
    header('Content-Type: application/json');
    $jsonUsuario = json_encode($usuarioDatos);
    echo $jsonUsuario;
}else{
    echo "false";
}


?>
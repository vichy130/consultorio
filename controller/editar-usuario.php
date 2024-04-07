<?php
session_start();
include_once("../models/usuario.php");

$username = $_POST['username-usuario'];
$nombre = $_POST['nombre-usuario'];
$apellidoPaterno = $_POST['apellidoPaterno-usuario'];
$apellidoMaterno = $_POST['apellidoMaterno-usuario'];
$telefono = $_POST['telefono-usuario'];
$correo = $_POST['correo-usuario'];
$contrasena = $_POST['contrasena-usuario'];
$tipoUsuario = $_POST['tipo-usuario'];
$usuario = new Usuario();
$usuario->setUsername($username);
$usuario->setValues($nombre, $apellidoPaterno, $apellidoMaterno, $telefono, $correo, $tipoUsuario);

if ($usuario->actualizar()) {
    $jsonUsuario = json_encode($usuario->getValues());
    header('Content-Type: application/json');
    echo $jsonUsuario;
} else {
    echo "false";
}
?>
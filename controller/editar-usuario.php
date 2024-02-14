<?php
session_start();
include_once("../models/usuario.php");

$username = $_SESSION['id_usuario'];
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
    echo "usuario actualizado";
} else {
    echo "Error al actualizar usuario";
}


?>
<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once("../models/usuario.php");

$username = $_POST['username-usuario'];
$nombre = $_POST['nombre-usuario'];
$apellidoPaterno = $_POST['apellidoPaterno-usuario"'];
$apellidoMaterno = $_POST['apellidoMaterno-usuario'];
$telefono = $_POST['telefono-usuario'];
$correo = $_POST['correo-usuario'];
$contrasena = $_POST['contrasena-usuario'];
$tipoUsuario = $_POST['tipo-usuario'];

$usuario = new Usuario();
$usuario->setId($username);
$usuario->setValues($nombre, $apellidoPaterno, $apellidoMaterno, $telefono, $correo, $contrasena, $tipoUsuario);
if ($usuario->actualizar()) {
    echo "usuario actualizado";
} else {
    echo "Error al actualizar usuario";
}



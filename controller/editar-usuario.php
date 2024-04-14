<?php
session_start();
include_once ("../models/usuario.php");
$respuesta;
try {
    $username = $_POST['username-usuario'];
    $nombre = $_POST['nombre-usuario'];
    $apellidoPaterno = $_POST['apellidoPaterno-usuario'];
    $apellidoMaterno = $_POST['apellidoMaterno-usuario'];
    $telefono = $_POST['telefono-usuario'];
    $correo = $_POST['correo-usuario'];
    $contrasena = $_POST['contrasena-usuario'];
    $contrasenaDos=$_POST['contrasena-usuario2'];
    $tipoUsuario = $_POST['tipo-usuario'];
    $usuario = new Usuario();
    $usuario->setUsername($username);
    $usuario->setValues($nombre, $apellidoPaterno, $apellidoMaterno, $telefono, $correo, $tipoUsuario);

    if($contrasena==$contrasenaDos && $contrasena!=null){
        $usuario->setContrasena($contrasena);
        $usuario->actualizarContrasena();
    }
    $respuesta=$usuario->actualizar();
    
} catch (Exception $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonrespuesta = json_encode($respuesta);
echo $jsonrespuesta;

?>
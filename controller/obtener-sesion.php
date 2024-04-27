<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

include '../models/usuario.php';
$username;
$password;
$respuesta;
$validate;
try {
    $username = $_POST['username'];
    $password = $_POST['contrasena'];
    $usuario = new Usuario();
    $usuario->setUsername($username);
    $usuario->setContrasena($password);
    $respuesta=$usuario->validar();
    if($respuesta===true){
        $_SESSION['username'] = $usuario->getUsername();
        $_SESSION['nombre'] = $usuario->getNombre();
        $_SESSION['apellidoPaterno'] = $usuario->getApellidoPaterno();
        $_SESSION['apellidoMaterno'] = $usuario->getApellidoMaterno();
        $_SESSION['tipoUsuario'] = $usuario->getTipoUsuario();
    }
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
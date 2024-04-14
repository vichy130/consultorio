<?php
session_start();
function redirect($url)
{
    ob_start();
    header('Location:' . $url);
    ob_end_flush();
    die();
}
if (!isset($_SESSION['username'])) {
    redirect("./iniciar-sesion.php");
    exit();
}
include '../models/usuario.php';
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
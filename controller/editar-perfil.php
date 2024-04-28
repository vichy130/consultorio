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
include_once ("../models/usuario.php");
$respuesta;
try {
    $username = $_SESSION['username'];
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
    if($_POST['especialidad-usuario']!=null && $_POST['universidad-usuario'] && $_POST['cedula-usuario']){
        $especialidad=$_POST['especialidad-usuario'];
        $universidad= $_POST['universidad-usuario'];
        $cedula=$_POST['cedula-usuario'];
        $usuario->setValuesMedico($especialidad, $universidad, $cedula);
    }

    if($contrasena==$contrasenaDos && $contrasena!=null){
        $usuario->setContrasena($contrasena);
        $usuario->actualizarContrasena();
    }
    $respuesta=$usuario->actualizarPerfil();
    
} catch (Exception $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonrespuesta = json_encode($respuesta);
echo $jsonrespuesta;

?>
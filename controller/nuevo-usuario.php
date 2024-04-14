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
}else{
    if($_SESSION['tipoUsuario']!="A"){
        redirect("./index.php");
        exit();
    }
}
include_once ("../models/usuario.php");
$respuesta;
try {
  $usuario = new usuario();
  $username = $_POST["username-usuario"];
  $nombre = $_POST["nombre-usuario"];
  $apellidoPaterno = $_POST["apellidoPaterno-usuario"];
  $apellidoMaterno = $_POST["apellidoMaterno-usuario"];
  $telefono = $_POST["telefono-usuario"];
  $correo = $_POST["correo-usuario"];
  $contrasena = $_POST["contrasena-usuario"];
  $tipoUsuario = $_POST["tipo-usuario"];
  $usuario->setUsername($username);
  $usuario->setValues($nombre, $apellidoPaterno, $apellidoMaterno, $telefono, $correo, $tipoUsuario);
  $usuario->setContrasena($contrasena);
  $respuesta = $usuario->insertar();

} catch (PDOException $e) {
  $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
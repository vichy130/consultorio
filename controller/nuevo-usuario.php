<?php 
session_start();
include_once("../models/usuario.php");
$usuario = new usuario(); //Creamos al objeto
//llenar al objeto con los valores del formulario

$username = $_POST["username-usuario"];
$nombre = $_POST["nombre-usuario"];
$apellidoPaterno = $_POST["apellidoPaterno-usuario"];
$apellidoMaterno = $_POST["apellidoMaterno-usuario"];
$telefono = $_POST["telefono-usuario"];
$correo = $_POST["correo-usuario"];
$contrasena = $_POST["contrasena-usuario"];
$tipoUsuario = $_POST["tipo-usuario"];
$usuario->setUsername($username);
$usuario->setValues($nombre,$apellidoPaterno,$apellidoMaterno,$telefono,$correo,$tipoUsuario);
$usuario->setContrasena($contrasena);

if($usuario->insertar()==1){
  echo "Usuario registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
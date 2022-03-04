<?php 
include_once("../models/usuario.php");
$usuario = new usuario(); //Creamos al objeto
//llenar al objeto con los valores del formulario

$usuario->username = $_POST["username-usuario"];
$usuario->apellidoPaterno = $_POST["apellidoPaterno-usuario"];
$usuario->apellidoMaterno = $_POST["apellidoMaterno-usuario"];
$usuario->telefono = $_POST["telefono-usuario"];
$usuario->correo = $_POST["correo-usuario"];
$usuario->contrasena = $_POST["contrasena-usuario"];
$usuario->tipoUsuario = $_POST["tipo-usuario"];

if($usuario->insertar()==1){
  echo "Usuario registrado";
}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
<?php
session_start();
$array=array();
$respuesta=array();
if(isset($_SESSION['username'])){
    $array['username']=$_SESSION['username'] ;
    $array['nombre']=$_SESSION['nombre'] ;
    $array['apellidoPaterno']=$_SESSION['apellidoPaterno'];
    $array['apellidoMaterno']=$_SESSION['apellidoMaterno'];
    $array['tipoUsuario']=$_SESSION['tipoUsuario'] ;
    $respuesta=$array;
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
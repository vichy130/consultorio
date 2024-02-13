<?php
session_start();
$usuarios=array();
include '../models/usuario.php';
include '../php/conexion.php';
$query= 'SELECT username FROM usuario; ';
$stmt = $dbh->prepare($query);
$stmt->execute();
while($lista = $stmt->fetch(PDO::FETCH_ASSOC)){
    $usuario=new Usuario();
    $usuario->setUsername($lista['username']);
    $usuario->obtener();
    $usuarios[]=$usuario->getValues();
}
header('Content-Type: application/json');
$jsonUsuarios = json_encode($usuarios);
echo $jsonUsuarios;
?>
<?php
session_start();
$usuarios = array();
include '../models/usuario.php';
include '../php/conexion.php';
try {
    $query = 'SELECT username FROM usuario; ';
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    while ($lista = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $usuario = new Usuario();
        $usuario->setUsername($lista['username']);
        $usuarios[] = $usuario->obtener();
    }
    $respuesta = $usuarios;
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
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
    if($_SESSION['tipoUsuario']!="S"){
        redirect("./index.php");
        exit();
    }
}
$usuarios = array();
include '../models/usuario.php';
include_once(__DIR__ ."/../models/conexion.php");

$con= new Conexion();
try {
    $query = 'SELECT username FROM usuario; ';
    $stmt = $con->getdbh()->prepare($query);
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
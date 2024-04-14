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
include '../models/medicamento.php';
$respuesta;
try {
    $medicamento = new Medicamento();
    if (isset($_SESSION['id_med'])) {
        $medicamento->setId($_SESSION['id_med']);
        $respuesta=$medicamento->obtener();
    }
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
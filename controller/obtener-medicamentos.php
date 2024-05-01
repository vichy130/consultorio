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
$medicamentos = array();
$respuesta;
include '../models/medicamento.php';
include_once(__DIR__ ."/../models/conexion.php");
$con= new Conexion();
try {
    $query = 'SELECT id FROM medicamento order by medicamento asc; ';
    $stmt = $con->getdbh()->prepare($query);
    $stmt->execute();
    while ($lista = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $medicamento = new Medicamento();
        $medicamento->setId($lista['id']);
        $medicamentos[] = $medicamento->obtener();
    }
    $respuesta = $medicamentos;
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
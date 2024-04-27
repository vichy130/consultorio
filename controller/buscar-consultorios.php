<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
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
$consultorios = array();
$respuesta = array();
include '../models/consultorio.php';
include_once(__DIR__ ."/../models/conexion.php");
$con= new Conexion();

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$queries = [
    "SELECT id from consultorio where calle like concat('%',:palabra1,'%')  OR colonia LIKE concat('%',:palabra1,'%') or ciudad like concat('%',:palabra1,'%') ",
    "UNION SELECT id from consultorio where calle like concat('%',:palabra2,'%')  OR colonia LIKE concat('%',:palabra2,'%') or ciudad like concat('%',:palabra2,'%') ",
    "UNION SELECT id from consultorio where calle like concat('%',:palabra3,'%')  OR colonia LIKE concat('%',:palabra3,'%') or ciudad like concat('%',:palabra3,'%') ",
    "UNION SELECT id from consultorio where calle like concat('%',:palabra4,'%')  OR colonia LIKE concat('%',:palabra4,'%') or ciudad like concat('%',:palabra4,'%') ",
    "UNION SELECT id from consultorio where calle like concat('%',:palabra5,'%')  OR colonia LIKE concat('%',:palabra5,'%') or ciudad like concat('%',:palabra5,'%') ",
];
$palabra = array(
    ":palabra1",
    ":palabra2",
    ":palabra3",
    ":palabra4",
    ":palabra5"
);

$query = "SELECT id from ( ";

for ($i = 0; $i < count($data); $i++) {
    $query .= $queries[$i];
}
$query .= ") as busqueda order by id asc; ";

try {
    $stmt = $con->getdbh()->prepare($query);
    for ($i = 0; $i < count($data); $i++) {
        $stmt->bindParam($palabra[$i], $data[$i]);
    }
    $stmt->execute();
    while ($datos = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $consultorio = new Consultorio();
        $consultorio->setId($datos['id']);
        $consultorio->obtener();
        $consultorios[] = $consultorio->getValues();
    }
    $respuesta = $consultorios;
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}

header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
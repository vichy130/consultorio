<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
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
$usuarios = array();
$respuesta = array();
include '../models/usuario.php';
include_once(__DIR__ ."/../models/conexion.php");
$con= new Conexion();

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$queries = [
    "SELECT username from usuario where nombre like concat('%',:palabra1,'%')  OR apellidoPaterno LIKE concat('%',:palabra1,'%') or apellidoMaterno like concat('%',:palabra1,'%') ",
    "UNION SELECT username from usuario where nombre like concat('%',:palabra2,'%')  OR apellidoPaterno LIKE concat('%',:palabra2,'%') or apellidoMaterno like concat('%',:palabra2,'%') ",
    "UNION SELECT username from usuario where nombre like concat('%',:palabra3,'%')  OR apellidoPaterno LIKE concat('%',:palabra3,'%') or apellidoMaterno like concat('%',:palabra3,'%') ",
    "UNION SELECT username from usuario where nombre like concat('%',:palabra4,'%')  OR apellidoPaterno LIKE concat('%',:palabra4,'%') or apellidoMaterno like concat('%',:palabra4,'%') ",
    "UNION SELECT username fromusuario where nombre like concat('%',:palabra5,'%')  OR apellidoPaterno LIKE concat('%',:palabra5,'%') or apellidoMaterno like concat('%',:palabra5,'%') ",
];
$palabra = array(
    ":palabra1",
    ":palabra2",
    ":palabra3",
    ":palabra4",
    ":palabra5"
);

$query = "SELECT username from ( ";

for ($i = 0; $i < count($data); $i++) {
    $query .= $queries[$i];
}
$query .= ") as busqueda order by username asc; ";

try {
    $stmt = $con->getdbh()->prepare($query);
    for ($i = 0; $i < count($data); $i++) {
        $stmt->bindParam($palabra[$i], $data[$i]);
    }
    $stmt->execute();
    while ($datos = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $usuario = new Usuario();
        $usuario->setUsername($datos['username']);
        $usuario->obtener();
        $usuarios[] = $usuario->getValues();
    }
    $respuesta = $usuarios;
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}

header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
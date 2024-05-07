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
$medicamentos = array();
$respuesta=array();
include '../models/medicamento.php';
include_once(__DIR__ ."/../models/conexion.php");
$con= new Conexion();

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$queries=[
    "SELECT id from medicamento where medicamento like concat('%',:palabra1,'%')  OR tipo LIKE concat('%',:palabra1,'%') or descripcion like concat('%',:palabra1,'%') ", 
   "UNION SELECT id from medicamento where medicamento like concat('%',:palabra2,'%')  OR tipo LIKE concat('%',:palabra2,'%') or descripcion like concat('%',:palabra2,'%') ",
   "UNION SELECT id from medicamento where  medicamento like concat('%',:palabra3,'%')  OR tipo LIKE concat('%',:palabra3,'%') or descripcion like concat('%',:palabra3,'%') ", 
   "UNION SELECT id from  medicamento where  medicamento like concat('%',:palabra4,'%')  OR tipo LIKE concat('%',:palabra4,'%') or descripcion like concat('%',:palabra4,'%') ", 
   "UNION SELECT id from  medicamento where  medicamento like concat('%',:palabra5,'%')  OR tipo LIKE concat('%',:palabra5,'%') or descripcion like concat('%',:palabra5,'%') ", 
];
$palabra=array(
    ":palabra1", ":palabra2", ":palabra3", ":palabra4", ":palabra5"
);

$query= "SELECT id from ( ";

for($i=0;$i<count($data);$i++){
    $query.=$queries[$i];
}
$query.=") as busqueda order by id asc; ";

try{
    $stmt=$con->getdbh()->prepare($query);
    for($i=0;$i<count($data);$i++){
        $stmt->bindParam($palabra[$i],$data[$i] );
    }
    $stmt->execute();
    while($datos = $stmt->fetch(PDO::FETCH_ASSOC)){
        $medicamento= new Medicamento();
        $medicamento->setId($datos['id']);
        $medicamento->obtener();
        $medicamentos[]=$medicamento->getValues();
    }
    $respuesta=$medicamentos;
} catch(PDOException $e){
    $respuesta=$e->getMessage();
}

header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
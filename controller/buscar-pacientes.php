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
$pacientes = array();
$respuesta=array();
include '../models/paciente.php';
include_once(__DIR__ ."/../models/conexion.php");
$con= new Conexion();

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);


// $query="SELECT DISTINCT * FROM (";
// $nombre='%'.$data[0].'%';
// $nombre2='%'.$data[1].'%';
// $query = "SELECT DISTINCT id FROM paciente WHERE nombre LIKE  :nombre OR apellidoPaterno LIKE :nombre or apellidoMaterno like :nombre; ";

// $query= "SELECT id from (select id from paciente where nombre like :nombre  OR apellidoPaterno LIKE :nombre or apellidoMaterno like :nombre UNION select id from paciente where nombre like :nombre2 OR apellidoPaterno LIKE :nombre2 or apellidoMaterno like :nombre2) as busqueda order by id asc";

$queries=[
    "SELECT id from paciente where nombre like concat('%',:palabra1,'%')  OR apellidoPaterno LIKE concat('%',:palabra1,'%') or apellidoMaterno like concat('%',:palabra1,'%') ", 
   "UNION SELECT id from paciente where nombre like concat('%',:palabra2,'%')  OR apellidoPaterno LIKE concat('%',:palabra2,'%') or apellidoMaterno like concat('%',:palabra2,'%') ",
   "UNION SELECT id from paciente where nombre like concat('%',:palabra3,'%')  OR apellidoPaterno LIKE concat('%',:palabra3,'%') or apellidoMaterno like concat('%',:palabra3,'%') ", 
   "UNION SELECT id from paciente where nombre like concat('%',:palabra4,'%')  OR apellidoPaterno LIKE concat('%',:palabra4,'%') or apellidoMaterno like concat('%',:palabra4,'%') ", 
   "UNION SELECT id from paciente where nombre like concat('%',:palabra5,'%')  OR apellidoPaterno LIKE concat('%',:palabra5,'%') or apellidoMaterno like concat('%',:palabra5,'%') ", 
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
        $paciente= new Paciente();
        $paciente->setId($datos['id']);
        $paciente->obtener();
        $pacientes[]=$paciente->getValues();
    }
    $respuesta=$pacientes;
} catch(PDOException $e){
    $respuesta=$e->getMessage();
}

header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
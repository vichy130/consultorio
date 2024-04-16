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
// else{
//     if($_SESSION['tipoUsuario']!="A"){
//         redirect("./index.php");
//         exit();
//     }
// }
$consultorios=array();
$respuesta;
include '../models/consultorio.php';
include '../php/conexion.php';
try {
$query= 'SELECT id FROM consultorio; ';
$stmt = $dbh->prepare($query);
$stmt->execute();
while($lista = $stmt->fetch(PDO::FETCH_ASSOC)){
    $consultorio=new Consultorio();
    $consultorio->setId($lista['id']);
    $consultorios[]=$consultorio->obtener();
}
 $respuesta=$consultorios;
}catch (PDOException $e) {
    $respuesta= $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
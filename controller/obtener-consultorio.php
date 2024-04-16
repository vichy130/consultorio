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
//    else{
//     if($_SESSION['tipoUsuario']!="A"){
//         redirect("./index.php");
//         exit();
//     }
// }
include '../models/consultorio.php';
try {
    $consultorio = new Consultorio();
    $respuesta;
    if (isset($_SESSION['id_con'])) {
        $consultorio->setId($_SESSION['id_con']);
        $respuesta = $consultorio->obtener();
    } else {
        $respuesta = null;
    }
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
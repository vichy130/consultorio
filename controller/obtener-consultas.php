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
$consultas = array();
$jsonConsultas;
$respuesta;
$jsonRespuesta;
$valor_consulta;
include '../models/consulta.php';
include '../php/conexion.php';
$query = 'SELECT id FROM consulta; ';
try {
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    while ($lista = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $consulta = new Consulta();
        $consulta->setId($lista['id']);
        $valor_consulta=$consulta->obtener();
        if($valor_consulta==true){
            if ($_SESSION["id_paciente"] == $consulta->getPaciente()) {
                $consultas[] = $consulta->getValues();
            }
        }else{
            $consultas[]=$valor_consulta;
        }
    }
    $respuesta=$consultas;
} catch (PDOException $e) {
    $respuesta= $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
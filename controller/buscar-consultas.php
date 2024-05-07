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
$consultas = array();
$jsonConsultas;
$respuesta;
$jsonRespuesta;
$valor_consulta;
include '../models/consulta.php';
include_once(__DIR__ ."/../models/conexion.php");

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if (isset($data['fecha'])) {
    $fecha = $data['fecha'];
    $paciente = $_SESSION['id_paciente'];
    $query = "SELECT * FROM consulta where paciente=:paciente and fecha=:fecha order by fecha desc; ";
    try {
        $con= new Conexion();
        $stmt = $con->getdbh()->prepare($query);
        $stmt->bindParam(":paciente", $paciente);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->execute();
        while ($datos = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $datos["id"];
            $fecha = $datos["fecha"];
            $usuario = $datos["usuario"];
            $paciente = $datos["paciente"];
            $ta = $datos["ta"];
            $oxigeno = $datos["oxigeno"];
            $pulso = $datos["pulso"];
            $peso = $datos["peso"];
            $estatura = $datos["estatura"];
            $temperatura = $datos["temperatura"];
            $motivoConsulta = $datos["motivoConsulta"];
            $exploracion = $datos["exploracion"];
            $indicaciones = $datos["indicaciones"];
            $receta = $datos["receta"];
            $consultorio = $datos["consultorio"];

            $consulta = new Consulta();
            $consulta->setValues(
                $fecha,
                $usuario,
                $paciente,
                $ta,
                $oxigeno,
                $pulso,
                $peso,
                $estatura,
                $temperatura,
                $motivoConsulta,
                $exploracion,
                $indicaciones,
                $receta,
                $consultorio
            );
            $consulta->setId($id);
            $consultas[] = $consulta->getValues();
        }
        $respuesta = $consultas;
    } catch (PDOException $e) {
        $respuesta = $e->getMessage();
    }
}

header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
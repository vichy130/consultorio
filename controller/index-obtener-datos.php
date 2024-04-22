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
include_once '../models/paciente.php';
include_once '../models/consulta.php';
include_once '../models/medicamento.php';
$respuesta;
try {
    $paciente = new Paciente();
    $respuesta ['pacientes']= $paciente->countPacientes();
} catch (PDOException $e) {
    $respuesta['pacientes']= $e->getMessage();
}

try {
    $consulta = new Consulta();
    $respuesta ['consultas']= $consulta->countConsultas();
} catch (PDOException $e) {
    $respuesta['consultas']= $e->getMessage();
}

try {
    $medicamento = new Medicamento();
    $respuesta ['medicamentos']= $medicamento->countMedicamentos();
} catch (PDOException $e) {
    $respuesta['medicamentos']= $e->getMessage();
}

header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
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

// error_reporting(E_ALL);
// ini_set('display_errors', '1');
include_once ("../models/consulta.php");
include_once ("../models/receta.php");
$consulta = new consulta();
$receta = new Receta();
$respuesta;
try {
    /*$jsonConsultaId= $_POST['consultaId'];
    $consultaId=json_decode($jsonConsultaId);*/

    $jsonConsultasPrevias = $_POST['jsonConsultasPrevias'];
    $consultasP = json_decode($jsonConsultasPrevias);

    $jsonTerapiasAplicadas = $_POST['jsonTerapiasAplicadas'];
    $terapiasAplicadas = json_decode($jsonTerapiasAplicadas);

    $jsonEstudiosSolicitados = $_POST['jsonEstudiosSolicitados'];
    $estudiosSolicitados = json_decode($jsonEstudiosSolicitados);

    $jsonMedicamentoIndicaciones = $_POST['jsonMedicamentoIndicaciones'];
    $medicamentoIndicaciones = json_decode($jsonMedicamentoIndicaciones);

    $fecha = $_POST['oculto-fecha-consulta'];
    $usuario = $_SESSION['username'];
    $paciente = $_SESSION["id_paciente"];
    $ta = $_POST["vitalesta-paciente"];
    $oxigeno = $_POST["vitalesoxigeno-paciente"];
    $pulso = $_POST["vitalespulso-paciente"];
    $peso = $_POST["vitalespeso-paciente"];
    $estatura = $_POST["vitalesestatura-paciente"];
    $temperatura = $_POST["vitalestemperatura-paciente"];
    $motivoConsulta = $_POST['consultamotivo-paciente'];
    $exploracion = $_POST['consultaexploracion-paciente'];
    $indicaciones = $_POST['consultaindicaciones-paciente'];
    $consultorio = $_POST['select-consultorio'];

    $consulta->setId($_SESSION['id_consulta']);
    $receta = $consulta->getReceta();
    // echo $_SESSION['id_consulta'];
// echo $receta;
    $consulta->setValues($fecha, $usuario, $paciente, $ta, $oxigeno, $pulso, $peso, $estatura, $temperatura, $motivoConsulta, $exploracion, $indicaciones, $receta, $consultorio);

    $respuesta=$consulta->actualizar($consultasP, $estudiosSolicitados, $medicamentoIndicaciones,$terapiasAplicadas);

} catch (Exception $e) {
    $respuesta = $e->getMessage();
}
header('Content-Type: application/json');
$jsonrespuesta = json_encode($respuesta);
echo $jsonrespuesta;
?>
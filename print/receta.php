<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
function redirect($url)
{
    ob_start();
    header('Location:' . $url);
    ob_end_flush();
    die();
}
session_start();
if (!isset($_SESSION['username'])) {
    redirect("./iniciar-sesion.php");
    exit();
}
// if ($_SESSION['tipoUsuario'] != 'M') {
//     exit();
// }
include '../models/consulta.php';
include '../models/paciente.php';
include '../models/medicamento.php';
include '../models/usuario.php';
include '../models/consultorio.php';
include './models/Receta.php';
include '../php/conexion.php';

$consulta = new Consulta();
$paciente = new Paciente();
$medicamentos = array();
$usuario = new Usuario();
$consultorio = new Consultorio();
$consultaDatos;

$query = 'SELECT id FROM medicamento; ';
$stmt = $dbh->prepare($query);
$stmt->execute();

while ($lista = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $medicamento = new Medicamento();
    $medicamento->setId($lista['id']);
    $medicamento->obtener();
    $medicamentos[] = $medicamento->getValues();
}

if (isset($_SESSION['id_consulta'])) {
    $consulta->setId($_SESSION['id_consulta']);
    $consulta->obtener();
    $consultaDatos = $consulta->getValues();
    if ($consultaDatos['paciente'] != null) {
        $paciente->setId($consultaDatos['paciente']);
        $paciente->obtener();
    }
    if ($consultaDatos['consultorio'] != null) {
        $consultorio->setId($consultaDatos['consultorio']);
        $consultorio->obtener();
    }
        // $usuario->setUsername($consulta->getUsuario());
        // $usuario->obtener();
}

$receta = new Receta();
$receta->AliasNbPages();
$receta->AddPage('P', 'Letter');
$receta->setConsulta($consultaDatos);
$receta->setPaciente($paciente->getApellidoPaterno(), $paciente->getApellidoMaterno(), $paciente->getNombre());
// $receta->setUsuario($usuario->getValues());
$receta->setArrayMedicamentos($medicamentos);
$receta->cuerpo();
$receta->Output();
?>
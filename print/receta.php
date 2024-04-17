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

include '../models/consulta.php';
include '../models/paciente.php';
include '../models/medicamento.php';
include '../models/usuario.php';
include '../models/consultorio.php';
include './models/Receta.php';
include '../php/conexion.php';

try {
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
            $consultorioDatos = $consultorio->getValues();
        }
        $usuario->setUsername($consultaDatos['usuario']);
        $usuario->obtener();
        $usuarioDatos = $usuario->getValues();

        $receta = new Receta();

        $receta->setUsuario($usuarioDatos['nombre'], $usuarioDatos['apellidoPaterno'], $usuarioDatos['apellidoMaterno'], $usuarioDatos['especialidad'], $usuarioDatos['universidad'], $usuarioDatos['cedula'], $usuarioDatos['telefono']);

        $receta->setConsultorio($consultorioDatos['calle'], $consultorioDatos['colonia'], $consultorioDatos['ciudad'], $consultorioDatos['codigoPostal']);

        // Define el tamaño HalfLetter en puntos (396x612)
        define('HALFLETTER_WIDTH', 139.7);
        define('HALFLETTER_HEIGHT', 215.9);

        // Agrega una página con el tamaño HalfLetter
        
        if ($_REQUEST['size']=="carta"){
            $receta->setTamano("carta");
            $receta->AddPage('P', 'Letter');
        }else {
            $receta->setTamano('media');
            $receta->AddPage('L', array(HALFLETTER_WIDTH, HALFLETTER_HEIGHT));
           
        }
        $receta->AliasNbPages();
        $receta->setConsulta($consultaDatos);
        $receta->setPaciente($paciente->getNombre(), $paciente->getApellidoPaterno(), $paciente->getApellidoMaterno());
        $receta->setArrayMedicamentos($medicamentos);
        $receta->cuerpo();
        $receta->Output();
    } else {

        $error = new FPDF();
        $error->AddPage();
        $error->SetFont('Arial', '', 12);
        $error->Cell(0, 10, "No existe una consulta seleccionada.", 0, 1);
        $error->Output();
    }

} catch (Exception $e) {
    // Manejo de excepciones: Imprimir mensaje personalizado con FPDF
    require ('./fpdf/fpdf.php');

    class ErrorFPDF extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, 'Error al generar el PDF', 0, 1, 'C');
        }

        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
    }

    $pdf = new ErrorFPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Error: ' . $e->getMessage(), 0, 1);
    $pdf->Output();
}



/*
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
        $consultorioDatos=$consultorio->getValues();

    }
        $usuario->setUsername($consultaDatos['usuario']);
        $usuario->obtener();
        $usuarioDatos=$usuario->getValues();
}

$receta = new Receta();

$receta->setUsuario($usuarioDatos['nombre'], $usuarioDatos['apellidoPaterno'], $usuarioDatos['apellidoMaterno'],$usuarioDatos['especialidad'],$usuarioDatos['universidad'], $usuarioDatos['cedula'], $usuarioDatos['telefono']);

$receta->setConsultorio($consultorioDatos['calle'],$consultorioDatos['colonia'],$consultorioDatos['ciudad'],$consultorioDatos['codigoPostal'] );

$receta->AliasNbPages();
$receta->AddPage('P', 'Letter');
$receta->setConsulta($consultaDatos);
$receta->setPaciente($paciente->getNombre(),$paciente->getApellidoPaterno(), $paciente->getApellidoMaterno() );
$receta->setArrayMedicamentos($medicamentos);
$receta->cuerpo();
$receta->Output();
?>*/
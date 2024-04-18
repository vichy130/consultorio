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
$respuesta;
if (!isset($_SESSION['username'])) {
    redirect("./iniciar-sesion.php");
    exit();
}
if (!isset($_SESSION['id_consulta'])) {
    $respuesta = "id_consulta";
}
include '../models/consulta.php';
include '../models/paciente.php';
include '../models/medicamento.php';
include '../models/usuario.php';
include '../models/consultorio.php';
include '../print/models/Receta.php';
include '../php/conexion.php';
$consulta = new Consulta();
$paciente = new Paciente();
$medicamentos = array();
$usuario = new Usuario();
$consultorio = new Consultorio();
$consultaDatos;
$usuarioDatos;
// Obtener medicamentos
try {
    $query = 'SELECT id FROM medicamento; ';
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    while ($lista = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $medicamento = new Medicamento();
        $medicamento->setId($lista['id']);
        $medicamentos[] = $medicamento->obtener();
    }
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
// obtener consulta
try {
    $consulta->setId($_SESSION['id_consulta']);
    $consulta->obtener();
    $consultaDatos = $consulta->getValues();
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
//obtener usuario
try {
    $usuario->setUsername($consultaDatos['usuario']);
    $usuario->obtener();
    $usuarioDatos = $usuario->getValues();
} catch (PDOException $e) {
    $respuesta = $e->getMessage();
}
if (
    !empty($consultaDatos) &&
    !empty($usuarioDatos['especialidad']) &&
    !empty($usuarioDatos['universidad']) &&
    !empty($usuarioDatos['cedula'])
) {

    $paciente->setId($consultaDatos['paciente']);
    $paciente->obtener();

    $consultorio->setId($consultaDatos['consultorio']);
    $consultorio->obtener();
    $consultorioDatos = $consultorio->getValues();

    $receta = new Receta();

    $receta->setUsuario($usuarioDatos['nombre'], $usuarioDatos['apellidoPaterno'], $usuarioDatos['apellidoMaterno'], $usuarioDatos['especialidad'], $usuarioDatos['universidad'], $usuarioDatos['cedula'], $usuarioDatos['telefono']);

    $receta->setConsultorio($consultorioDatos['calle'], $consultorioDatos['colonia'], $consultorioDatos['ciudad'], $consultorioDatos['codigoPostal']);

    // Define el tamaño HalfLetter en mm
    define('HALFLETTER_WIDTH', 139.7);
    define('HALFLETTER_HEIGHT', 215.9);
    if ($_REQUEST['size'] == "carta") {
        $receta->setTamano("carta");
        $receta->AddPage('P', 'Letter');
    } else {
        $receta->setTamano('media');
        $receta->AddPage('L', array(HALFLETTER_WIDTH, HALFLETTER_HEIGHT));
    }

    $receta->AliasNbPages();
    $receta->setConsulta($consultaDatos);
    $receta->setPaciente($paciente->getNombre(), $paciente->getApellidoPaterno(), $paciente->getApellidoMaterno());
    $receta->setArrayMedicamentos($medicamentos);
    $receta->cuerpo();
    $receta->Output();
    $respuesta = "true";

} else {
    // require('fpdf/fpdf.php');
    define('HALFLETTER_WIDTH', 139.7);
    define('HALFLETTER_HEIGHT', 215.9);
    function convertir($texto){
        return iconv('UTF-8', 'ISO-8859-1', $texto);
    }
    $respuesta = convertir("No se encontraron todos los valores necesarios para generar una Receta.");
    $sugerencia=convertir("Por favor revisa si existe un Médico, consulta o consultorio válido.");
    $error = new FPDF();
    $error->AddPage('L', array(HALFLETTER_WIDTH, HALFLETTER_HEIGHT));
    $error->SetFont('Arial','',12);
    $error->Cell(189,5,$respuesta,0,1);
    $error->Cell(189,5,$sugerencia,0,1);
    $error->Output();
    
}

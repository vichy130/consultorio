<?php
function redirect($url)
{
    ob_start();
    header('Location:' . $url);
    ob_end_flush();
    die();
}
session_start();
include '../models/consulta.php';
include '../models/paciente.php';
$consulta = new Consulta();
$paciente = new Paciente();
$consultaDatos;
if (isset($_SESSION['id_consulta'])) {
    $consulta->setId($_SESSION['id_consulta']);
    $consulta->obtener();
    $consultaDatos = $consulta->getValues();
    if ($consultaDatos['paciente'] != null) {
        $paciente->setId($consultaDatos['paciente']);
        $paciente->obtener();
        $pacienteDatos = $paciente->getValues();
    }
} else {
    redirect("./pacientes-consultas.php");
    exit();
}
require ('fpdf/fpdf.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
class PDF extends FPDF
{
    private $nombre;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $consulta;
    private $paciente;
    private $medicamentosIndicacion;
    private $estudiosSolicitados;
    function setPaciente($paciente)
    {
        $this->paciente = $paciente;
    }

    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    function setConsulta($consulta)
    {
        $this->consulta = $consulta;
        $this->medicamentosIndicacion = $consulta['medicamentosIndicacion'];
        $this->estudiosSolicitados = $consulta['estudiosSolicitados'];
    }
    function Header()
    {
        $maria = "María";
        $gutierrez = "Gutiérrez";
        $medico = "Médico";
        $textoDra = 'Dra. ' . iconv('UTF-8', 'ISO-8859-1', $maria) . ' del Refugio ' . iconv('UTF-8', 'ISO-8859-1', $gutierrez) . ' De La O';
        $textoMedico = iconv('UTF-8', 'ISO-8859-1', $medico) . ' Cirujano y partero';
        $textoUniversidad = "Universidad de Guadalajara";
        //set font to times, Italica, 11
        $this->SetFont('Times', 'B', 12);
        // CELL (width, height, text, border, end line, align)
        $this->Cell(60, 5, '', 0, 0);
        $this->Cell(129, 5, $textoDra, 0, 1, 'R');
        //End of line
        $this->SetFont('Times', 'I', 10);
        $this->Cell(60, 5, '', 0, 0);
        $this->Cell(129, 5, $textoMedico, 0, 1, 'R');
        // End of line
        //SetLineWidth(float width)
        $this->SetLineWidth(.4);
        // LINE (x,y coordenada inicio y x,y coordenada fin)
        $this->Line(10.5, 30, 199.5, 30);

        $this->Cell(60, 5, '', 0, 0);
        $this->Cell(129, 5, $textoUniversidad, 0, 1, 'R');
        // IMAGE (location, x,y, w,h)
        $this->Image('../img/medicina-black.png', 30, 14, -850);
        $this->Ln(11);
    }

    function Footer()
    {
        //SetLineWidth(float width)
        $this->SetLineWidth(.2);
        // LINE (x,y coordenada inicio y x,y coordenada fin)
        $this->Line(10.5, 251, 199.5, 251);
        $this->SetY(-25);
        $this->SetFont('Arial', '', 9);
        // CELL (width, height, text, border, end line, align)
        $this->Cell(120, 5, 'Gabrielle D annunzio 6154 Col. Lomas Universidad, Zapopan, Jalisco. CP 45016', 0, 0, '');
        // CELL (width, height, text, border, end line, align)
        $this->Cell(69, 5, 'REG. SSA. 63859', 0, 1, 'R');
        $this->SetFont('Arial', 'U', 9);
        $this->Cell(60, 5, 'refugiogu@gmail.com', 0, 0, '');
        $this->SetFont('Arial', '', 9);
        $this->Cell(55.5, 5, 'Tel. 56684730 Cel. 5560707118', 0, 0, 'R');
        $this->Cell(73.5, 5, 'CED. PROF. 50356', 0, 1, 'R');
        $textoPagina = "Página ";
        $pagina = iconv('UTF-8', 'ISO-8859-1', $textoPagina);
        $this->Cell(0, 10, $pagina . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    function cuerpo()
    {
        //NOMBRE
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, 'Nombre: ', 0, 0, '');
        $this->SetFont('Arial', '', 11);
        $this->Cell(100, 5, $this->paciente['apellidoPaterno'] . " " . $this->paciente['apellidoMaterno'] . ", " . $this->paciente['nombre'], 0, 1, '');
        //FECHA
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, 'Fecha: ', 0, 0, '');
        $this->SetFont('Arial', '', 11);
        $this->Cell(100, 5, $this->consulta['fecha'], 0, 1, '');
        $this->Ln(10);
        //MEDICAMENTOS
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(89, 5, 'Se solicita: ', 0, 0, '');
        $this->Cell(100, 5, 'Prescripcion: ', 0, 1, 'R');
        $this->SetFont('Arial', '', 11);
        foreach ($this->medicamentosIndicacion as $med) {
            // MULTICELL (ancho, tamaño linea, texto, borde,alineacion c o i, fondo)
            $y = $this->GetY();
            if ($y > 210) {
                $this->AddPage('P', 'Letter');
                $y = $this->GetY();
            }
            $this->MultiCell(85, 5, $med['medicamento']);
            $this->SetXY(99, $y);
            $this->MultiCell(100, 5, $med['indicaciones']);
            $this->Ln(10);
        }
        $this->Ln(10);
        //ESTUDIOS
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(100, 5, 'Estudios requeridos: ', 0, 1, '');
        $this->SetFont('Arial', '', 11);
        foreach ($this->estudiosSolicitados as $estudio) {
            // MULTICELL (ancho, tamaño linea, texto, borde,alineacion c o i, fondo)
            $y = $this->GetY();
            if ($y > 210) {
                $this->AddPage('P', 'Letter');
                $y = $this->GetY();
            }
            $this->MultiCell(189, 5, $estudio['estudio']);
            $this->Ln(1);
        }
        $this->Ln(10);
        //INDICACIONES GENERALES
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(100, 5, 'Indicaciones generales: ', 0, 1, '');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(189, 5, $this->consulta['indicaciones']);
        $this->Ln(1);

        //INDICACIONES GENERALES
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(100, 5, 'Firma Medico ', 0, 1, '');
        $this->Ln(1);
    }

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P', 'Letter');
$pdf->setConsulta($consultaDatos);
$pdf->setPaciente($pacienteDatos);
$pdf->cuerpo();
$pdf->Output();
?>
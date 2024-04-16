<?php
require ('./fpdf/fpdf.php');

class Receta extends FPDF
{
    private $usuario;
    private $nombre;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $especialidad;
    private $universidad;
    private $domicilio;
    private $localidad;
    private $cedula;
    private $telefono;
    private $consulta;
    private $pacienteNombre;
    private $pacienteApellidoPaterno;
    private $pacienteApellidoMaterno;
    private $medicamentosIndicacion = array();
    private $estudiosSolicitados = array();
    private $arrayMedicamentos = array();
    function convertir($texto)
    {
        return iconv('UTF-8', 'ISO-8859-1', $texto);
    }
    function setPaciente($pacienteNombre, $pacienteApellidoPaterno, $pacienteApellidoMaterno)
    {
        $this->pacienteNombre = $pacienteNombre;
        $this->pacienteApellidoPaterno=$pacienteApellidoPaterno;
        $this->pacienteApellidoMaterno=$pacienteApellidoMaterno;
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
    function setArrayMedicamentos($arrayMedicamentos)
    {
        $this->arrayMedicamentos = $arrayMedicamentos;
    }
    // function setUsuario(/*$nombre, $apellidoPaterno, $apellidoMaterno, $especialidad, $universidad,$cedula,$telefono*/$usuario)
    // {
    //     $this->usuario=$usuario;
    //     // $this->nombre = $nombre;
    //     // $this->apellidoPaterno = $apellidoPaterno;
    //     // $this->apellidoMaterno = $apellidoMaterno;
    //     // $this->especialidad = $especialidad;
    //     // $this->universidad=$universidad;
    //     // $this->cedula = $cedula;
    //     // $this->telefono=$telefono;
    // }
    function Header()
    {
        $this->nombre= "DR";
        $this->especialidad = $this->convertir('Médico Cirujano y partero');
        $this->universidad = $this->convertir("Universidad de Guadalajara");
        //set font to times, Italica, 11
        // $this->SetFont('Times', 'B', 12);
        $this->SetFont('Times', 'I', 10);
        // CELL (width, height, text, border, end line, align)
        // $this->Cell(60, 5, '', 0, 0);
        $this->Cell(189, 5, $this->nombre, 0, 1, 'C');
        //End of line
        // $this->SetFont('Times', 'I', 10);
        // $this->Cell(60, 5, '', 0, 0);
        $this->Cell(189, 5, $this->especialidad, 0, 1, 'C');
        // End of line
        //SetLineWidth(float width)
        $this->SetLineWidth(.4);
        // LINE (x,y coordenada inicio y x,y coordenada fin)
        $this->Line(10.5, 28, 199.5, 28);

        // $this->Cell(60, 5, '', 0, 0);
        $this->Cell(189, 5, $this->universidad, 0, 1, 'C');
        $this->Ln(7);
        // IMAGE (location, x,y, w,h)
        // $this->Image('../img/medicina-black.png', 30, 14, -850);
        // $this->Ln(11);
    }

    function Footer()
    {
        $this->domicilio = $this->convertir("Gabrielle D´annunzio 6154 Col. Lomas Universidad");
        $this->localidad = $this->convertir("Zapopan, Jalisco. CP 45016.");
        $this->cedula = $this->convertir('CED. PROF. 0503568');
        $this->telefono = "tel. 55 6070 7118";
        //SetLineWidth(float width)
        $this->SetLineWidth(.2);
        // LINE (x,y coordenada inicio y x,y coordenada fin)
        $this->Line(10.5, 251, 199.5, 251);
        $this->SetY(-25);
        $this->SetFont('Arial', '', 9);
        // CELL (width, height, text, border, end line, align)
        $this->Cell(94.5, 5, $this->domicilio, 0, 0, 'L');
        // CELL (width, height, text, border, end line, align)
        $this->Cell(94.5, 5, $this->cedula, 0, 1, 'R');
        $this->Cell(94.5, 5, $this->localidad, 0, 0, 'L');
        $this->Cell(94.5, 5, $this->telefono, 0, 1, 'R');
        $pagina = $this->convertir("Página ");
        $this->Cell(0, 10, $pagina . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    function cuerpo()
    {
        //NOMBRE
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, 'Nombre: ', 0, 0, '');
        $this->SetFont('Arial', '', 11);
        $this->Cell(100, 5, $this->convertir($this->pacienteApellidoPaterno) . " " . $this->convertir($this->pacienteApellidoMaterno) . ", " . $this->convertir($this->pacienteNombre), 0, 1, '');
        //FECHA
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, 'Fecha: ', 0, 0, '');
        $this->SetFont('Arial', '', 11);
        $this->Cell(100, 5, $this->consulta['usuario'], 0, 1, '');
        $this->Ln(10);
        //MEDICAMENTOS
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(89, 5, 'Se solicita: ', 0, 0, '');
        $this->Cell(100, 5, $this->convertir('Prescripción: '), 0, 1, 'R');
        $this->SetFont('Arial', '', 11);
        foreach ($this->medicamentosIndicacion as $medIndicacion) {
            foreach ($this->arrayMedicamentos as $medicamento) {
                if ($medIndicacion['medicamento'] == $medicamento['id']) {
                    // MULTICELL (ancho, tamaño linea, texto, borde,alineacion c o i, fondo)
                    $y = $this->GetY();
                    if ($y > 210) {
                        $this->AddPage('P', 'Letter');
                        $y = $this->GetY();
                    }
                    $this->MultiCell(89, 5, $this->convertir($medicamento['medicamento']) . " " . $this->convertir($medicamento['descripcion']), 0, 'L');
                    $this->SetXY(109, $y);
                    $this->MultiCell(90, 5, $this->convertir($medIndicacion['indicaciones']), 0, 'R');
                    $this->Ln(7);
                }
            }
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
            $this->MultiCell(189, 5, $this->convertir($estudio['estudio']));
            $this->Ln(1);
        }
        $this->Ln(10);
        //INDICACIONES GENERALES
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(100, 5, 'Indicaciones generales: ', 0, 1, '');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(189, 5, $this->convertir($this->consulta['indicaciones']));
        $this->Ln(1);

        //INDICACIONES GENERALES
        $this->setXY(160, 240);
        $this->SetFont('Arial', 'B', 11);
        //SetLineWidth(float width)
        $this->SetLineWidth(.2);
        // LINE (x,y coordenada inicio y x,y coordenada fin)
        $this->Line(150, 240, 193, 240);
        // $this->Cell(60, 5, 'Dra. Maria de∫l Refugio Gutierrez de la O ', 0, 1, '');
        $firmaMedico = $this->convertir("Firma Médico");
        $this->Cell(100, 5, $firmaMedico, 0, 1, '');
        $this->Ln(1);
    }

}
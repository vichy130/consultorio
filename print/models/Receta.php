<?php
require ('./fpdf/fpdf.php');

class Receta extends FPDF
{
    private $tamano;
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
    private $calleConsultorio;
    private $coloniaConsultorio;
    private $ciudadConsultorio;
    private $cpConsultorio;

    function convertir($texto)
    {
        return iconv('UTF-8', 'ISO-8859-1', $texto);
    }
    function setTamano($tamano)
    {
        $this->tamano = $tamano;
    }
    function setPaciente($pacienteNombre, $pacienteApellidoPaterno, $pacienteApellidoMaterno)
    {
        $this->pacienteNombre = $pacienteNombre;
        $this->pacienteApellidoPaterno = $pacienteApellidoPaterno;
        $this->pacienteApellidoMaterno = $pacienteApellidoMaterno;
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
    function setUsuario($nombre, $apellidoPaterno, $apellidoMaterno, $especialidad, $universidad, $cedula, $telefono)
    {
        $this->nombre = $nombre;
        $this->apellidoPaterno = $apellidoPaterno;
        $this->apellidoMaterno = $apellidoMaterno;
        $this->especialidad = $especialidad;
        $this->universidad = $universidad;
        $this->cedula = $cedula;
        $this->telefono = $telefono;
    }
    function setConsultorio($calleConsultorio, $coloniaConsultorio, $ciudadConsultorio, $cpConsultorio)
    {
        $this->calleConsultorio = $calleConsultorio;
        $this->coloniaConsultorio = $coloniaConsultorio;
        $this->ciudadConsultorio = $ciudadConsultorio;
        $this->cpConsultorio = $cpConsultorio;
    }
    function Header()
    {
        $nombreMedico = $this->convertir("Dr. (a) " . $this->nombre . " " . $this->apellidoPaterno . " " . $this->apellidoMaterno);
        $especialidadMedico = $this->convertir($this->especialidad);
        $universidadMedico = $this->convertir($this->universidad);
        //set font to times, Italica, 11
        // $this->SetFont('Times', 'B', 12);
        $this->SetFont('Times', 'I', 10);
        // CELL (width, height, text, border, end line, align)
        // $this->Cell(60, 5, '', 0, 0);
        $this->Cell(189, 5, $nombreMedico, 0, 1, 'C');
        //End of line
        // $this->SetFont('Times', 'I', 10);
        // $this->Cell(60, 5, '', 0, 0);
        $this->Cell(189, 5, $especialidadMedico, 0, 1, 'C');
        // End of line
        // $this->Cell(60, 5, '', 0, 0);
        $this->Cell(189, 5, $universidadMedico, 0, 1, 'C');
        if ($this->tamano == "carta") {
            //SetLineWidth(float width)
            $this->SetLineWidth(.4);
            // LINE (x,y coordenada inicio y x,y coordenada fin)
            $this->Line(10.5, 28, 199.5, 28);
            $this->Ln(7);
        } else {
            $this->Ln(4);
        }
        // IMAGE (location, x,y, w,h)
        // $this->Image('../img/medicina-black.png', 30, 14, -850);
        // $this->Ln(11);
    }

    function Footer()
    {
        //FIRMA
        if ($this->tamano == "carta") {
            $this->setXY(160, 240);
            $this->SetFont('Arial', 'B', 11);
            //SetLineWidth(float width)
            $this->SetLineWidth(.2);
            // LINE (x,y coordenada inicio y x,y coordenada fin)
            $this->Line(150, 240, 193, 240);
            $firmaMedico = $this->convertir("Firma Médico");
            $this->Cell(100, 5, $firmaMedico, 0, 1, '');
            $this->Ln(1);
        } else { //tamano media carta
            $this->setXY(160, 105);
            $this->SetFont('Arial', 'B', 10);
            //SetLineWidth(float width)
            $this->SetLineWidth(.2);
            // LINE (x,y coordenada inicio y x,y coordenada fin)
            $this->Line(150, 105, 193, 105);
            $firmaMedico = $this->convertir("Firma Médico");
            $this->Cell(100, 5, $firmaMedico, 0, 1, '');
            $this->Ln(1);
        }
        //FIRMA
        $this->domicilio = $this->convertir($this->calleConsultorio . ", " . $this->coloniaConsultorio);
        if ($this->ciudadConsultorio == "Zapopan" || $this->ciudadConsultorio == "Guadalajara") {
            $estado = "Jalisco";
        } else {
            $estado = "";
        }
        $this->localidad = $this->convertir($this->ciudadConsultorio . " " . $estado . ", CP. " . $this->cpConsultorio);
        $this->cedula = $this->convertir($this->cedula);
        ;
        if ($this->tamano == "carta") {
            //SetLineWidth(float width)
            $this->SetLineWidth(.2);
            // LINE (x,y coordenada inicio y x,y coordenada fin)
            $this->Line(10.5, 251, 199.5, 251);
            $this->SetY(-25);
        }
        $this->SetFont('Arial', '', 9);
        // CELL (width, height, text, border, end line, align)
        $this->Cell(94.5, 5, $this->domicilio, 0, 0, 'L');
        // CELL (width, height, text, border, end line, align)
        $this->Cell(94.5, 5, "CED: PROF. " . $this->cedula, 0, 1, 'R');
        $this->Cell(94.5, 5, $this->localidad, 0, 0, 'L');
        $this->Cell(94.5, 5, "Tel. " . $this->telefono, 0, 1, 'R');
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
        $this->Cell(100, 5, $this->consulta['fecha'], 0, 1, '');
        if($this->tamano=="carta"){
            $this->Ln(10);
        }else{
            $this->Ln(4);
        }
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
                    if($this->tamano=="carta"){
                        $this->Ln(7);
                    }else{
                        $this->Ln(2);
                    }
                }
            }
        }
        if($this->tamano=="carta"){
            $this->Ln(10);
        }else{
            $this->Ln(4);
        }
        //ESTUDIOS
        if (count($this->estudiosSolicitados) > 0) {
            $this->SetFont('Arial', 'B', 11);
            $this->Cell(100, 5, 'Estudios requeridos: ', 0, 1, '');
            $this->SetFont('Arial', '', 11);
        }
        foreach ($this->estudiosSolicitados as $estudio) {
            // MULTICELL (ancho, tamaño linea, texto, borde,alineacion c o i, fondo)
            $y = $this->GetY();
            if ($y > 210) {
                // $this->AddPage('P', 'Letter');
                $this->AddPage();
                $y = $this->GetY();
            }
            $this->MultiCell(189, 5, $this->convertir($estudio['estudio']));
            $this->Ln(1);
        }
        if($this->tamano=="carta"){
            $this->Ln(7);
        }else{
            $this->Ln(2);
        }
        //INDICACIONES GENERALES
        if ($this->consulta['indicaciones'] != null) {
            $this->SetFont('Arial', 'B', 11);
            $this->Cell(100, 5, 'Indicaciones generales: ', 0, 1, '');
            $this->SetFont('Arial', '', 11);
            $this->MultiCell(189, 5, $this->convertir($this->consulta['indicaciones']));
            $this->Ln(1);
        }
        //INDICACIONES GENERALES

    }

}
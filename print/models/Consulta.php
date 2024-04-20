<?php
require ('./fpdf/fpdf.php');
class ConsultaPDF extends FPDF
{
    private $consulta;
    private $paciente;
    private $id;
    private $ficha;
    private $consultorio;
    private $cPrevias = array();
    private $terapiasAplicadas = array();
    private $estudiosSolicitados = array();
    private $medicamentosIndicacion = array();
    private $medicamentos = array();
    function setConsulta($consulta)
    {
        $this->consulta = $consulta;
    }
    function setPaciente($paciente)
    {
        $this->paciente = $paciente;
    }
    function setFicha($ficha)
    {
        $this->ficha = $ficha;
    }
    function setConsultorio($consultorio)
    {
        $this->consultorio = $consultorio;
    }
    function setEstudiosSolicitados($estudiosSolicitados)
    {
        $this->estudiosSolicitados = $estudiosSolicitados;
    }
    function setTerapiasAplicadas($terapiasAplicadas)
    {
        $this->terapiasAplicadas = $terapiasAplicadas;
    }
    function setMedicamentosIndicacion($medicamentosIndicacion)
    {
        $this->medicamentosIndicacion = $medicamentosIndicacion;
    }
    function setCPrevias($cPrevias)
    {
        $this->cPrevias = $cPrevias;
    }
    function setMedicamentos($medicamentos)
    {
        $this->medicamentos = $medicamentos;
    }
    function header()
    {
        $date = new DateTime($this->consulta['fecha']);
        $date_string = $date->format('Y-m-d');
        $titulo = $this->convertir("Consulta");
        $fecha = $this->convertir("Fecha: " . $date_string);
        $this->SetFont('Times', 'BI', 16);
        // CELL (width, height, text, border, end line, align)
        $this->Cell(100, 5, $titulo, 0, 0, '');
        $this->SetFont('Times', '', 12);
        $this->Cell(89, 5, $fecha, 0, 1, 'R');
        $this->Ln(5);
    }
    function cuerpo()
    {
        $consultorio = $this->convertir("CONSULTORIO: " . $this->consultorio['calle'] . ", " . $this->consultorio['colonia'] . ", " . $this->consultorio['ciudad'] . ". CP. " . $this->consultorio['codigoPostal']);
        $nac = new DateTime($this->paciente['fechaNacimiento']);
        $hoy = new DateTime();
        $dif = $nac->diff($hoy);
        $edad = $dif->y;
        $nombre = $this->convertir("NOMBRE: " . $this->paciente['nombre'] . " " . $this->paciente['apellidoPaterno'] . " " . $this->paciente['apellidoMaterno']);
        $tipoSangre = $this->convertir("TIPO SANGRE: " . $this->ficha['tipoSangre']);
        $nacFecha = $this->convertir("NAC FECHA: " . $this->paciente['fechaNacimiento']);
        $edad = $this->convertir("EDAD: " . $edad);
        $sexo = $this->convertir("SEXO: " . $this->paciente['sexo']);
        $lugar = $this->convertir("LUGAR: " . $this->paciente['lugarNacimiento']);
        $tituloExploracion = $this->convertir("Exploración Física");
        $ta = $this->convertir("TA: " . $this->consulta['ta']);
        $oxigeno = $this->convertir("OXIGENO: " . $this->consulta['oxigeno']);
        $pulso = $this->convertir('PULSO: ' . $this->consulta['pulso'] . ' PPM');
        $peso = $this->convertir('PESO:' . $this->consulta['peso'] . ' KG');
        $estatura = $this->convertir('ESTATURA: ' . $this->consulta['estatura']);
        $temperatura = $this->convertir('TEMP: ' . $this->consulta['temperatura'] . ' C');
        $motivoConsulta = $this->convertir('MOTIVO DE CONSULTA: ' . $this->consulta['motivoConsulta']);
        $exploracion = $this->convertir('EXPLORACIÓN: ' . $this->consulta['exploracion']);
        $indicacionesGenerales = $this->convertir('INDICACIONES: ' . $this->consulta['indicaciones']);
        $tituloConsulta = $this->convertir("Consulta");
        $tituloConsultasEx = $this->convertir("Consultas Externas");
        $tituloEstudiosSolicitados = $this->convertir("Estudios a Solicitar");
        $tituloMedicamentosIndicacion = $this->convertir("Medicamentos prescritos");

        $this->SetFont('Arial', '', 11);

        // CELL (width, height, text, border, end line, align)
        // MULTICELL (ancho, tamaño linea, texto, borde,alineacion c o i, fondo)
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(189, 7, $consultorio, 1);
        // $this->SetXY($x + 189, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(140, 7, $nombre, 1);
        $this->SetXY($x + 140, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(49, 7, $tipoSangre, 1);
        // $this->SetXY($x+49, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        //nueva linea
        $this->MultiCell(63, 7, $nacFecha, 1);
        $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(63, 7, $edad, 1);
        $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(63, 7, $sexo, 1);
        // $this->SetXY($x+47.25, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(189, 7, $lugar, 1);

        //EXPLORACION
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10, $tituloExploracion, 0, 1);

        $this->SetFont('Arial', '', 11);

        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(47.25, 7, $ta, 1);
        $this->SetXY($x + 47.25, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(47.25, 7, $oxigeno, 1);
        $this->SetXY($x + 47.25, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(47.25, 7, $pulso, 1);
        $this->SetXY($x + 47.25, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(47.25, 7, $peso, 1);
        /*$this->SetXY($x+47.25, $y);*/
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(47.25, 7, $estatura, 1);
        $this->SetXY($x + 47.25, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(141.75, 7, $temperatura, 1);
        /*$this->SetXY($x+141.75, $y);
        $y = $this->GetY();
        $x = $this->GetX();
        $this->Ln(2);*/
        //Exploracion fisica //

        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10, $tituloConsultasEx, 0, 1);

        $this->SetFont('Arial', '', 11);

        $y = $this->GetY();
        $x = $this->GetX();

        foreach ($this->cPrevias as $con) {
            $diagnostico = $this->convertir("DIAGNOSTICO: " . $con['diagnostico']);
            $estudio = $this->convertir("ESTUDIO: " . $con['estudios']);
            $tratamiento = $this->convertir("TRATAMIENTO: " . $con['tratamiento']);
            $comentarios = $this->convertir("COMENTARIOS: " . $con['comentarios']);

            $this->MultiCell(189, 7, $diagnostico, 'LTR');
            // $this->SetXY($x+47.25, $y);
            $y = $this->GetY();
            $x = $this->GetX();

            $this->MultiCell(189, 7, $estudio, 'LR');
            // $this->SetXY($x+47.25, $y);
            $y = $this->GetY();
            $x = $this->GetX();

            $this->MultiCell(189, 7, $tratamiento, 'LR');
            // $this->SetXY($x+47.25, $y);
            $y = $this->GetY();
            $x = $this->GetX();
            $this->MultiCell(189, 7, $comentarios, 'LBR');
            // $this->SetXY($x+47.25, $y);
            $y = $this->GetY();
            $x = $this->GetX();
        }


        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10, $tituloConsulta, 0, 1);

        $this->SetFont('Arial', '', 11);

        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(189, 7, $motivoConsulta, 1);
        // $this->SetXY($x+47.25, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(189, 7, $exploracion, 1);
        // $this->SetXY($x+47.25, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(189, 7, $indicacionesGenerales, 1);
        // $this->SetXY($x+47.25, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10, $tituloEstudiosSolicitados, 0, 1);

        $this->SetFont('Arial', '', 11);

        $y = $this->GetY();
        $x = $this->GetX();
        foreach ($this->estudiosSolicitados as $estudio) {

            $estudioTexto = $this->convertir("ESTUDIO: " . $estudio['estudio']);

            $this->MultiCell(189, 7, $estudioTexto, 1);


        }

        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10, $tituloMedicamentosIndicacion, 0, 1);

        $this->SetFont('Arial', '', 11);

        $y = $this->GetY();
        $x = $this->GetX();

        foreach ($this->medicamentosIndicacion as $med) {
            foreach ($this->medicamentos as $medNombre) {
                if ($med['medicamento'] == $medNombre['id']) {
                    $medicamento = $this->convertir("MEDICAMENTO: " . $medNombre['medicamento']);

                    $hora = $this->convertir("HORA: " . $med['hora']);
                    $indicaciones = $this->convertir("INDICACIONES: " . $med['indicaciones']);

                    $this->MultiCell(150, 7, $medicamento, 'TL');
                    $this->SetXY($x + 150, $y);
                    $y = $this->GetY();
                    $x = $this->GetX();

                    $this->MultiCell(39, 7, $hora, 'TR');
                    // $this->SetXY($x+94.5, $y);
                    $y = $this->GetY();
                    $x = $this->GetX();

                    $this->MultiCell(189, 7, $indicaciones, 'LBR');
                    // $this->SetXY($x+100, $y);
                    $y = $this->GetY();
                    $x = $this->GetX();
                }
            }
        }
    }
    function footer()
    {
        $this->SetY(-20);
        $pagina = $this->convertir("Página ");
        $this->Cell(0, 10, $pagina . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    function convertir($texto)
    {
        return iconv('UTF-8', 'ISO-8859-1', $texto);
    }

}
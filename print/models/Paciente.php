<?php
require ('./fpdf/fpdf.php');

class PacientePDF extends FPDF{
private $paciente;
    function setPaciente($paciente)
    {
        $this->paciente = $paciente;
    }
    function Header()
    {
        $date=new DateTime();
        $date_string = $date->format('Y-m-d');
        $titulo = $this->convertir("Paciente");
        $fecha = $this->convertir("Fecha: ".$date_string);
        $this->SetFont('Times', 'BI', 16);
        // CELL (width, height, text, border, end line, align)
        $this->Cell(100, 5, $titulo, 0, 0, '');
        $this->SetFont('Times', '', 12);
        $this->Cell(89, 5, $fecha, 0, 1, 'R');
        $this->Ln(5);
    }
    function cuerpo(){
        $nombre = $this->convertir("NOMBRE: " . $this->paciente['nombre']);
        $apPa=$this->convertir('APELLIDO PATERNO: '. $this->paciente['apellidoPaterno'] );
        $apMa=$this->convertir('APELLIDO MATERNO: '.$this->paciente['apellidoMaterno']);
        $nac=$this->convertir('FECHA NACIMIENTO: ').$this->paciente['fechaNacimiento'];
        $sexo=$this->convertir('SEXO: '.$this->paciente['sexo']);
        $lugar=$this->convertir('LUGAR NACIMIENTO: '.$this->paciente['lugarNacimiento']);
        $calle=$this->convertir('CALLE: '.$this->paciente['calle']);
        $colonia=$this->convertir('COLONIA: '.$this->paciente['colonia']);
        $ciudad=$this->convertir('CIUDAD: '.$this->paciente['ciudad']);
        $cp=$this->convertir('CP: '.$this->paciente['codigoPostal']);
        $telCasa=$this->convertir('TEL. CASA: '.$this->paciente['telCasa']);
        $telOficina=$this->convertir('TEL. OFICINA: '.$this->paciente['telOficina']);
        $celular=$this->convertir('CELULAR:'.$this->paciente['celular']);
        $edoCivil=$this->convertir('ESTADO CIVIL: '.$this->paciente['edoCivil']);
        $ocupacion=$this->convertir('OCUPACIÓN: '.$this->paciente['ocupacion']);
        $escolaridad=$this->convertir('ESCOLARIDAD: '.$this->paciente['escolaridad']);
        $correo=$this->convertir('CORREO: '.$this->paciente['correo']);

        $this->SetFont('Arial', '', 11);
        // CELL (width, height, text, border, end line, align)
        // MULTICELL (ancho, tamaño linea, texto, borde,alineacion c o i, fondo)
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(189, 7, $nombre, 1);
        // $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(94.5, 7, $apPa, 1);
        $this->SetXY($x + 94.5, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(94.5, 7, $apMa, 1);
        // $this->SetXY($x + 94.5, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(94.5, 7, $nac, 1);
        $this->SetXY($x + 94.5, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(94.5, 7, $sexo, 1);
        // $this->SetXY($x + 94.5, $y);

        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10,"Domicilio", 0, 1);

        $this->SetFont('Arial', '', 11);

        $y = $this->GetY();
        $x = $this->GetX();
        $this->MultiCell(94.5, 7, $calle, 1);
        $this->SetXY($x + 94.5, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(94.5, 7, $colonia, 1);
        // $this->SetXY($x + 94.5, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(94.5, 7, $ciudad, 1);
        $this->SetXY($x + 94.5, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(94.5, 7, $cp, 1);
        // $this->SetXY($x + 94.5, $y);

        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10,"Contacto", 0, 1);

        $this->SetFont('Arial', '', 11);

        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(63, 7, $telCasa, 1);
        $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(63, 7, $telOficina, 1);
        $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(63, 7, $celular, 1);
        // $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(189, 7, $correo, 1);
        // $this->SetXY($x + 189, $y);

        $this->Ln(7);
        $y = $this->GetY();
        $x = $this->GetX();
        
        $this->MultiCell(94.5, 7, $edoCivil, 1);
        $this->SetXY($x + 94.5, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(94.5, 7, $ocupacion, 1);
        // $this->SetXY($x + 189, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(189, 7, $escolaridad, 1);
        $this->SetXY($x + 189, $y);
        $y = $this->GetY();
        $x = $this->GetX();
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
}// END PACIENTEPDF
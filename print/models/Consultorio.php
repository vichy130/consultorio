<?php
require ('./fpdf/fpdf.php');
class ConsultorioPDF extends FPDF{
private $consultorio=array();
function setConsultorio($consultorio){
    $this->consultorio=$consultorio;
}
function header(){
    $date = new DateTime();
    $date_string = $date->format('Y-m-d');
    $titulo = $this->convertir("Consultorio");
    $fecha = $this->convertir("Fecha: " . $date_string);
    $this->SetFont('Times', 'BI', 16);
    // CELL (width, height, text, border, end line, align)
    $this->Cell(100, 5, $titulo, 0, 0, '');
    $this->SetFont('Times', '', 12);
    $this->Cell(89, 5, $fecha, 0, 1, 'R');
    $this->Ln(5);
}
function cuerpo(){
    $nombreConsultorio=$this->convertir('CONSULTORIO: '.$this->consultorio['nombre']);
    $calle=$this->convertir('CALLE: '.$this->consultorio['calle']);
    $colonia=$this->convertir('COLONIA: '.$this->consultorio['colonia']);
    $ciudad=$this->convertir('CIUDAD: '.$this->consultorio['ciudad']);
    $codigoPostal=$this->convertir('CÓDIGO POSTAL: '.$this->consultorio['codigoPostal']);
    $telefono=$this->convertir('TELÉFONO: '.$this->consultorio['telefono']);

    $y = $this->GetY();
    $x = $this->GetX();

    $this->SetFont('Arial', '', 12);

    $this->MultiCell(189, 7, $nombreConsultorio, 1);
    // $this->SetXY($x + 189, $y);
    $y = $this->GetY();
    $x = $this->GetX();

    $this->MultiCell(106, 7, $calle, 1);
    $this->SetXY($x + 106, $y);
    $y = $this->GetY();
    $x = $this->GetX();

    $this->MultiCell(83, 7, $colonia, 1);
    // $this->SetXY($x + 83, $y);
    $y = $this->GetY();
    $x = $this->GetX();

    $this->MultiCell(106, 7, $ciudad,1);
    $this->SetXY($x + 106, $y);
    $y = $this->GetY();
    $x = $this->GetX();

    $this->MultiCell(83, 7, $codigoPostal, 1);
    // $this->SetXY($x +83, $y);
    $y = $this->GetY();
    $x = $this->GetX();

    $this->MultiCell(189, 7, $telefono, 1);
    $this->SetXY($x + 189, $y);
    $y = $this->GetY();
    $x = $this->GetX();
}
function footer(){
    $this->SetY(-20);
    $this->SetFont('Times', '', 12);
    $pagina = $this->convertir("Página ");
    $this->Cell(0, 10, $pagina . $this->PageNo() . '/{nb}', 0, 0, 'C');
}
function convertir($texto)
{
    return iconv('UTF-8', 'ISO-8859-1', $texto);
}
}
<?php

require('fpdf/fpdf.php');
function convertir($texto){
    return iconv('UTF-8', 'ISO-8859-1', $texto);
}
// Crear una nueva instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Definir el título
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Mi Documento PDF', 0, 1, 'C');

// Crear celda 1
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Nombre:', 0);
$pdf->Cell(50, 10, convertir('Júan Perez'), 0, 1);

// Crear celda 2
$pdf->Cell(50, 10, 'Edad:', 0);
$pdf->Cell(50, 10, '30', 0, 1);

// Salida del documento
$pdf->Output();
?>


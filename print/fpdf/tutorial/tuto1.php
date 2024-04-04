<?php
require('../fpdf.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
// $pdf = new FPDF();
// $pdf->AddPage();
// $pdf->SetFont('Arial','B',16);
// $pdf->Cell(40,10,'�Hola, Mundo!');
// $pdf->Output();


$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

$html='<table border="1">
<tr>
<td width="200" height="30">cell 1</td><td width="200" height="30" bgcolor="#D0D0FF">cell 2</td>
</tr>
<tr>
<td width="200" height="30">cell 3</td><td width="200" height="30">cell 4</td>
</tr>
</table>';

$pdf->WriteHTML($html);
$pdf->Output();
?>



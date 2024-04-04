
<?php
require('fpdf/fpdf.php');

//TEXTOS
$maria="María";
$gutierrez="Gutiérrez";
$medico="Médico";
$textoDra='Dra. '.iconv('UTF-8', 'ISO-8859-1', $maria).' del Refugio '.iconv('UTF-8', 'ISO-8859-1', $gutierrez).' De La O';
$textoMedico=iconv('UTF-8', 'ISO-8859-1', $medico).' Cirujano y partero';
$textoUniversidad="Universidad de Guadalajara";
$textoPagina="Página ";
$pagina=iconv('UTF-8', 'ISO-8859-1', $textoPagina);
//TEXTOS

$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();

//set font to times, Italica, 11
$pdf->SetFont('Times','B',11);
// CELL (width, height, text, border, end line, align)
$pdf->Cell(60,5,'',0,0);
$pdf->Cell(129,5,$textoDra,0,1,'R');
//End of line
$pdf->SetFont('Times','I',10);
$pdf->Cell(60,5,'',0,0);
$pdf->Cell(129,5,$textoMedico,0,1,'R');
// LINE (x,y coordenada inicio y x,y coordenada fin)
$pdf->Line(10.5,30,199.5,30);
// End of line
$pdf->Cell(60,5,'',0,0);
$pdf->Cell(129,5,$textoUniversidad,0,1,'R');
// IMAGE (location, x,y, w,h)
$pdf->Image('../img/medicina-black.png',30,14,-850);


$pdf->Cell(0,10,$pagina.$pdf->PageNo().'/{nb}',0,0,'C');
$pdf->Output();
?>
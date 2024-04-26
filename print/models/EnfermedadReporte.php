<?php
require ('./fpdf/fpdf.php');

class EnfermedadReportePDF extends FPDF
{
    private $reporte = [];
    private $tipo;
    function setDatos($reporte)
    {
        $this->reporte = $reporte;
    }
    function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
    function header()
    {
        $date = new DateTime();
        $date_string = $date->format('Y-m-d');
        $titulo = $this->convertir("Informe de enfermedades");
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
        switch ($this->tipo) {
            case "seis":
                $texto = $this->convertir("en últimos seis meses");
                break;
            case "ano":$texto = $this->convertir("en último año");
                break;
            case "todo": $texto="";
                break;
        }
        $this->SetFont('Times', '', 12);
        $this->Cell(189, 5, "Historial de enfermedades " . $texto, 0, 1, '');
        $this->Ln(2);
        $this->SetFont('Times', 'B', 12);
        $this->Cell(94.5, 5, "Enfermedad: ", 0, 0, '');
        $this->Cell(94.5, 5, "Cantidad:", 0, 1, '');
        $this->SetFont('Times', '', 12);
        foreach ($this->reporte as $rep) {
            $this->Cell(94.5, 5, $this->convertir($rep['label']), 0, 0, '');
            $this->Cell(94.5, 5, $this->convertir($rep['data']), 0, 1, '');
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
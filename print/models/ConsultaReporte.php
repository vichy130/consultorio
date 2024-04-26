<?php
require ('./fpdf/fpdf.php');

class ConsultaReportePDF extends FPDF
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
        $titulo = $this->convertir("Informe de consultas");
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
            case 0:
                $texto = $this->convertir("Último mes");
                break;
            case 1:$texto = $this->convertir("Últimos seis meses");
                break;
            case 2: $texto = $this->convertir("Último año");
                break;
            case 3: $texto="";
                break;
        }
        $this->SetFont('Times', '', 12);
        $this->Cell(189, 5, "Historial de Consultas registradas: " . $texto, 0, 1, '');
        $this->Ln(2);
        $this->Cell(94.5, 5, "Fecha: ", 1, 0, '');
        $this->Cell(94.5, 5, "Cantidad", 1, 1, '');
        foreach ($this->reporte as $rep) {
            $this->Cell(94.5, 5, $rep['label'], 1, 0, '');
            $this->Cell(94.5, 5, $rep['data'], 1, 1, '');
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
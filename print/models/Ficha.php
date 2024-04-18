<?php
require ('./fpdf/fpdf.php');

class Ficha extends FPDF
{

    private $id;
    private $paciente;
    private $tipoSangre;
    private $quienRecomendo;
    private $embarazo;
    private $partos;
    private $cesareas;
    private $abortos;
    private $muertos;
    private $enfs;
    private $fuma;
    private $cigarrosDia;
    private $fumaAntiguedad;
    private $alcohol;
    private $alcFrecuencia;
    private $alcoholCantidad;
    private $alcoholTipos;
    private $adicciones;
    private $alergias;
    private $desayuno;
    private $comida;
    private $cena;
    private $entreComidas;
    private $vasoAguaDia;
    private $otrosLiquidos;
    private $intolerancias;
    private $orinaDia;
    private $orinaNoche;
    private $orinaColor;
    private $orinaOlor;
    private $orinaMolestias;
    private $excrementoDia;
    private $exConsistencia;
    private $exOlor;
    private $exColor;
    private $exDolor;
    private $fechaMenstruacion;
    private $mensPeriodicidad;
    private $mensMolestias;
    private $ejercicioSemana;
    private $fecha;
    private $hora;
    private $usuario;
    private $hijos = array();
    private $antecedentes = array();
    private $antecedentesFam = array();

    public function setValues($paciente, $tipoSangre, $quienRecomendo, $embarazo, $partos, $cesareas, $abortos, $muertos, $enfs, $fuma, $cigarrosDia, $fumaAntiguedad, $alcohol, $alcFrecuencia, $alcoholCantidad, $alcoholTipos, $adicciones, $alergias, $desayuno, $comida, $cena, $entreComidas, $vasoAguaDia, $otrosLiquidos, $intolerancias, $orinaDia, $orinaNoche, $orinaColor, $orinaOlor, $orinaMolestias, $excrementoDia, $exConsistencia, $exOlor, $exColor, $exDolor, $fechaMenstruacion, $mensPeriodicidad, $mensMolestias, $ejercicioSemana, $fecha, $hora, $usuario)
    {
        $this->paciente = $paciente;
        $this->tipoSangre = $tipoSangre;
        $this->quienRecomendo = $quienRecomendo;
        $this->embarazo = $embarazo;
        $this->partos = $partos;
        $this->cesareas = $cesareas;
        $this->abortos = $abortos;
        $this->muertos = $muertos;
        $this->enfs = $enfs;
        $this->fuma = $fuma;
        $this->cigarrosDia = $cigarrosDia;
        $this->fumaAntiguedad = $fumaAntiguedad;
        $this->alcohol = $alcohol;
        $this->alcFrecuencia = $alcFrecuencia;
        $this->alcoholCantidad = $alcoholCantidad;
        $this->alcoholTipos = $alcoholTipos;
        $this->adicciones = $adicciones;
        $this->alergias = $alergias;
        $this->desayuno = $desayuno;
        $this->comida = $comida;
        $this->cena = $cena;
        $this->entreComidas = $entreComidas;
        $this->vasoAguaDia = $vasoAguaDia;
        $this->otrosLiquidos = $otrosLiquidos;
        $this->intolerancias = $intolerancias;
        $this->orinaDia = $orinaDia;
        $this->orinaNoche = $orinaNoche;
        $this->orinaColor = $orinaColor;
        $this->orinaOlor = $orinaOlor;
        $this->orinaMolestias = $orinaMolestias;
        $this->excrementoDia = $excrementoDia;
        $this->exConsistencia = $exConsistencia;
        $this->exOlor = $exOlor;
        $this->exColor = $exColor;
        $this->exDolor = $exDolor;
        $this->fechaMenstruacion = $fechaMenstruacion;
        $this->mensPeriodicidad = $mensPeriodicidad;
        $this->mensMolestias = $mensMolestias;
        $this->ejercicioSemana = $ejercicioSemana;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->usuario = $usuario;
    }
    public function setHijos($hijos)
    {
        $this->hijos = $hijos;
    }
    function setAntecedentes($antecedentes)
    {
        $this->antecedentes = $antecedentes;
    }
    function setAntecedentesFam($antecedentesFam)
    {
        $this->antecedentesFam = $antecedentesFam;
    }
    function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
    function convertir($texto)
    {
        return iconv('UTF-8', 'ISO-8859-1', $texto);
    }
    function Header()
    {
        $titulo = $this->convertir("Ficha Clínica");
        $this->fecha = $this->convertir("Fecha: 10/11/2024");
        $this->SetFont('Times', 'BI', 16);
        // CELL (width, height, text, border, end line, align)
        $this->Cell(100, 5, $titulo, 0, 0, '');
        $this->SetFont('Times', '', 12);
        $this->Cell(89, 5, $this->fecha, 0, 1, 'R');
        $this->Ln(5);
    }
    function cuerpo()
    {
        $nombre = $this->convertir("NOMBRE: Emiliano Alvaro Manzanos Avelardino");
        $ta = $this->convertir("TA: 120/90");
        $oxigeno = $this->convertir("OXIGENO: 95");
        $pulso = $this->convertir("PULSO: 85 PPM");
        $peso = $this->convertir("PESO: 80 KG");
        $estatura = $this->convertir("ESTATURA: 164 CM");
        $temperatura = $this->convertir("TEMP: 36.8 C");
        $tipoSangre = $this->convertir("TIPO SANGRE: OB+");
        $nacFecha = $this->convertir("NAC FECHA: 01/09/2000");
        $edad = $this->convertir("EDAD: 28 años");
        $sexo = $this->convertir("SEXO: Masculino");
        $lugar = $this->convertir("LUGAR: Guadalajara, Jalisco");
        $exploracionFisica = $this->convertir("Exploración Física");
        $datosPaciente = $this->convertir("Datos del Paciente");
        $domicilioPaciente = $this->convertir("DOMICILIO: Juan Manuel #765 Col. La calma, Guadalajara Jalisco CP 49000");
        $telCasa = $this->convertir("TEL: CASA 55 5555 55");
        $telOficina = $this->convertir("OFICINA 55 5555 55");
        $telCel = $this->convertir("CEL. 55 5555 55");
        $edoCivil = $this->convertir("EDO CIVIL: Divorciado");
        $ocupacion = $this->convertir("OCUPACIÓN: Empleada domestica");
        $escolaridad = $this->convertir("ESCOLARIDAD: Universidad");
        $email = $this->convertir("EMAIL: jalopez@hotmail.com");
        $quienRecomendo = $this->convertir("QUIEN LO(A) RECOMENDO: Nombre de la persona");
        $numHijos = $this->convertir("No. HIJOS: 2");
        $sexoHijo = $this->convertir("SEXO: Masculino");
        $edades = $this->convertir("EDADES: 10 y 12");
        $embarazos = $this->convertir("EMBARAZOS: 3");
        $partos = $this->convertir("PARTOS: 2");
        $cesareas = $this->convertir("CESÁREAS: 1");
        $abortos = $this->convertir("ABORTOS: 0");
        $muertos = $this->convertir("MUERTOS: 0");
        $enfs = $this->convertir("ENFS: Hipertensión");

        $antecNoPat=$this->convertir("Antecedentes no patológicos");
        $fuma = $this->convertir("¿FUMA?: Sí");
        $noPorDia = $this->convertir("#/ DÍA: 10");
        $antiguedad = $this->convertir("ANTIGUEDAD: 5 años");
        $alcohol = $this->convertir("ALCOHOL: Sí");
        $frecuencia = $this->convertir("FRECUENCIA: Ocasional");
        $cantidad = $this->convertir("CANTIDAD: 2 copas");
        $tipos = $this->convertir("TIPOS: Cerveza y vino");
        $adicciones = $this->convertir("ADICCIONES: Ninguna");
        $alergias = $this->convertir("ALERGIAS: Polen");
        $desayuno = $this->convertir("DESAYUNO: Café y pan");
        $comida = $this->convertir("COMIDA: Pollo y arroz");
        $cena = $this->convertir("CENA: Ensalada y pescado");
        $entreComidas = $this->convertir("ENTRE COMIDAS: Frutas");
        $vasosAguaDia = $this->convertir("VASOS DE AGUA AL DÍA: 8");
        $otrosLiquidos = $this->convertir("OTROS LÍQUIDOS: Jugo de naranja");
        $intolerancias = $this->convertir("INTOLERANCIAS: Lactosa");
        $orina = $this->convertir("ORINA: Diurna");
        $colorOrina = $this->convertir("COLOR Amarillo claro");
        $olorOrina = $this->convertir("OLOR  Normal");
        $molestiasOrina = $this->convertir("MOLESTIAS: Ninguna");
        $excrementoDia = $this->convertir("EXCREMENTO AL DÍA: 1");
        $consistenciaExcremento = $this->convertir("CONSISTENCIA: Normal");
        $olorExcremento = $this->convertir("OLOR: Sin olor");
        $colorExcremento = $this->convertir("COLOR: Marrón");
        $dolorExcremento = $this->convertir("DOLOR: Ninguno");
        $fechaUltimaMenstruacion = $this->convertir("FECHA ÚLTIMA MENSTRUACIÓN: 01/01/2024");
        $periodicidadMenstruacion = $this->convertir("PERIODICIDAD: 28 días");
        $molestiasMenstruacion = $this->convertir("MOLESTIAS: Ninguna");
        $ejercicioSemana = $this->convertir("EJERCICIO SEMANA: 3 días");
        $antecedentes = $this->convertir("Antecedentes: Ninguno");
        $antecedentesFamiliares = $this->convertir("ANTECEDENTES FAMILIARES: Diabetes");


        $this->SetFont('Arial', '', 11);
        // CELL (width, height, text, border, end line, align)
        // MULTICELL (ancho, tamaño linea, texto, borde,alineacion c o i, fondo)
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
        // $this->Ln(2); //

        //Exploracion fisica //
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10, $exploracionFisica, 0, 1);

        /* $this->SetXY($x+189, $y);*/
        $y = $this->GetY();
        $x = $this->GetX();

        $this->SetFont('Arial', '', 11);
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
        //Datos
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10, $datosPaciente, 0, 1);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->SetFont('Arial', '', 11);
        $this->MultiCell(189, 7, $domicilioPaciente, 1);
        // $this->SetXY($x+189, $y);
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

        $this->MultiCell(63, 7, $telCel, 1);
        // $this->SetXY($x+63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(89, 7, $edoCivil, 1);
        $this->SetXY($x + 89, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(100, 7, $ocupacion, 1);
        // $this->SetXY($x+76, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(89, 7, $escolaridad, 1);
        $this->SetXY($x + 89, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(100, 7, $email, 1);
        // $this->SetXY($x+76, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(189, 7, $quienRecomendo, 1);
        // $this->SetXY($x+189, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Número de hijos"
        $this->MultiCell(30, 7, $numHijos, 1);
        $this->SetXY($x + 30, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Sexo y edades"
        $this->MultiCell(70, 7, $sexoHijo, 1);
        $this->SetXY($x + 70, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Sexo y edades"
        $this->MultiCell(89, 7, $edades, 1);
        // $this->SetXY($x + 89, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->MultiCell(49, 7, $embarazos, 1);
        $this->SetXY($x + 49, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Partos"
        $this->MultiCell(35, 7, $partos, 1);
        $this->SetXY($x + 35, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Cesáreas"
        $this->MultiCell(35, 7, $cesareas, 1);
        $this->SetXY($x + 35, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Abortos"
        $this->MultiCell(35, 7, $abortos, 1);
        $this->SetXY($x + 35, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Muertos"
        $this->MultiCell(35, 7, $muertos, 1);
        // $this->SetXY($x + 35, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Enfermedades"
        $this->MultiCell(189, 7, $enfs, 1);
        // $this->SetXY($x + 189, $y);

        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10, $antecNoPat, 0, 1);
        $y = $this->GetY();
        $x = $this->GetX();
        
        $this->SetFont('Arial', '', 11);
        // MultiCell para "Fuma"
        $this->MultiCell(63, 7, $fuma, 1);
        $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "No. por día"
        $this->MultiCell(63, 7, $noPorDia, 1);
        $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Antigüedad"
        $this->MultiCell(63, 7, $antiguedad, 1);
        // $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();


        //nueva linea
        // MultiCell para "Alcohol"
        $this->MultiCell(29, 7, $alcohol, 1);
        $this->SetXY($x + 29, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Frecuencia"
        $this->MultiCell(80, 7, $frecuencia, 1);
        $this->SetXY($x + 80, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Cantidad"
        $this->MultiCell(80, 7, $cantidad, 1);
        // $this->SetXY($x + 80, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Tipos"
        $this->MultiCell(189, 7, $tipos, 1);
        // $this->SetXY($x + 189, $y);
        $y = $this->GetY();
        $x = $this->GetX();


        // MultiCell para "Adicciones"
        $this->MultiCell(189, 7, $adicciones, 1);
        // $this->SetXY($x + 189, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Alergias"
        $this->MultiCell(189, 7, $alergias, 1);
        // $this->SetXY($x + 189, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Desayuno"
        $this->MultiCell(63, 7, $desayuno, 1);
        $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Comida"
        $this->MultiCell(63, 7, $comida, 1);
        $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Cena"
        $this->MultiCell(63, 7, $cena, 1);
        $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();


    }



    function footer()
    {
        $this->SetY(-20);
        $pagina = $this->convertir("Página ");
        $this->Cell(0, 10, $pagina . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
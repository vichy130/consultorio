<?php
require ('./fpdf/fpdf.php');

class FichaPDF extends FPDF
{
    // private $id;
    private $paciente;
    private $ficha;
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
    function setPaciente($paciente)
    {
        $this->paciente = $paciente;
    }
    function setFicha($ficha)
    {
        $this->ficha = $ficha;
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
        $fecha = $this->convertir("Fecha: ".$this->ficha['fecha']);
        $this->SetFont('Times', 'BI', 16);
        // CELL (width, height, text, border, end line, align)
        $this->Cell(100, 5, $titulo, 0, 0, '');
        $this->SetFont('Times', '', 12);
        $this->Cell(89, 5, $fecha, 0, 1, 'R');
        $this->Ln(5);
    }
    function cuerpo()
    {
        $nac = new DateTime($this->paciente['fechaNacimiento']);
        $hoy = new DateTime();
        $dif = $nac->diff($hoy);
        $edad = $dif->y;
        $countHijos = 0;
        $countH = 0;
        $countM = 0;
        $countO = 0;
        $cadenaSexoHijo = "";
        $cadenaEdades = "";
        foreach ($this->hijos as $h) {
            $countHijos++;
            if ($cadenaEdades > 1) {
                $cadenaEdades .= ", " . $h['edad'];
            } else {
                $cadenaEdades .= $h['edad'];
            }
            if ($h['sexo'] == "Hombre") {
                $countH++;
            } else if ($h['sexo'] == "Mujer") {
                $countM++;
            } else {
                $countO++;
            }
        }
        if ($countH > 0) {
            $cadenaSexoHijo .= $countH . " Hombre ";
        }
        if ($countM > 0) {
            $cadenaSexoHijo .= $countH . " Mujer ";
        }
        if ($countO > 0) {
            $cadenaSexoHijo .= $countO . " Indef. ";
        }
        $fumaResultado="";
        if($this->ficha['fuma']==0){
            $fumaResultado="No";
        }else{
            $fumaResultado="Sí";
        }
        $alcoholResultado="";
        if($this->ficha['alcohol']==0){
            $alcoholResultado="No";
        }else{
            $alcoholResultado="Sí";
        }
        // $cadenaEdades=
        $nombre = $this->convertir("NOMBRE: " . $this->paciente['nombre'] . " " . $this->paciente['apellidoPaterno'] . " " . $this->paciente['apellidoMaterno']);
        // $ta = $this->convertir("TA: ");
        // $oxigeno = $this->convertir("OXIGENO: ");
        // $pulso = $this->convertir('PULSO: '..' PPM');
        // $peso = $this->convertir('PESO:'..' KG');
        // $estatura = $this->convertir('ESTATURA: '..' CM');
        // $temperatura = $this->convertir('TEMP: '..' C');
        $tipoSangre = $this->convertir("TIPO SANGRE: " . $this->ficha['tipoSangre']);
        $nacFecha = $this->convertir("NAC FECHA: " . $this->paciente['fechaNacimiento']);
        $edad = $this->convertir("EDAD: " . $edad);
        $sexo = $this->convertir("SEXO: " . $this->paciente['sexo']);
        $lugar = $this->convertir("LUGAR: " . $this->paciente['lugarNacimiento']);
        $datosPaciente = $this->convertir("Datos del Paciente");
        $domicilioPaciente = $this->convertir("DOMICILIO: " . $this->paciente['calle'] ." ". $this->paciente['colonia'] ." ". $this->paciente['ciudad'] ." ". $this->paciente['codigoPostal']);
        $telCasa = $this->convertir("TEL: CASA " . $this->paciente['telCasa']);
        $telOficina = $this->convertir("OFICINA " . $this->paciente['telOficina']);
        $telCel = $this->convertir("CEL. " . $this->paciente['celular']);
        $edoCivil = $this->convertir("EDO CIVIL: " . $this->paciente['edoCivil']);
        $ocupacion = $this->convertir("OCUPACIÓN: " . $this->paciente['ocupacion']);
        $escolaridad = $this->convertir("ESCOLARIDAD: " . $this->paciente['escolaridad']);
        $email = $this->convertir('EMAIL: ' . $this->paciente['correo']);
        $quienRecomendo = $this->convertir("QUIEN LO(A) RECOMENDO: " . $this->ficha['quienRecomendo']);
        $numHijos = $this->convertir("No. HIJOS: " . $countHijos);
        $sexoHijo = $this->convertir("SEXO: " . $cadenaSexoHijo);
        $edades = $this->convertir("EDADES: " . $cadenaEdades);
        $embarazos = $this->convertir("EMBARAZOS: " . $this->ficha['embarazo']);
        $partos = $this->convertir("PARTOS: " . $this->ficha['partos']);
        $cesareas = $this->convertir("CESÁREAS: " . $this->ficha['cesareas']);
        $abortos = $this->convertir("ABORTOS: " . $this->ficha['abortos']);
        $muertos = $this->convertir("MUERTOS: " . $this->ficha['muertos']);
        $enfs = $this->convertir("ENFS: " . $this->ficha['enfs']);

        $antecNoPat = $this->convertir("Antecedentes no patológicos");

        $fuma = $this->convertir("¿FUMA?: " .$fumaResultado);
        $noPorDia = $this->convertir("#/ DÍA: " . $this->ficha['cigarrosDia']);
        $antiguedad = $this->convertir("ANTIGUEDAD: " . $this->ficha['fumaAntiguedad']);
        $alcohol = $this->convertir("ALCOHOL: " . $alcoholResultado);
        $frecuencia = $this->convertir("FRECUENCIA: " . $this->ficha['alcFrecuencia']);
        $cantidad = $this->convertir("CANTIDAD: " . $this->ficha['alcFrecuencia']);
        $tipos = $this->convertir("TIPOS: " . $this->ficha['alcoholCantidad']);
        $adicciones = $this->convertir("ADICCIONES: " . $this->ficha['adicciones']);
        $alergias = $this->convertir("ALERGIAS: " . $this->ficha['alergias']);
        $desayuno = $this->convertir("DESAYUNO: " . $this->ficha['desayuno']);
        $comida = $this->convertir("COMIDA: " . $this->ficha['comida']);
        $cena = $this->convertir("CENA: " . $this->ficha['cena']);
        $entreComidas = $this->convertir("ENTRE COMIDAS: " . $this->ficha['entreComidas']);
        $vasosAguaDia = $this->convertir("VASOS DE AGUA AL DÍA: " . $this->ficha['vasoAguaDia']);
        $otrosLiquidos = $this->convertir("OTROS LÍQUIDOS: " . $this->ficha['otrosLiquidos']);
        $intolerancias = $this->convertir("TIENE INTOLERANCIAS: " . $this->ficha['intolerancias']);
        $orinaDia = $this->convertir("ORINA: DÍA" . $this->ficha['orinaDia']);
        $orinaNoche = $this->convertir("NOCHE " . $this->ficha['orinaNoche']);
        $colorOrina = $this->convertir("COLOR " . $this->ficha['orinaColor']);
        $olorOrina = $this->convertir("OLOR  " . $this->ficha['orinaOlor']);
        $molestiasOrina = $this->convertir('MOLESTIAS: ' . $this->ficha['orinaMolestias']);
        $excrementoDia = $this->convertir("EXCREMENTO AL DÍA: " . $this->ficha['excrementoDia']);
        $consistenciaExcremento = $this->convertir("CONSISTENCIA: " . $this->ficha['exConsistencia']);
        $olorExcremento = $this->convertir("OLOR: " . $this->ficha['exOlor']);
        $colorExcremento = $this->convertir("COLOR: "/*.$this->ficha['exColor']*/);
        $dolorExcremento = $this->convertir("DOLOR: " . $this->ficha['exDolor']);
        $fechaUltimaMenstruacion = $this->convertir("FECHA ÚLTIMA MENSTRUACIÓN: " . $this->ficha['fechaMenstruacion']);
        $periodicidadMenstruacion = $this->convertir("PERIODICIDAD: " . $this->ficha['mensPeriodicidad']);
        $molestiasMenstruacion = $this->convertir("MOLESTIAS: " . $this->ficha['mensMolestias']);
        $ejercicioSemana = $this->convertir("EJERCICIO SEMANA: " . $this->ficha['ejercicioSemana']);
        $alimentacion = $this->convertir("Alimentación");
        $urologia = $this->convertir("Urología");
        $gastro = $this->convertir("Gastroenterología");
        $gine = $this->convertir("Ginecología");
        $antec = $this->convertir("Antecedentes");
        $antecFam = $this->convertir("Antecedentes Familiares");

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
        // $this->SetFont('Arial', 'I', 12);
        // $this->Cell(189, 10, $exploracionFisica, 0, 1);

        // /* $this->SetXY($x+189, $y);*/
        // $y = $this->GetY();
        // $x = $this->GetX();

        // $this->SetFont('Arial', '', 11);
        // $this->MultiCell(47.25, 7, $ta, 1);
        // $this->SetXY($x + 47.25, $y);
        // $y = $this->GetY();
        // $x = $this->GetX();

        // $this->MultiCell(47.25, 7, $oxigeno, 1);
        // $this->SetXY($x + 47.25, $y);
        // $y = $this->GetY();
        // $x = $this->GetX();

        // $this->MultiCell(47.25, 7, $pulso, 1);
        // $this->SetXY($x + 47.25, $y);
        // $y = $this->GetY();
        // $x = $this->GetX();

        // $this->MultiCell(47.25, 7, $peso, 1);
        // /*$this->SetXY($x+47.25, $y);*/
        // $y = $this->GetY();
        // $x = $this->GetX();

        // $this->MultiCell(47.25, 7, $estatura, 1);
        // $this->SetXY($x + 47.25, $y);
        // $y = $this->GetY();
        // $x = $this->GetX();

        // $this->MultiCell(141.75, 7, $temperatura, 1);
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

        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10, $alimentacion, 0, 1);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->SetFont('Arial', '', 11);

        // MultiCell para "Desayuno"
        $this->MultiCell(189, 7, $desayuno, 1);
        // $this->SetXY($x + 189, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Comida"
        $this->MultiCell(189, 7, $comida, 1);
        // $this->SetXY($x +189, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Cena"
        $this->MultiCell(189, 7, $cena, 1);
        // $this->SetXY($x + 189, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Entre comidas"
        $this->MultiCell(189, 7, $entreComidas, 1);
        // $this->SetXY($x + 120, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Vasos agua al día"
        $this->MultiCell(60, 7, $vasosAguaDia, 1);
        $this->SetXY($x + 60, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Otros líquidos"
        $this->MultiCell(129, 7, $otrosLiquidos, 1);
        // $this->SetXY($x + 109, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Tiene intolerancias"
        $this->MultiCell(189, 7, $intolerancias, 1);
        // $this->SetXY($x + 189, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10, $urologia, 0, 1);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->SetFont('Arial', '', 11);

        // MultiCell para "Orina: día o noche"
        $this->MultiCell(63, 7, $orinaDia, 1);
        $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Orina: día o noche"
        $this->MultiCell(63, 7, $orinaNoche, 1);
        $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Color orina"
        $this->MultiCell(63, 7, $colorOrina, 1);
        // $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Olor orina"
        $this->MultiCell(63, 7, $olorOrina, 1);
        $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Molestias orina"
        $this->MultiCell(126, 7, $molestiasOrina, 1);
        // $this->SetXY($x + 126, $y);
        // $y = $this->GetY();
        // $x = $this->GetX();

        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10, $gastro, 0, 1);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->SetFont('Arial', '', 11);

        // MultiCell para "Excremento al día"
        $this->MultiCell(189, 7, $excrementoDia, 1);
        // $this->SetXY($x + 189, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Consistencia excremento"
        $this->MultiCell(63, 7, $consistenciaExcremento, 1);
        $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Olor excremento"
        $this->MultiCell(63, 7, $olorExcremento, 1);
        $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Color excremento"
        $this->MultiCell(63, 7, $colorExcremento, 1);
        // $this->SetXY($x + 63, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Dolor excremento"
        $this->MultiCell(189, 7, $dolorExcremento, 1);
        // $this->SetXY($x + 119, $y);
        // $y = $this->GetY();
        // $x = $this->GetX();

        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10, $gine, 0, 1);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->SetFont('Arial', '', 11);

        // MultiCell para "Fecha última menstruación"
        $this->MultiCell(94.5, 7, $fechaUltimaMenstruacion, 1);
        $this->SetXY($x + 94.5, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Periodicidad menstruación"
        $this->MultiCell(94.5, 7, $periodicidadMenstruacion, 1);
        // $this->SetXY($x + 94.5, $y);
        $y = $this->GetY();
        $x = $this->GetX();

        // MultiCell para "Molestias menstruación"
        $this->MultiCell(189, 7, $molestiasMenstruacion, 1);
        // $this->SetXY($x + 120, $y);
        // $y = $this->GetY();
        // $x = $this->GetX();

        $this->Ln(7);
        // MultiCell para "Ejercicio semana"
        $this->MultiCell(189, 7, $ejercicioSemana, 1);
        // $this->SetXY($x + 189, $y);
        // $y = $this->GetY();
        // $x = $this->GetX();

        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10, $antec, 0, 1);
        $y = $this->GetY();
        $x = $this->GetX();

        $this->SetFont('Arial', '', 11);

        foreach ($this->antecedentes as $a) {
            $enfermedad = $this->convertir("ENFERMEDAD: " . $a['enfermedad']);
            $descripcion = $this->convertir($a['descripcion']);

            // MultiCell para "Antecedentes"
            $this->MultiCell(189, 7, $enfermedad . ". " . $descripcion, 1);
            // $this->SetXY($x + 94.5, $y);
            $y = $this->GetY();
            $x = $this->GetX();

            // // MultiCell para "Antecedentes"
            // $this->MultiCell(189, 7, $descripcion, 1);
            // // $this->SetXY($x + 94.5, $y);
            // $y = $this->GetY();
            // $x = $this->GetX();
        }

        $this->SetFont('Arial', 'I', 12);
        $this->Cell(189, 10, $antecFam, 0, 1);
        $y = $this->GetY();
        $x = $this->GetX();




        $this->SetFont('Arial', '', 11);

        foreach ($this->antecedentesFam as $a) {
            $parentesco = $this->convertir("PARENTESCO: ".$a['familiar']);
            $enfamiliar = $this->convertir("ENFERMEDAD: ".$a['enfermedad']);
            $descfamiliar = $this->convertir("DESCRIPCIÓN: ".$a['descripcion']);

            // MultiCell para "Antecedentes Fam"
            $this->MultiCell(70, 7, $parentesco, 'TL');
            $this->SetXY($x + 70, $y);
            $y = $this->GetY();
            $x = $this->GetX();

            // MultiCell para "Antecedentes Fam"
            $this->MultiCell(119, 7, $enfamiliar, 'TR');
            // $this->SetXY($x + 94.5, $y);
            $y = $this->GetY();
            $x = $this->GetX();

            // MultiCell para "Antecedentes Fam"
            $this->MultiCell(189, 7, $descfamiliar, 'LRB');
            // $this->SetXY($x + 94.5, $y);
            $y = $this->GetY();
            $x = $this->GetX();
        }

    }
    function footer()
    {
        $this->SetY(-20);
        $pagina = $this->convertir("Página ");
        $this->Cell(0, 10, $pagina . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
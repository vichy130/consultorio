<?php
    include_once("../models/ficha-clinica.php");

    $ficha= new ficha();

    $ficha->tipoSangre  = $_POST["tipo-sangre"];
    $ficha->quienRecomendo  = $_POST["tipo-sangre"];
    $ficha->hijo  = $_POST["tipo-sangre"];
    $ficha->embarazo  = $_POST["tipo-sangre"];
    $ficha->partos  = $_POST["tipo-sangre"];
    $ficha->cesareas  = $_POST["tipo-sangre"];
    $ficha->abortos  = $_POST["tipo-sangre"];
    $ficha->muertos  = $_POST["tipo-sangre"];
    $ficha->enfs  = $_POST["tipo-sangre"];
    $ficha->fuma  = $_POST["tipo-sangre"];
    $ficha->cigarrosDia  = $_POST["tipo-sangre"];
    $ficha->fumaAntiguedad  = $_POST["tipo-sangre"];
    $ficha->alcohol  = $_POST["tipo-sangre"];
    $ficha->alcFrecuencia  = $_POST["tipo-sangre"];
    $ficha->alcoholCantidad  = $_POST["tipo-sangre"];
    $ficha->alcoholTipos  = $_POST["tipo-sangre"];
    $ficha->adicciones  = $_POST["tipo-sangre"];
    $ficha->alergias  = $_POST["tipo-sangre"];
    $ficha->desayuno  = $_POST["tipo-sangre"];
    $ficha->comida  = $_POST["tipo-sangre"];
    $ficha->cena  = $_POST["tipo-sangre"];
    $ficha->entreComidas  = $_POST["tipo-sangre"];
    $ficha->vasoAguaDia  = $_POST["tipo-sangre"];
    $ficha->otrosLiquidos  = $_POST["tipo-sangre"];
    $ficha->intolerancias  = $_POST["tipo-sangre"];
    $ficha->orinaDia  = $_POST["tipo-sangre"];
    $ficha->orinaNoche  = $_POST["tipo-sangre"];
    $ficha->orinaColor  = $_POST["tipo-sangre"];
    $ficha->orinaOlor  = $_POST["tipo-sangre"];
    $ficha->orinaMolestias  = $_POST["tipo-sangre"];
    $ficha->excrementoDia  = $_POST["tipo-sangre"];
    $ficha->exConsistencia  = $_POST["tipo-sangre"];
    $ficha->exOlor  = $_POST["tipo-sangre"];
    $ficha->exColor  = $_POST["tipo-sangre"];
    $ficha->exDolor  = $_POST["tipo-sangre"];
    $ficha->fechaMenstruacion  = $_POST["tipo-sangre"];
    $ficha->mensPeriodicidad  = $_POST["tipo-sangre"];
    $ficha->mensMolestias  = $_POST["tipo-sangre"];
    $ficha->ejercicioSemana  = $_POST["tipo-sangre"];
    $ficha->fecha  = $_POST["tipo-sangre"];
    $ficha->enfermedadesPadecidas  = $_POST["tipo-sangre"];
    $ficha->enfermedadesPresentes  = $_POST["tipo-sangre"];
    $ficha->firmaPaciente  = $_POST["tipo-sangre"];
    $ficha->firmaUsuario  = $_POST["tipo-sangre"];
    $ficha->hora  = $_POST["tipo-sangre"];
    $ficha->usuario  = $_POST["tipo-sangre"];

    if($ficha->insertar()==1){
        echo "ficha registrada";
      }else{
          echo "Error al registrar, intentalo nuevamente";
      }
?>
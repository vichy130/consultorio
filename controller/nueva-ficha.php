<?php
    include_once("../models/ficha-clinica.php");

    $ficha= new ficha();

    $ficha->tipoSangre  = $_POST["tipo-sangre"];
    $ficha->quienRecomendo  = $_POST["recomendo-paciente"];
    $ficha->hijo  = null;
    $ficha->embarazo  = $_POST["embarazos-paciente"];
    $ficha->partos  = $_POST["partos-paciente"];
    $ficha->cesareas  = $_POST["cesareas-paciente"];
    $ficha->abortos  = $_POST["abortos-paciente"];
    $ficha->muertos  = $_POST["muertos-paciente"];
    $ficha->enfs  = $_POST["enfs-paciente"];
    $ficha->fuma  = $_POST["fuma-paciente"];
    $ficha->cigarrosDia  = $_POST["cigarros-paciente"];
    $ficha->fumaAntiguedad  = $_POST["cigarros-antiguedad-paciente"];
    $ficha->alcohol  = $_POST["alcohol-paciente"];
    $ficha->alcFrecuencia  = $_POST["frecuencia-paciente"];
    $ficha->alcoholCantidad  = $_POST["cantidad-paciente"];
    $ficha->alcoholTipos  = $_POST["tipos-paciente"];
    $ficha->adicciones  = $_POST["addiciones-paciente"];
    $ficha->alergias  = $_POST["alergias-paciente"];
    $ficha->desayuno  = $_POST["desayuno-paciente"];
    $ficha->comida  = $_POST["comida-paciente"];
    $ficha->cena  = $_POST["cena-paciente"];
    $ficha->entreComidas  = $_POST["entrecomidas-paciente"];
    $ficha->vasoAguaDia  = $_POST["agua-paciente"];
    $ficha->otrosLiquidos  = $_POST["otrosliquidos-paciente"];
    $ficha->intolerancias  = $_POST["intolerancias-paciente"];
    $ficha->orinaDia  = $_POST["orinadia-paciente"];
    $ficha->orinaNoche  = $_POST["orinanoche-paciente"];
    $ficha->orinaColor  = $_POST["orinacolor-paciente"];
    $ficha->orinaOlor  = $_POST["orinaolor-paciente"];
    $ficha->orinaMolestias  = $_POST["orinamolestias-paciente"];
    $ficha->excrementoDia  = $_POST["excrementoaldia-paciente"];
    $ficha->exConsistencia  = $_POST["excrementoconsistencia-paciente"];
    $ficha->exOlor  = $_POST["excrementoolor-paciente"];
    $ficha->exColor  = $_POST["excrementocolor-paciente"];
    $ficha->exDolor  = $_POST["excrementodolor-paciente"];
    $ficha->fechaMenstruacion  = $_POST["menstruacion-paciente"];
    $ficha->mensPeriodicidad  = $_POST["menstruacionperiodicidad-paciente"];
    $ficha->mensMolestias  = $_POST["menstruacionmolestias-paciente"];
    $ficha->ejercicioSemana  = $_POST["ejercicio-paciente"];
    $ficha->fecha  = $_POST["tipo-sangre"];
    $ficha->enfermedadesPadecidas  = null;
    $ficha->enfermedadesPresentes  = null;
    $ficha->firmaPaciente  = $_POST["firma-paciente"];
    $ficha->firmaUsuario  = $_POST["firma-usuario"];
    $ficha->hora  = null;
    $ficha->usuario  = null;

    if($ficha->insertar()==1){
        echo "ficha registrada";
      }else{
          echo "Error al registrar, intentalo nuevamente";
      }
?>
<?php

session_start();
include_once("../models/ficha-clinica.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');

$jsonHijos = $_POST['json-hijos'];
$hijos = json_decode($jsonHijos);
$jsonAntecedentes = $_POST['json-antecedentes'];
$antecedentes = json_decode($jsonAntecedentes);
$jsonAntecedentesFam = $_POST['json-antecedentesFam'];
echo "echo".$jsonAntecedentesFam;
$antecedentesFam = json_decode($jsonAntecedentesFam);

$ficha = new ficha();
$ficha->id = null;
$id_paciente = $_SESSION["id_paciente"];
$ficha->paciente = $id_paciente;
$ficha->tipoSangre = $_POST["tipo-sangre"];
$ficha->quienRecomendo = $_POST["recomendo-paciente"];
if($_POST["embarazos-paciente"]!=null){
    $ficha->embarazo = $_POST["embarazos-paciente"];
}else{
    $ficha->embarazo =0;
}
if($_POST["partos-paciente"]!=null){
    $ficha->partos = $_POST["partos-paciente"];
}else{
    $ficha->partos =0;
}
if($_POST["cesareas-paciente"]!=null){
    $ficha->cesareas = $_POST["cesareas-paciente"];
}else{
    $ficha->cesareas =0;
}
if($_POST["abortos-paciente"]!=null){
    $ficha->abortos = $_POST["abortos-paciente"];
}else{
    $ficha->abortos =0;
}
if($_POST["muertos-paciente"]!=null){
    $ficha->muertos = $_POST["muertos-paciente"];
}else{
    $ficha->muertos =0;
}
if($_POST["enfs-paciente"]!=null){
    $ficha->enfs = $_POST["enfs-paciente"];
}else{
    $ficha->enfs =0;
}
$ficha->fuma = $_POST["fuma-paciente"];
$ficha->cigarrosDia = $_POST["cigarros-paciente"];
$ficha->fumaAntiguedad = $_POST["cigarros-antiguedad-paciente"];
$ficha->alcohol = $_POST["alcohol-paciente"];
$ficha->alcFrecuencia = $_POST["frecuencia-paciente"];
$ficha->alcoholCantidad = $_POST["cantidad-paciente"];
$ficha->alcoholTipos = $_POST["tipos-paciente"];
$ficha->adicciones = $_POST["addiciones-paciente"];
$ficha->alergias = $_POST["alergias-paciente"];
$ficha->desayuno = $_POST["desayuno-paciente"];
$ficha->comida = $_POST["comida-paciente"];
$ficha->cena = $_POST["cena-paciente"];
$ficha->entreComidas = $_POST["entrecomidas-paciente"];
if($_POST["agua-paciente"]!=null){
    $ficha->vasoAguaDia = $_POST["agua-paciente"];
}else{
    $ficha->vasoAguaDia=0;
}
$ficha->otrosLiquidos = $_POST["otrosliquidos-paciente"];
$ficha->intolerancias = $_POST["intolerancias-paciente"];
$ficha->orinaDia = $_POST["orinadia-paciente"];
$ficha->orinaNoche = $_POST["orinanoche-paciente"];
$ficha->orinaColor = $_POST["orinacolor-paciente"];
$ficha->orinaOlor = $_POST["orinaolor-paciente"];
$ficha->orinaMolestias = $_POST["orinamolestias-paciente"];
$ficha->excrementoDia = $_POST["excrementoaldia-paciente"];
$ficha->exConsistencia = $_POST["excrementoconsistencia-paciente"];
$ficha->exOlor = $_POST["excrementoolor-paciente"];
$ficha->exColor = $_POST["excrementocolor-paciente"];
$ficha->exDolor = $_POST["excrementodolor-paciente"];
$ficha->fechaMenstruacion = $_POST["menstruacion-paciente"];;
$ficha->mensPeriodicidad = $_POST["menstruacionperiodicidad-paciente"];
$ficha->mensMolestias = $_POST["menstruacionmolestias-paciente"];
$ficha->ejercicioSemana = $_POST["ejercicio-paciente"];
$ficha->fecha = $_POST['oculto-fecha-ficha'];
$ficha->firmaPaciente = $_POST["firma-paciente"];
$ficha->firmaUsuario = $_POST["firma-usuario"];
$ficha->hora = date("H:i:s");
$ficha->usuario = $_SESSION['username'];
$ficha->hijos = null;
$ficha->antcedentes= null;
$ficha->antecedentesFamilia=null;


if ($ficha->insertar() == 1) {
    $ficha->id = $ficha->id();
    if (!empty($hijos)) {
        $ficha->hijos= $ficha->insertarHijos($hijos, $ficha->id);
    }
    if (!empty($antecedentes)){
        $ficha->antecedentes= $ficha->insertarAntecedentes($antecedentes, $ficha->id);
    }
    if(!empty($antecedentesFam)){
        $ficha->antecedentesFamilia= $ficha->insertarAntecedentesFam($antecedentesFam, $ficha->id);
    }

} else {
    echo "Error al registrar, intentalo nuevamente";
}

?>
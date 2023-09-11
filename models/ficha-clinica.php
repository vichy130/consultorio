<?php
include_once("../models/hijo.php");
class ficha{

    var $id;
    var $paciente;
    var $tipoSangre;
    var $quienRecomendo;
    var $embarazo;
    var $partos;
    var $cesareas;
    var $abortos;
    var $muertos;
    var $enfs;
    var $fuma;
    var $cigarrosDia;
    var $fumaAntiguedad;
    var $alcohol;
    var $alcFrecuencia;
    var $alcoholCantidad;
    var $alcoholTipos;
    var $adicciones;
    var $alergias;
    var $desayuno;
    var $comida;
    var $cena;
    var $entreComidas;
    var $vasoAguaDia;
    var $otrosLiquidos;
    var $intolerancias;
    var $orinaDia;
    var $orinaNoche;
    var $orinaColor;
    var $orinaOlor;
    var $orinaMolestias;
    var $excrementoDia;
    var $exConsistencia;
    var $exOlor;
    var $exColor;
    var $exDolor;
    var $fechaMenstruacion;
    var $mensPeriodicidad;
    var $mensMolestias;
    var $ejercicioSemana;
    var $fecha;
    var $enfermedadesPadecidas;
    var $enfermedadesPresentes;
    var $firmaPaciente;
    var $firmaUsuario;
    var $hora;
    var $usuario;

    var $hijos=array();

    var $antecedentes=array();

    var $antecedentesFam=array();

    function insertar(){
        include_once("../php/conexion.php");
        //conexion:
        /*
        $query="insert into ficha (paciente,tipoSangre, quienRecomendo, embarazo, partos, cesareas, abortos, muertos, enfs, fuma, cigarrosDia, fumaAntiguedad, alcohol, alcFrecuencia, alcoholCantidad, alcoholTipos, adicciones, alergias, desayuno, comida, cena, entreComidas, vasoAguaDia, otrosLiquidos, intolerancias, orinaDia, orinaNoche, orinaColor, orinaOlor, orinaMolestias, excrementoDia, exConsistencia, exOlor, exColor, exDolor,mensPeriodicidad, mensMolestias, ejercicioSemana, usuario) values ('$this->paciente', '$this->tipoSangre', '$this->quienRecomendo', '$this->embarazo', '$this->partos', '$this->cesareas','$this->abortos','$this->muertos', '$this->enfs', '$this->fuma',  '$this->cigarrosDia', '$this->fumaAntiguedad', '$this->alcohol', '$this->alcFrecuencia, '$this->alcoholCantidad', '$this->alcoholTipos', '$this->adicciones', '$this->alergias', '$this->desayuno', '$this->comida', '$this->cena', '$this->entreComidas', '$this->vasoAguaDia', '$this->otrosLiquidos', '$this->intolerancias', '$this->orinaDia', '$this->orinaNoche', '$this->orinaColor', '$this->orinaOlor', '$this->orinaMolestias', '$this->excrementoDia', '$this->exConsistencia', '$this->exOlor', '$this->exColor', '$this->exDolor', '$this->mensPeriodicidad','$this->mensMolestias','$this->ejercicioSemana', '$this->usuario'); ";
        */

        $query="insert into ficha (paciente,tipoSangre, quienRecomendo, embarazo, partos, cesareas, abortos, muertos,enfs, fuma, cigarrosDia, fumaAntiguedad,  alcohol, alcFrecuencia, alcoholCantidad, alcoholTipos, adicciones, alergias, desayuno, comida, cena, entreComidas, vasoAguaDia, otrosLiquidos, intolerancias, orinaDia, orinaNoche, orinaColor, orinaOlor, orinaMolestias, excrementoDia, exConsistencia, exOlor, exColor, exDolor, fechaMenstruacion, mensPeriodicidad, mensMolestias, ejercicioSemana, fecha, hora, usuario) values ('$this->paciente', '$this->tipoSangre', '$this->quienRecomendo', '$this->embarazo', '$this->partos', '$this->cesareas', '$this->abortos', '$this->muertos', '$this->enfs', '$this->fuma', '$this->cigarrosDia', '$this->fumaAntiguedad', '$this->alcohol', '$this->alcFrecuencia', '$this->alcoholCantidad', '$this->alcoholTipos','$this->adicciones', '$this->alergias', '$this->desayuno', '$this->comida', '$this->cena', '$this->entreComidas', '$this->vasoAguaDia', '$this->otrosLiquidos', '$this->intolerancias', '$this->orinaDia', '$this->orinaNoche', '$this->orinaColor', '$this->orinaOlor', '$this->orinaMolestias', '$this->excrementoDia', '$this->exConsistencia', '$this->exOlor', '$this->exColor', '$this->exDolor', '$this->fechaMenstruacion', '$this->mensPeriodicidad', '$this->mensMolestias', '$this->ejercicioSemana', '$this->fecha', '$this->hora', '$this->usuario'); ";
        echo $query;
        $stmt=$dbh->prepare($query);
        $return= $stmt->execute();
        $this->id= $dbh->lastInsertId();
        return $return;
    }

    function insertarHijos($hijos, $id){
        foreach ($hijos as $i) {
            $hijo = new hijo();
            $hijo->sexo = $i->_sexo;
            $hijo->edad = $i->_edad;
            $hijo->ficha = $id;
            $this->hijos[] = $hijo;
            $hijo->insertar();
        }
        return $this->hijos;
    }

    function insertarAntecedentes($antecedentes, $id){
        return $this->antecedentes;
    }

    function insertarAntecedentesFam($antecedentesFam, $id){
        $this->antecedentesFam;
        return $this->antecedentesFam;
    }

    function buscarDatos(){
        include_once("./php/conexion.php");
        $query="SELECT * FROM ficha WHERE paciente= $this->paciente; ";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
         $datos = null;
          while( $datos = $stmt->fetch(PDO::FETCH_ASSOC) ){ 
              $this->id = $datos["id"];
              $this->paciente = $datos["paciente"];
              $this->tipoSangre = $datos["tipoSangre"];
              $this->quienRecomendo = $datos["quienRecomendo"];
              $this->embarazo = $datos["embarazo"];
              $this->partos = $datos["partos"];
              $this->cesareas = $datos["cesareas"];
              $this->abortos = $datos["abortos"];
              $this->muertos = $datos["muertos"];
              $this->enfs = $datos["enfs"];
              $this->fuma = $datos["fuma"];
              $this->cigarrosDia = $datos["cigarrosDia"];
              $this->fumaAntiguedad = $datos["fumaAntiguedad"];
              $this->alcohol = $datos["alcohol"];
              $this->alcFrecuencia = $datos["alcFrecuencia"];
              $this->alcoholCantidad = $datos["alcoholCantidad"];
              $this->alcoholTipos = $datos["alcoholTipos"];
              $this->adicciones = $datos["adicciones"];
              $this->alergias = $datos["alergias"];
              $this->desayuno = $datos["desayuno"];
              $this->comida = $datos["comida"];
              $this->cena = $datos["cena"];
              $this->entreComidas = $datos["entreComidas"];
              $this->vasoAguaDia = $datos["vasoAguaDia"];
              $this->otrosLiquidos = $datos["otrosLiquidos"];
              $this->intolerancias = $datos["intolerancias"];
              $this->orinaDia = $datos["orinaDia"];
              $this->orinaNoche = $datos["orinaNoche"];
              $this->orinaColor = $datos["orinaColor"];
              $this->orinaOlor = $datos["orinaOlor"];
              $this->orinaMolestias = $datos["orinaMolestias"];
              $this->excrementoDia = $datos["excrementoDia"];
              $this->exConsistencia = $datos["exConsistencia"];
              $this->exOlor = $datos["exOlor"];
              $this->exColor = $datos["exColor"];
              $this->exDolor = $datos["exDolor"];
              $this->fechaMenstruacion = $datos["fechaMenstruacion"];
              $this->mensPeriodicidad = $datos["mensPeriodicidad"];
              $this->mensMolestias = $datos["mensMolestias"];
              $this->ejercicioSemana = $datos["ejercicioSemana"];
              $this->fecha = $datos["fecha"];
              $this->enfermedadesPadecidas = $datos["enfermedadesPadecidas"];
              $this->enfermedadesPresentes = $datos["enfermedadesPresentes"];
              $this->firmaUsuario = $datos["firmaUsuario"];
              $this->hora = $datos["hora"];
              $this->usuario = $datos["usuario"];

          }
          return $this;
    }

    function id(){
        return $this->id;
    }
}
?>
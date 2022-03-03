<?php

class ficha{

    var $id;
    var $paciente;
    var $tipoSangre;
    var $quienRecomendo;
    var $hijo;
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

    function insertar(){
        include_once("../php/conexion.php");

        $query="INSERT INTO ficha (paciente,tipoSangre,quienRecomendo,hijo,embarazo,parto,cesareas,abortos,muertos,enfs,fuma,cigarrosDia,fumaAntiguedad,
        alcohol,alcFrecuencia,alcoholCantidad,alcoholTipos,addiciones,alergias,desayuno,comida,cena,entreComidas,vasoAguaDia,otrosLiquidos,intolerancias,
        orinaDia,orinaNoche,orinaColor,orinaOlor,orinaMolestias,excrementoDia,exConsistencia,exOlor,exColor,exDolor,fechaMenstruacion,mensPeriodicidad,
        mensMolestias,ejercicioSemana,fecha,enfermedadesPadecidas,enfermedadesPresentes,firmaPaciente,firmaUsuario,hora,usuario) VALUES ('$this->paciente',
        '$this->tipoSangre','$this->quienRecomendo','$this->hijo','$this->embarazo','$this->parto','$this->cesareas','$this->abortos','$this->muertos'
    ,'$this->enfs','$this->fuma','$this->cigarrosDia','$this->fumaAntiguedad','$this->alcohol','$this->alcFrecuencia,'$this->alcoholCantidad,
    ,'$this->alcoholTipos','$this->adicciones','$this->alergias','$this->desayuno','$this->comida','$this->cena','$this->entreComidas','$this->vasoAguaDia',
    '$this->otrosLiquidos','$this->intolerancias','$this->orinaDia','$this->orinaNoche','$this->orinaColor','$this->orinaOlor','$this->orinaMolestias'
    ,'$this->excrementoDia','$this->exConsistencia','$this->exOlor','$this->exColor','$this->exDolor','$this->fechaMenstruacion','$this->mensPeriodicidad',
    '$this->mensMolestias','$this->ejercicioSemana','$this->fecha','$this->enfermedadesPadecidas','$this->enfermedadesPresentes','$this->firmaPaciente',
    '$this->firmaUsuario','$this->hora','$this->usuario')";

        echo $query;
        $stmt=$dbh->prepare($query);
        return $stmt->excecute();
    }
}
?>
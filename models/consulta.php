<?php

class consulta{

var $id;
var $fecha;
var $usuario;
var $paciente;
var $signosVitales;
var $motivoConsulta;
var $exploracion;
var $indicaciones;
var $consultorio;

function insertar(){
    include_once("../php/conexion.php");
    $query="INSERT INTO consulta (fecha, usuario, paciente, signosVitales, motivoConsulta, exploracion, indicaciones, consultorio) 
    VALUES ('$this->fecha','$this->usuario','$this->paciente','$this->signosVitales','$this->motivoConsulta','$this->exploracion','$this->indicaciones','$this->consultorio'); ";
    echo $query;
    $stmt = $dbh->prepare($query);
    return $stmt->execute();
}
}
?>
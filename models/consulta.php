<?php

class consulta{

var $id;
var $fecha;
var $usuario;
var $paciente;
var $ta;
var $oxigeno;
var $pulso;
var $peso;
var $estatura;
var $temperatura;
var $motivoConsulta;
var $exploracion;
var $indicaciones;
var $consultorio;

function insertar(){
    include_once("../php/conexion.php");
    $query="INSERT INTO consulta (fecha, usuario, paciente,ta,oxigeno,pulso,peso,estatura,temperatura, motivoConsulta, exploracion, indicaciones, consultorio) 
    VALUES ('$this->fecha','$this->usuario','$this->paciente','$this->ta','$this->oxigeno','$this->pulso','$this->peso','$this->estatura','$this->temperatura','$this->motivoConsulta','$this->exploracion','$this->indicaciones','$this->consultorio'); ";
    echo $query;
    $stmt = $dbh->prepare($query);
    return $stmt->execute();
}
}
?>
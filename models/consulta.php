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
function listarConsultas(){
    include_once("php/conexion.php");
   
    
     $stmt =null;
     $query ="select * from consulta where paciente=$this->paciente";
     $stmt =  $dbh->prepare($query);
     $stmt->execute();
     $datos = null;
     $arrConsultas = null;
     $indice = 0;
      while( $datos = $stmt->fetch(PDO::FETCH_ASSOC) ){ 
         $consulta = new consulta();
         $consulta->id = $datos["id"];
         $consulta->fecha = $datos["fecha"];
         $consulta->usuario = $datos["usuario"];
         $consulta->paciente = $datos["paciente"];
         $consulta->ta = $datos["ta"];
         $consulta->oxigeno = $datos["oxigeno"];
         $consulta->pulso = $datos["pulso"];
         $consulta->peso = $datos["peso"];
         $consulta->estatura = $datos["estatura"];
         $consulta->temperatura = $datos["temperatura"];
         $consulta->motivoConsulta = $datos["motivoConsulta"];
         $consulta->exploracion = $datos["exploracion"];
         $consulta->indicaciones = $datos["indicaciones"];
         $consulta->consultorio = $datos["consultorio"];
         $arrConsultas[$indice] = $consulta;
         $indice = $indice + 1;
           
      }
      return $arrConsultas;
    }
}
?>
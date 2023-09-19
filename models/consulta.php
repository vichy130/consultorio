<?php

class consulta
{

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
    var $receta;
    var $consultorio;

    function insertar()
    {
        $this->receta=1;
        include_once("../php/conexion.php");
        $dbname = "consultorio";
        $user = "root";
        $password = "";
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        );
        $dbh = null;
        try {
            $dsn = "mysql:host=localhost; dbname=$dbname";
            $dbh = new PDO($dsn, $user, $password, $options);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $query = "INSERT INTO consulta (fecha, usuario, paciente,ta,oxigeno,pulso,peso,estatura,temperatura, motivoConsulta, exploracion, receta, consultorio) 
    VALUES ('$this->fecha','$this->usuario','$this->paciente','$this->ta','$this->oxigeno','$this->pulso','$this->peso','$this->estatura','$this->temperatura','$this->motivoConsulta','$this->exploracion','$this->receta','$this->consultorio'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $id = $dbh->lastInsertId();
        return $id;
    }
    function listarConsultas()
    {
        include_once("php/conexion.php");

        $stmt = null;
        $query = "select * from consulta where paciente=$this->paciente";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $datos = null;
        $arrConsultas = null;
        $indice = 0;
        while ($datos = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
            $consulta->receta = $datos["receta"];
            $consulta->consultorio = $datos["consultorio"];
            $arrConsultas[$indice] = $consulta;
            $indice = $indice + 1;

        }
        return $arrConsultas;
    }

    function mostrar()
    {
        include_once("php/conexion.php");
        $query = "SELECT * FROM consulta where id=$this->id; ";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $datos = null;
        while ($datos = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->fecha = $datos["fecha"];
            $this->usuario = $datos["usuario"];
            $this->paciente = $datos["paciente"];
            $this->ta = $datos["ta"];
            $this->oxigeno = $datos["oxigeno"];
            $this->pulso = $datos["pulso"];
            $this->peso = $datos["peso"];
            $this->estatura = $datos["estatura"];
            $this->temperatura = $datos["temperatura"];
            $this->motivoConsulta = $datos["motivoConsulta"];
            $this->exploracion = $datos["exploracion"];
            $this->receta = $datos["receta"];
            $this->consultorio = $datos["consultorio"];
        }
        return $this;
    }

}



?>
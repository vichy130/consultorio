<?php
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
    ?>
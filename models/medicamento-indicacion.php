<?php 

class medicamentoIndicacion{

    var $id;
    var $indicaciones;
    var $consulta;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT INTO medicamentoIndicacion (indicaciones,consulta) VALUES ('$this->indicaciones','$this->consulta'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
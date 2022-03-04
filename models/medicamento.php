<?php 

class medicamento{

    var $id;
    var $medicamento;
    var $medicamentoIndicacion;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT INTO medicamento (medicamento, medicamentoIndicacion) VALUES ('$this->medicamento','$this->medicamentoIndicacion'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
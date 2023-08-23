<?php 

class medicamento{

    var $id;
    var $medicamento;
    var $tipo;
    var $descripcion;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT INTO medicamento (medicamento, tipo, descripcion) VALUES ('$this->medicamento','$this->tipo','$this->descripcion'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
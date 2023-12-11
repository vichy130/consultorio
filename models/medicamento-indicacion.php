<?php 

class MedicamentoIndicacion{

    var $id;
    var $medicamento;
    var $hora;
    var $indicaciones;
    var $receta;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT INTO medicamentoIndicacion (medicamento, hora, indicaciones, receta) VALUES ('$this->medicamento','$this->hora','$this->indicaciones','$this->receta'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
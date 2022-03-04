<?php 

class consultaPrevia{

    var $id;
    var $comentarios;
    var $diagnostico;
    var $estudios;
    var $tratamiento;
    var $consulta;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT INTO consultaPrevia (comentarios,diagnostio,estudios,tratamiento,consulta) VALUES ('$this->comentarios','$this->diagnostico','$this->estudios','$this->tratamiento','$this->consulta'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
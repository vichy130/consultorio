<?php 

class terapia{

    var $id;
    var $terapia;
    var $consulta;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT INTO terapiasAplicadas (terapia,consulta) VALUES ('$this->terapia','$this->consulta'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
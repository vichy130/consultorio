<?php 

class nutriente{

    var $id;
    var $nutriente;
    var $consulta;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT INTO nutrientes (nutriente,consulta) VALUES ('$this->nutriente','$this->consulta'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
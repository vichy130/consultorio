<?php 

class estudioSolicitado{

    var $id;
    var $estudio;
    var $consulta;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT INTO estudiossolicitados (estudio, consulta) VALUES ('$this->estudio','$this->consulta'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
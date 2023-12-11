<?php 

class EstudioSolicitado{

    var $id;
    var $estudio;
    var $receta;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT INTO estudiossolicitados (estudio, receta) VALUES ('$this->estudio','$this->receta'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
<?php 

class consultorio{

    var $id;
    var $nombre;
    var $calle;
    var $colonia;
    var $ciudad;
    var $codigoPostal;
    var $telefono;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT INTO consultorio (nombre,calle,colonia,ciudad,codigoPostal,telefono) VALUES ('$this->nombre','$this->calle','$this->colonia','$this->ciudad','$this->codigoPostal','$this->telefono'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
<?php 

class antecedentePaciente{

    var $id;
    var $tipo;
    var $ficha;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT INTO antecedentePaciente (tipo,ficha) VALUES ('$this->tipo','$this->ficha'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
<?php 

class hijo{

    var $id;
    var $sexo;
    var $edad;
    var $ficha;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT INTO hijo (sexo,edad,ficha) VALUES ('$this->sexo','$this->edad','$this->ficha'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
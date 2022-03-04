<?php 

class signosVitales{

    var $id;
    var $ta;
    var $oxigeno;
    var $pulso;
    var $peso;
    var $estatura;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT into signosVitales (ta,oxigeno,pulso,peso,estatura) VALUES ('$this->ta','$this->oxigeno','$this->pulso','$this->peso','$this->estatura'); 
        ";
        $queryid = "SELECT LAST_INSERT_ID();";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
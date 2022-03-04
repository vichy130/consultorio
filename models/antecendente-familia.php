<?php 

class antecedenteFamilia{

    var $id;
    var $familiar;
    var $comentarios;
    var $ficha;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT INTO antecedentesFamilia (familiar,comentarios,ficha) VALUES ('$this->familiar','$this->comentarios','$this->ficha'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
<?php

class AntecedenteFamilia
{

    var $id;
    var $familiar;
    var $enfermedad;
    var $descripcion;
    var $ficha;

    function insertar()
    {
        /*include_once("../php/conexion.php");*/
        $dbname = "consultorio";
        $user = "root";
        $password = "";
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        );
        $dbh = null;
        try {
            $dsn = "mysql:host=localhost; dbname=$dbname";
            $dbh = new PDO($dsn, $user, $password, $options);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $query = "INSERT INTO antecedentesFamilia (familiar,enfermedad,descripcion,ficha) VALUES ('$this->familiar','$this->enfermedad','$this->descripcion','$this->ficha'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        $return = $stmt->execute();
        $this->id = $dbh->lastInsertId();
        return $return;
    }
}

?>
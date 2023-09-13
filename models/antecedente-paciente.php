<?php

class AntecedentePaciente
{

    var $id;
    var $enfermedad;
    var $descripcion;
    var $estaActiva;
    var $ficha;

    function insertar()
    {
        /*include_once(".../php/conexion.php");*/
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
        $query = "INSERT INTO antecedentes (enfermedad, descripcion, estaActiva, ficha) VALUES ('$this->enfermedad','$this->descripcion', '$this->estaActiva', '$this->ficha'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        $return = $stmt->execute();
        $this->id = $dbh->lastInsertId();
        return $return;
    }

}

?>
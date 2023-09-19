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
        include_once(".../php/conexion.php");
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
        $query = "INSERT INTO antecedentes (id, enfermedad, descripcion, estaActiva, ficha) VALUES ('$this->id','$this->enfermedad','$this->descripcion', '$this->estaActiva', '$this->ficha'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        $return = $stmt->execute();
        $this->id = $dbh->lastInsertId();
        return $return;
    }

    function mostrar()
    {
        include_once("../php/conexion.php");
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
        $query = "SELECT * FROM antecedentes WHERE ficha = :ficha";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":ficha", $this->ficha, PDO::PARAM_INT);
        try {
            $stmt->execute();
            $datos = null;
            while ($datos = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->id = $datos["id"];
                $this->enfermedad = $datos["enfermedad"];
                $this->descripcion = $datos["descripcion"];
                $this->estaActiva = $datos["estaActiva"];
                $this->ficha = $datos["ficha"];
            }
            return $this;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function eliminar()
    {
        include_once("../php/conexion.php");
        try {
            $query = "DELETE FROM antecedentes WHERE id = :id";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "Eliminación exitosa.";
            } else {
                echo "Error al eliminar el registro.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }



}


?>
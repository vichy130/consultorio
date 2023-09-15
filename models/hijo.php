<?php

class Hijo
{

    var $id;
    var $sexo;
    var $edad;
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

        $query = "INSERT INTO hijo (id,sexo,edad,ficha) VALUES ('$this->id','$this->sexo','$this->edad','$this->ficha'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        $return = $stmt->execute();
        $this->id= $dbh->lastInsertId();
        return $return;
    }

    function buscarDatos(){
        include_once("./php/conexion.php");
        $query="SELECT * FROM hijo WHERE ficha= $this->ficha; ";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
         $datos = null;
          while( $datos = $stmt->fetch(PDO::FETCH_ASSOC) ){
              $this->id = $datos["id"];
              $this->sexo = $datos["sexo"];
              $this->edad = $datos["edad"];
              $this->ficha = $datos["ficha"];
          }
          return $this;
    }

    

}

?>
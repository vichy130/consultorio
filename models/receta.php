<?php

class Receta {

    private $id;
    private $dbh;
    function __construct(){
        try {
            $dbname = "consultorio";
            $user = "root";
            $password = "";
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ];
            $dsn = "mysql:host=localhost;dbname=$dbname";
            $this->dbh = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getValues(){
        return $this->id;
    }
    public function setValues($id){
        $this->id=$id;
    }
    public function insertar(){
        $query="INSERT INTO receta values (:id); ";
        try{
            $stmt=$this->dbh->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            "Error al insertar Receta".$e->getMessage();
            return false;
        }
    }
}






























?>
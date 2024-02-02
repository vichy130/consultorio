<?php
class Conexion{
    //$dbname="agakhanc_consultorio";
    //$user="agakhanc_regular";
    //$password="DeVUVOtH68Z1";
    private $dbname="consultorio";
    private $user="root";
    private $password="";
    private $dsn;
    private $dbh;
    private $options;
    function __construct(){
        try {
            $dbname=$this->dbname;
            $this->options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ];
            $this->dsn = "mysql:host=localhost;dbname=$dbname";
            $this->dbh = new PDO($this->dsn,$this->getUser(), $this->getPassword(), $this->options);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function getdbname(){
        return $this->dbname;
    }
    function getUser(){
        return $this->user;
    }
    function getPassword(){
        return $this->password;
    }
    function getdbh(){
        return $this->dbh;
    }
}
?>
<?php

class Conexion
{
    private $dbname;
    private $user;
    private $password;
    private $dsn;
    private $dbh;
    private $options;
    function __construct()
    {
        include_once(__DIR__ . '/../config/config.php');

        $this->dbname = DB_NAME;
        $this->user = DB_USER;
        $this->password = DB_PASSWORD;
        try {
            $dbname = $this->dbname;
            $this->options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ];
            $this->dsn = "mysql:host=localhost;dbname=$dbname";
            $this->dbh = new PDO($this->dsn, $this->getUser(), $this->getPassword(), $this->options);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function getdbname()
    {
        return $this->dbname;
    }
    function getUser()
    {
        return $this->user;
    }
    function getPassword()
    {
        return $this->password;
    }
    function getdbh()
    {
        return $this->dbh;
    }
}
?>
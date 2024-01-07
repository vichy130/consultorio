<?php
class Terapia
{
    private $id;
    private $terapia;
    private $consulta;
    private $dbh;
    public function __construct()
    {
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
    public function insertar()
    {
        $query = "INSERT INTO terapiasAplicadas (terapia,consulta) VALUES (:terapia,:consulta); ";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':terapia', $this->terapia);
        $stmt->bindParam(':consulta', $this->consulta);
        return $stmt->execute();
    }
}
?>
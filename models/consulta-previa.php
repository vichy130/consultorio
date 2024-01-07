<?php
class ConsultaPrevia
{
    private $id;
    private $comentarios;
    private $diagnostico;
    private $estudios;
    private $tratamiento;
    private $consulta;
    private $dbh;
    public function __construct()
    {
        $dbname = "consultorio";
        $user = "root";
        $password = "";
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);
        $this->dbh = null;
        try {
            $dsn = "mysql:host=localhost; dbname=$dbname";
            $this->dbh = new PDO($dsn, $user, $password, $options);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function insertar()
    {
        try {
            $query = "INSERT INTO consultaPrevia (comentarios,diagnostico,estudios,tratamiento,consulta) VALUES (:comentarios,:diagnostico,:estudios,:tratamiento,:consulta); ";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':comentarios', $this->comentarios);
            $stmt->bindParam(':diagnostico', $this->diagnostico);
            $stmt->bindParam(':estudios', $this->estudios);
            $stmt->bindParam(':tratamiento', $this->tratamiento);
            $stmt->bindParam(':consulta', $this->consulta);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al insertar datos consulta previa: " . $e->getMessage());
            return false; // Indicar que ha habido un error
        }
    }
}
?>
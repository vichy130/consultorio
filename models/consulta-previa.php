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
    public function __construct($comentarios, $diagnostico, $estudios, $tratamiento, $consulta)
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
        $this->comentarios = $comentarios;
        $this->diagnostico = $diagnostico;
        $this->estudios = $estudios;
        $this->tratamiento = $tratamiento;
        $this->consulta = $consulta;
    }
    function insertar()
    {
        $query = "INSERT INTO consultaPrevia (comentarios,diagnostico,estudios,tratamiento,consulta) VALUES (:comentarios,:diagnostico,:estudios,:tratamiento,:consulta); ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':comentarios', $this->comentarios);
            $stmt->bindParam(':diagnostico', $this->diagnostico);
            $stmt->bindParam(':estudios', $this->estudios);
            $stmt->bindParam(':tratamiento', $this->tratamiento);
            $stmt->bindParam(':consulta', $this->consulta);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error al insertar datos consulta previa: " . $e->getMessage());
            return false; // Indicar que ha habido un error
        }
    }
    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }
    public function getValues(){
        return[
            
        ];
    }
}
?>
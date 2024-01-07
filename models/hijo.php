<?php

class Hijo
{
    private $id;
    private $sexo;
    private $edad;
    private $ficha;
    private $dbh;
    public function __construct($id, $sexo, $edad, $ficha)
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
        $this->id = $id;
        $this->sexo = $sexo;
        $this->edad = $edad;
        $this->ficha = $ficha;
    }
    public function getValues()
    {
        return [
            'id' => $this->id,
            'sexo' => $this->sexo,
            'edad' => $this->edad,
            'ficha' => $this->ficha
        ];
    }
    public function getId()
    {
        return $this->id;
    }
    function insertar()
    {
        $query = "INSERT INTO hijo (id, sexo, edad, ficha) VALUES (:id, :sexo, :edad, :ficha); ";
        try {
            $stmt = $this->dbh->prepare($query);
            // Vincula los valores de los parámetros de forma segura
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':sexo', $this->sexo, PDO::PARAM_STR);
            $stmt->bindParam(':edad', $this->edad, PDO::PARAM_INT);
            $stmt->bindParam(':ficha', $this->ficha, PDO::PARAM_INT);
            // Ejecuta la consulta
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error en insertar hijo" . $e->getMessage();
        }
    }
    function eliminar()
    {
        $query = "DELETE FROM hijo where id= :id; ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            echo "HIJO ELIMINADO" . $this->id;
        } catch (PDOException $e) {
            echo "Error al eliminar Hijo" . $e->getMessage();
        }
    }
}
?>
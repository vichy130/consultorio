<?php

class Medicamento
{
    private $id;
    private $medicamento;
    private $tipo;
    private $descripcion;
    private $dbh;
    function __construct()
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
    public function setValues($medicamento, $tipo, $descripcion)
    {
        $this->medicamento = $medicamento;
        $this->tipo = $tipo;
        $this->descripcion = $descripcion;
    }
    public function getValues()
    {
        return [
            'id' => $this->id,
            'medicamento' => $this->medicamento,
            'tipo' => $this->tipo,
            'descripcion' => $this->descripcion
        ];
    }
    public function insertar()
    {
        $query = "INSERT INTO medicamento (medicamento, tipo, descripcion) VALUES (:medicamento,:tipo,:descripcion); ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':medicamento', $this->medicamento);
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':descripcion', $this->descripcion);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al insertar medicamento" . $e->getMessage();
        }
    }
}
?>
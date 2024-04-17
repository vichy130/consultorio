<?php
include_once("../models/conexion.php");
class Hijo
{
    private $id;
    private $sexo;
    private $edad;
    private $ficha;
    private $conexion;
    public function __construct($id, $sexo, $edad, $ficha)
    {
        $this->conexion = new Conexion();
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
            $stmt = $this->conexion->getdbh()->prepare($query);
            // Vincula los valores de los parámetros de forma segura
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':sexo', $this->sexo, PDO::PARAM_STR);
            $stmt->bindParam(':edad', $this->edad, PDO::PARAM_INT);
            $stmt->bindParam(':ficha', $this->ficha, PDO::PARAM_INT);
            // Ejecuta la consulta
            return $stmt->execute();
        } catch (PDOException $e) {
           return $e->getMessage();
        }
    }
    function eliminar()
    {
        $query = "DELETE FROM hijo where id= :id; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
        } catch (PDOException $e) {
            return  $e->getMessage();
        }
    }
}
?>
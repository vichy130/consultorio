<?php
include_once("../models/conexion.php");

class Medicamento
{
    private $id;
    private $medicamento;
    private $tipo;
    private $descripcion;
    private $dbh;
    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getMedicamento(){
       return $this->medicamento;
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
        $query = "INSERT INTO medicamento (id, medicamento, tipo, descripcion) VALUES (:id,:medicamento,:tipo,:descripcion); ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':medicamento', $this->medicamento);
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return $this->getValues();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function obtener()
    {
        $query = "SELECT * FROM medicamento where id=:id; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($datos) {
                $this->id = $datos["id"];
                $this->medicamento = $datos["medicamento"];
                $this->tipo = $datos["tipo"];
                $this->descripcion = $datos["descripcion"];
                return $this->getValues();
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function eliminar()
    {
        $query = "DELETE FROM medicamento where id= :id; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function actualizar()
    {
        $query = "UPDATE medicamento SET
        medicamento=:medicamento, 
        tipo=:tipo,
        descripcion=:descripcion 
        WHERE id=:id; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(":medicamento", $this->medicamento);
            $stmt->bindParam(":tipo", $this->tipo);
            $stmt->bindParam(":descripcion", $this->descripcion);
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            return $this->getValues();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
?>
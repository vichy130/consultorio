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
        $query = "INSERT INTO medicamento (id, medicamento, tipo, descripcion) VALUES (:medicamento,:tipo,:descripcion); ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':medicamento', $this->medicamento);
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->execute();
            $this->id = $this->conexion->getdbh()->lastInsertId();
        } catch (PDOException $e) {
            echo "Error al insertar medicamento" . $e->getMessage();
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
            }
        } catch (PDOException $e) {
            echo "error al obtener medicamento" . $e->getMessage();
        }
    }
    function eliminar()
    {
        $query = "DELETE FROM medicamento where id= :id; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            echo "medicamento eliminado" . $this->id;
        } catch (PDOException $e) {
            echo "Error al eliminar medicamento" . $e->getMessage();
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
            return true;
        } catch (PDOException $e) {
            echo "ERROR actualizar medicamento" . $e->getMessage();
            return false;
        }
    }
}
?>
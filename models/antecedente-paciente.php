<?php
include_once("../models/conexion.php");
class AntecedentePaciente
{
    private $id;
    private $enfermedad;
    private $descripcion;
    private $estaActiva;
    private $ficha;
    private $conexion;
    public function __construct($id, $enfermedad, $descripcion, $estaActiva, $ficha)
    {
        $this->conexion = new Conexion();
        $this->id = $id;
        $this->enfermedad = $enfermedad;
        $this->descripcion = $descripcion;
        $this->estaActiva = $estaActiva;
        $this->ficha = $ficha;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getEnfermedad()
    {
        return $this->enfermedad;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getValues()
    {
        return [
            'id' => $this->id,
            'enfermedad' => $this->enfermedad,
            'descripcion' => $this->descripcion,
            'estaActiva' => $this->estaActiva,
            'ficha' => $this->ficha
        ];
    }
    function insertar()
    {
        try {
            $query = "INSERT INTO antecedentes (id, enfermedad, descripcion, estaActiva, ficha) VALUES (:id,:enfermedad,:descripcion, :estaActiva, :ficha); ";
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':enfermedad', $this->enfermedad);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':estaActiva', $this->estaActiva);
            $stmt->bindParam(':ficha', $this->ficha);
            $stmt->execute();

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function eliminar()
    {
        $query = "DELETE FROM antecedentes WHERE id = :id";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            return  $e->getMessage();
        }
    }
}
?>
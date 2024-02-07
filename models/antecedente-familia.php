<?php
include_once("../models/conexion.php");
class AntecedenteFamilia
{
    private $id;
    private $familiar;
    private $enfermedad;
    private $descripcion;
    private $ficha;
    private $conexion;

    public function __construct($id, $familiar, $enfermedad, $descripcion, $ficha)
    {
        $this->conexion= new Conexion();
        $this->id = $id;
        $this->familiar = $familiar;
        $this->enfermedad = $enfermedad;
        $this->descripcion = $descripcion;
        $this->ficha = $ficha;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getValues()
    {
        return [
            'id' => $this->id,
            'familiar' => $this->familiar,
            'enfermedad' => $this->enfermedad,
            'descripcion' => $this->descripcion,
            'ficha' => $this->ficha
        ];
    }
    function insertar()
    {
        try {
            $query = "INSERT INTO antecedentesFamilia (id, familiar, enfermedad, descripcion, ficha) VALUES (:id, :familiar, :enfermedad, :descripcion, :ficha); ";
            $stmt = $this->conexion->getdbh()->prepare($query);
            // Vincular parámetros
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':familiar', $this->familiar);
            $stmt->bindParam(':enfermedad', $this->enfermedad);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':ficha', $this->ficha);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al insertar datos: " . $e->getMessage();
        }
    }
    function eliminar()
    {
        try {
            $query = "DELETE FROM antecedentesFamilia WHERE id = :id; ";
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                echo "Eliminación exitosa.";
            } else {
                echo "Error al eliminar el registro.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
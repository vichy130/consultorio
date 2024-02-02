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
        $this->conexion= new Conexion();
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
            $query = "INSERT INTO antecedentes (id, enfermedad, descripcion, estaActiva, ficha) VALUES (:id,:enfermedad,:descrpcion, :estaActiva, :ficha); ";
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':enfermedad', $this->enfermedad);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':estaActiva', $this->estaActiva);
            $stmt->bindParam(':ficha', $this->ficha);
            $return = $stmt->execute();
            $this->id = $this->conexion->getdbh()->lastInsertId();
            return $return;
        } catch (PDOException $e) {
            error_log("Error al insertar datos: " . $e->getMessage());
            return false; // Indicar que ha habido un error
        }
    }
    function mostrar()
    {
        $query = "SELECT * FROM antecedentes WHERE ficha = :ficha";
        $stmt = $this->conexion->getdbh()->prepare($query);
        $stmt->bindParam(":ficha", $this->ficha, PDO::PARAM_INT);
        try {
            $stmt->execute();
            $datos = null;
            while ($datos = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->id = $datos["id"];
                $this->enfermedad = $datos["enfermedad"];
                $this->descripcion = $datos["descripcion"];
                $this->estaActiva = $datos["estaActiva"];
                $this->ficha = $datos["ficha"];
            }
            return $this;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    function eliminar()
    {
        $query = "DELETE FROM antecedentes WHERE id = :id";
        try {
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
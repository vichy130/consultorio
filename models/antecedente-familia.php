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
            $query = "INSERT INTO antecedentesFamilia (familiar, enfermedad, descripcion, ficha) VALUES (:familiar, :enfermedad, :descripcion, :ficha); ";
            $stmt = $this->conexion->getdbh()->prepare($query);
            // Vincular parámetros
            $stmt->bindParam(':familiar', $this->familiar);
            $stmt->bindParam(':enfermedad', $this->enfermedad);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':ficha', $this->ficha);
            $return = $stmt->execute();
            // Obtener el ID insertado
            $this->id = $this->conexion->getdbh()->lastInsertId();
            return $return;
        } catch (PDOException $e) {
            error_log("Error al insertar datos: " . $e->getMessage());
            return false; // Indicar que ha habido un error
        }
    }
    function mostrar()
    {
        $query = "SELECT * FROM antecedentesFamilia WHERE ficha = :ficha";
        $stmt = $this->conexion->getdbh()->prepare($query);
        $stmt->bindParam(":ficha", $this->ficha, PDO::PARAM_INT);
        try {
            $stmt->execute();
            $datos = null;

            while ($datos = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->id = $datos["id"];
                $this->familiar = $datos["familiar"];
                $this->enfermedad = $datos["enfermedad"];
                $this->descripcion = $datos["descripcion"];
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
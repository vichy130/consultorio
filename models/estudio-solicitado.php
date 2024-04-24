<?php
include_once("../models/conexion.php");
class EstudioSolicitado
{
    private $id;
    private $estudio;
    private $receta;
    private $conexion;
    public function __construct($id, $estudio, $receta)
    {
        $this->conexion = new Conexion();
        $this->id = $id;
        $this->estudio = $estudio;
        $this->receta = $receta;
    }
    public function getValues()
    {
        return [
            'id' => $this->id,
            'estudio' => $this->estudio,
            'receta' => $this->receta
        ];
    }
    function insertar()
    {
        try {
            $query = "INSERT INTO estudiosSolicitados VALUES (:id, :estudio,:receta); ";
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':estudio', $this->estudio);
            $stmt->bindParam(':receta', $this->receta);
            $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function eliminar()
    {
        $query = "DELETE FROM estudiosSolicitados where id= :id; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
}
?>
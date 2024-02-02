<?php
include_once("../models/conexion.php");
class MedicamentoIndicacion
{
    private $id;
    private $medicamento;
    private $hora;
    private $indicaciones;
    private $receta;
    private $conexion;
    function __construct($id, $medicamento, $hora, $indicaciones, $receta)
    {
        $this->conexion = new Conexion();
        $this->id = $id;
        $this->medicamento = $medicamento;
        $this->hora = $hora;
        $this->indicaciones = $indicaciones;
        $this->receta = $receta;
    }
    public function getValues()
    {
        return [
            'id' => $this->id,
            'medicamento' => $this->medicamento,
            'hora' => $this->hora,
            'indicaciones' => $this->indicaciones,
            'receta' => $this->receta
        ];
    }
    public function setValues($medicamento, $hora, $indicaciones, $receta)
    {
        $this->medicamento = $medicamento;
        $this->hora = $hora;
        $this->indicaciones = $indicaciones;
        $this->receta = $receta;
    }
    public function insertar()
    {
        $query = "INSERT INTO medicamentoIndicacion (id, medicamento, hora, indicaciones, receta) VALUES (:id, :medicamento, :hora, :indicaciones, :receta); ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':medicamento', $this->medicamento);
            $stmt->bindParam(':hora', $this->hora);
            $stmt->bindParam(':indicaciones', $this->indicaciones);
            $stmt->bindParam(':receta', $this->receta);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al insertar medicamento indicacion" . $e->getMessage();
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
    public function getNames(){
        return " valores".$this->id." ID, ".$this->receta." RECETA.";
    }
    public function eliminar()
    {
        $query = "DELETE FROM medicamentoIndicacion WHERE id=:id; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "ERROR en eliminar medicamento Indicacion : ".$e->getMessage();
        }

    }
}
?>
<?php
include_once("../models/conexion.php");
class ConsultaPrevia
{
    private $id;
    private $comentarios;
    private $diagnostico;
    private $estudios;
    private $tratamiento;
    private $consulta;
    private $conexion;
    public function __construct($id, $comentarios, $diagnostico, $estudios, $tratamiento, $consulta)
    {
        $this->conexion = new Conexion();
        $this->id=$id;
        $this->comentarios = $comentarios;
        $this->diagnostico = $diagnostico;
        $this->estudios = $estudios;
        $this->tratamiento = $tratamiento;
        $this->consulta = $consulta;
    }
    function insertar()
    {
        $query = "INSERT INTO consultaPrevia (id, comentarios,diagnostico,estudios,tratamiento,consulta) VALUES (:id,:comentarios,:diagnostico,:estudios,:tratamiento,:consulta); ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':comentarios', $this->comentarios);
            $stmt->bindParam(':diagnostico', $this->diagnostico);
            $stmt->bindParam(':estudios', $this->estudios);
            $stmt->bindParam(':tratamiento', $this->tratamiento);
            $stmt->bindParam(':consulta', $this->consulta);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error al insertar datos consulta previa: " . $e->getMessage());
            return false; // Indicar que ha habido un error
        }
    }
    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }
    public function getValues(){
        return[
            'id'=>$this->id,
            'comentarios'=>$this->comentarios,
            'diagnostico'=>$this->diagnostico,
            'estudios'=>$this->estudios,
            'tratamiento'=>$this->tratamiento,
            'consulta'=>$this->consulta
        ];
    }
    function eliminar(){
        $query = "DELETE FROM consultaPrevia where id= :id; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            echo "consulta eliminada" . $this->id;
        } catch (PDOException $e) {
            echo "Error al eliminar consulta previa" . $e->getMessage();
        }
    }
}
?>
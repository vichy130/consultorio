<?php
include_once("../models/conexion.php");
class TerapiaAplicada
{
    private $id;
    private $terapia;
    private $consulta;
    private $conexion;

    function __construct($id, $terapia, $consulta){
        $this->conexion = new Conexion();
        $this->id=$id;
        $this->terapia=$terapia;
        $this->consulta=$consulta;
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
    }
    public function insertar(){
        $query= "INSERT INTO terapiasAplicadas (id, terapia, consulta) VALUES (:id, :terapia, :consulta); ";
        try{
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id',$this->id);
            $stmt->bindParam(':terapia',$this->terapia);
            $stmt->bindParam(':consulta',$this->consulta);
            $stmt->execute();
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
    function eliminar(){
        $query = "DELETE FROM terapiasAplicadas where id= :id; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function getValues(){
        return[
            'id'=>$this->id,
            'terapia'=>$this->terapia,
            'consulta'=>$this->consulta
        ];
    }
}
?>
<?php
include_once("../models/conexion.php");
class Receta {

    private $id;
    private $conexion;
    function __construct(){
        $this->conexion = new Conexion();
    }
    public function getValues(){
        return $this->id;
    }
    public function setValues($id){
        $this->id=$id;
    }
    public function insertar(){
        $query="INSERT INTO receta values (:id); ";
        try{
            $stmt=$this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            "Error al insertar Receta".$e->getMessage();
            return false;
        }
    }
}






























?>
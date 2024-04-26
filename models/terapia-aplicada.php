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
    function getReporte(){
        $terapias=[];
        $query="SELECT terapia, count(*) as numero from terapiasAplicadas join consulta on consulta.id=terapiasAplicadas.consulta where consulta.fecha>= DATE_SUB(CURRENT_DATE(), INTERVAL 3 MONTH) group by terapia order by numero desc limit 5; ";
        $terapias['tres']=$this->executeReporte($query);

        $querySeis="SELECT terapia, count(*) as numero from terapiasAplicadas join consulta on consulta.id=terapiasAplicadas.consulta where consulta.fecha>= DATE_SUB(CURRENT_DATE(), INTERVAL 6 MONTH) group by terapia order by numero desc limit 5; ";
        $terapias['seis']=$this->executeReporte($querySeis);

        $queryAno="SELECT terapia, count(*) as numero from terapiasAplicadas join consulta on consulta.id=terapiasAplicadas.consulta where consulta.fecha>= DATE_SUB(CURRENT_DATE(), INTERVAL 12 MONTH) group by terapia order by numero desc limit 5; ";
        $terapias['ano']=$this->executeReporte($queryAno);

        $queryTodo="SELECT terapia, count(*) as numero from terapiasAplicadas join consulta on consulta.id=terapiasAplicadas.consulta group by terapia order by numero desc limit 10; ";
        $terapias['todo']=$this->executeReporte($queryTodo);

        return $terapias;
    }
    function executeReporte($query)
    {
        $consultaPeriodo = array();
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->execute();
            while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $valor = array();
                $valor['label'] = $res['terapia'];
                $valor['data'] = $res['numero'];
                $consultaPeriodo[] = $valor;
            }
            return $consultaPeriodo;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
?>
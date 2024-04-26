<?php
include_once("../models/conexion.php");

class Medicamento
{
    private $id;
    private $medicamento;
    private $tipo;
    private $descripcion;
    private $dbh;
    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getMedicamento(){
       return $this->medicamento;
    }
    public function setValues($medicamento, $tipo, $descripcion)
    {
        $this->medicamento = $medicamento;
        $this->tipo = $tipo;
        $this->descripcion = $descripcion;
    }
    public function getValues()
    {
        return [
            'id' => $this->id,
            'medicamento' => $this->medicamento,
            'tipo' => $this->tipo,
            'descripcion' => $this->descripcion
        ];
    }
    public function insertar()
    {
        $query = "INSERT INTO medicamento (id, medicamento, tipo, descripcion) VALUES (:id,:medicamento,:tipo,:descripcion); ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':medicamento', $this->medicamento);
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return $this->getValues();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function obtener()
    {
        $query = "SELECT * FROM medicamento where id=:id; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($datos) {
                $this->id = $datos["id"];
                $this->medicamento = $datos["medicamento"];
                $this->tipo = $datos["tipo"];
                $this->descripcion = $datos["descripcion"];
                return $this->getValues();
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function eliminar()
    {
        $query = "DELETE FROM medicamento where id= :id; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function actualizar()
    {
        $query = "UPDATE medicamento SET
        medicamento=:medicamento, 
        tipo=:tipo,
        descripcion=:descripcion 
        WHERE id=:id; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(":medicamento", $this->medicamento);
            $stmt->bindParam(":tipo", $this->tipo);
            $stmt->bindParam(":descripcion", $this->descripcion);
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            return $this->getValues();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function countMedicamentos()
    {
        try {
            $query = "SELECT COUNT('id') as nutrientes from medicamento where tipo='nutriente'; ";
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->execute();
            $datosN  = $stmt->fetch(PDO::FETCH_ASSOC);
            $respuesta['nutrientes']=$datosN['nutrientes'];

            $query = "SELECT COUNT('id') as alopatica from medicamento where tipo='Alopática'; ";
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->execute();
            $datosA  = $stmt->fetch(PDO::FETCH_ASSOC);
            $respuesta['alopatica']=$datosA['alopatica'];

            $query = "SELECT COUNT('id') as homeopatica from medicamento where tipo='Homeopática'; ";
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->execute();
            $datosH  = $stmt->fetch(PDO::FETCH_ASSOC);
            $respuesta['homeopatica']=$datosH['homeopatica'];

            return $respuesta;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function getReporte(){
        $medicamentos=[];
        $query="SELECT  medicamento.medicamento, COUNT(*) as numero
        FROM medicamentoIndicacion 
        JOIN receta on medicamentoIndicacion.receta=receta.id
        JOIN medicamento on medicamentoIndicacion.medicamento=medicamento.id
        JOIN consulta on receta.id=consulta.receta
        WHERE consulta.fecha>= DATE_SUB(CURRENT_DATE(), INTERVAL 3 MONTH)
        GROUP BY medicamento
        ORDER 	BY numero DESC
        LIMIT 5; ";
        $medicamentos['tres']=$this->executeReporte($query);

        $queryAno="SELECT  medicamento.medicamento, COUNT(*) as numero
        FROM medicamentoIndicacion 
        JOIN receta on medicamentoIndicacion.receta=receta.id
        JOIN medicamento on medicamentoIndicacion.medicamento=medicamento.id
        JOIN consulta on receta.id=consulta.receta
        WHERE consulta.fecha>= DATE_SUB(CURRENT_DATE(), INTERVAL 12 MONTH)
        GROUP BY medicamento
        ORDER 	BY numero DESC
        LIMIT 5; ";
        $medicamentos['ano']=$this->executeReporte($queryAno);

        $queryTodo="SELECT  medicamento.medicamento, COUNT(*) as numero
        FROM medicamentoIndicacion 
        JOIN receta on medicamentoIndicacion.receta=receta.id
        JOIN medicamento on medicamentoIndicacion.medicamento=medicamento.id
        JOIN consulta on receta.id=consulta.receta
        GROUP BY medicamento
        ORDER 	BY numero DESC
        LIMIT 12; ";

        $medicamentos['todo']=$this->executeReporte($queryTodo);

        $queryTipo="SELECT medicamento.tipo as medicamento,count(*) as numero
        from medicamentoIndicacion join medicamento ON medicamento.id=medicamentoIndicacion.medicamento
        join receta on receta.id=medicamentoIndicacion.receta join consulta on consulta.receta=receta.id group by medicamento order by numero desc; ";

        $medicamentos['tipo']=$this->executeReporte($queryTipo);

        return $medicamentos;
    }
    function executeReporte($query){
        $consultaPeriodo=array();
        try{
            $stmt=$this->conexion->getdbh()->prepare($query);
            $stmt->execute();
            while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
                $valor = array();
                $valor['label'] = $res['medicamento'];
                $valor['data'] = $res['numero'];
                $consultaPeriodo[] = $valor;
            }
            return $consultaPeriodo;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
}
?>
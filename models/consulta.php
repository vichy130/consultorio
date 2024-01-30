<?php
include("../models/consulta-previa.php");
include("../models/terapia-aplicada.php");
include("../models/estudio-solicitado.php");
include("../models/medicamento-indicacion.php");
class Consulta
{
    private $id;
    private $fecha;
    private $usuario;
    private $paciente;
    private $ta;
    private $oxigeno;
    private $pulso;
    private $peso;
    private $estatura;
    private $temperatura;
    private $motivoConsulta;
    private $exploracion;
    private $indicaciones;
    private $receta;
    private $consultorio;
    private $consultasPrevias = array();
    private $terapiasAplicadas = array();
    private $medicamentosIndicacion = array();
    private $estudiosSolicitados = array();
    private $dbh;
    function __construct()
    {
        $dbname = "consultorio";
        $user = "root";
        $password = "";
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        );
        try {
            $dsn = "mysql:host=localhost; dbname=$dbname";
            $this->dbh = new PDO($dsn, $user, $password, $options);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;
    }
    public function getPaciente()
    {
        return $this->paciente;
    }
    public function setValues(
        $fecha,
        $usuario,
        $paciente,
        $ta,
        $oxigeno,
        $pulso,
        $peso,
        $estatura,
        $temperatura,
        $motivoConsulta,
        $exploracion,
        $indicaciones,
        $receta,
        $consultorio,
    ) {
        $this->fecha = $fecha;
        $this->usuario = $usuario;
        $this->paciente = $paciente;
        $this->ta = $ta;
        $this->oxigeno = $oxigeno;
        $this->pulso = $pulso;
        $this->peso = $peso;
        $this->estatura = $estatura;
        $this->temperatura = $temperatura;
        $this->motivoConsulta = $motivoConsulta;
        $this->exploracion = $exploracion;
        $this->indicaciones=$indicaciones;
        $this->receta = $receta;
        $this->consultorio = $consultorio;
    }
    public function getValues()
    {
        return [
            'id' => $this->id,
            'fecha' => $this->fecha,
            'usuario' => $this->usuario,
            'paciente' => $this->paciente,
            'ta' => $this->ta,
            'oxigeno' => $this->oxigeno,
            'pulso' => $this->pulso,
            'peso' => $this->peso,
            'estatura' => $this->estatura,
            'temperatura' => $this->temperatura,
            'motivoConsulta' => $this->motivoConsulta,
            'exploracion' => $this->exploracion,
            'indicaciones'=>$this->indicaciones,
            'receta' => $this->receta,
            'consultorio' => $this->consultorio,
            'consultasPrevias' => $this->getCPrevias(),
            'terapiasAplicadas'=>$this->getTerapiasAplicadas(),
            'estudiosSolicitados'=>$this->getEstudiosSolicitados(),
            'medicamentosIndicacion'=> $this->getMedicamentosIndicacion(),
        ];
    }
    public function setRecetaId($receta) //pending
    {
        $this->receta=$receta;
    }
    public function getRecetaId()
    {
        return $this->receta;
    }
    public function setMedicamentosIndicacion($medicamentosIndicacion)
    {
        foreach ($medicamentosIndicacion as $m) {
            $medicamentoIndicacion = new MedicamentoIndicacion($m->_id,$m->_medicamento, $m->_hora, $m->_indicaciones, $m->_receta);
            $medicamentoIndicacion->insertar();
            $this->medicamentosIndicacion[] = $medicamentoIndicacion;
        }
    }
    public function getMedicamentosIndicacion()
    {
        $medsIndicacion = array();
        foreach ($this->medicamentosIndicacion as $mi) {
            $medsIndicacion[] = $mi->getValues();
        }
        return $medsIndicacion;
    }
    public function setEstudiosSolicitados($estudiosSolicitados)
    {
        foreach($estudiosSolicitados as $es){
            $estudioS=new EstudioSolicitado($es->_id, $es->_estudio, $es->_receta);
            $this->estudiosSolicitados[]=$estudioS;
            $estudioS->insertar();
        }
    }
    public function getEstudiosSolicitados()
    {
        $eSolicitados = array();
        foreach ($this->estudiosSolicitados as $estudioSolicitado) {
            $eSolicitados[] = $estudioSolicitado->getValues();
        }
        return $eSolicitados;
    }
    public function setCPrevias($arrayCP)
    {
        foreach ($arrayCP as $cPrevia) {
            $cp = new ConsultaPrevia($cPrevia->_id, $cPrevia->_comentarios, $cPrevia->_diagnostico, $cPrevia->_estudios, $cPrevia->_tratamiento, $this->id);
            $this->consultasPrevias[] = $cp;
            $cp->insertar();
        }
    }
    public function getCPrevias(){
        $consultasPrevias=array();
        foreach($this->consultasPrevias as $conPre){
            $consultasPrevias[]=$conPre->getValues();
        }
        return $consultasPrevias;
    }
    public function setTerapiasAplicadas($terapiasAplicadas)
    {
        foreach ($terapiasAplicadas as $tAplicada) {
            $terapiaAplicada = new TerapiaAplicada($tAplicada->_id, $tAplicada->_terapia, $this->id);
            $this->terapiasAplicadas[] = $terapiaAplicada;
            $terapiaAplicada->insertar();
        }
    }
    public function getTerapiasAplicadas(){
        $terapiasAplicadas=array();
        foreach($this->terapiasAplicadas as $terapia){
            $terapiasAplicadas[]=$terapia->getValues();
        }
        return $terapiasAplicadas;
    }
    public function insertar()
    {
        $query = "INSERT INTO consulta (fecha, usuario, paciente,ta,oxigeno,pulso,peso,estatura,temperatura, motivoConsulta, exploracion, indicaciones, receta, consultorio) 
    VALUES (:fecha,:usuario,:paciente,:ta,:oxigeno,:pulso,:peso,:estatura,:temperatura,:motivoConsulta,:exploracion,:indicaciones,:receta,:consultorio); ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':fecha', $this->fecha);
            $stmt->bindParam(':usuario', $this->usuario);
            $stmt->bindParam(':paciente', $this->paciente);
            $stmt->bindParam(':ta', $this->ta);
            $stmt->bindParam(':oxigeno', $this->oxigeno);
            $stmt->bindParam(':pulso', $this->pulso);
            $stmt->bindParam(':peso', $this->peso);
            $stmt->bindParam(':estatura', $this->estatura);
            $stmt->bindParam(':temperatura', $this->temperatura);
            $stmt->bindParam(':motivoConsulta', $this->motivoConsulta);
            $stmt->bindParam(':exploracion', $this->exploracion);
            $stmt->bindParam(':indicaciones', $this->exploracion);
            $stmt->bindParam(':receta', $this->receta);
            $stmt->bindParam(':consultorio', $this->consultorio);
            $stmt->execute();
            $this->id = $this->dbh->lastInsertId();
            return true;
        } catch (PDOException $e) {
            echo "No se pudo insertar nueva consulta" . $e->getMessage();
            return false;
        }
    }
    public function obtener()
    {
        $query = "SELECT * FROM consulta where id=:id; ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($datos) {
                $this->fecha = $datos["fecha"];
                $this->usuario = $datos["usuario"];
                $this->paciente = $datos["paciente"];
                $this->ta = $datos["ta"];
                $this->oxigeno = $datos["oxigeno"];
                $this->pulso = $datos["pulso"];
                $this->peso = $datos["peso"];
                $this->estatura = $datos["estatura"];
                $this->temperatura = $datos["temperatura"];
                $this->motivoConsulta = $datos["motivoConsulta"];
                $this->exploracion = $datos["exploracion"];
                $this->indicaciones = $datos["indicaciones"];
                $this->receta = $datos["receta"];
                $this->consultorio = $datos["consultorio"];
                $this->obtenerConsultasPrevias();
                $this->obtenerTerapias();
                $this->obtenerMedicamentoIndicacion();
                $this->obtenerEstudiosSolicitados();
            }
            return true;
        } catch (PDOException $e) {
            echo "No se pudo obtener consulta" . $e->getMessage();
            return false;
        }
    }
    public function obtenerConsultasPrevias(){
        $query="SELECT * FROM consultaPrevia where consulta=:id; ";
        try{
            $stmt=$this->dbh->prepare($query);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();
            while($cP = $stmt->fetch(PDO::FETCH_ASSOC)){
                $conPre = new ConsultaPrevia($cP['id'], $cP['comentarios'], $cP['diagnostico'], $cP['estudios'], $cP['tratamiento'], $cP['consulta']);
                $this->consultasPrevias[]=$conPre;
            }
        }catch (PDOException $e){
            echo "ERROR: ".$e->getMessage();
        }
    }
    public function obtenerMedicamentoIndicacion(){
        $query="SELECT * from medicamentoIndicacion where receta=:receta; "; //AQUI puede haber error con recuperar receta
        try{
            $stmt=$this->dbh->prepare($query);
            $stmt->bindParam(":receta", $this->receta, PDO::PARAM_INT);
            $stmt->execute();
            while($mI = $stmt->fetch(PDO::FETCH_ASSOC)){
                $mI=new MedicamentoIndicacion($mI['id'], $mI['medicamento'], $mI['hora'], $mI['indicaciones'], $mI['receta']);
                $this->medicamentosIndicacion[]=$mI;
            }
        }catch(PDOException $e){
            echo "Error al obtener medicamento Indicacion".$e->getMessage();
        }
    }
    public function obtenerTerapias(){
        $query="SELECT * FROM terapiasAplicadas where consulta=:id; ";
        try{
            $stmt=$this->dbh->prepare($query);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();
            while($terapia = $stmt->fetch(PDO::FETCH_ASSOC)){
                $tA = new TerapiaAplicada($terapia['id'],$terapia['terapia'], $terapia['consulta']);
                $this->terapiasAplicadas[]=$tA;
            }
        }catch (PDOException $e){
            echo "ERROR: ".$e->getMessage();
        }
    }
    public function obtenerEstudiosSolicitados(){
        $query="SELECT * FROM estudiosSolicitados where receta=:receta; ";
        try{
            $stmt=$this->dbh->prepare($query);
            $stmt->bindParam(":receta", $this->receta, PDO::PARAM_INT);
            $stmt->execute();
            while($eS = $stmt->fetch(PDO::FETCH_ASSOC)){
                $estudio = new EstudioSolicitado($eS['id'], $eS['estudio'], $eS['receta']);
                $this->estudiosSolicitados[]=$estudio;
            }
        }catch (PDOException $e){
            echo "ERROR: ".$e->getMessage();
        }
    }
    public function eliminar()
    {
        $query = "DELETE FROM consulta WHERE id=:id; ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(":id", $this->getId(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar consulta " . $e->getMessage();
            return false;
        }
    }
    public function actualizar()
    {

    }
}
?>
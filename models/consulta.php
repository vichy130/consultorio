<?php

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
    private $receta;
    private $consultorio;
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
        $dbh = null;
        try {
            $dsn = "mysql:host=localhost; dbname=$dbname";
            $dbh = new PDO($dsn, $user, $password, $options);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->dbh = $dbh;
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
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
        $receta,
        $consultorio,
    ){
        $this->fecha=$fecha;
        $this->usuario=$usuario;
        $this->paciente=$paciente;
        $this->ta=$ta;
        $this->oxigeno=$oxigeno;
        $this->pulso=$pulso;
        $this->peso=$peso;
        $this->estatura=$estatura;
        $this->temperatura=$temperatura;
        $this->motivoConsulta=$motivoConsulta;
        $this->exploracion=$exploracion;
        $this->receta=$receta;
        $this->consultorio=$consultorio;
    }
    public function getValues(){
        return[
            'id'=>$this->id,
            'fecha'=>$this->fecha,
            'usuario'=>$this->usuario,
            'paciente'=>$this->paciente,
            'ta'=>$this->ta,
            'oxigeno'=>$this->oxigeno,
            'pulso'=>$this->pulso,
            'peso'=>$this->peso,
            'estatura'=>$this->estatura,
            'temperatura'=>$this->temperatura,
            'motivoConsulta'=>$this->motivoConsulta,
            'exploracion'=>$this->exploracion,
            'receta'=>$this->receta,
            'consultorio'=>$this->consultorio
        ];
    }
    public function insertar()
    {
        $query = "INSERT INTO consulta (fecha, usuario, paciente,ta,oxigeno,pulso,peso,estatura,temperatura, motivoConsulta, exploracion, receta, consultorio) 
    VALUES (:fecha,:usuario,:paciente,:ta,:oxigeno,:pulso,:peso,:estatura,:temperatura,:motivoConsulta,:exploracion,:receta,:consultorio); ";
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
            $stmt->bindParam(':receta', $this->receta);
            $stmt->bindParam(':consultorio', $this->consultorio);
            $stmt->execute();
            $id = $this->dbh->lastInsertId();
            return true;
        } catch (PDOException $e) {
            echo "No se pudo insertar nueva consulta" . $e->getMessage();
            return false;
        }
    }
    function obtener()
    {
        $query = "SELECT * FROM consulta where id=:id; ";
        try{
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            if($datos) {
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
                $this->receta = $datos["receta"];
                $this->consultorio = $datos["consultorio"];
            }
            return true;
        }catch (PDOException $e){
            echo "No se pudo obtener consulta". $e->getMessage();
            return false;
        }
    }
    public function actualizar(){
        
    }
}
?>
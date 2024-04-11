<?php
include_once("../models/conexion.php");
class Paciente
{
    private $id;
    private $nombre;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $fechaNacimiento;
    private $sexo;
    private $lugarNacimiento;
    private $calle;
    private $colonia;
    private $ciudad;
    private $codigoPostal;
    private $telCasa;
    private $telOficina;
    private $celular;
    private $edoCivil;
    private $ocupacion;
    private $escolaridad;
    private $correo;
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
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setValues(
        $nombre,
        $apellidoPaterno,
        $apellidoMaterno,
        $fechaNacimiento,
        $sexo,
        $lugarNacimiento,
        $calle,
        $colonia,
        $ciudad,
        $codigoPostal,
        $telCasa,
        $telOficina,
        $celular,
        $edoCivil,
        $ocupacion,
        $escolaridad,
        $correo
    ) {
        $this->nombre = $nombre;
        $this->apellidoPaterno = $apellidoPaterno;
        $this->apellidoMaterno = $apellidoMaterno;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->sexo = $sexo;
        $this->lugarNacimiento = $lugarNacimiento;
        $this->calle = $calle;
        $this->colonia = $colonia;
        $this->ciudad = $ciudad;
        $this->codigoPostal = $codigoPostal;
        $this->telCasa = $telCasa;
        $this->telOficina = $telOficina;
        $this->celular = $celular;
        $this->edoCivil = $edoCivil;
        $this->ocupacion = $ocupacion;
        $this->escolaridad = $escolaridad;
        $this->correo = $correo;
    }
    public function getValues()
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellidoPaterno' => $this->apellidoPaterno,
            'apellidoMaterno' => $this->apellidoMaterno,
            'fechaNacimiento' => $this->fechaNacimiento,
            'sexo' => $this->sexo,
            'lugarNacimiento' => $this->lugarNacimiento,
            'calle' => $this->calle,
            'colonia' => $this->colonia,
            'ciudad' => $this->ciudad,
            'codigoPostal' => $this->codigoPostal,
            'telCasa' => $this->telCasa,
            'telOficina' => $this->telOficina,
            'celular' => $this->celular,
            'edoCivil' => $this->edoCivil,
            'ocupacion' => $this->ocupacion,
            'escolaridad' => $this->escolaridad,
            'correo' => $this->correo
        ];
    }
    public function insertar()
    {
        $query = "INSERT INTO paciente (nombre, apellidoPaterno, apellidoMaterno, fechaNacimiento, sexo, lugarNacimiento, calle, colonia, ciudad, codigoPostal, telCasa, telOficina, celular, edoCivil, ocupacion, escolaridad, correo) 
                  VALUES (:nombre, :apellidoPaterno, :apellidoMaterno, :fechaNacimiento, :sexo, :lugarNacimiento, :calle, :colonia, :ciudad, :codigoPostal, :telCasa, :telOficina, :celular, :edoCivil, :ocupacion, :escolaridad, :correo)";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellidoPaterno', $this->apellidoPaterno);
            $stmt->bindParam(':apellidoMaterno', $this->apellidoMaterno);
            $stmt->bindParam(':fechaNacimiento', $this->fechaNacimiento);
            $stmt->bindParam(':sexo', $this->sexo);
            $stmt->bindParam(':lugarNacimiento', $this->lugarNacimiento);
            $stmt->bindParam(':calle', $this->calle);
            $stmt->bindParam(':colonia', $this->colonia);
            $stmt->bindParam(':ciudad', $this->ciudad);
            $stmt->bindParam(':codigoPostal', $this->codigoPostal);
            $stmt->bindParam(':telCasa', $this->telCasa);
            $stmt->bindParam(':telOficina', $this->telOficina);
            $stmt->bindParam(':celular', $this->celular);
            $stmt->bindParam(':edoCivil', $this->edoCivil);
            $stmt->bindParam(':ocupacion', $this->ocupacion);
            $stmt->bindParam(':escolaridad', $this->escolaridad);
            $stmt->bindParam(':correo', $this->correo);
            $stmt->execute();
            $this->id = $this->conexion->getdbh()->lastInsertId();
            return $this->getValues();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function obtener()
    {
        $query = "SELECT * FROM paciente WHERE id = :id; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($datos) {
                $this->nombre = $datos["nombre"];
                $this->apellidoPaterno = $datos["apellidoPaterno"];
                $this->apellidoMaterno = $datos["apellidoMaterno"];
                $this->fechaNacimiento = $datos["fechaNacimiento"];
                $this->sexo = $datos["sexo"];
                $this->lugarNacimiento = $datos["lugarNacimiento"];
                $this->calle = $datos["calle"];
                $this->colonia = $datos["colonia"];
                $this->ciudad = $datos["ciudad"];
                $this->codigoPostal = $datos["codigoPostal"];
                $this->telCasa = $datos["telCasa"];
                $this->telOficina = $datos["telOficina"];
                $this->celular = $datos["celular"];
                $this->edoCivil = $datos["edoCivil"];
                $this->ocupacion = $datos["ocupacion"];
                $this->escolaridad = $datos["escolaridad"];
                $this->correo = $datos["correo"];
                return $this->getValues();
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function actualizar()
    {
        $query = "UPDATE paciente 
                  SET nombre=:nombre, apellidoPaterno=:apellidoPaterno, apellidoMaterno=:apellidoMaterno,
                      fechaNacimiento=:fechaNacimiento, sexo=:sexo, lugarNacimiento=:lugarNacimiento,
                      calle=:calle, colonia=:colonia, ciudad=:ciudad, codigoPostal=:codigoPostal,
                      telCasa=:telCasa, telOficina=:telOficina, celular=:celular,
                      edoCivil=:edoCivil, ocupacion=:ocupacion, escolaridad=:escolaridad, correo=:correo 
                  WHERE id=:id";

        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellidoPaterno', $this->apellidoPaterno);
            $stmt->bindParam(':apellidoMaterno', $this->apellidoMaterno);
            $stmt->bindParam(':fechaNacimiento', $this->fechaNacimiento);
            $stmt->bindParam(':sexo', $this->sexo);
            $stmt->bindParam(':lugarNacimiento', $this->lugarNacimiento);
            $stmt->bindParam(':calle', $this->calle);
            $stmt->bindParam(':colonia', $this->colonia);
            $stmt->bindParam(':ciudad', $this->ciudad);
            $stmt->bindParam(':codigoPostal', $this->codigoPostal);
            $stmt->bindParam(':telCasa', $this->telCasa);
            $stmt->bindParam(':telOficina', $this->telOficina);
            $stmt->bindParam(':celular', $this->celular);
            $stmt->bindParam(':edoCivil', $this->edoCivil);
            $stmt->bindParam(':ocupacion', $this->ocupacion);
            $stmt->bindParam(':escolaridad', $this->escolaridad);
            $stmt->bindParam(':correo', $this->correo);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
            return $this->getValues();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function eliminar()
    {
        try {
            $query = "DELETE FROM paciente WHERE id=:id;";
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT); 
            return $stmt->execute();
        } catch (PDOException $e) {
            return  $e->getMessage();
        }
    }
}
?>
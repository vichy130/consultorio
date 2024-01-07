<?php
class Consultorio
{
    private $id;
    private $nombre;
    private $calle;
    private $colonia;
    private $ciudad;
    private $codigoPostal;
    private $telefono;
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
        $this->dbh = null;
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
    public function setValues(
        $nombre,
        $calle,
        $colonia,
        $ciudad,
        $codigoPostal,
        $telefono
    ) {
        $this->nombre = $nombre;
        $this->calle = $calle;
        $this->colonia = $colonia;
        $this->ciudad = $ciudad;
        $this->codigoPostal = $codigoPostal;
        $this->telefono = $telefono;
    }
    public function getValues()
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'calle' => $this->calle,
            'colonia' => $this->colonia,
            'ciudad' => $this->ciudad,
            'codigoPostal' => $this->codigoPostal,
            'teleono' => $this->telefono
        ];
    }
    public function insertar()
    {
        include_once("../php/conexion.php");
        $query = "INSERT INTO consultorio (nombre,calle,colonia,ciudad,codigoPostal,telefono) VALUES (:nombre, :calle, :colonia, :ciudad, :codigoPostal, :telefono); ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':calle', $this->calle);
            $stmt->bindParam(':colonia', $this->colonia);
            $stmt->bindParam(':ciudad', $this->ciudad);
            $stmt->bindParam(':codigoPostal', $this->codigoPostal);
            $stmt->bindParam(':telefono', $this->telefono);
            $stmt->execute();
            $this->id = $this->dbh->lastInsertId();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function obtener()
    {
        $query = 'SELECT * FROM consultorio WHERE id= :id; ';
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($datos) {
                $this->nombre = $datos['nombre'];
                $this->calle = $datos['calle'];
                $this->colonia = $datos['colonia'];
                $this->ciudad = $datos['ciudad'];
                $this->codigoPostal = $datos['codigoPostal'];
                $this->telefono = $datos['telefono'];
            }
            return true;
        } catch (PDOException $e) {
            echo "Error al obtener datos del paciente: " . $e->getMessage();
            return false;
        }
    }
    public function actualizar()
    {
        $query = "UPDATE consultorio
        SET nombre=:nombre, calle=:calle, colonia=:colonia, ciudad=:ciudad, codigoPostal=:codigoPostal, telefono=:telefono WHERE id=:id; ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':calle', $this->calle);
            $stmt->bindParam('colonia', $this->colonia);
            $stmt->bindParam('ciudad', $this->ciudad);
            $stmt->bindParam('codigoPostal', $this->codigoPostal);
            $stmt->bindParam('telefono', $this->telefono);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "No se pudieron actualizar los datos" . $e->getMessage();
            return false;
        }
    }
    public function eliminar()
    {
        try {
            $query = "DELETE FROM consultorio WHERE id=:id; ";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam('id', $this->getId(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "No se pudo eliminar " . $e->getMessage();
            return false;
        }
    }
}
?>
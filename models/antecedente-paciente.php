<?php

class AntecedentePaciente
{
    private $id;
    private $enfermedad;
    private $descripcion;
    private $estaActiva;
    private $ficha;
    private $dbh;
    public function __construct($id,$enfermedad,$descripcion,$estaActiva,$ficha)
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
            $this->dbh = new PDO($dsn, $user, $password, $options);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->id = $id;
        $this->enfermedad = $enfermedad;
        $this->descripcion = $descripcion;
        $this->estaActiva = $estaActiva;
        $this->ficha = $ficha;
    }
    public function getId(){
        return $this->id;
    }
    public function getValues(){
        return [
            'id'=> $this->id,
            'enfermedad'=> $this->enfermedad,
            'descripcion'=> $this->descripcion,
            'estaActiva'=>$this->estaActiva,
            'ficha'=>$this->ficha
        ];
    }
    function insertar()
    {
        $query = "INSERT INTO antecedentes (id, enfermedad, descripcion, estaActiva, ficha) VALUES ('$this->id','$this->enfermedad','$this->descripcion', '$this->estaActiva', '$this->ficha'); ";
        $stmt = $this->dbh->prepare($query);
        $return = $stmt->execute();
        $this->id = $this->dbh->lastInsertId();
        return $return;
    }
    function mostrar()
    {
        $query = "SELECT * FROM antecedentes WHERE ficha = :ficha";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(":ficha", $this->ficha, PDO::PARAM_INT);
        try {
            $stmt->execute();
            $datos = null;
            while ($datos = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->id = $datos["id"];
                $this->enfermedad = $datos["enfermedad"];
                $this->descripcion = $datos["descripcion"];
                $this->estaActiva = $datos["estaActiva"];
                $this->ficha = $datos["ficha"];
            }
            return $this;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    function eliminar()
    {
        $query = "DELETE FROM antecedentes WHERE id = :id";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                echo "Eliminación exitosa.";
            } else {
                echo "Error al eliminar el registro.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
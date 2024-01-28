<?php

class MedicamentoIndicacion
{
    private $id;
    private $medicamento;
    private $hora;
    private $indicaciones;
    private $receta;
    private $dbh;
    function __construct($id,$medicamento,$hora,$indicaciones,$receta)
    {
        try {
            $dbname = "consultorio";
            $user = "root";
            $password = "";
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ];
            $dsn = "mysql:host=localhost;dbname=$dbname";
            $this->dbh = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->id=$id;
        $this->medicamento=$medicamento;
        $this->hora=$hora;
        $this->indicaciones=$indicaciones;
        $this->receta=$receta;
    }
    public function getValues()
    {
        return [
            'id' => $this->id,
            'medicamento' => $this->medicamento,
            'hora' => $this->hora,
            'indicaciones' => $this->indicaciones,
            'receta'=>$this->receta
        ];
    }
    public function setValues($medicamento, $hora, $indicaciones, $receta)
    {
        $this->medicamento = $medicamento;
        $this->hora = $hora;
        $this->indicaciones = $indicaciones;
        $this->receta=$receta;
    }
    public function insertar()
    {
        $query = "INSERT INTO medicamentoIndicacion (id, medicamento, hora, indicaciones, receta) VALUES (:medicamento, :hora, :indicaciones); ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':medicamento', $this->medicamento);
            $stmt->bindParam(':hora', $this->hora);
            $stmt->bindParam(':indicaciones', $this->indicaciones);
            $stmt->bindParam(':receta', $this->receta);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al insertar medicamento indicacion" . $e->getMessage();
        }
    }
    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }
}
?>
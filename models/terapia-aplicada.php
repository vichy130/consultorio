<?php
class TerapiaAplicada
{
    private $id;
    private $terapia;
    private $consulta;
    private $dbh;

    function __construct($terapia, $consulta){
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
        $query= "INSERT INTO terapiasAplicadas (terapia, consulta) VALUES (:terapia, :consulta); ";
        try{
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':terapia',$this->terapia);
            $stmt->bindParam(':consulta',$this->consulta);
            $stmt->execute();
            $this->id = $this->dbh->lastInsertId();
            return true;
        }catch(PDOException $e){
            echo "Error Terapia ".$e->getMessage();
            return false;
        }
    }
}
?>
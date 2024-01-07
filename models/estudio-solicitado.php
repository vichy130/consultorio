<?php 
class EstudioSolicitado{
    private $id;
    private $estudio;
    private $receta;
    private $dbh;
    public function __construct(){
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
    function insertar(){
        try{
            $query="INSERT INTO estudiossolicitados (estudio, receta) VALUES (:estudio,:receta); ";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':estudio', $this->estudio);
            $stmt->bindParam(':receta', $this->receta);
            return $stmt->execute();
        }
        catch(PDOException $e){
            echo "error al insertar un estudio solicitado".$e->getMessage();
            return false;
        }
    }
}
?>
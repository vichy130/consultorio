<?php 
class EstudioSolicitado{
    private $id;
    private $estudio;
    private $receta;
    private $dbh;
    public function __construct($id,$estudio, $receta){
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
        $this->id=$id;
        $this->estudio=$estudio;
        $this->receta=$receta;
    }
    public function getValues(){
        return[
            'id'=>$this->id,
            'estudio'=>$this->estudio,
            'receta'=>$this->receta
        ];
    }
    function insertar(){
        try{
            $query="INSERT INTO estudiosSolicitados VALUES (:id, :estudio,:receta); ";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':estudio', $this->estudio);
            $stmt->bindParam(':receta', $this->receta);
            return $stmt->execute();
        }
        catch(PDOException $e){
            echo "error al insertar un estudio solicitado".$e->getMessage();
            return false;
        }
    }
    function eliminar(){
        $query = "DELETE FROM estudiosSolicitados where id= :id; ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            echo "estudio eliminado" . $this->id;
        } catch (PDOException $e) {
            echo "Error al eliminar Estudio" . $e->getMessage();
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
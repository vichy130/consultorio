<?php 

class consultaPrevia{

    var $id;
    var $comentarios;
    var $diagnostico;
    var $estudios;
    var $tratamiento;
    var $consulta;

    function insertar(){
        $dbname="consultorio";
        $user="root";
        $password="";
        $options=array(
        PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES 'utf8mb4'",
        PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_OBJ);
        $dbh=null;
        try{
        $dsn="mysql:host=localhost; dbname=$dbname";
        $dbh= new PDO($dsn, $user, $password, $options);
    
}       catch (PDOException $e){
        echo $e->getMessage();
}
        $query="INSERT INTO consultaPrevia (comentarios,diagnostio,estudios,tratamiento,consulta) VALUES ('$this->comentarios','$this->diagnostico','$this->estudios','$this->tratamiento','$this->consulta'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
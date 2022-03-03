<?php 

class usuario{
    var $username;
    var $nombre;
    var $apellidoPaterno;
    var $apellidoMaterno;
    var $telefono;
    var $correo;
    var $contrasena;
    var $tipoUsuario;

    function insertar(){
        include_once("../php/conexion.php");
        $query = "INSERT INTO usuario values ('$this->username','$this->nombre','$this->apellidoPaterno','$this->apellidoMaterno','$this->telefono','$this->correo','$this->contrasena','$this->tipoUsuario'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
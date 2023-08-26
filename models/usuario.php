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
∫
    function insertar(){
        include_once("../php/conexion.php");
        $query = "INSERT INTO usuario values ('$this->username','$this->nombre','$this->apellidoPaterno','$this->apellidoMaterno','$this->telefono','$this->correo','$this->contrasena','$this->tipoUsuario'); ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

    function buscarDatos(){
        include_once("./php/conexion.php");
        $query="SELECT * FROM usuario WHERE username='$this->username'; ";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
         $datos = null;
          while( $datos = $stmt->fetch(PDO::FETCH_ASSOC) ){ 
              $this->username = $datos["username"];
              $this->nombre = $datos["nombre"];
              $this->apellidoPaterno = $datos["apellidoPaterno"];
              $this->apellidoMaterno = $datos["apellidoMaterno"];
              $this->telefono = $datos["telefono"];
              $this->correo = $datos["correo"];
              $this->contrasena = $datos["contrasena"];
              $this->tipoUsuario = $datos["tipoUsuario"];
          }
          return $this;
    }

    function eliminar(){
        include_once("../php/conexion.php");
        $query = "DELETE FROM usuario where username='$this->username'; ";

    }
}

?>
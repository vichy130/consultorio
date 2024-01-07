<?php

class usuario
{
    private $username;
    private $nombre;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $telefono;
    private $correo;
    private $contrasena;
    private $tipoUsuario;
    private $dbh;
    function __construct()
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
    }
    public function insertar()
    {
        $query = "INSERT INTO usuario values (':username',':nombre',':apellidoPaterno',':apellidoMaterno',':telefono',':correo',':contrasena',':tipoUsuario'); ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellidoPaterno', $this->apellidoPaterno);
            $stmt->bindParam(':apellidoMaterno', $this->apellidoMaterno);
            $stmt->bindParam(':telefono', $this->telefono);
            $stmt->bindParam(':correo', $this->correo);
            $stmt->bindParam(':contrasena', $this->contrasena);
            $stmt->bindParam(':tipoUsuario', $this->tipoUsuario);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al insertar Usuario" . $e->getMessage();
        }
    }
    function buscarDatos()
    {
        $query = "SELECT * FROM usuario WHERE username=':username'; ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->execute();
            $datos = null;
            while ($datos = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
        } catch (PDOException $e) {
            echo "Error al buscar datos de Usuario" . $e->getMessage();
        }
    }
    function eliminar()
    {
        $query = "DELETE FROM usuario where username=':username'; ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar Usuario" . $e->getMessage();
        }
    }
}
?>
<?php
include_once ("../models/conexion.php");
class usuario
{
    private $username;
    private $nombre;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $telefono;
    private $correo;
    private $contrasena;
    private $hashedPassword;
    private $tipoUsuario;
    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
    }
    public function setValues(
        $nombre,
        $apellidoPaterno,
        $apellidoMaterno,
        $telefono,
        $correo,
        $tipoUsuario
    ) {
        $this->nombre = $nombre;
        $this->apellidoPaterno = $apellidoPaterno;
        $this->apellidoMaterno = $apellidoMaterno;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->tipoUsuario = $tipoUsuario;
    }

    public function getValues()
    {
        return [
            'username' => $this->username,
            'nombre' => $this->nombre,
            'apellidoPaterno' => $this->apellidoPaterno,
            'apellidoMaterno' => $this->apellidoMaterno,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
            'tipoUsuario' => $this->tipoUsuario
        ];
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }
    public function getContrasena()
    {
        return $this->contrasena;
    }
    function getHashed()
    {
        return $this->hashedPassword;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellidoPaterno()
    {
        return $this->apellidoPaterno;
    }
    public function getApellidoMaterno()
    {
        return $this->apellidoMaterno;
    }
    public function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }
    public function insertar()
    {
        $this->encriptar();
        $query = "INSERTs INTO usuario (username,nombre,apellidoPaterno,apellidoMaterno,telefono,correo,contrasena,tipoUsuario)values (:username,:nombre,:apellidoPaterno,:apellidoMaterno,:telefono,:correo,:contrasena,:tipoUsuario); ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellidoPaterno', $this->apellidoPaterno);
            $stmt->bindParam(':apellidoMaterno', $this->apellidoMaterno);
            $stmt->bindParam(':telefono', $this->telefono);
            $stmt->bindParam(':correo', $this->correo);
            $stmt->bindParam(':contrasena', $this->hashedPassword);
            $stmt->bindParam(':tipoUsuario', $this->tipoUsuario);
            $stmt->execute();
            return $this->getValues();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function obtener()
    {
        $query = "SELECT * FROM usuario WHERE username=:username; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->execute();
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($datos) {
                $this->username = $datos["username"];
                $this->nombre = $datos["nombre"];
                $this->apellidoPaterno = $datos["apellidoPaterno"];
                $this->apellidoMaterno = $datos["apellidoMaterno"];
                $this->telefono = $datos["telefono"];
                $this->correo = $datos["correo"];
                $this->tipoUsuario = $datos["tipoUsuario"];
                $this->hashedPassword = $datos["contrasena"];
            }
            return $this->getValues();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function eliminar()
    {
        $query = "DELETE FROM usuario where username=:username; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':username', $this->username);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function actualizar()
    {
        $query = "UPDATE usuario set
            username=:username,
            nombre=:nombre,
            apellidoPaterno=:apellidoPaterno,
            apellidoMaterno=:apellidoMaterno,
            telefono=:telefono,
            correo=:correo,
            tipoUsuario=:tipoUsuario
            WHERE username=:username; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":apellidoPaterno", $this->apellidoPaterno);
            $stmt->bindParam(":apellidoMaterno", $this->apellidoMaterno);
            $stmt->bindParam(":telefono", $this->telefono);
            $stmt->bindParam(":correo", $this->correo);
            $stmt->bindParam(":tipoUsuario", $this->tipoUsuario);
            $stmt->bindParam(":username", $this->username);
            $stmt->execute();
            return $this->getValues();

        } catch (PDOException $e) {
            echo $e->getMessage();
            return $e->getMessage();
        }
    }
    function actualizarContrasena()
    {
        $this->encriptar();
        $query = "UPDATE usuario set
            contrasena=:contrasena
            WHERE username=:username; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(":contrasena", $this->hashedPassword);
            $stmt->bindParam(":username", $this->username);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return $e->getMessage();
        }
    }
    function encriptar()
    {
        $this->hashedPassword = password_hash($this->contrasena, PASSWORD_DEFAULT);
    }
    function validar()
    {
        $query = "SELECT * FROM usuario WHERE username=:username; ";
        try {
            $stmt = $this->conexion->getdbh()->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->execute();
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($datos) {
                $this->hashedPassword = $datos["contrasena"];
                if (password_verify($this->contrasena, $this->hashedPassword)) {
                    $this->username = $datos["username"];
                    $this->nombre = $datos["nombre"];
                    $this->apellidoPaterno = $datos["apellidoPaterno"];
                    $this->apellidoMaterno = $datos["apellidoMaterno"];
                    $this->telefono = $datos["telefono"];
                    $this->correo = $datos["correo"];
                    $this->tipoUsuario = $datos["tipoUsuario"];
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
?>
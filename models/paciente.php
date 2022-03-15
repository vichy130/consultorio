<?php 

class paciente{

    var $id;
    var $nombre;
    var $apellidoPaterno;
    var $apellidoMaterno;
    var $fechaNacimiento;
    var $sexo;
    var $lugarNacimiento;
    var $calle;
    var $colonia;
    var $ciudad;
    var $codigoPostal;
    var $telCasa;
    var $telOficina;
    var $celular;
    var $edoCivil;
    var $ocupacion;
    var $escolaridad;
    var $correo;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT into paciente (nombre,apellidoPaterno,apellidoMaterno,fechaNacimiento,sexo,lugarNacimiento,calle,colonia,ciudad,codigoPostal,telCasa,telOficina,celular,edoCivil,ocupacion,escolaridad,correo) 
          VALUES ('$this->nombre','$this->apellidoPaterno','$this->apellidoMaterno','$this->fechaNacimiento','$this->sexo','$this->lugarNacimiento','$this->calle','$this->colonia','$this->ciudad',
          '$this->codigoPostal','$this->telCasa','$this->telOficina','$this->celular','$this->edoCivil','$this->ocupacion','$this->escolaridad','$this->correo');
        ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

    function buscarDatos(){

      include_once("./php/conexion.php");
      $query="select * from paciente where id=$this->id;
      ";
    
      $stmt = $dbh->prepare($query);
      $stmt->execute();
       $datos = null;
        while( $datos = $stmt->fetch(PDO::FETCH_ASSOC) ){ 
            $this->nombre = $datos["nombre"];
            $this->apellidoPaterno = $datos["apellidoPaterno"];
            $this->apellidoMaterno = $datos["apellidoMaterno"];
            $this->fechaNacimiento = $datos["fechaNacimiento"];
            $this->sexo = $datos["sexo"];
            $this->lugarNacimiento = $datos["lugarNacimiento"];
            $this->calle = $datos["calle"];
            $this->colonia = $datos["colonia"];
            $this->ciudad = $datos["ciudad"];
            $this->codigoPostal = $datos["codigoPostal"];
            $this->telCasa = $datos["telCasa"];
            $this->telOficina = $datos["telOficina"];
            $this->celular = $datos["celular"];
            $this->edoCivil = $datos["edoCivil"];
            $this->ocupacion = $datos["ocupacion"];
            $this->escolaridad = $datos["escolaridad"];
            $this->correo = $datos["correo"];
        }
        return $this;
    }

    function crearFicha(){
        include_once("./php/conexion.php");
        $query="insert into ficha (paciente) values ($this->$id); ";
        $stmt = $dbh->prepare($query);
        return $stmt->execute();

    }

}

?>
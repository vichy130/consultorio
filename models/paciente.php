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
    var $telefono;
    var $edoCivil;
    var $ocupacion;
    var $escolaridad;
    var $correo;

    function insertar(){
        include_once("../php/conexion.php");
        $query="INSERT into paciente (nombre,apellidoPaterno,apellidoMaterno,fechaNacimiento,sexo,lugarNacimiento,calle,colonia,ciudad,codigoPostal,telefono,edoCivil,ocupacion,escolaridad,correo) 
          VALUES ('$this->nombre','$this->apellidoPaterno','$this->apellidoMaterno','$this->fechaNacimiento','$this->sexo','$this->lugarNacimiento','$this->calle','$this->colonia','$this->ciudad',
          '$this->codigoPostal',null,'$this->edoCivil','$this->ocupacion','$this->escolaridad','$this->correo');
        ";
        echo $query;
        $stmt = $dbh->prepare($query);
        return $stmt->execute();
    }

}

?>
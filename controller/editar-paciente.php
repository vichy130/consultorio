<?php /* edited 04 08 22*/ 
session_start();

include_once("../models/paciente.php");
$paciente=new paciente();
$id_paciente=$_SESSION["id_paciente"];
$paciente->id = $id_paciente;
$paciente->nombre  = $_POST["nombre-paciente"];
$paciente->apellidoPaterno = $_POST["apellidop-paciente"];
$paciente->apellidoMaterno = $_POST["apellidom-paciente"];
$paciente->fechaNacimiento = $_POST["nacimiento-paciente"];
$paciente->sexo = $_POST["sexo"];
$paciente->lugarNacimiento = $_POST["lugar-paciente"];
$paciente->calle= $_POST["calle-paciente"];
$paciente->colonia = $_POST["colonia-paciente"];
$paciente->ciudad = $_POST["ciudad-paciente"];
$paciente->codigoPostal = $_POST["cp-paciente"];
$paciente->telCasa = $_POST["telefono-casa-paciente"];
$paciente->telOficina = $_POST["telefono-oficina-paciente"];
$paciente->celular = $_POST["telefono-cel-paciente"];
$paciente->edoCivil = $_POST["civil-paciente"];
$paciente->ocupacion = $_POST["ocupacion-paciente"];
$paciente->escolaridad = $_POST["escolaridad-paciente"];
$paciente->correo = $_POST["email-paciente"];

function actualizarDatos(paciente $paciente){
    include_once("../php/conexion.php");
    $query="UPDATE paciente SET nombre='$paciente->nombre', apellidoPaterno='$paciente->apellidoPaterno', apellidoMaterno='$paciente->apellidoMaterno',
    fechaNacimiento='$paciente->fechaNacimiento', sexo='$paciente->sexo', lugarNacimiento='$paciente->lugarNacimiento', calle='$paciente->calle', 
    colonia='$paciente->colonia', ciudad='$paciente->ciudad', codigoPostal='$paciente->codigoPostal', telCasa='$paciente->telCasa', telOficina='$paciente->telOficina',
    celular='$paciente->celular', edoCivil='$paciente->edoCivil', ocupacion='$paciente->ocupacion', escolaridad='$paciente->escolaridad', correo='$paciente->correo' where id='$paciente->id';
    ";
    echo $query;
    $stmt = $dbh->prepare($query);
    return $stmt->execute();
    
}

if(actualizarDatos($paciente)==1){
    echo "ENVIADO";
}else{
    echo "ERROR, no se enviaron los datos";
}
?>
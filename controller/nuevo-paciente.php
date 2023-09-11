<?php 
include_once("../models/paciente.php");
$paciente = new paciente(); //Creamos al objeto
//llenar al objeto con los valores del formulario

$paciente->nombre  = $_POST["nombre-paciente"];
$paciente->apellidoPaterno = $_POST["apellidop-paciente"];
$paciente->apellidoMaterno = $_POST["apellidom-paciente"];
$paciente->sexo = $_POST["sexo"];
$paciente->fechaNacimiento = $_POST["nacimiento-paciente"];
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

if($paciente->insertar()==1){
  echo "Paciente registrado";
  echo $paciente->id();
  $id=$paciente->id();
  header("Location: ../pacientes-informacion.php?exito=1&id=$id");

}else{
    echo "Error al registrar, intentalo nuevamente";
}

?>
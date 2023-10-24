<?php /* edited 04 08 22*/ 
session_start();

include_once("../models/paciente.php");
$paciente=new Paciente();
$id_paciente=$_SESSION["id_paciente"];
$nombre  = $_POST["nombre-paciente"];
$apellidoPaterno = $_POST["apellidop-paciente"];
$apellidoMaterno = $_POST["apellidom-paciente"];
$fechaNacimiento = $_POST["nacimiento-paciente"];
$sexo = $_POST["sexo"];
$lugarNacimiento = $_POST["lugar-paciente"];
$calle= $_POST["calle-paciente"];
$colonia = $_POST["colonia-paciente"];
$ciudad = $_POST["ciudad-paciente"];
$codigoPostal = $_POST["cp-paciente"];
$telCasa = $_POST["telefono-casa-paciente"];
$telOficina = $_POST["telefono-oficina-paciente"];
$celular = $_POST["telefono-cel-paciente"];
$edoCivil = $_POST["civil-paciente"];
$ocupacion = $_POST["ocupacion-paciente"];
$escolaridad = $_POST["escolaridad-paciente"];
$correo = $_POST["email-paciente"];

$paciente->setId($id_paciente);
$paciente->setValues($nombre, $apellidoPaterno, $apellidoMaterno,
$fechaNacimiento, $sexo, $lugarNacimiento, $calle,
$colonia, $ciudad, $codigoPostal, $telCasa, $telOficina,
$celular, $edoCivil, $ocupacion, $escolaridad, $correo);

if($paciente->actualizar())
{
    echo "1";
}else echo "0";
?>
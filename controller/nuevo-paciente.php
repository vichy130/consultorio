<?php 
session_start();
function redirect($url)
{
    ob_start();
    header('Location:' . $url);
    ob_end_flush();
    die();
}
if (!isset($_SESSION['username'])) {
    redirect("./iniciar-sesion.php");
    exit();
}
include_once("../models/paciente.php");
$respuesta;
try{
$paciente = new Paciente(); //Creamos al objeto
//llenar al objeto con los valores del formulario
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

$paciente->setValues($nombre, $apellidoPaterno, $apellidoMaterno,
$fechaNacimiento, $sexo, $lugarNacimiento, $calle,
$colonia, $ciudad, $codigoPostal, $telCasa, $telOficina,
$celular, $edoCivil, $ocupacion, $escolaridad, $correo);

$respuesta=$paciente->insertar();
$_SESSION["id_paciente"]=$paciente->getId();
}
catch(PDOException $e){
  $respuesta=$e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;
?>
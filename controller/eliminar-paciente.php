<?php /* edited 08 08 22*/ 
session_start();
include_once("../models/paciente.php");
$paciente=new Paciente();
$id_paciente=$_REQUEST["id"];
$paciente->setId($id_paciente);
if($paciente->eliminar()==1){
    echo "datos eliminados";
}else{
    echo "Datos no eliminados";
}
?>
<?php /* edited 08 08 22*/ 
session_start();

include_once("../models/paciente.php");
$paciente=new paciente();
$id_paciente=$_REQUEST["id"];
$paciente->id = $id_paciente;

echo "eliminar paciente";
echo $id_paciente;

function eliminarDatos(paciente $paciente){
    include_once("../php/conexion.php");
    $query="DELETE FROM paciente WHERE id='$paciente->id'; ";
    echo $query;
    $stmt = $dbh->prepare($query);
    return $stmt->execute();
}

if(eliminarDatos($paciente)==1){
    echo("<script>console.log('Datos eliminados');</script>");
    /*header("location:../pacientes.php");*/
}else{
    echo("<script>console.log('Datos NO eliminados');</script>");
}

?>
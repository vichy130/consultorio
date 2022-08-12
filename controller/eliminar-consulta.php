<?php /* edited 09 08 22 consulta*/ 
session_start();

include_once("../models/consulta.php");
$consulta=new consulta();
$id_consulta=$_REQUEST["id"];
$consulta->id = $id_consulta;

echo "eliminar consulta";
echo $id_consulta;

function eliminarDatos(consulta $consulta){
    include_once("../php/conexion.php");
    $query="DELETE FROM consulta WHERE id='$consulta->id'; ";
    echo $query;
    $stmt = $dbh->prepare($query);
    return $stmt->execute();
}

if(eliminarDatos($paciente)==1){
    echo "DATOS ELIMINADOS";
}else{
    echo "ERROR. DATOS NO ELIMINADOS";
}

?>
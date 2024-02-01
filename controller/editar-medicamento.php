<?php
session_start();

include_once("../models/medicamento.php");
$medicamento=new Medicamento();

$id=$_SESSION['id_med'];
$nombre=$_POST['nombre-medicamento'];
$tipo=$_POST['tipo-medicamento'];
$descripcion=$_POST['medicamento-descripcion'];

$medicamento->setId($id);
$medicamento->setValues($nombre, $tipo, $descripcion);

if($medicamento->actualizar()){
    return true;
}else {
    return false;
}


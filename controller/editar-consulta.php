<?php
session_start();
include_once("../models/consulta.php");
$consulta= new consulta();
$consulta->id=$_SESSION["id_consulta"];
echo $consulta->id;
?>
<?php
session_start();
include_once("../models/ficha-clinica.php");

if (isset($_SESSION["id_paciente"])) {
    $id_paciente = $_SESSION["id_paciente"];
    $ficha = new Ficha();
    $ficha->paciente = $id_paciente;
    $ficha->obtener();
    // Devolver la ficha en formato JSON
    header("Content-Type: application/json");
    echo json_encode($ficha);
} else {
    redirect("./pacientes-informacion.php");
}



?>
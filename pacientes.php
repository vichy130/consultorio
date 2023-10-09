<?php
session_start(); 

function redirect($url) {
    ob_start();
    header('Location:'.$url);
    ob_end_flush();
    die();
}
if(!isset($_SESSION['username'])){
    redirect("./iniciar-sesion.php");
    exit();
}

if(isset($_SESSION["id_paciente"])){
    unset($_SESSION["id_paciente"]);
    unset($_SESSION["id_consulta"]);
    unset($_REQUEST["id"]);
    unset($_REQUEST["id2"]);
}

require("./php/conexion.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos-pacientes.css">
    <title>Pacientes</title>
</head>

<body>
    <div class="contenedor">
        <?php require("./layout/menu.php"); ?>

        <div class="content-general">
            <label class="span-4">Pacientes</label>
            <input class="form_input span-2" type="text">
            <button class="boton azul"><i class="fas fa-search"></i> Buscar</button>
            <button class="boton azul" id="nuevo-paciente-boton"><i class="fas fa-user-plus"></i> Nuevo
                paciente</button>
            <table class="table span-4" id="tabla-pacientes">
                <thead>
                    <tr>
                        <th>Nombre(s)</th>
                        <th>Apellidos</th>
                        <th class="column-to-hide">Telefono</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
            </table>

        </div>
        <!-- end div content-pacientes -->
        <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
</body>
<script src="./js/form-pacientes.js"></script>
</html>
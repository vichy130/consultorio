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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos-pacientes-informacion.css">
    <link rel="stylesheet" href="./css/estilos-pacientes.css">
    <title>Nueva consulta</title>
</head>
<body>
    <div class="contenedor">
    <?php require("./layout/menu.php"); ?>
    <div class="content">
    <?php require("./layout/content-informacion.php"); ?>
    <?php require("./layout/submenu-pacientes.php"); ?>
        <div class="contenido">
            <form class="form" action="">

            <div class="formulario_grupo">
                        <label class="form_label" for="nombre-paciente">Nombre(s)</label>
                        <input class="form_input" type="text" id="nombre-paciente" name="nombre-paciente">
                    </div><!-- end form-grupo -->

            </form >
        </div>
        <!-- end contenido -->
    </div>
    <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
</body>
</html>
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
    <link rel="stylesheet" href="./css/estilos-index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Aga-Khan</title>
</head>

<body>
    <div class="contenedor">
        <?php require("./layout/menu.php"); ?>
            <div class="content-general">
                <div id="titulo"><h2>Inicio</h2></div>
                <div class="pacientes">Pacientes</div>
                <div class="consultas">Consultas</div>
                <div class="medicamentos">Medicamentos</div>

            </div>
        <?php require("./layout/footer.php"); ?>
    <!-- END contenedor -->
</body>
<script src="./js/form-inicio.js"></script>
</html>
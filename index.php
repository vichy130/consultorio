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
    <title>Consultorio Homeopático</title>
</head>

<body>
    <div class="contenedor">
        <?php require("./layout/menu.php"); ?>

            <div class="content-general">Bienvenido (a)</div>

        <?php require("./layout/footer.php"); ?>
    <!-- END contenedor -->
</body>

</html>
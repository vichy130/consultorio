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
    <link rel="stylesheet" href="./css/estilos-pacientes.css">
    <title>Pacientes</title>
</head>

<body>
    <div class="contenedor">
        <?php require("./layout/menu.php"); ?>

        <div class="content-pacientes">
            <i class="fas fa-search"></i>
            <input class="form_input" type="text">
            <button class="boton">Buscar</button>


            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre(s)</th>
                        <th>Apellido paterno</th>
                        <th>Apellido materno</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td><a href="./pacientes-informacion.php">ver/modificar</a></td>
                        <td><i class="fas fa-trash"></i></td>
                    </tr>
                    <tr>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td><a href="./pacientes-informacion.php">ver/modificar</a></td>
                        <td><i class="fas fa-trash"></i></td>
                    </tr>
                    <tr>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td><a href="./pacientes-informacion.php">ver/modificar</a></td>
                        <td><i class="fas fa-trash"></i></td>
                    </tr>
                </tbody>
            </table>

        </div>
        <!-- end div content-pacientes -->
        <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
</body>

</html>
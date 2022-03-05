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
require("./php/conexion.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos-pacientes.css">
    <link rel="stylesheet" href="./css/estilos-pacientes-consultas.css">
    <link rel="stylesheet" href="./css/estilos-pacientes-informacion.css">
    <link rel="stylesheet" href="./css/mediaqueries.css">
    <title>Consultas</title>
</head>

<body>
    <div class="contenedor">
        <?php require("./layout/menu.php"); ?>
        <div class="content">
            <?php require("./layout/content-informacion.php"); ?>
            <?php require("./layout/submenu-pacientes.php"); ?>

            <div class="content-pacientes">

                <label class="span-4" for="">Consultas</label>

                <input class="form_input" type="date">

                <button class="boton azul"><i class="fas fa-search"></i> Buscar</button>

                <div></div>

                <button class="boton azul" onClick="redirectNuevaConsulta()"><i class="fas fa-plus"></i> Nueva
                    consulta</button>

                <table class="table span-4">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th class="column-to-hide">Motivo de consulta</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
            $stat= $dbh-> prepare ("select fecha, motivoConsulta from consulta; ");
            $stat->execute();
            while($datosConsultas=$stat->fetch(PDO::FETCH_OBJ)){
                ?>
                        <tr>
                            <td><?php echo $datosConsultas->fecha;?></td>
                            <td class="column-to-hide"><?php echo $datosConsultas->motivoConsulta;?></td>
                            <td><a href="#">Ver/modificar</a></td>
                            <td><i class="fas fa-trash"></i></td>
                        </tr>
                <?php } ?>
                    </tbody>
                </table>

            </div>
            <!-- end div content-pacientes -->

        </div>
        <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
    <script src="./js/botones.js"></script>
</body>

</html>
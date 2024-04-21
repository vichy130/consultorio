<?php
session_start();

function redirect($url)
{
    ob_start();
    header('Location:' . $url);
    ob_end_flush();
    die();
}
if (!isset($_SESSION['username'])) {
    redirect("./iniciar-sesion.php");
    exit();
}
$id_paciente = 0;
if (isset($_SESSION["id_paciente"])) {
    $id_paciente = $_SESSION["id_paciente"];
} else {
    redirect("./pacientes-informacion.php");
}
if (isset($_SESSION["id_consulta"])) {
    unset($_SESSION["id_consulta"]);
}
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
        <?php require ("./layout/menu.php"); ?>
        <div class="content">
            <?php require ("./layout/content-informacion.php"); ?>
            <?php require ("./layout/submenu-pacientes.php"); ?>

            <div class="content-pacientes">

                <div id="modal" class="modal">
                    <div id="modal-contenido" class="modal-contenido">
                        <span class="cerrar-modal" id="cerrarModal">&times;</span>
                    </div>
                </div>

                <label class="span-4" for="">Consultas</label>
                <input class="form_input" type="date" id="input-buscar">
                <button class="boton azul" id="boton-buscar-consulta"><i class="fas fa-search"></i> Buscar</button>
                <div></div>
                <button class="boton azul" id="nueva-consulta-boton"><i class="fas fa-plus"></i> Nueva
                    consulta</button>
                <table class="table span-4" id="tabla-consultas">
                    <!--<thead>
                        <tr>
                            <th>Fecha</th>
                            <th class="column-to-hide">Motivo de consulta</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>-->
                </table>
                <div id="no-tabla"></div>
            </div>
            <!-- end div content-pacientes -->
        </div>
        <?php require ("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
</body>
<script src="./js/form-consultas.js"></script>

</html>
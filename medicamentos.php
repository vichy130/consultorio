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

unset($_SESSION["id_paciente"]);
unset($_SESSION["id_consulta"]);
unset($_SESSION['id_med']);
unset($_REQUEST['id']);
unset($_SESSION['id_con']);

require ("./php/conexion.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos-pacientes.css">
    <title>Medicamentos</title>
</head>

<body>
    <div class="contenedor">
        <?php require ("./layout/menu.php"); ?>

        <div class="content-general">

            <div id="modal" class="modal">
                <div id="modal-contenido" class="modal-contenido">
                    <span class="cerrar-modal" id="cerrarModal">&times;</span>
                </div>
            </div>

            <label class="span-4">Medicamentos</label>
            
            <div class="formulario_grupo span-2">
                <div class="form_grupo-input">
                    <input class="form_input" type="text" id="input-buscar">
                    <i id="icono-buscar" class="form_validacion-buscar fa-solid fa-xmark"></i>
                </div>
            </div>

            <button class="boton azul" id="boton-buscar-medicamento"><i class="fas fa-search"></i> Buscar</button>
            <button class="boton azul" id="boton-nuevo-medicamento"><i class="fas fa-user-plus"></i> Nuevo
                medicamento</button>
            <table class="table span-4" id="tabla-medicamentos">
                <!--<thead>
                    <tr>
                        <th>Medicamento</th>
                        <th>Tipo</th>
                        <th class="column-to-hide">Descripción</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>-->
            </table>
            <div id="no-tabla"></div>
        </div>
        <!-- end div content-pacientes -->
        <?php require ("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
</body>
<script src="./js/form-medicamentos.js"></script>

</html>
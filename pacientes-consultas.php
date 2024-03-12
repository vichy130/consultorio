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
        <?php require("./layout/menu.php"); ?>
        <div class="content">
            <?php require("./layout/content-informacion.php"); ?>
            <?php require("./layout/submenu-pacientes.php"); ?>

            <div class="content-pacientes">
            <div id="modalPregunta" class="modal-preguntar">
                <div class="modal-contenido-preguntar">
                    <span class="cerrar-modal" id="cerrarModalPregunta">&times;</span>
                    <h2>Confirmar Eliminación</h2>
                    <br>
                    <p>¿Seguro que desea eliminar esta consulta?</p>
                    <div class="botones">
                        <button class="boton rojo" id="botonAceptarEliminar">Aceptar</button>
                        <button class="boton azul" id="botonCancelarEliminar">Cancelar</button>
                    </div>
                </div>
            </div>
            <div id="modalExito" class="modal-exito">
                <div class="modal-contenido-exito">
                <span class="cerrar-modal" id="cerrarModalExito">&times;</span>
                <h2>¡Consulta eliminada!</h2>
                <br>
                <p>Los datos se han eliminado con éxito.</p>
                </div>
            </div>
            <div id="modalError" class="modal-error">
                <div class="modal-contenido-error">
                <span class="cerrar-modal" id="cerrarModalError">&times;</span>
                <h2>La consulta No ha sido eliminada</h2>
                <br>
                <p>Porfavor, revisa la información e intenta de nuevo.</p>
                </div>
            </div>
                <label class="span-4" for="">Consultas</label>
                <input class="form_input" type="date">
                <button class="boton azul"><i class="fas fa-search"></i> Buscar</button>
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
        <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
</body>
<script src="./js/form-consultas.js"></script>
</html>
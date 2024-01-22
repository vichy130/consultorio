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
if (isset($_SESSION["id_paciente"])) {
    unset($_SESSION["id_paciente"]);
    unset($_SESSION["id_consulta"]);
    unset($_REQUEST["id"]);
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
    <title>Medicamentos</title>
</head>

<body>
    <div class="contenedor">
        <?php require("./layout/menu.php"); ?>

        <div class="content-general">
            <div id="modalPregunta" class="modal-preguntar">
                <div class="modal-contenido-preguntar">
                    <span class="cerrar-modal" id="cerrarModalPregunta">&times;</span>
                    <h2>Confirmar Eliminación</h2>
                    <br>
                    <p>¿Seguro que desea eliminar este medicamento?</p>
                    <div class="botones">
                        <button class="boton rojo" id="botonAceptarEliminar">Aceptar</button>
                        <button class="boton azul" id="botonCancelarEliminar">Cancelar</button>
                    </div>
                </div>
            </div>
            <div id="modalExito" class="modal-exito">
                <div class="modal-contenido-exito">
                <span class="cerrar-modal" id="cerrarModalExito">&times;</span>
                <h2>¡Medicamento eliminado!</h2>
                <br>
                <p>Los datos se han eliminado con éxito.</p>
                </div>
            </div>
            <div id="modalError" class="modal-error">
                <div class="modal-contenido-error">
                <span class="cerrar-modal" id="cerrarModalError">&times;</span>
                <h2>El medicamento NO ha sido eliminado</h2>
                <br>
                <p>Porfavor, revisa la información e intenta de nuevo.</p>
                </div>
            </div>

            <label class="span-4">Medicamentos</label>
            <input class="form_input span-2" type="text">
            <button class="boton azul"><i class="fas fa-search"></i> Buscar</button>
            <button class="boton azul" id="boton-nuevo-medicamento"><i class="fas fa-user-plus"></i> Nuevo
                medicamento</button>
            <table class="table span-4" id="tabla-medicamentos">
                <thead>
                    <tr>
                        <th>Medicamento</th>
                        <th>Tipo</th>
                        <th class="column-to-hide">Descripcion</th>
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
<script src="./js/form-medicamentos.js"></script>

</html>
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
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
unset($_SESSION['id_con']);

// include_once (__DIR__ . '/php/conexion.php');
// echo "ESTE ES EL DIR". __DIR__ . '/php/conexion.php';
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
        <?php require ("./layout/menu.php"); ?>

        <div class="content-general">

            <div id="modal" class="modal">
                <div id="modal-contenido" class="modal-contenido">
                    <span class="cerrar-modal" id="cerrarModal">&times;</span>
                </div>
            </div>
            <!-- <div id="modalExito" class="modal-exito">
                <div class="modal-contenido-exito">
                <span class="cerrar-modal" id="cerrarModalExito">&times;</span>
                <h2>¡Paciente eliminado!</h2>
                <br>
                <p>Los datos se han eliminado con éxito.</p>
                </div>
            </div>
            <div id="modalError" class="modal-error">
                <div class="modal-contenido-error">
                <span class="cerrar-modal" id="cerrarModalError">&times;</span>
                <h2>El paciente NO ha sido eliminado</h2>
                <br>
                <p>Porfavor, revisa la información e intenta de nuevo.</p>
                </div>
            </div> -->

            <label class="span-4">Pacientes</label>

            <div class="formulario_grupo span-2">
                <div class="form_grupo-input">
                <input class="form_input" type="text" id="input-buscar">
                <i id="icono-buscar" class="form_validacion-buscar fa-solid fa-xmark"></i>
                </div>
            </div>
            
            <button class="boton azul" id="boton-buscar-paciente"><i class="fas fa-search"></i> Buscar</button>
            <button class="boton azul" id="nuevo-paciente-boton"><i class="fas fa-user-plus"></i> Nuevo
                paciente</button>
            <table class="table span-4" id="tabla-pacientes">
                <!--<thead>
                    <tr>
                        <th>Registro</th>
                        <th>Nombre(s)</th>
                        <th>Apellidos</th>
                        <th class="column-to-hide">Telefono</th>
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
<script src="./js/form-pacientes.js"></script>

</html>
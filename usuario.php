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

if (isset($_REQUEST["id"])) {
    $_SESSION['id_usuario']=$_REQUEST["id"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos-pacientes.css">
    <title>Nuevo Usuario</title>
</head>

<body>
    <div class="contenedor">
        <?php require("./layout/menu.php"); ?>

        <!--<div id="modalExito" class="modal">
            <div class="modal-contenido">
                <span class="cerrar-modal" id="cerrarModal">&times;</span>
                <h2>¡Usuario creado!</h2>
                <br>
                <p>Los datos se han guardado con éxito.</p>
            </div>
        </div>
-->

        <form class="content-general" id="form-usuario">

            <label class="formulario_grupo span-4">Nuevo usuario</label>

            <div class="formulario_grupo">
                <label class="form_label" for="username-usuario">Nombre de usuario</label>
                <input class="form_input" type="text" id="username-usuario" name="username-usuario">
            </div><!-- end form-grupo -->

            <div class=" formulario_grupo">
                <label class="form_label" for="nombre-usuario">Nombre</label>
                <input class="form_input" type="text" id="nombre-usuario" name="nombre-usuario">
            </div><!-- end form-grupo -->

            <div class="formulario_grupo">
                <label class="form_label" for="apellidoPaterno-usuario">Apellido paterno</label>
                <input class="form_input" type="text" id="apellidoPaterno-usuario" name="apellidoPaterno-usuario">
            </div><!-- end form-grupo -->

            <div class="formulario_grupo">
                <label class="form_label" for="apellidoMaterno-usuario">Apellido materno</label>
                <input class="form_input" type="text" id="apellidoMaterno-usuario" name="apellidoMaterno-usuario">
            </div><!-- end form-grupo -->

            <div class="formulario_grupo">
                <label class="form_label" for="telefono-usuario">Telefono</label>
                <input class="form_input" type="text" id="telefono-usuario" name="telefono-usuario">
            </div><!-- end form-grupo -->

            <div class="formulario_grupo">
                <label class="form_label" for="correo-usuario">Correo electronico</label>
                <input class="form_input" type="text" id="correo-usuario" name="correo-usuario">
            </div><!-- end form-grupo -->

            <div class="formulario_grupo">
                <label class="form_label" for="contrasena-usuario">Contraseña</label>
                <input class="form_input" type="text" id="contrasena-usuario" name="contrasena-usuario">
            </div><!-- end form-grupo -->

            <div class="formulario_grupo">
                <label class="form_label" for="tipo-usuario">Tipo de usuario</label>
                <input class="form_input" type="text" id="tipo-usuario" name="tipo-usuario">
            </div><!-- end form-grupo -->
            <div class="formulario_grupo">
                <label class="form_label" for="firma-usuario">Firma Médico</label>
                <input class="form_input" type="file" id="firma-usuario" name="firma-usuario"
                    accept=".jpg, .jpeg, .png">
            </div><!-- end form-grupo -->
            <button class="input_submit boton amarillo span-2">Imprimir</button>
            <input class="input_submit boton azul span-2" type="submit" value="Guardar" id="boton-guardar-usuario">

        </form>
        <!-- end FORM -->
        <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
    <script src="./js/form-usuario.js"></script>
</body>

</html>
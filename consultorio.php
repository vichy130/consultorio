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
if (isset($_REQUEST['id'])) {
    $_SESSION['id_con'] = $_REQUEST['id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos-pacientes.css">
    <title>Consultorio</title>
</head>

<body>

    <div class="contenedor">
        <?php require ("./layout/menu.php"); ?>

        <div id="modal" class="modal">
            <div id="modal-contenido" class="modal-contenido">
                <span class="cerrar-modal" id="cerrarModal">&times;</span>
            </div>
        </div>

        <form class="content-general" id="form-consultorio">
            <label class="formulario_grupo span-4">Consultorio</label>

            <!-- Grupo: -->
            <div class="formulario_grupo span-2" id="grupo_nombre">
                <label class="form_label" for="nombre-consultorio">Nombre de consultorio</label>
                <div class="form_grupo-input">
                    <input class="form_input" type="text" id="nombre-consultorio" name="nombre-consultorio">
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">El campo no puede estar vacío. Solo permite letras y números, máximo 100
                    caracteres.</p>
            </div><!-- end form-grupo -->

            <label class="formulario_grupo span-4">Domicilio</label>

            <!-- Grupo: -->
            <div class="formulario_grupo" id="grupo_calle">
                <label class="form_label" for="calle-consultorio">Calle</label>
                <div class="form_grupo-input">
                    <input class="form_input" type="text" id="calle-consultorio" name="calle-consultorio">
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">El campo no puede estar vacío. Solo permite letras y números, máximo 45
                    caracteres.</p>
            </div><!-- end form-grupo -->

            <!-- Grupo: -->
            <div class="formulario_grupo" id="grupo_colonia">
                <label class="form_label" for="colonia-consultorio">Colonia</label>
                <div class="form_grupo-input">
                    <input class="form_input" type="text" id="colonia-consultorio" name="colonia-consultorio">
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">El campo no puede estar vacío. Solo permite letras y números, máximo 45
                    caracteres.</p>
            </div><!-- end form-grupo -->

            <!-- Grupo: -->
            <div class="formulario_grupo" id="grupo_ciudad">
                <label class="form_label" for="ciudad-consultorio">Ciudad</label>
                <div class="form_grupo-input">
                    <input class="form_input" type="text" id="ciudad-consultorio" name="ciudad-consultorio">
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">El campo no puede estar vacío. Solo permite letras y números, máximo 45
                    caracteres.</p>
            </div><!-- end form-grupo -->

            <!-- Grupo: -->
            <div class="formulario_grupo" id="grupo_cp">
                <label class="form_label" for="cp-consultorio">Codigo postal</label>
                <div class="form_grupo-input">
                    <input class="form_input" type="text" id="cp-consultorio" name="cp-consultorio">
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">El campo no puede estar vacío. Solo permite letras y números, máximo 45
                    caracteres.</p>
            </div><!-- end form-grupo -->

            <!-- Grupo: -->
            <div class="formulario_grupo" id="grupo_telefono">
                <label class="form_label" for="telefono-consultorio">Teléfono</label>
                <div class="form_grupo-input">
                    <input class="form_input" type="text" id="telefono-consultorio" name="telefono-consultorio">
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">El campo no puede estar vacío. Solo permite letras y números, máximo 45
                    caracteres.
                <Nav></Nav>
                </p>
            </div><!-- end form-grupo -->

            <button class="input_submit boton amarillo span-2">Imprimir</button>

            <div>
                <input class="input_submit boton azul span-2" type="submit" value="Guardar" id="boton-guardar">
            </div>

        </form>
        <!-- end FORM -->

        <?php require ("./layout/footer.php"); ?>
        <script src="./js/validacion-consultorio.js"></script>
        <script src="./js/form-consultorio.js"></script>
    </div>
    <!-- end contenedor -->
</body>

</html>
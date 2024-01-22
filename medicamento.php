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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos-pacientes.css">
    <title>Medicamento</title>
</head>

<body>

    <div class="contenedor">
        <?php require("./layout/menu.php"); ?>
        <!-- 
        <div id="modalExito" class="modal">
            <div class="modal-contenido">
                <span class="cerrar-modal" id="cerrarModal">&times;</span>
                <h2>¡Medicamento creado!</h2>
                <br>
                <p>Los datos se han guardado con éxito.</p>
            </div>
        </div>
        -->

        <form class="content-general" action="./controller/nuevo-consultorio.php" method="POST">
            <label class="formulario_grupo span-4">Medicamento</label>

            <div class="formulario_grupo span-2">
                <label class="form_label" for="nombre-medicamento">Nombre de medicamento</label>
                <input class="form_input" type="text" id="nombre-medicamento" name="nombre-medicamento">
            </div><!-- end form-grupo -->

            <div class="formulario_grupo span-2">
                <label class="form_label" for="medicamento-tipo">Tipo</label>
                <input class="form_input" type="text" id="medicamento-tipo" name="medicamento-tipo">
            </div><!-- end form-grupo -->

            <div class="formulario_grupo span-4">
                <label class="form_label" for="medicamento-descripcion">Descripción</label>
                <input class="form_input" type="text" id="medicamento-descripcion" name="medicamento-descripcion">
            </div><!-- end form-grupo -->

            <button class="input_submit boton amarillo span-2">Cancelar</button>
            <input class="input_submit boton azul span-2" type="submit" value="Guardar">

        </form>
        <!-- end FORM -->

        <?php require("./layout/footer.php"); ?>
        <script src="./js/form-consultorio.js"></script>
    </div>
    <!-- end contenedor -->
</body>

</html>
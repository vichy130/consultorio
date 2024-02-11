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
if (isset($_REQUEST['id'])){
    $_SESSION['id_med']=$_REQUEST['id'];
    echo $_SESSION['id_med'];
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

        <form class="content-general" id="form-medicamento">
            <label class="formulario_grupo span-4">Medicamento</label>

            <div class="formulario_grupo span-2">
                <label class="form_label" for="nombre-medicamento">Nombre de medicamento</label>
                <input class="form_input" type="text" id="nombre-medicamento" name="nombre-medicamento">
            </div><!-- end form-grupo -->

            <div class="formulario_grupo span-2">
            <label class="form_label" for="tipo-medicamento">Tipo</label>
                <select class="form_input" name="tipo-medicamento" id="tipo-medicamento">
                    <option value="">Selecciona una opción</option>
                    <option value="Homeopática">Homeopática</option>
                    <option value="Alopática">Alopática</option>
                    <option value="Nutriente">Nutriente</option>
                </select>
            </div><!-- end form-grupo -->

            <div class="formulario_grupo span-4">
                <label class="form_label" for="medicamento-descripcion">Descripción</label>
                <textarea class="form_textarea" id="medicamento-descripcion"
                            name="medicamento-descripcion" rows="5" cols="50"></textarea>
            </div><!-- end form-grupo -->

            <button class="input_submit boton amarillo span-2">Cancelar</button>
            <input class="input_submit boton azul span-2" type="submit" value="Guardar">

        </form>
        <!-- end FORM -->

        <?php require("./layout/footer.php"); ?>
        <script src="./js/form-medicamento.js"></script>
    </div>
    <!-- end contenedor -->
</body>

</html>
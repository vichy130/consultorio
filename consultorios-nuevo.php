
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

        <div id="modalExito" class="modal">
                    <div class="modal-contenido">
                        <span class="cerrar-modal" id="cerrarModal">&times;</span>
                        <h2>¡consultorio creado!</h2>
                        <br>
                        <p>Los datos se han guardado con éxito.</p>
                    </div>
                </div>
        
                <form class="content-general" action="./controller/nuevo-consultorio.php" method="POST">
                    <label class="formulario_grupo span-4">Nuevo Consultorio</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="nombre-consultorio">Nombre de consultorio</label>
                        <input class="form_input" type="text" id="nombre-consultorio" name="nombre-consultorio">
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Domicilio</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="calle-consultorio">Calle</label>
                        <input class="form_input" type="text" id="calle-consultorio" name="calle-consultorio">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="colonia-consultorio">Colonia</label>
                        <input class="form_input" type="text" id="colonia-consultorio" name="colonia-consultorio">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="ciudad-consultorio">Ciudad</label>
                        <input class="form_input" type="text" id="ciudad-consultorio" name="ciudad-consultorio">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="cp-consultorio">Codigo postal</label>
                        <input class="form_input" type="text" id="cp-consultorio" name="cp-consultorio">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="telefono-consultorio">Teléfono</label>
                        <input class="form_input" type="text" id="telefono-consultorio" name="telefono-consultorio">
                    </div><!-- end form-grupo -->

                    <button class="input_submit boton amarillo span-2">Imprimir</button>
                    <input class="input_submit boton azul span-2" type="submit" value="Guardar">

                </form>
                <!-- end FORM -->

        <?php require("./layout/footer.php"); ?>
        <script src="./js/form-validacion-guardar.js"></script>
    </div>
    <!-- end contenedor -->
</body>

</html>
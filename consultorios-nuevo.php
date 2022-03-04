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
    <title>Nuevo Consultorio</title>
</head>

<body>
    <div class="contenedor">
        <?php require("./layout/menu.php"); ?>
        <div class="content">
            <?php require("./layout/content-informacion.php"); ?>
            <?php require("./layout/submenu-pacientes.php"); ?>
            <div class="contenido">
                <form class="form" action="" method="POST">

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
                        <input class="form_input" type="text" id="tipo-usuario" name="tipo-usuario-usuario">
                    </div><!-- end form-grupo -->

                    <button class="input_submit boton amarillo span-2">Imprimir</button>
                    <input class="input_submit boton azul span-2" type="submit" value="Guardar">

                </form>
                <!-- end FORM -->
            </div>
            <!-- end contenido -->
        </div>
        <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
</body>

</html>
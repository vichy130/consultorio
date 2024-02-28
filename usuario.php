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
    $_SESSION['id_usuario'] = $_REQUEST["id"];
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

        <form class="content-general formulario" id="form-usuario">

            <label class="formulario_grupo span-4">Usuario</label>
            <!-- Grupo: Username -->
            <div class="formulario_grupo" id="grupo_usuario">
                <label class="form_label" for="username-usuario">Nombre de usuario</label>
                <div class="form_grupo-input">
                    <input class="form_input" type="text" id="username-usuario" name="username-usuario"
                        placeholder="John123">
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener
                    números, letras y guion bajo.</p>
            </div><!-- end form-grupo -->

            <!-- Grupo: nombre -->
            <div class=" formulario_grupo" id="grupo_nombre">
                <label class="form_label" for="nombre-usuario">Nombre</label>
                <div class="form_grupo-input">
                    <input class="form_input" type="text" id="nombre-usuario" name="nombre-usuario" placeholder="John">
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">El nombre solo puede contener letras y no puede estar vacio.</p>
            </div><!-- end form-grupo -->

            <!-- Grupo: Apellido Paterno -->
            <div class="formulario_grupo" id="grupo_apellidoPaterno">
                <label class="form_label" for="apellidoPaterno-usuario">Apellido paterno</label>
                <div class="form_grupo-input">
                    <input class="form_input" type="text" id="apellidoPaterno-usuario" name="apellidoPaterno-usuario"
                        placeholder="Doe">
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">El apellido solo puede contener letras y no puede estar vacio.</p>
            </div><!-- end form-grupo -->

            <!-- Grupo: Apellido materno -->
            <div class="formulario_grupo" id="grupo_apellidoMaterno">
                <label class="form_label" for="apellidoMaterno-usuario">Apellido materno</label>
                <div class="form_grupo-input">
                    <input class="form_input" type="text" id="apellidoMaterno-usuario" name="apellidoMaterno-usuario">
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">El apellido solo puede contener letras.</p>
            </div><!-- end form-grupo -->

            <!-- Grupo: telefono -->
            <div class="formulario_grupo" id="grupo_telefono">
                <label class="form_label" for="telefono-usuario">Teléfono</label>
                <div class="form_grupo-input">
                    <input class="form_input" type="text" id="telefono-usuario" name="telefono-usuario" placeholder="33 3333 3333">
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">El telefono solo puede contener números y el maximo son 14 dígitos.</p>
            </div><!-- end form-grupo -->

            <!-- Grupo: correo -->
            <div class="formulario_grupo" id="grupo_correo">
                <label class="form_label" for="correo-usuario">Correo electrónico</label>
                <div class="form_grupo-input">
                    <input class="form_input" type="text" id="correo-usuario" name="correo-usuario"
                        placeholder="correo@correo.com">
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
            </div><!-- end form-grupo -->

            <!-- Grupo: tipo Usuario -->
            <div class="formulario_grupo" id="grupo_tipo">
                <label class="form_label" for="tipo-usuario">Tipo de usuario</label>
                <div class="form_grupo-input">
                    <select name="tipo-usuario" id="tipo-usuario" class="form_input">
                        <option value="">Selecciona una opción...</option>
                        <option value="A">Administrador</option>
                        <option value="M">Médico</option>
                        <option value="S">Asistente</option>
                    </select>
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">Selecciona un tipo de Usuario.</p>
            </div><!-- end form-grupo -->

            <!-- Grupo: contrasena -->
            <div class="formulario_grupo" id="grupo_contrasena">
                <label class="form_label" for="contrasena-usuario">Contraseña</label>
                <div class="form_grupo-input">
                    <input class="form_input" type="password" id="contrasena-usuario" name="contrasena-usuario">
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">La contraseña tiene que ser de 8 a 12 dígitos.</p>
            </div><!-- end form-grupo -->

            <!-- Grupo: contrasena 2 -->
            <div class="formulario_grupo" id="grupo_contrasena2">
                <label class="form_label" for="contrasena-usuario"> Repetir contraseña</label>
                <div class="form_grupo-input">
                    <input class="form_input" type="password" id="contrasena-usuario2" name="contrasena-usuario2">
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">Ambas contraseñas deben ser iguales.</p>
            </div><!-- end form-grupo -->

            <!-- Grupo: firma -->
            <div class="formulario_grupo" id="grupo_firma">
                <label class="form_label" for="firma-usuario">Firma Médico</label>
                <div class="form_grupo-input">
                    <input class="form_input" type="file" id="firma-usuario" name="firma-usuario"
                        >
                    <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                </div>
                <p class="form_input-error">El archivo debe ser tipo JPG, JPEJ o PNG.</p>
            </div><!-- end form-grupo -->

            <div class="form_mensaje span-4" id="form_mensaje">
                <p><i class="fa-solid fa-circle-exclamation"></i> Error: Porfavor rellena el formulario correctamente.</p>
            </div>

            <div class="formulario_grupo formulario_btn-enviar span-4">
            <input class="input_submit boton azul" type="submit" value="Guardar" id="boton-guardar-usuario">
            </div>
        </form>
        <!-- end FORM -->
        <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
    <script src="./js/form-usuario.js"></script>
    <script src="./js/validacion-usuario.js"></script>
</body>

</html>
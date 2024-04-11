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
} else if (isset($_REQUEST["id"])) {
    $_SESSION["id_paciente"] = $_REQUEST["id"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos-pacientes-informacion.css">
    <link rel="stylesheet" href="./css/estilos-pacientes.css">
    <title>Información básica</title>
</head>

<body>
    <div class="<?php if (isset($_SESSION["id_paciente"])) {
        echo "contenedor";
    } else {
        echo "contenedor-no";
    } ?>">
        <?php require ("./layout/menu.php"); ?>
        <div class="content">
            <?php require ("./layout/content-informacion.php"); ?>
            <?php require ("./layout/submenu-pacientes.php"); ?>
            <div class="contenido">

                <div id="modal" class="modal">
                    <div id="modal-contenido" class="modal-contenido">
                        <span class="cerrar-modal" id="cerrarModal">&times;</span>
                    </div>
                </div>

                <form class="form" id="form-paciente">

                    <label class="formulario_grupo span-4">Informacion basica</label>

                    <!-- Grupo: nombre paciente -->
                    <div class="formulario_grupo span-2" id="grupo_nombre">
                        <label class="form_label" for="nombre-paciente">Nombre(s)</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="nombre-paciente" name="nombre-paciente"
                                placeholder="María">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: apellidop Paciente -->
                    <div class="formulario_grupo grupo_apellidop" id="grupo_apellidop">
                        <label class="form_label" for="apellidop-paciente">Apellido paterno</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="apellidop-paciente" name="apellidop-paciente"
                                placeholder="Pino">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: apellidom Paciente -->
                    <div class="formulario_grupo grupo_apellidom" id="grupo_apellidom">
                        <label class="form_label" for="apellidom-paciente">Apellido materno</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="apellidom-paciente" name="apellidom-paciente"
                                placeholder="Suárez">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: Sexo paciente -->
                    <div class="formulario_grupo radio span-4" id="grupo_sexo">
                        <div class="form_grupo-input">
                            <label for="sexo-paciente"><i class=" fas fa-male"></i> Hombre</label>
                            <input type="radio" id="masculino" name="sexo" value="masculino">
                            <label for="sexo-paciente"><i class=" fas fa-female"></i> Mujer</label>
                            <input type="radio" id="femenino" name="sexo" value="femenino">
                            <label for="sexo-paciente">Otro</label>
                            <input type="radio" id="otro" name="sexo" value="otro" checked>

                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">Selecciona el sexo</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: nacimiento paciente -->
                    <div class="formulario_grupo" id="grupo_nacimiento">
                        <label class="form_label" for="nacimiento-paciente"><i
                                class="izquierda fas fa-birthday-cake"></i>Fecha de nacimiento</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="date" id="nacimiento-paciente" name="nacimiento-paciente"
                                value="">
                            <i class="form_validacion-estado select fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: lugar paciente -->
                    <div class="formulario_grupo" id="grupo_lugar">
                        <label class="form_label" for="lugar-paciente">Lugar de nacimiento</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="lugar-paciente" name="lugar-paciente"
                                placeholder="Guadalajara">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío. Solo debe contener letras</p>
                    </div><!-- end form-grupo -->

                    <label class=" formulario_grupo span-4">Domicilio</label>

                    <!-- Grupo: calle paciente -->
                    <div class="formulario_grupo span-2" id="grupo_calle">
                        <label class="form_label" for="calle-paciente">Calle y número</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="calle-paciente" name="calle-paciente" value="">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío. Solo debe contener letras y números
                        </p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: colonia paciente -->
                    <div class="formulario_grupo grupo_colonia" id="grupo_colonia">
                        <label class="form_label" for="colonia-paciente">Colonia</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="colonia-paciente" name="colonia-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío. Solo debe contener letras</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: ciudad paciente -->
                    <div class="formulario_grupo grupo_ciudad" id="grupo_ciudad">
                        <label class="form_label" for="ciudad-paciente">ciudad</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="ciudad-paciente" name="ciudad-paciente" value="">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío. Solo debe contener letras</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: cp paciente -->
                    <div class="formulario_grupo grupo_cp" id="grupo_cp">
                        <label class="form_label" for="cp-paciente">Codigo postal</label>
                        <div class="form_grupo-input">
                            <input class="form_input form_input_small" type="text" id="cp-paciente" name="cp-paciente"
                                placeholder="55555">
                            <i class="form_validacion-estado spanone fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío. Debe contener 5 dígitos</p>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Telefono de contacto</label>

                    <!-- Grupo: telefono casa paciente -->
                    <div class="formulario_grupo" id="grupo_casa">
                        <label class="form_label" for="telefono-casa-paciente"><i
                                class="izquierda fas fa-phone-volume"></i>Telefono de casa</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="telefono-casa-paciente"
                                name="telefono-casa-paciente" placeholder="33 33333333">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo solo debe contener números</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: telefono-oficina-paciente -->
                    <div class="formulario_grupo" id="grupo_oficina">
                        <label class="form_label" for="telefono-oficina-paciente"><i
                                class="izquierda fas fa-phone-alt"></i>Oficina</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="telefono-oficina-paciente"
                                name="telefono-oficina-paciente" placeholder="33 33333333">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo solo debe contener números</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: telefono cel paciente -->
                    <div class="formulario_grupo" id="grupo_celular">
                        <label class="form_label" for="telefono-cel-paciente"><i
                                class="izquierda fas fa-mobile-alt"></i>Celular</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="telefono-cel-paciente"
                                name="telefono-cel-paciente" placeholder="33 33333333">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo solo debe contener números</p>
                    </div><!-- end form-grupo -->

                    <div class=""></div>

                    <!-- Grupo: civil paciente -->
                    <div class="formulario_grupo" id="grupo_estadoCivil">
                        <label class="form_label" for="civil-paciente">Estado civil</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="civil-paciente" name="civil-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío. Solo debe contener letras</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: ocupacion paciente -->
                    <div class="formulario_grupo" id="grupo_ocupacion">
                        <label class="form_label" for="ocupacion-paciente">Ocupación</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="ocupacion-paciente" name="ocupacion-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío. Solo debe contener letras</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: escolaridad-paciente -->
                    <div class="formulario_grupo" id="grupo_escolaridad">
                        <label class="form_label" for="escolaridad-paciente"><i
                                class="izquierda fas fa-graduation-cap"></i>Escolaridad</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="escolaridad-paciente" name="escolaridad-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío. Solo debe contener letras</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: correo-->
                    <div class="formulario_grupo" id="grupo_email">
                        <label class="form_label" for="email-paciente"><i class="izquierda fas fa-at"></i>Email</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="email" id="email-paciente" name="email-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío. Escribe un correo válido</p>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <button class="input_submit boton amarillo" type="button" id="boton-imprimir-paciente">Imprimir
                            Paciente</button>
                    </div>

                    <div class="formulario_grupo formulario_btn-enviar">
                        <input class="input_submit boton azul" type="submit" value="Guardar Paciente">
                    </div>
                </form>
                <!-- end form -->
            </div>

        </div>
        <?php require ("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
    <script src="./js/validacion-informacion.js"></script>
    <script src="./js/form-informacion.js"></script>
</body>

</html>
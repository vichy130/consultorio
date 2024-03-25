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
} else {
    redirect("./pacientes-informacion.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos-pacientes.css">
    <link rel="stylesheet" href="./css/estilos-pacientes-ficha.css">
    <link rel="stylesheet" href="./css/estilos-pacientes-informacion.css">
    <link rel="stylesheet" href="./css/mediaqueries.css">
    <title>Ficha clinica</title>
</head>

<body>
    <div class="<?php if (isset($_SESSION["id_paciente"])) {
        echo "contenedor";
    } else {
        echo "contenedor-no";
    } ?>">
        <?php require("./layout/menu.php"); ?>
        <div class="content">
            <?php require("./layout/content-informacion.php"); ?>
            <?php require("./layout/submenu-pacientes.php"); ?>
            <div class="contenido">
                <!-- FORM POST PHP -->
                <!-- Modal de confirmación (oculto por defecto) -->
                <div id="modalConfirmacion" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="cerrarModal()">&times;</span>
                        <p id="mensajeModal">Mensaje de confirmación aquí.</p>
                    </div>
                </div>

                <form class="form" id="form-ficha">

                    <!-- Grupo: Fecha -->
                    <div class="formulario_grupo" id="grupo_fecha">
                        <label class="form_label" for="fecha-ficha"><i class="izquierda fa fa-calendar"
                                aria-hidden="true"></i>Fecha</label>
                        <input class="form_input " type="date" id="fecha-ficha" name="fecha-ficha" disabled>
                        <input type="hidden" name="oculto-fecha-ficha" id="oculto-fecha-ficha">
                    </div><!-- end form-grupo -->

                    <!-- Grupo: recomendo paciente -->
                    <div class="formulario_grupo span-2" id="grupo_recomendo">
                        <label class="form_label" for="recomendo-paciente">¿Quién le recomendo?</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="recomendo-paciente" name="recomendo-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: tipo sangre -->
                    <div class="formulario_grupo" id="grupo_tipo">
                        <label class="form_label" for="tipo-sangre"><i class="izquierda fas fa-tint"></i>Tipo de
                            sangre</label>
                        <div class="form_grupo-input">
                            <select class="form_input" name="tipo-sangre" id="tipo-sangre">
                                <option value="">Selecciona una opción</option>
                                <option value="A+">A+</option>
                                <option value="B+">B+</option>
                                <option value="O+">O+</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="A-">A-</option>
                                <option value="B-">B-</option>
                                <option value="O-">O-</option>
                            </select>
                            <i class="form_validacion-estado select fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Hijos</label>

                    <!-- Grupo: hijo edad paciente -->
                    <div class="formulario_grupo" id="grupo_hijoedad">
                        <label class="form_label" for="hijoedad-paciente">Edad</label>
                        <div class="form_grupo-input">
                            <input class="form_input form_input_small" type="text" id="hijoedad-paciente"
                                name="hijoedad-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: sexo -->
                    <div class="formulario_grupo radio span-4" id="grupo_hijosexo">
                        <label for="sexo-hijo"><i class="izquierda fas fa-male"></i>Hombre</label>
                        <input type="radio" id="hombre" name="sexo-hijo" value="Hombre">
                        <label for="sexo-hijo"><i class="izquierda fas fa-female"></i>Mujer</label>
                        <input type="radio" id="mujer" name="sexo-hijo" value="Mujer">
                        <label for="sexo-hijo">Otro</label>
                        <input type="radio" id="otro" name="sexo-hijo" checked="checked" value="Otro">
                        <p class="form_input-error"></p>
                    </div><!-- end form-grupo -->

                    <button class="boton azul" id="agregarHijo" type="button"><i class="fas fa-plus"></i> Añadir
                        Hijo</button>

                        <table class="table span-4 tabla-hijos" id="tabla-hijos">
                           <!-- <thead>
                                <tr>
                                    <th class="column-to-hide"></th>
                                    <th>Sexo</th>
                                    <th>Edad</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-hijos">
                            </tbody> -->
                        </table>
                    <label class="formulario_grupo span-4">Antecedentes gineco-obstétricos</label>

                    <!-- Grupo: Embarazos -->
                    <div class="formulario_grupo" id="grupo_embarazos">
                        <label class="form_label" for="embarazos-paciente">Embarazos</label>
                        <div class="form_grupo-input">
                            <input class="form_input form_input_small" type="text" id="embarazos-paciente"
                                name="embarazos-paciente">
                            <i class="form_validacion-estado spanone fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">Solo se permiten números</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: Partos-->
                    <div class=" formulario_grupo" id="grupo_partos">
                        <label class="form_label" for="partos-paciente">Partos</label>

                        <div class="form_grupo-input">
                            <input class="form_input form_input_small" type="text" id="partos-paciente"
                                name="partos-paciente">
                            <i class="form_validacion-estado spanone fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">Solo se permiten números</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: Cesareas -->
                    <div class="formulario_grupo" id="grupo_cesareas">
                        <label class="form_label" for="cesareas-paciente">Cesáreas</label>
                        <div class="form_grupo-input">
                            <input class="form_input form_input_small" type="text" id="cesareas-paciente"
                                name="cesareas-paciente">
                            <i class="form_validacion-estado spanone fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">Solo se permiten números</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: Abortos -->
                    <div class="formulario_grupo" id="grupo_abortos">
                        <label class="form_label" for="abortos-paciente">Abortos</label>
                        <div class="form_grupo-input">
                            <input class="form_input form_input_small" type="text" id="abortos-paciente"
                                name="abortos-paciente">
                            <i class="form_validacion-estado spanone fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">Solo se permiten números</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: Muertos -->
                    <div class="formulario_grupo" id="grupo_muertos">
                        <label class="form_label" for="muertos-paciente">Muertos</label>

                        <div class="form_grupo-input">
                            <input class="form_input form_input_small" type="text" id="muertos-paciente"
                                name="muertos-paciente">
                            <i class="form_validacion-estado spanone fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">Solo se permiten números</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: ENFS -->
                    <div class="formulario_grupo" id="grupo_enfs">
                        <label class="form_label" for="enfs-paciente">ENFS</label>
                        <div class="form_grupo-input">
                            <input class="form_input form_input_small" type="text" id="enfs-paciente"
                                name="enfs-paciente">
                            <i class="form_validacion-estado spanone fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">Solo se permiten números</p>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Ginecología</label>

                    <!-- Grupo: Menstruacion -->
                    <div class="formulario_grupo" id="grupo_menstruacion">
                        <label class="form_label" for="menstruacion-paciente">Fecha última menstruación</label>
                        <div class="form_grupo-input">
                            <input class="form_input " type="date" id="menstruacion-paciente"
                                name="menstruacion-paciente">
                            <i class="form_validacion-estado select fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: Periodicidad -->
                    <div class="formulario_grupo" id="grupo_menstruacionperiodicidad">
                        <label class="form_label" for="menstruacionperiodicidad-paciente"><i
                                class="icono izquierda fas fa-calendar"></i>Periodicidad</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="menstruacionperiodicidad-paciente"
                                name="menstruacionperiodicidad-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: Menstruacion molestias -->
                    <div class="formulario_grupo span-2" id="grupo_menstruacionmolestias">
                        <label class="form_label" for="menstruacionmolestias-paciente">Molestias</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" id="menstruacionmolestias-paciente"
                                name="menstruacionmolestias-paciente" rows="4" cols="50"></textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Antecedentes no patologicos</label>

                    <!-- Grupo: Fuma -->
                    <div class="formulario_grupo" id="grupo_fuma">
                        <label class="form_label" for="fuma-paciente">Fuma</label>
                        <div class="form_grupo-input">
                            <select class="form_input" name="fuma-paciente" id="fuma-paciente">
                                <option value="1">Si</option>
                                <option value="0" selected="selected">No</option>
                                <option value="2">A veces</option>
                            </select>
                            <i class="form_validacion-estado select fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: Cigarros -->
                    <div class="formulario_grupo" id="grupo_cigarros">
                        <label class="form_label" for="cigarros-paciente"><i
                                class="icono izquierda fas fa-smoking"></i>Cigarros al día</label>
                        <div class="form_grupo-input">
                            <input class="form_input form_input_small" type="number" id="cigarros-paciente"
                                name="cigarros-paciente">
                            <i class="form_validacion-estado spanone fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: cigarros antiguedad -->
                    <div class="formulario_grupo" id="grupo_cigarrosantiguedad">
                        <label class="form_label" for="cigarros-antiguedad-paciente">Antiguedad</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="cigarros-antiguedad-paciente"
                                name="cigarros-antiguedad-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <div class=""></div>

                    <!-- Grupo: alcohol paciente -->
                    <div class="formulario_grupo" id="grupo_alcohol">
                        <label class="form_label" for="alcohol-paciente">Alcohol</label>
                        <div class="form_grupo-input">
                            <select class="form_input" name="alcohol-paciente" id="alcohol-paciente">
                                <option value="1">Si</option>
                                <option value="0" selected="selected">No</option>
                                <option value="1">A veces</option>
                            </select>
                            <i class="form_validacion-estado select fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: Frecuencia paciente -->
                    <div class="formulario_grupo" id="grupo_frecuencia">
                        <label class="form_label" for="frecuencia-paciente">Frecuencia</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="frecuencia-paciente" name="frecuencia-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: cantidad paciente -->
                    <div class="formulario_grupo" id="grupo_cantidad">
                        <label class="form_label" for="cantidad-paciente">Cantidad</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="cantidad-paciente" name="cantidad-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: Tipos paciente -->
                    <div class="formulario_grupo" id="grupo_tipos">
                        <label class="form_label" for="tipos-paciente">Tipos</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="tipos-paciente" name="tipos-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: adicciones paciente -->
                    <div class="formulario_grupo span-2" id="grupo_adicciones">
                        <label class="form_label" for="adicciones-paciente">Addiciones</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" id="adicciones-paciente" name="adicciones-paciente" rows="4"
                                cols="50"></textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: alergias paciente -->
                    <div class="formulario_grupo span-2" id="grupo_alergias">
                        <label class="form_label" for="alergias-paciente">Alergias</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" id="alergias-paciente" name="alergias-paciente" rows="4"
                                cols="50"></textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Alimentación</label>

                    <!-- Grupo: desayuno paciente -->
                    <div class="formulario_grupo span-2" id="grupo_desayuno">
                        <label class="form_label" for="desayuno-paciente">Desayuno</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" id="desayuno-paciente" name="desayuno-paciente" rows="4"
                                cols="50"></textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: comida paciente -->
                    <div class="formulario_grupo span-2" id="grupo_comida">
                        <label class="form_label" for="comida-paciente">Comida</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" id="comida-paciente" name="comida-paciente" rows="4"
                                cols="50"></textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: cena paciente -->
                    <div class="formulario_grupo span-2" id="grupo_cena">
                        <label class="form_label" for="cena-paciente">Cena</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" id="cena-paciente" name="cena-paciente" rows="4"
                                cols="50"></textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: entre comidas paciente -->
                    <div class="formulario_grupo span-2" id="grupo_entrecomidas">
                        <label class="form_label" for="entrecomidas-paciente">Entre comidas</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" id="entrecomidas-paciente" name="entrecomidas-paciente"
                                rows="4" cols="50"></textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: agua paciente -->
                    <div class="formulario_grupo" id="grupo_agua">
                        <label class="form_label" for="agua-paciente">Vasos de agua al día</label>
                        <div class="form_grupo-input">
                            <input class="form_input form_input_small" type="number" id="agua-paciente"
                                name="agua-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: otros liquidos paciente -->
                    <div class="formulario_grupo" id="grupo_otrosliquidos">
                        <label class="form_label" for="otrosliquidos-paciente">Otros liquidos</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="otrosliquidos-paciente"
                                name="otrosliquidos-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: intolerancias paciente -->
                    <div class="formulario_grupo span-2" id="grupo_intolerancias">
                        <label class="form_label" for="intolerancias-paciente">Intolerancias</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="intolerancias-paciente"
                                name="intolerancias-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Urología</label>

                    <!-- Grupo: orina dia paciente -->
                    <div class="formulario_grupo" id="grupo_orinadia">
                        <label class="form_label" for="orinadia-paciente">Orina: día</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="orinadia-paciente" name="orinadia-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: orina noche paciente -->
                    <div class="formulario_grupo" id="grupo_orinanoche">
                        <label class="form_label" for="orinanoche-paciente">Orina: noche</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="orinanoche-paciente" name="orinanoche-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: orina color paciente -->
                    <div class="formulario_grupo" id="grupo_orinacolor">
                        <label class="form_label" for="orinacolor-paciente">Orina: color</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="orinacolor-paciente" name="orinacolor-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: orina olor paciente -->
                    <div class="formulario_grupo" id="grupo_orinaolor">
                        <label class="form_label" for="orinaolor-paciente">Orina: olor</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="orinaolor-paciente" name="orinaolor-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo:orina molestias paciente -->
                    <div class="formulario_grupo span-2" id="grupo_orinamolestias">
                        <label class="form_label" for="orinamolestias-paciente">Molestias</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" id="orinamolestias-paciente" name="orinamolestias-paciente"
                                rows="4" cols="50"></textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Gastroenterólogia</label>

                    <!-- Grupo: excremento dia paciente -->
                    <div class="formulario_grupo" id="grupo_excrementoaldia">
                        <label class="form_label" for="excrementoaldia-paciente">Excremento al día</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="excrementoaldia-paciente"
                                name="excrementoaldia-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: excremento consistencia paciente -->
                    <div class="formulario_grupo" id="grupo_excrementoconsistencia">
                        <label class="form_label" for="excrementoconsistencia-paciente">Consistencia</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="excrementoconsistencia-paciente"
                                name="excrementoconsistencia-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: excremento olor paciente -->
                    <div class="formulario_grupo" id="grupo_excrementoolor">
                        <label class="form_label" for="excrementoolor-paciente">Olor</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="excrementoolor-paciente"
                                name="excrementoolor-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: excremento color paciente -->
                    <div class="formulario_grupo" id="grupo_excrementocolor">
                        <label class="form_label" for="excrementocolor-paciente">Color</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="excrementocolor-paciente"
                                name="excrementocolor-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: excremento dolor paciente -->
                    <div class="formulario_grupo" id="grupo_excrementodolor">
                        <label class="form_label" for="excrementodolor-paciente">Dolor</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="excrementodolor-paciente"
                                name="excrementodolor-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Ejercicio</label>

                    <!-- Grupo: ejercicio paciente -->
                    <div class="formulario_grupo  span-2" id="grupo_ejercicio">
                        <label class="form_label" for="ejercicio-paciente">Ejercicio por semana</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="ejercicio-paciente" name="ejercicio-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Antecedentes familiares</label>

                    <!-- Grupo: parentesco paciente -->
                    <div class="formulario_grupo" id="grupo_parentesco-paciente">
                        <label class="form_label" for="parentesco-paciente">Parentesco</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="parentesco-paciente" name="parentesco-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: familiar enfermedad paciente -->
                    <div class="formulario_grupo span-2" id="grupo_familiarenfermedad-paciente">
                        <label class="form_label" for="familiarenfermedad-paciente">Enfermedad</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="familiarenfermedad-paciente"
                                name="familiarenfermedad-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: familiar enfermedad descripcion paciente -->
                    <div class="formulario_grupo span-4" id="grupo_familiarenfermedad-descripcion-paciente">
                        <label class="form_label" for="familiarenfermedad-descripcion-paciente">Descripción</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="familiarenfermedad-descripcion-paciente"
                                name="familiarenfermedad-descripcion-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <button class="boton azul" type="button" id="agregarAntecedenteFam"><i
                            class="fas fa-plus"></i>Añadir</button>

                    <table class="table span-4 tabla-antecedentes-familiares" id="tabla-antecedentes-familiares">
                        <!--
                        <thead>
                            <tr>
                                <th class="column-to-hide"></th>
                                <th>Parentesco</th>
                                <th>Enfermedad</th>
                                <th>Descripción</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id=tbody-antecedentes-familiares>

                        </tbody> -->
                    </table>

                    <label class="formulario_grupo span-4">Antecedentes del paciente</label>

                    <!-- Grupo: enfermedad paciente -->
                    <div class="formulario_grupo span-2" id="grupo_enfermedad-paciente">
                        <label class="form_label" for="enfermedad-paciente">Enfermedad</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="enfermedad-paciente" name="enfermedad-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: esta activa paciente -->
                    <div class="formulario_grupo span-2" id="grupo_enfermedad-activa">
                        <label class="form_label" for="enfermedad-activa">Está Activa</label>
                        <div class="form_grupo-input">
                            <select class="form_input" name="enfermedad-activa" id="enfermedad-activa">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                                <option value="2" selected="selected">No lo sé</option>
                            </select>
                            <i class="form_validacion-estado select fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- Grupo: enfermedad descripcion paciente -->
                    <div class="formulario_grupo span-4" id="grupo_enfermedad-descripcion-paciente">
                        <label class="form_label" for="enfermedad-descripcion-paciente">Descripción</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="enfermedad-descripcion-paciente"
                                name="enfermedad-descripcion-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <button class="boton azul" type="button" id="agregarAntecedente"><i class="fas fa-plus"></i>
                        Añadir</button>

                    <table class="table span-4 tabla-antecedentes" id="tabla-antecedentes">
                       <!-- <thead>
                            <tr>
                                <th class="column-to-hide"></th>
                                <th>Enfermedad</th>
                                <th>Descripción</th>
                                <th>Está activa</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-antecedentes">

                        </tbody> -->
                    </table>

                    <!-- Grupo: firma  paciente -->
                    <div class="formulario_grupo" id="grupo_firma-paciente">
                        <label class="form_label" for="firma-paciente">Firma Paciente</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="file" id="firma-paciente" name="firma-paciente"
                                accept=".jpg, .jpeg, .png">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-4">
                        <label class="form_label" id="usuario-actualizacion"></label>
                    </div><!-- end form-grupo -->

                    <div class=""></div>
                    <div class=""></div>
                    <button class="input_submit boton amarillo span-2">Imprimir</button>
                    <input class="input_submit boton azul span-2" type="submit" value="<?php if (isset($_SESSION["id_paciente"])) {
                        echo "Actualizar Ficha";
                    } else {
                        echo "Guardar";
                    } ?>">
                </form>
            </div>
        </div>
        <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
    <script src="./js/validacion-ficha.js"></script>
    <script src="./js/form-ficha.js"></script>
</body>

</html>
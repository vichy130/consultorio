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
                <!-- FORM POST PHP 
                <form class="form" action="controller/ficha-test.php" method="POST">-->
                <!-- Modal de confirmación (oculto por defecto) -->
                <div id="modalConfirmacion" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="cerrarModal()">&times;</span>
                        <p id="mensajeModal">Mensaje de confirmación aquí.</p>
                    </div>
                </div>

                <form class="form" id="form-ficha">
                    <div class="formulario_grupo">
                        <label class="form_label" for="fecha-ficha"><i class="izquierda fa fa-calendar" aria-hidden="true"></i>Fecha</label>
                        <input class="form_input " type="date" id="fecha-ficha" name="fecha-ficha" disabled>
                        <input type="hidden" name="oculto-fecha-ficha" id="oculto-fecha-ficha">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="recomendo-paciente">¿Quién le recomendo?</label>
                        <input class="form_input" type="text" id="recomendo-paciente" name="recomendo-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="tipo-sangre"><i class="izquierda fas fa-tint"></i>Tipo de
                            sangre</label>
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
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Hijos</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="hijoedad-paciente">Edad</label>
                        <input class="form_input form_input_small" type="text" id="hijoedad-paciente"
                            name="hijoedad-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo radio span-2">
                        <label for="sexo-hijo"><i class="izquierda fas fa-male"></i>Hombre</label>
                        <input type="radio" id="hombre" name="sexo-hijo" value="Hombre">
                        <label for="sexo-hijo"><i class="izquierda fas fa-female"></i>Mujer</label>
                        <input type="radio" id="mujer" name="sexo-hijo" value="Mujer">
                        <label for="sexo-hijo">Otro</label>
                        <input type="radio" id="otro" name="sexo-hijo" checked="checked" value="Otro">
                    </div><!-- end form-grupo -->

                    <button class="boton azul" id="agregarHijo" type="button"><i class="fas fa-plus"></i> Añadir
                        Hijo</button>

                    <table class="table span-4" id="tabla-hijos">
                        <thead>
                            <tr>
                                <th class="column-to-hide"></th>
                                <th>Sexo</th>
                                <th>Edad</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-hijos">
                        </tbody>
                    </table>

                    <label class="formulario_grupo span-4">Antecedentes gineco-obstétricos</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="embarazos-paciente">Embarazos</label>
                        <input class="form_input form_input_small" type="number" id="embarazos-paciente"
                            name="embarazos-paciente">
                    </div><!-- end form-grupo -->

                    <div class=" formulario_grupo">
                        <label class="form_label" for="partos-paciente">Partos</label>
                        <input class="form_input form_input_small" type="number" id="partos-paciente"
                            name="partos-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="cesareas-paciente">Cesáreas</label>
                        <input class="form_input form_input_small" type="number" id="cesareas-paciente"
                            name="cesareas-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="abortos-paciente">Abortos</label>
                        <input class="form_input form_input_small" type="number" id="abortos-paciente"
                            name="abortos-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="muertos-paciente">Muertos</label>
                        <input class="form_input form_input_small" type="number" id="muertos-paciente"
                            name="muertos-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="enfs-paciente">ENFS</label>
                        <input class="form_input form_input_small" type="number" id="enfs-paciente"
                            name="enfs-paciente">
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Ginecología</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="menstruacion-paciente">Fecha última menstruación</label>
                        <input class="form_input " type="date" id="menstruacion-paciente" name="menstruacion-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="menstruacionperiodicidad-paciente"><i
                                class="icono izquierda fas fa-calendar"></i>Periodicidad</label>
                        <input class="form_input" type="text" id="menstruacionperiodicidad-paciente"
                            name="menstruacionperiodicidad-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="menstruacionmolestias-paciente">Molestias</label>
                        <textarea class="form_textarea" id="menstruacionmolestias-paciente"
                            name="menstruacionmolestias-paciente" rows="4" cols="50"></textarea>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Antecedentes no patologicos</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="fuma-paciente">Fuma</label>
                        <select class="form_input" name="fuma-paciente" id="fuma-paciente">
                            <option value="1">Si</option>
                            <option value="0" selected="selected">No</option>
                            <option value="2">A veces</option>
                        </select>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="cigarros-paciente"><i
                                class="icono izquierda fas fa-smoking"></i>Cigarros al día</label>
                        <input class="form_input form_input_small" type="number" id="cigarros-paciente"
                            name="cigarros-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="cigarros-antiguedad-paciente">Antiguedad</label>
                        <input class="form_input" type="text" id="cigarros-antiguedad-paciente"
                            name="cigarros-antiguedad-paciente">
                    </div><!-- end form-grupo -->

                    <div class=""></div>

                    <div class="formulario_grupo">
                        <label class="form_label" for="alcohol-paciente">Alcohol</label>
                        <select class="form_input" name="alcohol-paciente" id="alcohol-paciente">
                            <option value="1">Si</option>
                            <option value="0" selected="selected">No</option>
                            <option value="1">A veces</option>
                        </select>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="frecuencia-paciente">Frecuencia</label>
                        <input class="form_input" type="text" id="frecuencia-paciente" name="frecuencia-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="cantidad-paciente">Cantidad</label>
                        <input class="form_input" type="text" id="cantidad-paciente" name="cantidad-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="tipos-paciente">Tipos</label>
                        <input class="form_input" type="text" id="tipos-paciente" name="tipos-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="addiciones-paciente">Addiciones</label>
                        <input class="form_input" type="text" id="adicciones-paciente" name="adicciones-paciente">
                    </div><!-- end form-grupo -->

                    <div class="span-2"></div>

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="alergias-paciente">Alergias</label>
                        <textarea class="form_textarea" id="alergias-paciente" name="alergias-paciente" rows="4"
                            cols="50"></textarea>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Alimentación</label>

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="desayuno-paciente">Desayuno</label>
                        <textarea class="form_textarea" id="desayuno-paciente" name="desayuno-paciente" rows="4"
                            cols="50"></textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="comida-paciente">Comida</label>
                        <textarea class="form_textarea" id="comida-paciente" name="comida-paciente" rows="4"
                            cols="50"></textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="cena-paciente">Cena</label>
                        <textarea class="form_textarea" id="cena-paciente" name="cena-paciente" rows="4"
                            cols="50"></textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="entrecomidas-paciente">Entre comidas</label>
                        <textarea class="form_textarea" id="entrecomidas-paciente" name="entrecomidas-paciente" rows="4"
                            cols="50"></textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="agua-paciente">Vasos de agua al día</label>
                        <input class="form_input form_input_small" type="number" id="agua-paciente"
                            name="agua-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="otrosliquidos-paciente">Otros liquidos</label>
                        <input class="form_input" type="text" id="otrosliquidos-paciente" name="otrosliquidos-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="intolerancias-paciente">Intolerancias</label>
                        <input class="form_input" type="text" id="intolerancias-paciente" name="intolerancias-paciente">
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Urología</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="orinadia-paciente">Orina: día</label>
                        <input class="form_input" type="text" id="orinadia-paciente" name="orinadia-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="orinanoche-paciente">Orina: noche</label>
                        <input class="form_input" type="text" id="orinanoche-paciente" name="orinanoche-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="orinacolor-paciente">Orina: color</label>
                        <input class="form_input" type="text" id="orinacolor-paciente" name="orinacolor-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="orinaolor-paciente">Orina: olor</label>
                        <input class="form_input" type="text" id="orinaolor-paciente" name="orinaolor-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="orinamolestias-paciente">Molestias</label>
                        <textarea class="form_textarea" id="orinamolestias-paciente" name="orinamolestias-paciente"
                            rows="4" cols="50"></textarea>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Gastroenterólogia</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="excrementoaldia-paciente">Excremento al día</label>
                        <input class="form_input" type="text" id="excrementoaldia-paciente"
                            name="excrementoaldia-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="excrementoconsistencia-paciente">Consistencia</label>
                        <input class="form_input" type="text" id="excrementoconsistencia-paciente"
                            name="excrementoconsistencia-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="excrementoolor-paciente">Olor</label>
                        <input class="form_input" type="text" id="excrementoolor-paciente"
                            name="excrementoolor-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="excrementocolor-paciente">Color</label>
                        <input class="form_input" type="text" id="excrementocolor-paciente"
                            name="excrementocolor-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="excrementodolor-paciente">Dolor</label>
                        <input class="form_input" type="text" id="excrementodolor-paciente"
                            name="excrementodolor-paciente">
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Ejercicio</label>

                    <div class="formulario_grupo  span-2">
                        <label class="form_label" for="ejercicio-paciente">Ejercicio por semana</label>
                        <input class="form_input" type="text" id="ejercicio-paciente" name="ejercicio-paciente">
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Antecedentes familiares</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="parentesco-paciente">Parentesco</label>
                        <input class="form_input" type="text" id="parentesco-paciente" name="parentesco-paciente"
                            value="<?php /*echo $oF==null? "": $oF->exDolor; */?>">
                    </div><!-- end form-grupo -->
                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="familiarenfermedad-paciente">Enfermedad</label>
                        <input class="form_input" type="text" id="familiarenfermedad-paciente"
                            name="familiarenfermedad-paciente">
                    </div><!-- end form-grupo -->
                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="familiarenfermedad-descripcion-paciente">Descripción</label>
                        <input class="form_input" type="text" id="familiarenfermedad-descripcion-paciente"
                            name="familiarenfermedad-descripcion-paciente">
                    </div><!-- end form-grupo -->

                    <button class="boton azul" type="button" id="agregarAntecedenteFam"><i
                            class="fas fa-plus"></i>Añadir</button>

                    <table class="table span-4">
                        <thead>
                            <tr>
                                <th class="column-to-hide"></th>
                                <th>Parentesco</th>
                                <th>Enfermedad</th>
                                <th>Descripción</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id=tabla-antecedentesFam>

                        </tbody>
                    </table>

                    <label class="formulario_grupo span-4">Antecedentes del paciente</label>

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="enfermedad-paciente">Enfermedad</label>
                        <input class="form_input" type="text" id="enfermedad-paciente" name="enfermedad-paciente">
                    </div><!-- end form-grupo -->
                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="enfermedad-descripcion-paciente">Descripción</label>
                        <input class="form_input" type="text" id="enfermedad-descripcion-paciente"
                            name="enfermedad-descripcion-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="enfermedad-activa">Está Activa</label>
                        <select class="form_input" name="enfermedad-activa" id="enfermedad-activa">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                            <option value="2" selected="selected">No lo sé</option>
                        </select>
                    </div><!-- end form-grupo -->
                    <button class="boton azul" type="button" id="agregarAntecedente"><i class="fas fa-plus"></i>
                        Añadir</button>

                    <table class="table span-4">
                        <thead>
                            <tr>
                                <th class="column-to-hide"></th>
                                <th>Enfermedad</th>
                                <th>Descripción</th>
                                <th>Está activa</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-antecedentes">

                        </tbody>
                    </table>

                    <div class="formulario_grupo">
                        <label class="form_label" for="firma-paciente">Firma Paciente</label>
                        <input class="form_input" type="file" id="firma-paciente" name="firma-paciente"
                            accept=".jpg, .jpeg, .png">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="firma-usuario">Firma Médico</label>
                        <input class="form_input" type="file" id="firma-usuario" name="firma-usuario"
                            accept=".jpg, .jpeg, .png">
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
    <script src="./js/form-ficha-clinica.js"></script>
</body>

</html>
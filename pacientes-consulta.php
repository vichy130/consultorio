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
    $_SESSION["id_consulta"] = $_REQUEST["id"];
    echo $_SESSION["id_consulta"];
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
    <title>Nueva consulta</title>
</head>

<body>
    <div class="contenedor">
        <?php require("./layout/menu.php"); ?>
        <div class="content">
            <?php require("./layout/content-informacion.php"); ?>
            <?php require("./layout/submenu-pacientes.php"); ?>
            <div class="contenido">
                <form class="form" id="form-consulta">
                    <label id="consulta-nombre" class="formulario_grupo span-4">
                        <h2></h2>
                    </label>
                    <label id="consulta-titulo" class="formulario_grupo span-4">Consulta</label>

                    <!-- grupo: -->
                    <div class="formulario_grupo">
                        <label class="form_label" for="consultafecha-paciente"><i class="izquierda fa fa-calendar"
                                aria-hidden="true"></i>Fecha</label>
                        <input class="form_input" type="date" id="consultafecha-paciente" name="consultafecha-paciente">
                        <input type="hidden" name="oculto-fecha-consulta" id="oculto-fecha-consulta">
                    </div><!-- end form-grupo -->

                    <!-- grupo: -->
                    <div class="formulario_grupo" id="grupo_consultorio">
                        <label class="form_label" for="select-consultorio"><i
                                class="izquierda fa fa-map-marker"></i>Consultorio</label>
                        <div class="form_grupo-input">
                            <select class="form_input" name="select-consultorio" id="select-consultorio">
                            </select>
                        </div>
                    </div><!-- end form-grupo -->

                    <div class="span-2"></div>
                    <div class=""></div>

                    <label class="formulario_grupo span-4">Examen fisico</label>

                    <!-- grupo: -->
                    <div class="formulario_grupo" id="grupo_vitalesta">
                        <label class="form_label" for="vitalesta-paciente">TA</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="vitalesta-paciente" name="vitalesta-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- grupo: -->
                    <div class="formulario_grupo" id="grupo_vitalesoxigeno">
                        <label class="form_label" for="vitalesoxigeno-paciente">Oxigeno</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="vitalesoxigeno-paciente"
                                name="vitalesoxigeno-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- grupo: -->
                    <div class="formulario_grupo" id="grupo_vitalespulso">
                        <label class="form_label" for="vitalespulso-paciente">Pulso</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="vitalespulso-paciente"
                                name="vitalespulso-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- grupo: -->
                    <div class="formulario_grupo" id="grupo_vitalespeso">
                        <label class="form_label" for="vitalespeso-paciente">Peso</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="vitalespeso-paciente" name="vitalespeso-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- grupo: -->
                    <div class="formulario_grupo" id="grupo_vitalesestatura">
                        <label class="form_label" for="vitalesestatura-paciente">Estatura</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="vitalesestatura-paciente"
                                name="vitalesestatura-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- grupo: -->
                    <div class="formulario_grupo" id="grupo_vitalestemperatura">
                        <label class="form_label" for="vitalestemperatura-paciente">Temperatura</label>
                        <div class="form_grupo-input">
                            <input class="form_input" type="text" id="vitalestemperatura-paciente"
                                name="vitalestemperatura-paciente">
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- grupo: -->
                    <div class="formulario_grupo span-4" id="grupo_consultamotivo">
                        <label class="form_label" for="consultamotivo-paciente">Motivo de consulta</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" type="text" id="consultamotivo-paciente"
                                name="consultamotivo-paciente" rows="4" cols="50"> </textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- grupo: -->
                    <div class="formulario_grupo span-4" id="grupo_consultaexploracion">
                        <label class="form_label" for="consultaexploracion-paciente">Exploración</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" type="text" id="consultaexploracion-paciente"
                                name="consultaexploracion-paciente" rows="4" cols="50"></textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Consultas externas</label>

                    <!-- grupo: -->
                    <div class="formulario_grupo span-2" id="grupo_consultapreviacomentarios">
                        <label class="form_label" for="consultapreviacomentarios-paciente">Comentarios</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" type="text" id="consultapreviacomentarios-paciente"
                                name="consultapreviacomentarios-paciente" rows="4" cols="50"> </textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- grupo: -->
                    <div class="formulario_grupo span-2" id="grupo_consultapreviadiagnostico">
                        <label class="form_label" for="consultapreviadiagnostico-paciente">Diagnostico</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" type="text" id="consultapreviadiagnostico-paciente"
                                name="consultapreviadiagnostico-paciente" rows="4" cols="50"> </textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- grupo: -->
                    <div class="formulario_grupo span-2" id="grupo_consultapreviaestudio">
                        <label class="form_label" for="consultapreviaestudio-paciente">Estudios</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" type="text" id="consultapreviaestudio-paciente"
                                name="consultapreviaestudio-paciente" rows="4" cols="50"> </textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <!-- grupo: -->
                    <div class="formulario_grupo span-2" id="grupo_consultapreviatratamientos">
                        <label class="form_label" for="consultapreviatratamientos-paciente">Tratamiento</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" type="text" id="consultapreviatratamiento-paciente"
                                name="consultapreviatratamientos-paciente" rows="4" cols="50"> </textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <button class="boton azul" id="boton-consulta-previa" type="button"><i
                            class="fas fa-plus"></i>Añadir</button>

                    <table class="table span-4" id="tabla-consultas-previas">
                        <!--<thead>
                            <tr>
                                <th>Comentarios</th>
                                <th>Diagnostico</th>
                                <th>Estudios</th>
                                <th>Tratamientos</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-consultas-previas">
                        </tbody>-->
                    </table>
                    <label class="formulario_grupo span-4" for="consultaindicaciones-paciente">Indicaciones
                        Generales</label>

                    <!-- grupo: -->
                    <div class="formulario_grupo span-4" id="grupo_consultaindicaciones">
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" type="text" id="consultaindicaciones-paciente"
                                name="consultaindicaciones-paciente" rows="4" cols="50"> </textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Medicamento</label>

                    <!-- grupo: -->
                    <div class="formulario_grupo span-2" id="grupo_consultanombremed">
                        <label class="form_label" for="consultanombremed-paciente">Nombre del medicamento</label>
                        <div class="form_grupo-input">
                            <input class="form_input" list="consultanombremed-paciente" id="input-medicamento">
                            <datalist class="form_input" id="consultanombremed-paciente">
                            </datalist>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="select-medicamento-hora"><i
                                class="fa fa-hourglass-half izquierda" aria-hidden="true"></i>Cada (horas)</label>
                        <select class="form_input" name="time" id="select-medicamento-hora">
                            <option value="01:00">01:00 hr</option>
                            <option value="02:00">02:00 hrs</option>
                            <option value="03:00">03:00 hrs</option>
                            <option value="04:00">04:00 hrs</option>
                            <option value="05:00">05:00 hrs</option>
                            <option value="06:00">06:00 hrs</option>
                            <option value="07:00">07:00 hrs</option>
                            <option value="08:00">08:00 hrs</option>
                            <option value="09:00">09:00 hrs</option>
                            <option value="10:00">10:00 hrs</option>
                            <option value="11:00">11:00 hrs</option>
                            <option value="12:00">12:00 hrs</option>
                            <option value="13:00">13:00 hrs</option>
                            <option value="14:00">14:00 hrs</option>
                            <option value="15:00">15:00 hrs</option>
                            <option value="16:00">16:00 hrs</option>
                            <option value="17:00">17:00 hrs</option>
                            <option value="18:00">18:00 hrs</option>
                            <option value="19:00">19:00 hrs</option>
                            <option value="20:00">20:00 hrs</option>
                            <option value="21:00">21:00 hrs</option>
                            <option value="22:00">22:00 hrs</option>
                            <option value="23:00">23:00 hrs</option>
                            <option value="24:00">24:00 hrs</option>
                        </select>
                    </div><!-- end form-grupo -->

                    <!-- grupo: -->
                    <div class="formulario_grupo span-4" id="grupo_indicacionesmed">
                        <label class="form_label" for="indicacionesmed-paciente">Indicaciones</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" id="indicacionesmed-paciente"
                                name="indicacionesmed-paciente" rows="4" cols="50"> </textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <button class="boton azul" id="boton-medicamento-indicacion" type="button"><i
                            class="fas fa-plus"></i> Añadir</button>

                    <table class="table span-4" id="tabla-medicamento-indicacion">
                        <!--<thead>
                            <tr>
                                <th>Medicamento</th>
                                <th>Indicaciones</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-medicamento-indicacion">
                        </tbody>-->
                    </table>
                    <label class="formulario_grupo" for="estudiossolicitados-paciente">Estudios solicitados</label>

                    <!-- grupo: -->
                    <div class="formulario_grupo span-4" id="grupo_estudiossolicitados">
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" type="text" id="estudiossolicitados-paciente"
                                name="estudiossolicitados-paciente" rows="4" cols="50"> </textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <button class="boton azul" id="boton-estudios-solicitados" type="button"><i class="fas fa-plus"></i>
                        Añadir</button>
                    <table class="table span-4" id="tabla-estudios-solicitados">
                        <!--<thead>
                            <tr>
                                <th>Estudio</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-estudios-solicitados">
                        </tbody>-->
                    </table>

                    <!-- grupo: -->
                    <div class="formulario_grupo span-4" id="grupo_consultaterapia">
                        <label class="form_label span-4" for="consultaterapia-paciente">Terapia</label>
                        <div class="form_grupo-input">
                            <textarea class="form_textarea" id="consultaterapia-paciente"
                                name="consultaterapia-paciente" rows="4" cols="50"> </textarea>
                            <i class="form_validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="form_input-error">El campo no debe estar vacío</p>
                    </div><!-- end form-grupo -->

                    <button class="boton azul" id="boton-terapia" type="button"><i class="fas fa-plus"></i>
                        Añadir</button>

                    <table class="table span-4" id="tabla-terapias-aplicadas">
                        <!--<thead>
                            <tr>
                                <th>Terapia aplicada</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-terapias-aplicadas">
                        </tbody>-->
                    </table>

                    <button class="input_submit boton amarillo span-2" id="boton-imprimir-receta" type="button" ><i
                            class="fa fa-print" aria-hidden="true"></i>
                        Imprimir Receta</button>
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
<script src="./js/form-consulta.js"></script>
<script src="./js/validacion-consulta.js"></script>
</html>
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
    <link rel="stylesheet" href="./css/estilos-pacientes-ficha.css">
    <link rel="stylesheet" href="./css/estilos-pacientes-informacion.css">
    <link rel="stylesheet" href="./css/mediaqueries.css">
    <title>Ficha clinica</title>
</head>

<body>
    <div class="contenedor">
        <?php require("./layout/menu.php"); ?>
        <div class="content">
            <?php require("./layout/content-informacion.php"); ?>
            <?php require("./layout/submenu-pacientes.php"); ?>
            <div class="contenido">
                <form class="form">

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="recomendo-paciente">¿Quién le recomendo?</label>
                        <input class="form_input" type="text" id="recomendo-paciente" name="recomendo-paciente">
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Hijos</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="hijo-paciente">Edad</label>
                        <input class="form_input" type="text" id="hijo-edad-paciente" name="hijo-edad-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo radio span-2">
                        <label for="sexo-hijo"><i class="izquierda fas fa-male"></i>Hombre</label>
                        <input type="radio" id="hombre" name="hombre">
                        <label for="sexo-hijo"><i class="izquierda fas fa-female"></i>Mujer</label>
                        <input type="radio" id="mujer" name="mujer">
                        <label for="sexo-hijo">Otro</label>
                        <input type="radio" id="otro" name="otro">
                    </div><!-- end form-grupo -->

                    <button class="boton azul"><i class="fas fa-plus"></i> Añadir</button>

                    <table class="table span-4">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Sexo</th>
                                <th>Edad</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td><i class="fas fa-trash"></i></td>
                            </tr>
                        </tbody>
                    </table>

                    <label class="formulario_grupo span-4">Antecedentes gineco-obstétricos</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="embarazos-paciente">Embarazos</label>
                        <input class="form_input" type="number" id="embarazos-paciente" name="embarazos-paciente"
                            value="0">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="partos-paciente">Partos</label>
                        <input class="form_input" type="number" id="partos-paciente" name="partos-paciente" value="0">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="cesareas-paciente">Cesáreas</label>
                        <input class="form_input" type="number" id="cesareas-paciente" name="cesareas-paciente"
                            value="0">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="abortos-paciente">Abortos</label>
                        <input class="form_input" type="number" id="abortos-paciente" name="abortos-paciente" value="0">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="muertos-paciente">Muertos</label>
                        <input class="form_input" type="number" id="muertos-paciente" name="muertos-paciente" value="0">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="enfs-paciente">ENFS</label>
                        <input class="form_input" type="number" id="enfs-paciente" name="enfs-paciente" value="0">
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Ginecología</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="menstruacion-paciente">Fecha última menstruación</label>
                        <input class="form_input" type="date" id="menstruacion-paciente" name="menstruacion-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="menstruacionperiodicidad-paciente"><i
                                class="icono izquierda fas fa-calendar"></i>Periodicidad</label>
                        <input class="form_input" type="text" id="menstruacionperiodicidad-paciente"
                            name="menstruacionperiodicidad-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="menstruacionmolestias-paciente">Molestias</label>
                        <input class="form_input" type="text" id="menstruacionmolestias-paciente"
                            name="menstruacionmolestias-paciente">
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Antecedentes no patologicos</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="fuma-paciente">Fuma</label>
                        <input class="form_input" type="text" id="fuma-paciente" name="fuma-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="cigarros-paciente"><i
                                class="icono izquierda fas fa-smoking"></i>Cigarros al día</label>
                        <input class="form_input" type="text" id="cigarros-paciente" name="cigarros-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="cigarros-antiguedad-paciente">Antiguedad</label>
                        <input class="form_input" type="text" id="cigarros-antiguedad-paciente"
                            name="cigarros-antiguedad-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="alcohol-paciente">Alcohol</label>
                        <input class="form_input" type="text" id="alcohol-paciente" name="alcohol-paciente">
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
                        <input class="form_input" type="text" id="addiciones-paciente" name="addiciones-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="alergias-paciente">Alergias</label>
                        <input class="form_input" type="text" id="alergias-paciente" name="alergias-paciente">
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Alimentación</label>

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="desayuno-paciente">Desayuno</label>
                        <textarea class="form_textarea" id="desayuno-paciente" name="desayuno-paciente" rows="4"
                            cols="50"> </textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="comida-paciente">Comida</label>
                        <textarea class="form_textarea" id="comida-paciente" name="comida-paciente" rows="4"
                            cols="50"> </textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="cena-paciente">Cena</label>
                        <textarea class="form_textarea" id="cena-paciente" name="cena-paciente" rows="4"
                            cols="50"> </textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="entrecomidas-paciente">Entre comidas</label>
                        <textarea class="form_textarea" id="entrecomidas-paciente" name="entrecomidas-paciente" rows="4"
                            cols="50"> </textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="agua-paciente">Vasos de agua al día</label>
                        <input class="form_input" type="text" id="agua-paciente" name="agua-paciente">
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
                        <input class="form_input" type="text" id="orinamolestias-paciente"
                            name="orinamolestias-paciente">
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

                    <div class="formulario_grupo">
                        <label class="form_label" for="ejercicio-paciente">Ejercicio por semana</label>
                        <input class="form_input" type="text" id="ejercicio-paciente" name="ejercicio-paciente">
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Antecedentes familiares</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="parentesco-paciente">Parentesco</label>
                        <input class="form_input" type="text" id="parentesco-paciente" name="parentesco-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="familiarenfermedad-paciente">Enfermedad</label>
                        <input class="form_input" type="text" id="familiarenfermedad-paciente"
                            name="familiarenfermedad-paciente">
                    </div><!-- end form-grupo -->

                    <button class="boton azul"><i class="fas fa-plus"></i> Añadir</button>

                    <table class="table span-4">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Parentesco</th>
                                <th>Enfermedad</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td><i class="fas fa-trash"></i></td>
                            </tr>
                        </tbody>
                    </table>

                    <label class="formulario_grupo span-4">Antecedentes del paciente</label>

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="enfermedad-paciente">Enfermedad</label>
                        <input class="form_input" type="text" id="enfermedad-paciente" name="enfermedad-paciente">
                    </div><!-- end form-grupo -->

                    <button class="boton azul"><i class="fas fa-plus"></i> Añadir</button>

                    <table class="table span-4">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Enfermedad</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td><i class="fas fa-trash"></i></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="formulario_grupo">
                        <label class="form_label" for="firma-paciente">Firma</label>
                        <input class="form_input" type="file" id="firma-paciente" name="firma-paciente">
                    </div><!-- end form-grupo -->

                    <button class="input_submit boton amarillo span-2">Imprimir</button>
                    <input class="input_submit boton azul span-2" type="submit" value="Guardar">
                </form>
            </div>

        </div>
        <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
</body>

</html>
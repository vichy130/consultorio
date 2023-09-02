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
$id_paciente=0;
$oF=null;
if(isset($_SESSION["id_paciente"])){
    $id_paciente=$_SESSION["id_paciente"];
    include_once("models/ficha-clinica.php");
    $oF=new ficha();
    $oF->paciente = $id_paciente;
    $oF->buscarDatos();
}else {
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
    <div class="<?php if(isset($_SESSION["id_paciente"])){ echo "contenedor"; }else {echo "contenedor-no"; }?>">
        <?php require("./layout/menu.php"); ?>
        <div class="content">
            <?php require("./layout/content-informacion.php"); ?>
            <?php require("./layout/submenu-pacientes.php"); ?>
            <div class="contenido">
                <form class="form" action="controller/ficha-test.php" method="POST">

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="recomendo-paciente">¿Quién le recomendo?</label>
                        <input class="form_input" type="text" id="recomendo-paciente" name="recomendo-paciente" value="<?php echo $oF==null? "": $oF->quienRecomendo; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="tipo-sangre"><i class="izquierda fas fa-tint"></i>Tipo de
                            sangre</label>
                            <select class="form_input" name="tipo-sangre" id="tipo-sangre">
                                <option value="">Selecciona una opción</option>
                                <option value="A+">A+</option>
                                <option value="A+">B+</option>
                                <option value="A+">O+</option>
                                <option value="A+">AB+</option>
                                <option value="A+">AB-</option>
                                <option value="A+">A-</option>
                                <option value="A+">B-</option>
                                <option value="A+">O-</option>
                            </select>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Hijos</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="hijoedad-paciente">Edad</label>
                        <input class="form_input form_input_small" type="text" id="hijoedad-paciente"
                            name="hijoedad-paciente"  value="<?php echo $oF==null? "": $oF->hijo; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo radio span-2">
                        <label for="sexo-hijo"><i class="izquierda fas fa-male"></i>Hombre</label>
                        <input type="radio" id="hombre" name="sexo-hijo" value="Hombre">
                        <label for="sexo-hijo"><i class="izquierda fas fa-female"></i>Mujer</label>
                        <input type="radio" id="mujer" name="sexo-hijo" value="Mujer">
                        <label for="sexo-hijo">Otro</label>
                        <input type="radio" id="otro" name="sexo-hijo" checked="checked" value="Otro">
                    </div><!-- end form-grupo -->

                    <button class="boton azul" id="agregarHijo" type="button"><i class="fas fa-plus"></i> Añadir Hijo</button>

                    <table class="table span-4" >
                    <thead>
                            <tr>
                                <th class="column-to-hide"></th>
                                <th>Sexo</th>
                                <th>Edad</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-hijos">
                            
                        </tbody>
                    </table>

                    <label class="formulario_grupo span-4">Antecedentes gineco-obstétricos</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="embarazos-paciente">Embarazos</label>
                        <input class="form_input form_input_small" type="number" id="embarazos-paciente"
                            name="embarazos-paciente"  value="<?php echo $oF==null? "0": $oF->embarazo; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="partos-paciente">Partos</label>
                        <input class="form_input form_input_small" type="number" id="partos-paciente"
                            name="partos-paciente"  value="<?php echo $oF==null? "0": $oF->partos; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="cesareas-paciente">Cesáreas</label>
                        <input class="form_input form_input_small" type="number" id="cesareas-paciente"
                            name="cesareas-paciente"  value="<?php echo $oF==null? "0": $oF->cesareas; ?>" >
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="abortos-paciente">Abortos</label>
                        <input class="form_input form_input_small" type="number" id="abortos-paciente"
                            name="abortos-paciente" value="<?php echo $oF==null? "0": $oF->abortos; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="muertos-paciente">Muertos</label>
                        <input class="form_input form_input_small" type="number" id="muertos-paciente"
                            name="muertos-paciente" value="<?php echo $oF==null? "0": $oF->muertos; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="enfs-paciente">ENFS</label>
                        <input class="form_input form_input_small" type="number" id="enfs-paciente" name="enfs-paciente"
                        value="<?php echo $oF==null? "0": $oF->enfs; ?>">
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Ginecología</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="menstruacion-paciente">Fecha última menstruación</label>
                        <input class="form_input " type="date" id="menstruacion-paciente" name="menstruacion-paciente" value="<?php echo $oF==null? "": $oF->fechaMenstruacion; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="menstruacionperiodicidad-paciente"><i
                                class="icono izquierda fas fa-calendar"></i>Periodicidad</label>
                        <input class="form_input" type="text" id="menstruacionperiodicidad-paciente"
                            name="menstruacionperiodicidad-paciente" value="<?php echo $oF==null? "": $oF->mensPeriodicidad; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="menstruacionmolestias-paciente">Molestias</label>
                        <textarea class="form_textarea" id="menstruacionmolestias-paciente"
                            name="menstruacionmolestias-paciente" rows="4" cols="50"><?php echo $oF==null? "": $oF->mensMolestias; ?></textarea>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Antecedentes no patologicos</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="fuma-paciente">Fuma</label>
                        <select class="form_input" name="fuma-paciente" id="fuma-paciente">
                            <option value="true">Si</option>
                            <option value="false" selected="selected">No</option>
                            <option value="true">A veces</option>
                        </select>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="cigarros-paciente"><i
                                class="icono izquierda fas fa-smoking"></i>Cigarros al día</label>
                        <input class="form_input form_input_small" type="text" id="cigarros-paciente"
                            name="cigarros-paciente" value="<?php echo $oF==null? "": $oF->cigarrosDia; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="cigarros-antiguedad-paciente">Antiguedad</label>
                        <input class="form_input" type="text" id="cigarros-antiguedad-paciente"
                            name="cigarros-antiguedad-paciente" value="<?php echo $oF==null? "": $oF->fumaAntiguedad; ?>">
                    </div><!-- end form-grupo -->

                    <div class=""></div>

                    <div class="formulario_grupo">
                        <label class="form_label" for="alcohol-paciente">Alcohol</label>
                        <select class="form_input" name="alcohol-paciente" id="alcohol-paciente">
                            <option value="true">Si</option>
                            <option value="false" selected="selected">No</option>
                            <option value="true">A veces</option>
                        </select>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="frecuencia-paciente">Frecuencia</label>
                        <input class="form_input" type="text" id="frecuencia-paciente" name="frecuencia-paciente" value="<?php echo $oF==null? "": $oF->alcFrecuencia; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="cantidad-paciente">Cantidad</label>
                        <input class="form_input" type="text" id="cantidad-paciente" name="cantidad-paciente" value="<?php echo $oF==null? "": $oF->alcoholCantidad; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="tipos-paciente">Tipos</label>
                        <input class="form_input" type="text" id="tipos-paciente" name="tipos-paciente" value="<?php echo $oF==null? "": $oF->alcoholTipos; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="addiciones-paciente">Addiciones</label>
                        <input class="form_input" type="text" id="addiciones-paciente" name="addiciones-paciente " value="<?php echo $oF==null? "": $oF->adicciones; ?>">
                    </div><!-- end form-grupo -->

                    <div class="span-2"></div>

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="alergias-paciente">Alergias</label>
                        <textarea class="form_textarea" id="alergias-paciente" name="alergias-paciente" rows="4"
                            cols="50" ><?php echo $oF==null? "": $oF->alergias; ?></textarea>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Alimentación</label>

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="desayuno-paciente">Desayuno</label>
                        <textarea class="form_textarea" id="desayuno-paciente" name="desayuno-paciente" rows="4"
                            cols="50" ><?php echo $oF==null? "": $oF->desayuno; ?></textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="comida-paciente">Comida</label>
                        <textarea class="form_textarea" id="comida-paciente" name="comida-paciente" rows="4"
                            cols="50" ><?php echo $oF==null? "": $oF->comida; ?></textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="cena-paciente">Cena</label>
                        <textarea class="form_textarea" id="cena-paciente" name="cena-paciente" rows="4"
                            cols="50" ><?php echo $oF==null? "": $oF->cena; ?></textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="entrecomidas-paciente">Entre comidas</label>
                        <textarea class="form_textarea" id="entrecomidas-paciente" name="entrecomidas-paciente" rows="4"
                            cols="50" ><?php echo $oF==null? "": $oF->entreComidas; ?></textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="agua-paciente">Vasos de agua al día</label>
                        <input class="form_input form_input_small" type="text" id="agua-paciente" name="agua-paciente" value="<?php echo $oF==null? "": $oF->vasoAguaDia; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="otrosliquidos-paciente">Otros liquidos</label>
                        <input class="form_input" type="text" id="otrosliquidos-paciente" name="otrosliquidos-paciente" value="<?php echo $oF==null? "": $oF->otrosLiquidos; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="intolerancias-paciente">Intolerancias</label>
                        <input class="form_input" type="text" id="intolerancias-paciente" name="intolerancias-paciente" value="<?php echo $oF==null? "": $oF->intolerancias; ?>">
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Urología</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="orinadia-paciente">Orina: día</label>
                        <input class="form_input" type="text" id="orinadia-paciente" name="orinadia-paciente" value="<?php echo $oF==null? "": $oF->orinaDia; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="orinanoche-paciente">Orina: noche</label>
                        <input class="form_input" type="text" id="orinanoche-paciente" name="orinanoche-paciente" value="<?php echo $oF==null? "": $oF->orinaNoche; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="orinacolor-paciente">Orina: color</label>
                        <input class="form_input" type="text" id="orinacolor-paciente" name="orinacolor-paciente" value="<?php echo $oF==null? "": $oF->orinaColor; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="orinaolor-paciente">Orina: olor</label>
                        <input class="form_input" type="text" id="orinaolor-paciente" name="orinaolor-paciente" value="<?php echo $oF==null? "": $oF->orinaOlor; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="orinamolestias-paciente">Molestias</label>
                        <textarea class="form_textarea" id="orinamolestias-paciente" name="orinamolestias-paciente" rows="4"
                            cols="50" ><?php echo $oF==null? "": $oF->orinaMolestias; ?></textarea>
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Gastroenterólogia</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="excrementoaldia-paciente">Excremento al día</label>
                        <input class="form_input" type="text" id="excrementoaldia-paciente"
                            name="excrementoaldia-paciente" value="<?php echo $oF==null? "": $oF->excrementoDia; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="excrementoconsistencia-paciente">Consistencia</label>
                        <input class="form_input" type="text" id="excrementoconsistencia-paciente"
                            name="excrementoconsistencia-paciente" value="<?php echo $oF==null? "": $oF->exConsistencia; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="excrementoolor-paciente">Olor</label value="<?php echo $oF==null? "": $oF->exOlor; ?>">
                        <input class="form_input" type="text" id="excrementoolor-paciente"
                            name="excrementoolor-paciente" value="<?php echo $oF==null? "": $oF->exOlor; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="excrementocolor-paciente">Color</label>
                        <input class="form_input" type="text" id="excrementocolor-paciente"
                            name="excrementocolor-paciente" value="<?php echo $oF==null? "": $oF->exColor; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="excrementodolor-paciente">Dolor</label>
                        <input class="form_input" type="text" id="excrementodolor-paciente"
                            name="excrementodolor-paciente" value="<?php echo $oF==null? "": $oF->exDolor; ?>">
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Ejercicio</label>

                    <div class="formulario_grupo  span-2">
                        <label class="form_label" for="ejercicio-paciente">Ejercicio por semana</label>
                        <input class="form_input" type="text" id="ejercicio-paciente" name="ejercicio-paciente" value="<?php echo $oF==null? "": $oF->ejercicioSemana; ?>">
                    </div><!-- end form-grupo -->

                    <label class="formulario_grupo span-4">Antecedentes familiares</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="parentesco-paciente">Parentesco</label>
                        <input class="form_input" type="text" id="parentesco-paciente" name="parentesco-paciente" value="<?php /*echo $oF==null? "": $oF->exDolor; */?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="familiarenfermedad-paciente">Enfermedad</label>
                        <input class="form_input" type="text" id="familiarenfermedad-paciente"
                            name="familiarenfermedad-paciente" >
                    </div><!-- end form-grupo -->

                    <button class="boton azul"><i class="fas fa-plus"></i> Añadir</button>

                    <table class="table span-4">
                        <thead>
                            <tr>
                                <th class="column-to-hide"></th>
                                <th>Parentesco</th>
                                <th>Enfermedad</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="column-to-hide">1</td>
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
                                <th class="column-to-hide"></th>
                                <th>Enfermedad</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="column-to-hide">1</td>
                                <td></td>
                                <td><i class="fas fa-trash"></i></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="formulario_grupo">
                        <label class="form_label" for="firma-paciente">Firma Paciente</label>
                        <input class="form_input" type="file" id="firma-paciente" name="firma-paciente" >
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="firma-usuario">Firma Médico</label>
                        <input class="form_input" type="file" id="firma-usuario" name="firma-usuario">
                    </div><!-- end form-grupo -->

                    <div class=""></div>
                    <div class=""></div>
                    <button class="input_submit boton amarillo span-2">Imprimir</button>
                    <input class="input_submit boton azul span-2" type="submit" value="Guardar">
                </form>
            </div>

        </div>
        <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
    <script src="./js/form-ficha-clinica.js"></script>
</body>

</html>
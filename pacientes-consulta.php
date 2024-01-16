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
if(isset($_REQUEST["id"])){
    $_SESSION["id_consulta"]= $_REQUEST["id"];
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
                <form class="form" action="./controller/nueva-consulta.php" method="POST">
                    <label id="consulta-nombre" class="formulario_grupo span-4"><h2></h2></label>       
                    <label id="consulta-titulo" class="formulario_grupo span-4">Consulta</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="consultafecha-paciente"><i class="izquierda fa fa-calendar" aria-hidden="true"></i>Fecha</label>
                        <input class="form_input" type="date" id="consultafecha-paciente" name="consultafecha-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="tipo-sangre"><i class="izquierda fa fa-map-marker"></i>Consultorio</label>
                        <select class="form_input" name="select-consultorio" id="select-consultorio">
                            <option value="">Selecciona una opción</option>
                        </select>
                    </div><!-- end form-grupo -->

                    <div class="span-2"></div>
                    <div class=""></div>

                    <label class="formulario_grupo span-4">Examen fisico</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="vitalesta-paciente">TA</label>
                        <input class="form_input" type="text" id="vitalesta-paciente" name="vitalesta-paciente" value="">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="vitalesoxigeno-paciente">Oxigeno</label>
                        <input class="form_input" type="text" id="vitalesoxigeno-paciente" name="vitalesoxigeno-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="vitalespulso-paciente">Pulso</label>
                        <input class="form_input" type="text" id="vitalespulso-paciente" name="vitalespulso-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="vitalespeso-paciente">Peso</label>
                        <input class="form_input" type="text" id="vitalespeso-paciente" name="vitalespeso-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="vitalesestatura-paciente">Estatura</label>
                        <input class="form_input" type="text" id="vitalesestatura-paciente" name="vitalesestatura-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="vitalestemperatura-paciente">Temperatura</label>
                        <input class="form_input" type="text" id="vitalestemperatura-paciente" name="vitalestemperatura-paciente">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-4">
                        <label class="form_label" for="consultamotivo-paciente">Motivo de consulta</label>
                        <textarea class="form_textarea" type="text" id="consultamotivo-paciente"
                            name="consultamotivo-paciente" rows="4" cols="50"> </textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-4">
                        <label class="form_label" for="consultaexploracion-paciente">Exploración</label>
                        <textarea class="form_textarea" type="text" id="consultaexploracion-paciente"
                            name="consultaexploracion-paciente" rows="4" cols="50" value=""><?php echo $consulta==null? "": $consulta->motivoConsulta; ?></textarea>
                    </div><!-- end form-grupo -->
                    <label class="formulario_grupo span-4">Consultas previas</label>

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="consultapreviacomentarios-paciente">Comentarios</label>
                        <textarea class="form_textarea" type="text" id="consultapreviacomentarios-paciente"
                            name="consultapreviacomentarios-paciente" rows="4" cols="50"> </textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="consultapreviadiagnostico-paciente">Diagnostico</label>
                        <textarea class="form_textarea" type="text" id="consultapreviadiagnostico-paciente"
                            name="consultapreviadiagnostico-paciente" rows="4" cols="50"> </textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="consultapreviaestudio-paciente">Estudios</label>
                        <textarea class="form_textarea" type="text" id="consultapreviaestudio-paciente"
                            name="consultapreviaestudio-paciente" rows="4" cols="50"> </textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="consultapreviatratamientos-paciente">Tratamientos</label>
                        <textarea class="form_textarea" type="text" id="consultapreviatratamientos-paciente"
                            name="consultapreviatratamientos-paciente" rows="4" cols="50"> </textarea>
                    </div><!-- end form-grupo -->

                    <button class="boton azul"><i class="fas fa-plus"></i>Añadir</button>

                    <table class="table span-4" id="tabla-consultas-previas">
                        <thead>
                            <tr>
                                <th>Comentarios</th>
                                <th>Diagnostico</th>
                                <th>Estudios</th>
                                <th>Tratamientos</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-consultas-previas">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><i class="fas fa-trash"></i></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="formulario_grupo span-4">
                        <label class="form_label" for="consultaindicaciones-paciente">Indicaciones</label>
                        <textarea class="form_textarea" type="text" id="consultaindicaciones-paciente"
                            name="consultaindicaciones-paciente" rows="4" cols="50"> </textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="nutrientes-paciente">Nutrientes</label>
                        <input class="form_input" type="text" id="nutrientes-paciente" name="nutrientes-paciente">
                    </div><!-- end form-grupo -->

                    <button class="boton azul"><i class="fas fa-plus"></i>Añadir</button>

                    <table class="table span-4">
                        <thead>
                            <tr>
                                <th>Nutriente</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td><i class="fas fa-trash"></i></td>
                            </tr>
                        </tbody>
                    </table>

                    <label class="formulario_grupo span-4">Medicamento</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="consultanombremed-paciente">Nombre del medicamento</label>
                        <input class="form_input" type="text" id="consultanombremed-paciente"
                            name="consultanombremed-paciente">
                    </div><!-- end form-grupo -->

                    <button class="boton azul"><i class="fas fa-plus"></i> Añadir medicamento</button>

                    <div class="formulario_grupo">
                        <label class="form_label" for="indicacionesmed-paciente">Indicaciones</label>
                        <textarea class="form_textarea" id="indicacionesmed-paciente" name="indicacionesmed-paciente"
                            rows="4" cols="50"> </textarea>
                    </div><!-- end form-grupo -->

                    <button class="boton azul"><i class="fas fa-plus"></i> Añadir</button>

                    <table class="table span-4">
                        <thead>
                            <tr>
                                <th>Medicamento</th>
                                <th>Indicaciones</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><i class="fas fa-trash"></i></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="estudiossolicitados-paciente">Estudios solicitados</label>
                        <textarea class="form_textarea" type="text" id="estudiossolicitados-paciente"
                            name="estudiossolicitados-paciente" rows="4" cols="50"> </textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo">
                        <label class="form_label" for="consultaterapia-paciente">Terapia</label>
                        <textarea class="form_textarea" id="consultaterapia-paciente" name="consultaterapia-paciente"
                            rows="4" cols="50"> </textarea>
                    </div><!-- end form-grupo -->

                    <button class="boton azul"><i class="fas fa-plus"></i> Añadir</button>

                    <table class="table span-4">
                        <thead>
                            <tr>
                                <th>Terapia aplicada</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td><i class="fas fa-trash"></i></td>
                            </tr>
                        </tbody>
                    </table>

                    <button class="input_submit boton amarillo span-2"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
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
</html>
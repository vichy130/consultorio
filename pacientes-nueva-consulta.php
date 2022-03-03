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
                <form class="form" action="" method="POST">

                    <label class="formulario_grupo span-4">Nueva consulta</label>

                    <div class="formulario_grupo">
                        <label class="form_label" for="consultafecha-paciente">Fecha</label>
                        <input class="form_input" type="date" id="consultafecha-paciente" name="consultafecha-paciente">
                    </div><!-- end form-grupo -->

                    <div class="span-2"></div>
                    <div class=""></div>

                    <div class="formulario_grupo span-4">
                        <label class="form_label" for="consultamotivo-paciente">Motivo de consulta</label>
                        <textarea class="form_textarea" type="text" id="consultamotivo-paciente"
                            name="consultamotivo-paciente" rows="4" cols="50"> </textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-4">
                        <label class="form_label" for="consultaexploracion-paciente">Exploración</label>
                        <textarea class="form_textarea" type="text" id="consultaexploracion-paciente"
                            name="consultaexploracion-paciente" rows="4" cols="50"> </textarea>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="consultaprevia-paciente">Consultas previas</label>
                        <textarea class="form_textarea" type="text" id="consultaprevia-paciente"
                            name="consultaprevia-paciente" rows="4" cols="50"> </textarea>
                    </div><!-- end form-grupo -->

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
                        <label class="form_label" for="consultanombremed-paciente">Nombre</label>
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
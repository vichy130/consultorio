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
$oP=null;
if(isset($_REQUEST["id"])){

include_once("models/paciente.php");
$oP=new paciente();
$oP->id = $_REQUEST["id"];
$oP->buscarDatos();
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
    <div class="contenedor">
        <?php require("./layout/menu.php"); ?>
        <div class="content">
            <?php require("./layout/content-informacion.php"); ?>
            <?php require("./layout/submenu-pacientes.php"); ?>
            <div class="contenido">

                <form action="controller/nuevo-paciente.php" class="form" method="POST">
                    <label class="formulario_grupo span-4">Informacion basica</label>

                    <div class="formulario_grupo span-2">
                        <label class="form_label" for="nombre-paciente">Nombre(s)</label>
                        <input class="form_input" type="text" id="nombre-paciente" name="nombre-paciente" value="<?php echo $oP==null? "": $oP->nombre; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo grupo_apellidop">
                        <label class="form_label" for="apellidop-paciente">Apellido paterno</label>
                        <input class="form_input" type="text" id="apellidop-paciente" name="apellidop-paciente"  value="<?php echo $oP==null? "": $oP->apellidoPaterno; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo grupo_apellidom">
                        <label class="form_label" for="apellidom-paciente">Apellido materno</label>
                        <input class="form_input" type="text" id="apellidom-paciente" name="apellidom-paciente" value="<?php echo $oP==null? "": $oP->apellidoMaterno; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo radio span-4">
                        <label for="sexo-paciente"><i class="izquierda fas fa-male"></i>Hombre</label>
                        <input type="radio" id="hombre" name="sexo" value="masculino" <?php echo $oP==null? "": ($oP->sexo == "masculino" ? "checked" : ""); ?>>
                        <label for="sexo-paciente"><i class="izquierda fas fa-female" ></i>Mujer</label>
                        <input type="radio" id="mujer" name="sexo" value="femenino" <?php echo $oP==null? "": ($oP->sexo == "femenino" ? "checked" : ""); ?>>
                        <label for="sexo-paciente">Otro</label>
                        <input type="radio" id="otro" name="sexo" value="otro" <?php echo $oP==null? "": ($oP->sexo == "otro" ? "checked" : ""); ?>>
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo ">
                        <label class="form_label" for="nacimiento-paciente"><i
                                class="izquierda fas fa-birthday-cake"></i>Fecha de
                            nacimiento</label>
                        <input class="form_input" type="date" id="nacimiento-paciente" name="nacimiento-paciente" value="<?php echo $oP==null? "": $oP->fechaNacimiento; ?>">
                    </div><!-- end form-grupo -->

                    <div class="formulario_grupo ">
                    <label class="form_label" for="lugar-paciente">Lugar de nacimiento</label>
                    <input class="form_input" type="text" id="lugar-paciente" name="lugar-paciente">
                </div><!-- end form-grupo -->

                <label class=" formulario_grupo span-4">Domicilio</label>

                <div class="formulario_grupo span-2">
                    <label class="form_label" for="calle-paciente">Calle y número</label>
                    <input class="form_input" type="text" id="calle-paciente" name="calle-paciente">
                </div><!-- end form-grupo -->

                <div class="formulario_grupo grupo_colonia">
                    <label class="form_label" for="colonia-paciente">Colonia</label>
                    <input class="form_input" type="text" id="colonia-paciente" name="colonia-paciente">
                </div><!-- end form-grupo -->

                <div class="formulario_grupo grupo_ciudad">
                    <label class="form_label" for="ciudad-paciente">ciudad</label>
                    <input class="form_input" type="text" id="ciudad-paciente" name="ciudad-paciente">
                </div><!-- end form-grupo -->

                <div class="formulario_grupo grupo_cp">
                    <label class="form_label" for="cp-paciente">Codigo postal</label>
                    <input class="form_input form_input_small" type="text" id="cp-paciente" name="cp-paciente">
                </div><!-- end form-grupo -->

                <label class="formulario_grupo span-4">Telefono de contacto</label>

                <div class="formulario_grupo">
                    <label class="form_label" for="telefono-casa-paciente"><i
                            class="izquierda fas fa-phone-volume"></i>Telefono de casa</label>
                    <input class="form_input" type="text" id="telefono-casa-paciente" name="telefono-casa-paciente">
                </div><!-- end form-grupo -->

                <div class="formulario_grupo ">
                    <label class="form_label" for="telefono-oficina-paciente"><i
                            class="izquierda fas fa-phone-alt"></i>Oficina</label>
                    <input class="form_input" type="text" id="telefono-oficina-paciente"
                        name="telefono-oficina-paciente">
                </div><!-- end form-grupo -->

                <div class="formulario_grupo ">
                    <label class="form_label" for="telefono-cel-paciente"><i
                            class="izquierda fas fa-mobile-alt"></i>Celular</label>
                    <input class="form_input" type="text" id="telefono-cel-paciente" name="telefono-cel-paciente">
                </div><!-- end form-grupo -->

                <div class=""></div>
                
                <div class="formulario_grupo">
                    <label class="form_label" for="civil-paciente">Estado civil</label>
                    <input class="form_input" type="text" id="civil-paciente" name="civil-paciente">
                </div><!-- end form-grupo -->

                <div class="formulario_grupo">
                    <label class="form_label" for="ocupacion-paciente">Ocupación</label>
                    <input class="form_input" type="text" id="ocupacion-paciente" name="ocupacion-paciente">
                </div><!-- end form-grupo -->

                <div class="formulario_grupo">
                    <label class="form_label" for="escolaridad-paciente"><i
                            class="izquierda fas fa-graduation-cap"></i>Escolaridad</label>
                    <input class="form_input" type="text" id="escolaridad-paciente" name="escolaridad-paciente">
                </div><!-- end form-grupo -->

                <div class="formulario_grupo">
                    <label class="form_label" for="email-paciente"><i class="izquierda fas fa-at"></i>Email</label>
                    <input class="form_input" type="email" id="email-paciente" name="email-paciente">
                </div><!-- end form-grupo -->

                <button class="input_submit boton amarillo span-2">Imprimir</button>
                <input class="input_submit boton azul span-2" type="submit" value="Guardar">
                </form>
                <!-- end form -->
            </div>

        </div>
        <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
    <script src="./js/formulario-informacion.js"></script>
</body>

</html>
<?php session_start();

function redirect($url)
{
    ob_start();
    header('Location: ' . $url);
    ob_end_flush();
    die();
}
if (isset($_SESSION['username'])) {
    redirect("./index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos-iniciar-sesion.css">
    <link rel="icon" href="./img/logobb.png">
    <!-- roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,300&display=swap"
        rel="stylesheet">
    <!-- roboto -->
    <script src="https://kit.fontawesome.com/1af08fd608.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Inicio de sesión</title>
</head>

<body>
    <div class="contenedor">

        <div class="content">
            <form id="form-iniciar-sesion">
                <!-- Grupo usuario -->
                <div class="formulario__grupo" id="grupo__usuario">
                    <label class="formulario_label">Usuario</label>
                    <div class="formulario__grupo-input">
                        <input class="formulario_input" type="text" value="" name="username" id="username">
                        <i class="formulario__validacion-estado fas fa-times"></i>
                    </div>
                    <p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener
                        números, letras y guion bajo.</p>
                </div>
                <!-- Grupo Contraseña    -->
                <div class="formulario__grupo" id="grupo__contrasena">
                    <label class="formulario_label">Contraseña</label>
                    <div class="formulario__grupo-input">
                        <input class="formulario_input" type="password" value="" name="contrasena" id="contrasena">
                        <i class="formulario__validacion-estado fas fa-times"></i>
                    </div>
                    <p class="formulario__input-error">La contraseña tiene que ser de 8 a 16 dígitos.</p>
                </div>
                <div class="texto formulario_datos-incorrectos" id="grupo_datos-incorrectos"><i
                        class="fas fa-times"></i> Usuario o contraseña incorrecta, por favor intenta de nuevo.
                </div>
                <div class="texto formulario_captcha-error" id="grupo_captcha-error"><i
                        class="fas fa-times"></i> Por favor, completa el Captcha.
                </div>

                <div class="texto formulario_bloqueo">Cuenta bloqueada, <a href="">Desbloquea aquí</a></div>
                <div class="formulario__boton">
                    <button class="boton" type="submit" id="boton-iniciar-sesion">Ingresar</button>
                </div>

                <div class="texto"><a class="" href=""> ¿Olvidaste tu contraseña?</a></div>

                <div class="g-recaptcha" data-sitekey="6LfFi7cpAAAAAE_XSP3nk8E3nseLWT7yUiHL2UH6"></div>
            </form>
            <!-- end form -->
        </div>
        <!-- end wrapper -->
        <div class="footer">
            <div class="logo">
            </div>
            <div class="texto-footer">Zapopan Jalisco, México. 2024</div>
        </div>
    </div>
    <!-- end contenedor -->
    <script src="./js/form-iniciar-sesion.js"></script>
    <script src="./js/validacion-iniciar-sesion.js"></script>
</body>

</html>
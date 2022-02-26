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
    <title>Inicio de sesión</title>
</head>

<body>
    <div class="contenedor">

        <div class="content">
            <form id="login" method="POST" action="./iniciar-sesion-ve.php">
                <div class="formulario__grupo">
                    <label class="formulario_label">Usuario</label>
                    <div class="formulario__grupo-input">
                        <input class="formulario_input" type="text" value="" name="username" id="username">
                    </div>
                </div>

                <div class="formulario__grupo">
                    <label class="formulario_label">Contraseña</label>
                    <div class="formulario__grupo-input">
                        <input class="formulario_input" type="password" value="" name="password" id="password">
                    </div>
                </div>
                <div class="texto formulario_bloqueo">Cuenta bloqueada, <a href="">Desbloquea aquí</a></div>
                <div class="formulario__boton">
                    <input class="boton" type="submit" value="Ingresar">
                </div>

                <div class="texto"><a class="" href="#"> ¿Olvidaste tu contraseña?</a></div>
            </form>
            <!-- end form -->
        </div>
        <!-- end wrapper -->
        <div class="footer">
            <div class="logo">
                <div class="logo1"><img src="./img/logowb.png" alt=""></div>
                <div class="texto-footer">
                    <p>Consultorio Homeopático</p>
                </div>
            </div>
            <div class="texto-footer">Zapopan Jalisco, México. 2022</div>
        </div>
    </div>
    <!-- end contenedor -->
</body>

</html>
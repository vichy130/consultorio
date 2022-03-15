<?php session_start();    

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
    <script src="https://kit.fontawesome.com/0d1f50c390.js" crossorigin="anonymous"></script>
    <title>Resetear contraseña</title>
</head>

<body>
    <div class="contenedor">

        <div class="content">
            <form id="form-nueva-contrasena" method="POST" action="./iniciar-sesion.php">

                <label class="formulario_grupo span-4">Nueva contraseña</label>

                <div class="formulario__grupo" id="grupo__nuevacontrasena">
                    <label class="formulario_label">Contraseña</label>
                    <div class="formulario__grupo-input">
                        <input class="formulario_input" type="password" value="" name="nuevacontrasena" id="nuevacontrasena">
                        <i class="formulario__validacion-estado fas fa-times"></i>
                    </div>
                    <p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
                </div>

                <div class="formulario__grupo" id="grupo__nuevacontrasena2">
                    <label class="formulario_label">Repetir contraseña</label>
                    <div class="formulario__grupo-input">
                        <input class="formulario_input" type="password" value="" name="nuevacontrasena2" id="nuevacontrasena2">
                        <i class="formulario__validacion-estado fas fa-times"></i>
                    </div>
                    <p class="formulario__input-error">La contraseñas deben coincidir</p>
                </div>

                <div class="formulario__boton">
                    <input class="boton" type="submit" value="Enviar">
                </div>


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
    <script src="./js/form-nueva-contrasena.js"></script>
</body>

</html>
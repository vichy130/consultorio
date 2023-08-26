


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/grid.css">
    <link rel="stylesheet" href="./css/estilos-menu.css">
    <link rel="stylesheet" href="./css/mediaqueries.css">
    <link rel="icon" href="./img/logobb.png">
    <!-- roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,300&display=swap"
        rel="stylesheet">
    <!-- roboto -->
    <script src="https://kit.fontawesome.com/0d1f50c390.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navI">
        <div class="boton-menu"><a href="#"><i class="fas fa-bars"></i></a></div>
        <ul class="menu">
            <div class="logo">
                <div class="imagen"><img src="./img/medicina.png" alt=""></div>
                <div class="texto">Aga-Khan</div>
            </div>
            <li><a href="./index.php"><i class="icono izquierda fas fa-home"></i>Inicio</a></li>
            <li><a href="./pacientes.php"><i class="icono izquierda fas fa-hospital-user"></i>Pacientes</a></li>
            <li><a href="./reportes.php"><i class="icono izquierda fas fa-file"></i>Centro de reportes</a></li>
            <li><a href="#"><i class="icono izquierda fas fa-cog"></i>Configuración<i
                        class="icono derecha fas fa-chevron-down"></i></a>
                <ul>
                <?php if(isset($_SESSION['username'])){ 
                    if($_SESSION['tipoUsuario']=='A'){
                    ?>
                        <li><a href="./usuarios.php"><i class="icono izquierda fas fa-user-tie"></i>Usuarios</a></li>
                    <?php
                    }
                 }?>  
                    <li><a href="./consultorios.php"><i class="icono izquierda fas fa-stethoscope"></i>Consultorios</a>
                    </li>
                </ul>
            </li>
            <li><a href=""><i class="icono izquierda fas fa-user-circle"></i><?php if(isset($_SESSION['username'])){ echo $_SESSION['nombre']." ".$_SESSION['apellidoPaterno']; }?><i class="icono derecha fas fa-chevron-down"></i></a>
                <ul>
                    <li><a href="./mi-perfil.php"><i class="icono izquierda fas fa-id-badge"></i>Mi perfil</a></li>
                    <li><a href="./php/cerrar-sesion.php"><i class="icono izquierda fas fa-sign-out-alt"></i>Cerrar
                            sesión</a></li>
                </ul>
            </li>
        </ul>
        <!-- end UL -->
    </nav>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/main.js"></script>
    <!-- JQUERY -->
</body>

</html>
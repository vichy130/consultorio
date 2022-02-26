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
                    <div class="uno">DIV 1</div>
                    <div class="dos">DIV 2</div>
                    <div class="uno">DIV 1</div>
                    <div class="dos">DIV 2</div>
                </form>
            </div>

        </div>
        <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
</body>

</html>
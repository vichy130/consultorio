<?php
session_start();

function redirect($url)
{
    ob_start();
    header('Location:' . $url);
    ob_end_flush();
    die();
}
if (!isset($_SESSION['username'])) {
    redirect("./iniciar-sesion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./css/estilos-reportes.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de reportes</title>
</head>

<body>
    <div class="contenedor">
        <?php require ("./layout/menu.php"); ?>
        <div class="content-reportes">
        <label class="span-2 centrar">Centro de reportes</label>
            <div class="reportes-consultas">
                <select name="consultas" id="select-consultas">
                    <option value="ultimo mes">Último més</option>
                    <option value="ultimos tres meses">Últimos tres meses</option>
                    <option value="ultimo año">Último año</option>
                    <i class="fa-light fa-print"></i>
                </select>
            </div>
            <div class="reportes-medicamentos">
                
            </div>
            <div class="reportes-enfermedades">
                
            </div>
            <div class="reportes-terapias">
                
            </div>
        </div>
        <?php require ("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
</body>

</html>
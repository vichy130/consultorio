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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de reportes</title>
</head>

<body>
    <div class="contenedor">
        <?php require ("./layout/menu.php"); ?>
        <div class="content-index">
        <label class="span-2">Centro de reportes</label>
            <div class="reportes-consulta">
                <h2>Consultas médicas</h2>
            </div>
            <div class="reportes-medicamento">
                <h2>Medicamentos</h2>
            </div>
            <div class="reportes-enfermedades">
                <h2>Enfermedades</h2>
            </div>
            <div class="reportes-terapias">
                <h2>terapias</h2>
            </div>
        </div>
        <?php require ("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
</body>

</html>
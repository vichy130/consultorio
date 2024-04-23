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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="contenedor">
        <?php require ("./layout/menu.php"); ?>
        <div class="content-reportes">
            <label class="span-2 centrar">Centro de reportes</label>
            <div class="reportes-consultas">
                <div class="grid-reportes">
                    <select class="form_input-reportes" name="consultas" id="select-consultas">
                        <option value="ultimo mes">Último mes</option>
                        <option value="ultimos tres meses">Últimos seis meses</option>
                        <option value="ultimo año">Último año</option>
                    </select>
                    <i class="icono-reportes fa-regular fa-file-pdf"></i>
                </div>
                <canvas id="chart-consultas"></canvas>
            </div>
            <div class="reportes-medicamentos">
                <div class="grid-reportes">
                    <select class="form_input-reportes" name="medicamentos" id="select-medicamentos">
                        <option value="ultimo mes">Último mes</option>
                        <option value="ultimos tres meses">Últimos tres meses</option>
                        <option value="ultimo año">Último año</option>
                    </select>
                    <i class="icono-reportes fa-regular fa-file-pdf"></i>
                </div>
                <canvas id="chart-medicamentos"></canvas>
            </div>
            <div class="reportes-enfermedades">
                <div class="grid-reportes">
                    <select class="form_input-reportes" name="enfermedades" id="select-enfermedades">
                        <option value="ultimo mes">Último mes</option>
                        <option value="ultimos tres meses">Últimos tres meses</option>
                        <option value="ultimo año">Último año</option>
                    </select>
                    <i class="icono-reportes fa-regular fa-file-pdf"></i>
                </div>
                <canvas id="chart-enfermedades"></canvas>
            </div>
            <div class="reportes-terapias">
                <div class="grid-reportes">
                    <select class="form_input-reportes" name="terapias" id="select-terapias">
                        <option value="ultimo mes">Último mes</option>
                        <option value="ultimos tres meses">Últimos tres meses</option>
                        <option value="ultimo año">Último año</option>
                    </select>
                    <i class="icono-reportes fa-regular fa-file-pdf"></i>
                </div>
                <canvas id="chart-terapias"></canvas>
            </div>
        </div>
        <?php require ("./layout/footer.php"); ?>
    </div>
    <script src="./js/form-reportes.js"></script>
    <!-- end contenedor -->
</body>

</html>
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
                        <option value="0">Último mes</option>
                        <option value="1">Últimos seis meses</option>
                        <option value="2" selected>Último año</option>
                        <option value="3">Todos los registros</option>
                    </select>
                    <i class="icono-reportes cursor fa-regular fa-file-pdf" id="icono-consulta-pdf"></i>
                </div>
                <canvas class="chart-consultas" id="chart-consultas"></canvas>
            </div>
            <div class="reportes-medicamentos">
                <div class="grid-reportes">
                    <select class="form_input-reportes" name="medicamentos" id="select-medicamentos">
                        <option value="tres">Últimos tres meses</option>
                        <option value="ano">Último año</option>
                        <option value="todo" selected>Todos los registros</option>
                        <option value="tipo">Por tipo de medicamento</option>
                    </select>
                    <i class="icono-reportes fa-regular fa-file-pdf"id="icono-medicamento-pdf"></i>
                </div>
                <canvas class="chart" id="chart-medicamentos"></canvas>
            </div>
            <div class="reportes-enfermedades">
                <div class="grid-reportes">
                    <select class="form_input-reportes" name="enfermedades" id="select-enfermedades">
                        <option value="seis">Últimos seis meses</option>
                        <option value="ano">Último año</option>
                        <option value="todo">Todos los registros</option>
                    </select>
                    <i class="icono-reportes fa-regular fa-file-pdf" id="icono-enfermedad-pdf"></i>
                </div>
                <canvas id="chart-enfermedades"></canvas>
            </div>
            <div class="reportes-terapias">
                <div class="grid-reportes">
                    <select class="form_input-reportes" name="terapias" id="select-terapias">
                        <option value="tres">Últimos tres meses</option>
                        <option value="seis">Últimos seis meses</option>
                        <option value="ano">Último año</option>
                        <option value="todo">Todos los registros</option>
                    </select>
                    <i class="icono-reportes fa-regular fa-file-pdf" id="icono-terapia-pdf"></i>
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
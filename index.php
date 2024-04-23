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
    <link rel="stylesheet" href="./css/estilos-index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Aga-Khan</title>
</head>

<body>
    <div class="contenedor">
        <?php require ("./layout/menu.php"); ?>
        <div class="content-index">
            <label class="span-2 rectangulos-flex">Inicio</label>
            <div class="rectangulos-flex">
                <div class="rectangulo backgr-pacientes">
                    <p>Pacientes registrados</p>
                    <h2 class="numero pacientes-registrados" id="pacientes-registrados"></h2>
                    <i class="icono-index fa-solid fa-hospital-user"></i>
                    <div id="boton-agregar-paciente" class="boton-agregar-paciente">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <div class="rectangulos-flex">
                <div class="rectangulo backgr-consultas">
                    <p>Consultas realizadas</p>
                    <h2 class="numero consultas-realizadas" id="consultas-realizadas"></h2>
                    <i class="icono-index fa-solid fa-calendar-check"></i>
                </div>
            </div>
            <div class="rectangulos-flex span-2">
                <div class="rectangulo-med backgr-medicamentos">
                    <p>Medicamentos registrados</p>
                    <div class="contenedor-absoluto">
                        <div class="numero-med">
                            <div class>
                                <p>Nutrientes</p>
                                <h2 class="medicamentos-registrados" id="nutrientes-registrados"></h2>
                            </div>
                            <div>
                                <p>Alopático</p>
                                <h2 class="medicamentos-registrados" id="alopatico-registrados"></h2>
                            </div>
                            <div>
                                <p>Homeopático</p>
                                <h2 class="medicamentos-registrados" id="homeopatico-registrados"></h2>
                            </div>
                        </div>
                    </div>
                    <i class="icono-index fa-solid fa-prescription-bottle-medical"></i>
                    <div id="boton-agregar-medicamento" class="boton-agregar-medicamento">
                        <i class="fa-solid fa-capsules"> +</i>
                    </div>
                </div>
            </div>
        </div> <!-- END DIV CONTENT GRAL -->
        <?php require ("./layout/footer.php"); ?>
    </div> <!-- END contenedor -->
</body>
<script src="./js/form-inicio.js"></script>

</html>
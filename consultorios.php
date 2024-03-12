<?php
session_start(); 

function redirect($url) {
    ob_start();
    header('Location:'.$url);
    ob_end_flush();
    die();
}
if(!isset($_SESSION['username'])){
    redirect("./iniciar-sesion.php");
    exit();
}
unset($_SESSION['id_con']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos-pacientes.css">
    <title>Consultorios</title>
</head>
<body>
    <div class="contenedor">
    <?php require("./layout/menu.php"); ?>
    <div class="content-general">
            <label class="span-4" for="">Consultorios</label>

            <input class="form_input span-2" type="text">
            <button class="boton azul"><i class="fas fa-search"></i> Buscar</button>

            <button class="boton azul" id="boton-nuevo-consultorio"><i class="fas fa-user-plus" ></i> Nuevo
                consultorio</button>
            <table class="table span-4" id="tabla-consultorios">
                <!--<thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Domicilio</th>
                        <th>Telefono</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="tbody-consultorios">
                </tbody>-->
            </table>

    </div>
    <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
    <script src="./js/form-consultorios.js"  ></script>
</body>
</html>
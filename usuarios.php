<?php
session_start();
if (!isset($_SESSION['username'])) {
    redirect("./iniciar-sesion.php");
    exit();
}
unset($_SESSION['id_usuario']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos-pacientes.css">
    <title>Usuarios</title>
</head>

<body>
    <div class="contenedor">
        <?php require("./layout/menu.php"); ?>
        <div class="content-general">

            <label class="span-4">Usuarios</label>

            <input class="form_input span-2" type="text">
            <button class="boton azul" id="boton-buscar"><i class="fas fa-search"></i> Buscar</button>

            <button class="boton azul" id="boton-nuevo-usuario"><i class="fas fa-user-plus"></i> Nuevo
                Usuario</button>
            <table class="table span-4" id="tabla-usuarios">
                <!--<thead>
                    <tr>
                        <th>Usuario</th>
                        <th class="column-to-hide">Nombre</th>
                        <th class="column-to-hide">Telefono</th>
                        <th class="column-to-hide">Email</th>
                        <th>Tipo de usuario</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>-->
            </table>
        </div>
        <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
    <script src="./js/form-usuarios.js"></script>
</body>
</html>
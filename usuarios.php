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
require("./php/conexion.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>

<body>
    <div class="contenedor">
        <?php require("./layout/menu.php"); ?>
        <div class="content-general">

            <label class="span-4">Usuarios</label>

            <input class="form_input span-2" type="text">
            <button class="boton azul"><i class="fas fa-search"></i> Buscar</button>

            <button class="boton azul" onClick="redirectNuevoPaciente()"><i class="fas fa-user-plus"></i> Nuevo
                Usuario</button>
            <table class="table span-4">
                <thead>
                    <tr>
                        <th>Nombre(s)</th>
                        <th>Apellido paterno</th>
                        <th class="column-to-hide">Apellido materno</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $stat= $dbh-> prepare ("select nombre, apellidoPaterno, apellidoMaterno from paciente; ");
                    $stat->execute();
                    while($datosPaciente=$stat->fetch(PDO::FETCH_OBJ)){
                    ?>
                    <tr>
                        <td><?php echo $datosPaciente->nombre;?></td>
                        <td><?php echo $datosPaciente->apellidoPaterno;?></td>
                        <td class="column-to-hide"><?php echo $datosPaciente->apellidoMaterno;?></td>
                        <td><a href="./pacientes-informacion.php">ver/modificar</a></td>
                        <td><i class="fas fa-trash"></i></td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php require("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
</body>

</html>
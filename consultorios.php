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
// }else{
//     if($_SESSION['tipoUsuario']!="S"){
//         redirect("./index.php");
//         exit();
//     }
// }
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
        <?php require ("./layout/menu.php"); ?>
        <div class="content-general">

            <div id="modal" class="modal">
                <div id="modal-contenido" class="modal-contenido">
                    <span class="cerrar-modal" id="cerrarModal">&times;</span>
                </div>
            </div>
            <label class="span-4" for="">Consultorios</label>

            <div class="formulario_grupo span-2">
                <div class="form_grupo-input">
                    <input class="form_input" type="text" id="input-buscar">
                    <i id="icono-buscar" class="form_validacion-buscar fa-solid fa-xmark"></i>
                </div>
            </div>
            <button class="boton azul" id="boton-buscar-consultorio"><i class="fas fa-search"></i> Buscar</button>
            <div class="div-boton">
                <button class="boton azul" id="boton-nuevo-consultorio"><i class="fas fa-user-plus"></i> Nuevo
                    consultorio</button>
            </div>
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
            <div id="no-tabla"></div>
        </div>
        <?php require ("./layout/footer.php"); ?>
    </div>
    <!-- end contenedor -->
    <script src="./js/form-consultorios.js"></script>
</body>

</html>
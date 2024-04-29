<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos-content-informacion.css">
</head>

<body>
    <div class="content-informacion">
        <div class="icono-paciente">
            <img id="imagen-sexo" class="imagen-sexo" src="" alt="">
        </div>
        <div class="nombre-content-informacion">
            <label class="derecha" name="nombre" id="nombre-content"></label>
        </div>
        <div class="iconos-content-informacion">
            <i class="fas fa-birthday-cake"></i>
            <i class="fas fa-phone-alt"></i>
            <i class="fas fa-venus-mars"></i>
            <i class="fas fa-tint"></i>
        </div>
        <div class="datos-content-informacion">
            <label class="cumpleanos-content" name="cumpleanos-content" id="cumpleanos-content"> </label>
            <label class="telefono-content" name="telefono-content" id="telefono-content"> </label>
            <label class="genero-content" name="genero-content" id="genero-content"> </label>
            <label class="tipo-sangre-content" name="tipo-sangre-content" id="tipo-sangre-content"> </label>
        </div>
        <button class="boton-nueva-consulta span-2" id="boton-nueva-content"><i class="fas fa-plus"></i>Nueva
            consulta</button>
            <div id="enfermedades-content" class="span-2 cuadro antecedentes">
                <!-- <h4>Enfermedades del paciente:</h4> -->
            </div>
        <div id="consultas-content" class="span-2 cuadro consultas-anteriores">
            <!-- <h4>Consultas:</h4> -->
        </div>
    </div>
    <script src="./js/form-content-informacion.js"></script>
</body>

</html>
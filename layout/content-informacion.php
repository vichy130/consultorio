<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="content-informacion">
        <script> console.log("esto es JS en content form");</script>
        <div class="icono-paciente">
            <i class="fas fa-user-circle"></i>
        </div>
        <div class="nombre-content-informacion">
            <label class="derecha" name="nombre" id="nombre-content">Nombre</label>
        </div>
        <div class="iconos-content-informacion">
            <i class="fas fa-birthday-cake"></i>
            <i class="fas fa-phone-alt"></i>
            <i class="fas fa-venus-mars"></i>
            <i class="fas fa-tint"></i>
        </div>
        <div class="datos-content-informacion">
            <label class="cumpleanos-content" name="cumpleanos-content" id="cumpleanos-content"></label>
            <label class="telefono-content" name="telefono-content" id="telefono-content"></label>
            <label class="genero-content" name="genero-content" id="genero-content"></label>
            <label class="tipo-sangre-content" name="tipo-sangre-content" id="tipo-sangre-content"></label>
        </div>
        <button class="boton-nueva-consulta span-2" onClick="redirectNuevaConsulta()"><i class="fas fa-plus"></i>Nueva
            consulta</button>
        <div class="antecedentes-content-informacion span-2">
            <label class="antecedentes-patologicos-content" name="antecedentes-patologicos-content"
                id="antecedentes-patologicos-content">Antecedentes Patólogicos</label>
            <label class="enfermedad-content" id="enfermedad-content"></label>
            <label class="descripcion-content" id="descripcion-content"></label>

        </div>
        <div class="consultas-content-informacion span-2">
            <label class="consultasAnteriores-content" name="consultasAnteriores-content"
                id="consultasAnteriores-content">Consultas Anteriores</label>
        </div>
    </div>
    <script src="./js/botones.js"></script>
    <script src="./js/form-content-informacion.js"></script>
</body>

</html>

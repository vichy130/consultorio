<?php
// Un ejemplo de array en PHP
$datos = array(
    'nombre' => 'Juan',
    'edad' => 30,
    'ciudad' => 'Ejemploville',
);

// Codifica el array en formato JSON
$datos_json = json_encode($datos);

// Configura las cabeceras para indicar que estás enviando JSON
header('Content-Type: application/json');

// Envía los datos JSON como respuesta
echo $datos_json;
?>

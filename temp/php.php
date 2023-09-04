<?php
// Recibe los datos JSON del cliente
$data = json_decode(file_get_contents('php://input'));

if ($data) {
  // Haz lo que necesites con los datos, por ejemplo, imprimirlos
  foreach ($data as $objeto) {
    echo 'Nombre: ' . $objeto->nombre . ', Edad: ' . $objeto->edad . '<br>';
  }
} else {
  echo 'No se recibieron datos JSON.';
}
?>

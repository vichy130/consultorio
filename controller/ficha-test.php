<?php
// Recibe los datos JSON del cliente
$data = json_decode(file_get_contents('php://input'));
echo $data;
if ($data) {
  foreach ($data as $objeto) {
    echo 'hijo-sexo: ' . $objeto->_sexo . ', hijo-edad: ' . $objeto->_edad. '<br>';
  }
} else {
  echo 'No se recibieron datos JSON.';
}


?>
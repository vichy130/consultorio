<?php


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Datos del formulario
        
        $tipoSangre = $_POST['tipo-sangre'];
      
        // Datos JSON
        $jsonData = $_POST['json_data'];
        $data = json_decode($jsonData);
      
        $data=  json_encode($data);

        echo "PHP DATA  ".$data;
        echo "PHP ".$tipoSangre;

    }
      
?>
<?php
    include_once("../models/ficha-clinica.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Datos del formulario
        
        $tipoSangre = $_POST['tipo-sangre'];
      
        // Datos JSON
        $jsonHijos = $_POST['json_hijos'];
        $hijos = json_decode($jsonHijos);

        foreach ($hijos as $hijo){
            echo $hijo->_sexo;
            echo $hijo->_edad;
        }

        echo "PHP ".$tipoSangre; 
    }

    $ficha = new ficha();
    if($ficha->insertar()==1){
        echo "Ficha registrada";
      
      }else{
          echo "Error al registrar, intentalo nuevamente";
      }
      
?>
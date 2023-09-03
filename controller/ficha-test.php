<?php
    include_once("../models/hijo.php");

    $hijo =new hijo();



    $hijo->id  = null;
    $hijo->sexo="Mujer";
    $hijo->edad="30";
    $hijo->ficha  = null;


    echo $hijo->sexo;
    echo intval($hijo->edad);
    
    if($hijo->insertar()==1){
    echo "Hijo registrado";
    }else{
        echo "Error al registrar, intentalo nuevamente";
    }


    ?>
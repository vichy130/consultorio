<?php
session_start();
include_once("../models/consultorio.php");
try {
    $json = json_decode(file_get_contents('php://input'), true);
    if (isset($json['id'])) {
        $id = $json['id'];
        $consultorio = new Consultorio();
        $consultorio->setId($id);
        if ($consultorio->eliminar()) {
            return true;
        } else {
            return false;
        }
    }
}catch(PDOException $e){
    echo "ERROR al eliminar consultorio".$e->getMessage();
}
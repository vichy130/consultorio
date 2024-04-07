<?php
session_start();
include_once("../models/consulta.php");
try {
    $json = json_decode(file_get_contents('php://input'), true);
    if (isset($json['id'])) {
        $id = $json['id'];
        $consulta = new Consulta();
        $consulta->setId($id);
        if ($consulta->eliminar()) {
            echo "true";
        } else {
            echo "false";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    echo "false";
}
?>
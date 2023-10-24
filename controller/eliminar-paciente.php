<?php
session_start();
include_once("../models/paciente.php");
try {
    $json = json_decode(file_get_contents('php://input'), true);
    if (isset($json['id'])) {
        $id = $json['id'];
        $paciente = new Paciente();
        $paciente->setId($id);
        if ($paciente->eliminar()) {
            echo "1";
        } else {
            echo "0";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    echo "0";
}
?>
<?php
session_start();
if (isset($_REQUEST['id'])){
    $_SESSION['id_med']=$_REQUEST['id'];
}
include_once("../models/medicamento.php");
try {
    $json = json_decode(file_get_contents('php://input'), true);
    if (isset($json['id'])) {
        $id = $json['id'];
        $medicamento = new Medicamento();
        $medicamento->setId($id);
        if ($medicamento->eliminar()) {
            return true;
        } else {
            return false;
        }
    }
} catch (Exception $e) {
    echo "Error: No se pudo eliminar Medicamento (PHP)" . $e->getMessage();
    return false;
}
?>
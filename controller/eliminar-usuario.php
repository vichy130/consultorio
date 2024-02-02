<?php
session_start();

include_once("../models/usuario.php");
try {
    $json = json_decode(file_get_contents('php://input'), true);
    if (isset($json['id'])) {
        $username= $json['id'];
        $usuario = new Usuario();
        $usuario->setUsername($username);
        if ($usuario->eliminar()) {
            return true;
        } else {
            return false;
        }
    }
} catch (Exception $e) {
    echo "Error: No se pudo eliminar usuario" . $e->getMessage();
    return false;
}
?>
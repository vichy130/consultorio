<?php
session_start(); 
include "../php/conexion.php";

function redirect($url) {
    ob_start();
    header('Location:'.$url);
    ob_end_flush();
    die();
}
$username = $_POST['username'];
$contrasena = $_POST['contrasena'];

if ($dbh != null) {
    $stat = $dbh->prepare(" select username, nombre, apellidoPaterno, contrasena from usuario where
     username=:username and contrasena=:contrasena; ");
   

    $stat->bindParam(':username', $username);
    $stat->bindParam(':contrasena', $contrasena);
    $stat->setFetchMode(PDO::FETCH_ASSOC);
    $stat->execute();
    $datos = $stat->fetch();

    if ($datos!= NULL) {
        $_SESSION['username'] = $datos['username'];
        $_SESSION['nombre'] = $datos['nombre'];
        $_SESSION['apellidoPaterno'] = $datos['apellidoPaterno'];
        $_SESSION['contrasena'] = $datos['contrasena'];

        echo  $_SESSION['username'];
        echo $_SESSION['nombre'];

        redirect("../index.php");
        exit();
    } else {

        redirect("../iniciar-sesion.php");
        exit();
    }
    $dbh = null;
} else {

    redirect("../iniciar-sesion.php");
}

?>
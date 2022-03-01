<?php

//$dbname="proye200_consultorio";
//$user="proye200_admin";
//$password="Vacunacion12.";
$dbname="consultorio";
$user="root";
$password="";
$options=array(
PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES 'utf8mb4'",
PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_OBJ);

try{
    $dsn="mysql:host=localhost; dbname=$dbname";
    $dbh= new PDO($dsn, $user, $password, $options);
    
}catch (PDOException $e){
    echo $e->getMessage();
}

?>
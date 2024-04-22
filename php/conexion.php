<?php

// private $dbname="agakhanc_consultorio";
// private $user="agakhanc_regular";
// private $password="ZMmWoZ.5kRAS";
$dbname="consultorio";
// $_ENV['dbname']=
$user="root";
$password="";
$options=array(
PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES 'utf8mb4'",
PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_OBJ);
$dbh=null;
try{
    $dsn="mysql:host=localhost; dbname=$dbname";
    $dbh= new PDO($dsn, $user, $password, $options);
    
}catch (PDOException $e){
    echo $e->getMessage();
}

?>
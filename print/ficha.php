<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once ("../models/conexion.php");
include_once ("../models/hijo.php");
include_once ("../models/antecedente-paciente.php");
include_once ("../models/antecedente-familia.php");

include '../print/models/Ficha.php';

$ficha = new Ficha();
$ficha->AddPage('P','Letter');
$ficha->AliasNbPages();
$ficha->cuerpo();
$ficha->Output();
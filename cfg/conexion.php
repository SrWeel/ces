<?php

/*$host="10.1.13.138";
$user='USR_PRE_FOR_MED';
$pass='forumpri';
$dbname='FORMULARIO_MEDIACION';
$tipobase='mysql';
$DB_gogess = DatabaseLayer::getConnection("AdodbPhp",$host,$user,$pass,$dbname,$tipobase); 
*/


$host = "192.168.100.50";
//$user = 'remote-user';
//$pass = 'Remote@CesDB.2025';
$user = 'root';
$pass = 'R003@CesDB.2025';
$dbname = 'cesdb_aroriginal';
$tipobase = 'mysqli';
$DB_gogess = DatabaseLayer::getConnection("AdodbPhp", $host, $user, $pass, $dbname, $tipobase);

$hora_ini = '07:00';
$rango_hora = 15;
$hora_fin = '19:00';

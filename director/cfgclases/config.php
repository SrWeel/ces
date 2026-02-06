<?php
//Mysql
//$dsn = "postgres://postgres:123456@localhost/sigepdb";
//$DB_gogess->debug = true;

//$DB_gogess = &ADONewConnection($dsn);
$host = "192.168.100.50";
//$user = 'remote-user';
//$pass = 'Remote@CesDB.2025';
$user = 'root';
$pass = 'R003@CesDB.2025';
$dbname = 'cesdb_aroriginal';

$DB_gogess = NewADOConnection('mysqli');
$DB_gogess->Connect($host, $user, $pass, $dbname);
$DB_gogess->SetCharSet('utf8');
//$DB_gogess->debug=true;
//Path editor
$ptaeditor = "/ces/director/";

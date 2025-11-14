<?php



//Mysql

//$dsn = "postgres://postgres:123456@localhost/sigepdb";

 //$DB_gogess->debug = true;

//$DB_gogess = &ADONewConnection($dsn);
$host="localhost";
$user='domohsco_domohs';
$pass='Facj2017.';
$dbname='domohsco_domohsdb';


$DB_gogess = NewADOConnection('mysql');

$DB_gogess->Connect($host,$user,$pass, $dbname);

//$DB_gogess->debug=true;

//Path editor

$ptaeditor="/domohs/adm_domohs/";



?>


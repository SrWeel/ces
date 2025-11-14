<?php
/*
################################################################
#	Coneccion a la base de datos
#
################################################################
*/

$DB_gogess = ADONewConnection('odbc_mssql');
$dsn = "Driver={SQL Server};Server=ETERNO\SQLEXPRESS;Database=sydedb;";

//$DB_gogess->debug=true;
//$DB_gogess->Connect('Eterno-PC\SQLEXPRESS','sa','cjt2013','sydedb');

$DB_gogess->Connect($dsn, 'sa', 'cjt2013');
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;	


?>
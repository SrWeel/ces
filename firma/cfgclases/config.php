<?php
//mysql
$DB_gogess = NewADOConnection('mysqli');
$DB_gogess->Connect("localhost", "root", "", "medicdnsdb");

 


//sqlserver
//$DB_gogess =& ADONewConnection('odbc_mssql');
//$dsn = "Driver={SQL Server};Server=HP\SQLEXPRESS;Database=fakturasdb;";
//$DB_gogess->Connect($dsn,'sa','fa2013')or die("Unable to connect to server");
//$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;	
?>
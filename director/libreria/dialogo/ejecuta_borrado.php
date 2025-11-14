<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
ini_set("session.gc_maxlifetime","14400");
session_start();

$table=$_POST["ptabla"];
//Llamando objetos
$director="../../";
include("../../cfgclases/clases.php");
//echo $_POST["ptabla"];
//echo base64_decode($_POST["paraborra"]);
if($_POST["paraborra"])
{
$delete_sql="delete from ".$table." where ".base64_decode($_POST["paraborra"]);

$ok=$DB_gogess->Execute($delete_sql);
	if($ok)
	{
	  echo " var result_borrado = '1'; ";
	  
	}
	else
	{
	  echo " var result_borrado = '0'; ";
	  

	}
	
}




?>
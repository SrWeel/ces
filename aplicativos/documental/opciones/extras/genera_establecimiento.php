<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);

if($_POST["pemision_id"])
{
	$_SESSION['ces1313777_pemision_id']=$_POST["pemision_id"];
	$_SESSION['ces1313777_pestab_id']=$_POST["pestab_id"];
}
?>
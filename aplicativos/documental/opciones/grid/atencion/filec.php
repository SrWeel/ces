<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444456000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$lista_tablaspop="select * from api_consentimientoi where conset_id='".$_POST["conset_id"]."'";
$rs_tablastop = $DB_gogess->executec($lista_tablaspop,array());
$archiv_data=$rs_tablastop->fields["conset_archivo"];
$conset_nombre=$rs_tablastop->fields["conset_nombre"];
?>

<a href="archivo/<?php echo $archiv_data; ?>" target="_blank"><?php echo $conset_nombre; ?>&nbsp;<img src="archivo/file.png" width="20px" ><span class="selected"></span></a>

<?php

}


?>
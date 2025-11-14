<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(isset($_SESSION['sessidadm_frank']))
{
//Llamando objetos
$director="../../";
include("../../cfgclases/clases.php");
//agregatablas

?>
<?php

//echo $_POST["rptenlc_id"]."<br>";
//echo $_POST["campoa"]."<br>";
//echo $_POST["campob"]."<br>";

$actualizacampos="update sth_reportenlaces set rptenlc_campoa='".$_POST["campoa"]."',rptenlc_campob='".$_POST["campob"]."' where rptenlc_id=".$_POST["rptenlc_id"];
//echo $actualizacampos;
$resulokAC = $DB_gogess->Execute($actualizacampos);


?>
<?php
}
else
{
echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000'><b>A caducado la sesi&oacute;n vuelva a ingresar al sistema presione F5</b></div>";

}		
?>
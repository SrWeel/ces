<?php
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(isset($_SESSION['sessidadm1777_pichincha']))
{

$director="../../";
include("../../cfgclases/clases.php");


//echo $_POST["vardev_id"];
//echo $_POST["textarea_op"];
$txt_op='';
$txt_op=str_replace("'","\'",$_POST["textarea_op"]);

$actualizar="update sth_vddetalle set vardevdet_campo='".$_POST["nfield"]."',vardevdet_operation='".$txt_op."' where vardevdet_id=".$_POST["vardevdet_id"];
  
$DB_gogess->Execute($actualizar);



}
?>
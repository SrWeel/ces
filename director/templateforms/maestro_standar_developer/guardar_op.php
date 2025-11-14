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

$insertdata="insert into sth_vddetalle (vardev_id,vardevdet_tabla,vardevdet_campo,vardevdet_operation) values (".$_POST["vardev_id"].",'','".$_POST["nfield"]."','".$txt_op."')";
  
$DB_gogess->Execute($insertdata);



}
?>
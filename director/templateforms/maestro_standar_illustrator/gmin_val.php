<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(isset($_SESSION['sessidadm1777_pichincha']))
{
$director="../../";
include("../../cfgclases/clases.php");

 $actualiza_title="update rose_graph set graph_min='".$_POST["valor"]."' where graph_id=".$_POST["graph_id"];
 $ok_g= $DB_gogess->Execute($actualiza_title);

}

?>
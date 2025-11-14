<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime","460000");
ini_set("session.gc_maxlifetime","460000");
session_start();
$director="../adm_alianzanorte/";
include ("../adm_alianzanorte/cfgclases/clases.php");
  
@$_SESSION['formularioweb_ac']=0;
if(@$_SESSION['formularioweb_asite_id'])
{
   $inv_id=$_POST["inv_id"];
   $asite_id=$_POST["asite_id"];
   $campo=$_POST["campo"];
   $tabla=$_POST["tabla"];
   $valor=$_POST["valor"];
   
   $update_campo="update app_invitados set ".$campo."='".$valor."' where inv_id='".$inv_id."'";
   $rs_campoupdate = $DB_gogess->Execute($update_campo);

}
?>

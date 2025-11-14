<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime","36000");
ini_set("session.gc_maxlifetime","36000");
session_start();

if(@$_SESSION['formularioweb_asite_id'])
{
   $director="../adm_alianzanorte/";
   include ("../adm_alianzanorte/cfgclases/clases.php");
   
   $fecha_rserva=$_POST["fecha_rserva"];
   $even_id=$_POST["even_id"];
   $asite_id=$_POST["asite_id"];

   $borrar_reserva="delete from  app_reservas where asite_id='".$asite_id."' and reserv_fecha='".$fecha_rserva."' and even_id='".$even_id."'";
   $rs_br = $DB_gogess->Execute($borrar_reserva);
  
}
?>
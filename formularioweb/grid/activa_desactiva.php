<?php
ini_set("session.gc_maxlifetime","36000");
session_start();
//echo $_POST["pVar1"];
//Llamando objetos
if(@$_SESSION['formularioweb_usua_id'])
{
$director="../../adm_alianzanorte/";
include ("../../adm_alianzanorte/cfgclases/clases.php");

$fecha_hoy=date("Y-m-d");

$fecha_hoy=$_POST["fecha_reg"];
 
$hora_hoy=date("H:i:s");
  $asis_asiste=0;

$busca_si="select * from app_asistencia where  clie_id=".$_POST["clie_id"]." and asis_fecharegistro='".$fecha_hoy."' and even_id='".$_POST["even_id"]."'";
$rs_siesta = $DB_gogess->Execute($busca_si);
  if($rs_siesta)
			{
			   $asialu_id=$rs_siesta->fields["asis_id"];
			   $asis_asiste=$rs_siesta->fields["asis_asiste"];
			
			}
  

$estado_nuevo=0;
if($asis_asiste==1)
{
$estado_nuevo=0;
}
else
{
$estado_nuevo=1;
}

if($asialu_id)
{
 $actualiza_id="update app_asistencia set asis_asiste='".$estado_nuevo."',asis_fecharegistro='".$fecha_hoy."' where asis_id=".$asialu_id;
 $ok_asis = $DB_gogess->Execute($actualiza_id);
}
else
{
$inserta_asis="insert into  app_asistencia (clie_id,asis_asiste,asis_fecharegistro,asis_fechahora,even_id) values ('".$_POST["clie_id"]."',1,'".$fecha_hoy."','".$hora_hoy."','".$_POST["even_id"]."')";
$ok_asis = $DB_gogess->Execute($inserta_asis);

}
  


$busca_plan1="select * from app_asistencia where clie_id=".$_POST["clie_id"]." and asis_fecharegistro='".$fecha_hoy."' and even_id='".$_POST["even_id"]."'";
$rs_plan1 = $DB_gogess->Execute($busca_plan1);
if($rs_plan1->fields["asis_asiste"]==1)
{
echo '<img src="images/on.png" >';
}
else
{
echo '<img src="images/off.png" >';
}




}
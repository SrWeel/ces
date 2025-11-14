<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_POST["usr_cedulax"])
{

if($_SESSION['ces1313777_sessid_inicio'])
{
//---------------------------------------------------
//echo $_POST["pVar1"];
//Llamando objetos
$director="../../../../";
include ("../../../../cfgclases/clases.php");

$objperfil->usuarios_perfil($_SESSION['ces1313777_sessid_cedula'],$_SESSION['idmen'],$DB_gogess);
// echo $_POST["itmenap_idx"]."<br>";
 //echo $_POST["activox"]."<br>";
 //echo $_POST["makerx"]."<br>";
 //echo $_POST["checkerx"]."<br>";
// echo $_POST["usr_cedulax"]."<br>";
 
 
 if($_POST["activox"]=='true')
 {
    $activox_val=1;
 
 }
 else
 {
    $activox_val=0;
 
 }
 
 

 
 if($_POST["activardatax"]=='1')
 {
    $makerx_val=1;
	$checkerx_val=0;
	$consultax_val=0;
    $desactivarx_val=0;
 }

 if($_POST["activardatax"]=='2')
 {
    $makerx_val=0;
	$checkerx_val=1;
	$consultax_val=0;
	$desactivarx_val=0;
 
 }
 
  if($_POST["activardatax"]=='3')
 {
    $makerx_val=0;
	$checkerx_val=0;
	$consultax_val=1;
	$desactivarx_val=0;
 
 }
 
 
  if($_POST["activardatax"]=='4')
 {
    $makerx_val=0;
	$checkerx_val=0;
	$consultax_val=0;
	$desactivarx_val=1;
 
 }
 
 
 $banderaexiste=0;
$listalinkstr="select * from spag_usuarios_perfil where usr_cedula='".$_POST["usr_cedulax"]."' and perusu_codobj=".$_POST["itmenap_idx"];
	
	$resultadolktr = $DB_gogess->Execute($listalinkstr);	
	if($resultadolktr)
	{  
      while (!$resultadolktr->EOF) {
	  
	  $banderaexiste=1;
	  
	  $resultadolktr->MoveNext();
	  }
	 } 

if($banderaexiste)
{
   
     if($objperfil->estado_maker==1)
				{
   $actualiza="update spag_usuarios_perfil set perusu_activo='".$activox_val."',perusu_maker='".$makerx_val."',perusu_checker='".$checkerx_val."', perusu_consulta='".$consultax_val."',perusu_desactivar='".$desactivarx_val."' where usr_cedula='".$_POST["usr_cedulax"]."' and perusu_codobj=".$_POST["itmenap_idx"];  
   $okval = $DB_gogess->Execute($actualiza);
   
   }
   
     if($objperfil->estado_checker==1)
				{
				$actualiza="update spag_usuarios_perfil set perusu_activo='".$activox_val."' where usr_cedula='".$_POST["usr_cedulax"]."' and perusu_codobj=".$_POST["itmenap_idx"];  
   $okval = $DB_gogess->Execute($actualiza);
				
				}
   
   
}
else
{
   $actualiza="insert into spag_usuarios_perfil (usr_cedula,perusu_codobj,perusu_activo,perusu_maker,perusu_checker,perusu_consulta,perusu_desactivar) values ('".$_POST["usr_cedulax"]."','".$_POST["itmenap_idx"]."','".$activox_val."','".$makerx_val."','".$checkerx_val."','".$consultax_val."','".$desactivarx_val."')";
   $okval = $DB_gogess->Execute($actualiza);  
   
}


//$actualiza_usuario="update factur_usuarios set usr_usuarioactiva=".$_SESSION['ces1313777_sessid_inicio'].", usr_activo='' where usr_cedula=".$_POST["usr_cedulax"];
//$ok3=$DB_gogess->Execute($actualiza_usuario);

//---------------------------------------------------
}
else
{
 echo '<div style="font-family:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000">Sesi&oacute;n de usuario ha terminado porfavor de clic en F5 para continuar...</div>';
}

}
?>
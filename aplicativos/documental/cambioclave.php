<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$usarioencontrado='';
$busca_usuario="select * from app_usuario where usua_id=? and usua_clave=?";

$rs_generafrm = $DB_gogess->executec($busca_usuario,array($_POST["id_valor"],md5($_POST["clave_old"])));

 
	  if ($rs_generafrm)
	  { 
	  
	     while (!$rs_generafrm->EOF) {
		 
		 $usarioencontrado=$rs_generafrm->fields["usua_id"];
		 
		 
		 $rs_generafrm->MoveNext();
		 
		 }
	  }
	  

if($usarioencontrado==$_SESSION['ces1313777_sessid_inicio'])
{
 
  /////////////////
 
 
$valida1=1;
$valida2=1;
$valida3=1;
$valida4=1;
$valida5=1;

 if (!preg_match('`[A-Z]`',$_POST["clave_nueva"])){
      
        
	  //$valida1=0;
	  
   }
  
  if (!preg_match('`[0-9]`',$_POST["clave_nueva"])){
     
    //  $valida2=0;
   } 
   
   

  


   $longitud=strlen($_POST["clave_nueva"]);
   
   if(!($longitud>=8 and $longitud<=16))
   {
       $valida4=0;
   }
   
   //buscaclaveya usada
  /* $buscaclaveyausada="select * from app_controlclv where clvc_encriptado=md5('".$_POST["clave_nueva"]."')";
   $rs_buscaclv = $DB_gogess->Execute($buscaclaveyausada);
    if ($rs_buscaclv)
	  { 	  
	     while (!$rs_buscaclv->EOF) {		 
		
		 $valida5=0;		 
		 
		 $rs_buscaclv->MoveNext();		 
		 }
	  }*/
   //buscaclaveya usada
   
   
   $verifcatdo=$valida1*$valida2*$valida4*$valida5;
   
   if(!($verifcatdo))
   {
   
   
  echo '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;" >La clave debe tener las siguientes caracteristicas: m&iacutenimo 8 caracteres...</span>';
  
  echo '<input name="exito_val" type="hidden" id="exito_val" value="0" />';
		 
  
  }
  else
  {
           $fechahoy_valor=date("Y-m-d H:i:s");
		
		////////////////////
		  $actualizaclave="update app_usuario set usua_fecha_cambioclv=?,usua_clave=? where  usua_id=?";  
		  $rs_ok = $DB_gogess->executec($actualizaclave,array($fechahoy_valor,md5($_POST["clave_nueva"]),$_POST["id_valor"]));
		  
		  if($rs_ok)
		  {
		  echo '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Cambio de clave realizado con exito...<br>El sistema se finalizara para actualizar su clave...</span>';
		   echo '<input name="exito_val" type="hidden" id="exito_val" value="1" />';
		  //---------------crea registro cambio
		 /* 
		  $cambiaclv="insert into app_controlclv (usua_id,clvc_encriptado,clvc_fecha) values('".$_POST["id_valor"]."','".md5($_POST["clave_nueva"])."','".$fechahoy_valor."')";
		  $rs_okc = $DB_gogess->Execute($cambiaclv);
		  */
		  //---------------crea registro cambio
		  session_destroy();
		  
		  }
		  else
		  {
		   echo '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;" >Error: Por favor intente mas tarde...</span>';		            echo '<input name="exito_val" type="hidden" id="exito_val" value="0" />';
		  }
		
  
  }
  
  
}
else
{
  echo '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;" >Clave anterior incorrecta...</span>';
   echo '<input name="exito_val" type="hidden" id="exito_val" value="0" />';
}


//echo $_POST["clave_nueva"]."<br>";
//echo $_POST["re_clave_nueva"]."<br>";


}
?>
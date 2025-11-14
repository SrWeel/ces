<style type="text/css">
<!--
.accesstl1 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #003366;
}
-->
</style>

<?php

  /////////////////////////////////////////////////////////
  $sisusu=$q;
  $pwdusu=$q1;
   $objacceso_system->tablaingreso="guia_cliente";
   $objacceso_system->usuariog="cli_email";
   $objacceso_system->claveg="cli_clave";			
   $objacceso_system->nombreg="cli_nombre";			
   $objacceso_system->cedulag="guia_codes";
   $objacceso_system->idclienteg="cli_id";	
   
   $objacceso_system->acept_session($sisusu,$pwdusu);    
   $sessid=$objacceso_session->create_session($objacceso_system->user,$objacceso_system->pass,     		   $objacceso_system->name,$objacceso_system->idg,$objacceso_system->idcliente);

   if ($objacceso_system->user)
   {
   
	  $_SESSION['vir_ususer']=$objacceso_system->user;
	  $_SESSION['vir_pwd']=$objacceso_system->pass;
	  $_SESSION['vir_name']=$objacceso_system->name;	
      $_SESSION['idg']=$objacceso_system->idg;	
	  $_SESSION['vir_ci']=$objacceso_system->ci;	
	  $_SESSION['vir_idcliente']=$objacceso_system->idcliente;
	  $_SESSION['vir_sessid']=$sessid;
	  $entrando=1;
      echo  "<span class=titulohome>Espere un momento por favor...</span>";
	 echo '<form id="accfin" name="accfin" method="post" action="">
  <input name="vfaca" type="hidden" id="vfaca" value="'.$sessid.'" />
</form>';
   }
   else
   {
      $mensaje="Usuario no existe...o verifique su cuenta y clave";
	  include("ing1.php");     
   }   
   
 /////////////////////////////////////////////////////////////  
?>



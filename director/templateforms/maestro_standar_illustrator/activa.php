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
/*SACAR GRID*/
   
  $veractual="select graph_activo from rose_graph where graph_id=".$_POST["id"];
  $result_veractual = $DB_gogess->Execute($veractual);	
  $estaod_ac=0;
  if($result_veractual->fields["graph_activo"]==1)
  {
	  
	  $estaod_ac=0;
  }
  else
  {
	  
	  $estaod_ac=1;
  }

  

  $borra_reg="update rose_graph set graph_activo=".$estaod_ac." where graph_id=".$_POST["id"];
  $result_data = $DB_gogess->Execute($borra_reg);	


  if($estaod_ac==0)
	 {
		 
		 $estado_g='<img src="images/check_off.png" width="32" height="32">';
		 
		 
	 }
	 else
	 {
		  $estado_g='<img src="images/check_on.png" width="32" height="32">';
	 }


     echo $estado_g;
}
?>
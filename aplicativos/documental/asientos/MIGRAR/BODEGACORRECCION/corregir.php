<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$acfi_id=$_POST["valor_id"];

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$cuadrobm_id=277;

$saca_precios="SELECT *,dns_temporaldespacho.moviin_id as asignamovi,dns_principalmovimientoinventario.moviin_id as mb_principal FROM dns_principalmovimientoinventario inner join dns_temporaldespacho on dns_principalmovimientoinventario.tempdsp_id=dns_temporaldespacho.tempdsp_id WHERE dns_principalmovimientoinventario.cuadrobm_id=".$cuadrobm_id." and moviintranscent_id=0 and dns_principalmovimientoinventario.tipom_id=2 and dns_principalmovimientoinventario.tipomov_id in (7,15) ";
$rs_paraentrega = $DB_gogess->executec($saca_precios,array());
  if($rs_paraentrega)
   {
	  while (!$rs_paraentrega->EOF) {	
	  
	      
		  if($rs_paraentrega->fields["moviintranscent_id"]==0)
		  {
		     $actualiz_data="update dns_principalmovimientoinventario set moviin_crr='CRR',moviintranscent_id='".$rs_paraentrega->fields["asignamovi"]."' where moviin_id='".$rs_paraentrega->fields["mb_principal"]."'";
			 $rs_acdata = $DB_gogess->executec($actualiz_data,array()); 
			 
			 echo "Modif:".$rs_paraentrega->fields["mb_principal"]."<br>";
		  
		  }
	   
	   
	   $rs_paraentrega->MoveNext(); 
	  }
	}  


}



		 
?>
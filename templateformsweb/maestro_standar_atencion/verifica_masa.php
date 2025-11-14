<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();


$busca_cliente="select tarterial_id from app_cliente where clie_id=".$_POST["clie_id"];
$rs_cliente = $DB_gogess->executec($busca_cliente,array());
$idten=$rs_cliente->fields["tarterial_id"];


if($idten==7)
{
	
$busca_rangoverif="select * from dns_pesoadultos";
$rs_rangovalor = $DB_gogess->executec($busca_rangoverif,array());
$berifica_estado='';
if($rs_rangovalor)
 {
	  while (!$rs_rangovalor->EOF) {
		  
		  
		  
		  if($_POST["atenc_masacorporal"]>=$rs_rangovalor->fields["padultos_inicio"] and  $_POST["atenc_masacorporal"]<=$rs_rangovalor->fields["padultos_fin"])
	      {
			  if(trim($rs_rangovalor->fields["padultos_nombre"])=='Normal')
				  {
					$berifica_estado='<span style="color:#00CC00" ><b>'.$rs_rangovalor->fields["padultos_nombre"].'</b></span>';  
					}  
			  else
				  {
					$berifica_estado='<span style="color:#FF0000" ><b>'.$rs_rangovalor->fields["padultos_nombre"].'</b></span>'; 
					} 
			   
			  
		  }	  
		  

        $rs_rangovalor->MoveNext();	   
	  }
 }

 
 }

?>
<script language="javascript">
<!--
 $('#atenc_masacorporal_despliegue').html('<?php echo $berifica_estado; ?>');
//-->
</script>

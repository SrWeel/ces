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

$busca_rangoverif="select * from dns_tensionarterial where tarterial_id=".$idten;
$rs_rangovalor = $DB_gogess->executec($busca_rangoverif,array());

$atenc_presionarterial=explode("/",$_POST["atenc_presionarterial"]);
//print_r($atenc_presionarterial);
$sistolico='0';
//echo $rs_rangovalor->fields["tarterial_sisinicio"];

if($atenc_presionarterial[0]<$rs_rangovalor->fields["tarterial_sisinicio"] or $atenc_presionarterial[0]>$rs_rangovalor->fields["tarterial_sisfin"])
	{
		   $sistolico='1';
	}
	
$diastolico='0';
if($atenc_presionarterial[1]<$rs_rangovalor->fields["tarterial_diainicio"] or  $atenc_presionarterial[1]>$rs_rangovalor->fields["tarterial_diafin"])
	{
		   $diastolico='1';
	}	
$totalv=0;	
$totalv=$sistolico+$diastolico;

if($totalv>0)
{	
?>
<script language="javascript">
<!--
 $('#atenc_presionarterial_despliegue').html('<span style="color:#FF0000" ><b>SIGNO ALTERADO</b></span>');
//-->
</script>
<?php
}
else
{	
?>
<script language="javascript">
<!--
 $('#atenc_presionarterial_despliegue').html('<span style="color:#000000" ><b>NORMAL</b></span>');
//-->
</script>
<?php
}	
?>
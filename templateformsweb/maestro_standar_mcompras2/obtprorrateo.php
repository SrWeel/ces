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

$cuadrobm_id=$_POST["cuadrobm_id"];


$ac_data="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
$rs_data = $DB_gogess->executec($ac_data,array());


$unidcb_id=trim($rs_data->fields["unidcb_id"]);
$uniddesgcb_id=trim($rs_data->fields["uniddesgcb_id"]);
$cuadrobm_prorrateo=$rs_data->fields["cuadrobm_prorrateo"];
$cuadrobm_codigoatc=trim($rs_data->fields["cuadrobm_codigoatc"]);

?>
<script type="text/javascript">
<!--
<?php

if($cuadrobm_prorrateo==1)
{
 if($unidcb_id>0 && $uniddesgcb_id>0)
 {
   echo "$('#unid_id').val('".$unidcb_id."');
$('#uniddesg_id').val('".$uniddesgcb_id."'); 
$('#moviin_codigoproveedor').val('".$cuadrobm_codigoatc."'); 
colocar_medidas();
";
 
 }
 else
 {    
	echo 'alert("Alerta!!!...Verificar el porrrateo...")'; 
 }

}
else
{

 echo "$('#unid_id').val('1');
$('#uniddesg_id').val('1'); 
$('#moviin_codigoproveedor').val('".$cuadrobm_codigoatc."'); 

colocar_medidas();
";


}
?>


//  End -->
</script>
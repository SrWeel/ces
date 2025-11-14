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
$doccab_identificacionpaciente=$_POST["doccab_identificacionpaciente"];

if($_SESSION['ces1313777_sessid_inicio'])
{

$busca_clientes="select * from app_cliente where clie_rucci='".$doccab_identificacionpaciente."'";
$rs_clientes = $DB_gogess->executec($busca_clientes,array());


?>
<script type="text/javascript">
<!--

<?php
if($rs_clientes->fields["clie_id"]>0)
{
?>

$('#tippo_id').val('<?php echo $rs_clientes->fields["tippo_id"]; ?>');

showUser_combogconvenio('conve_id',$('#tippo_id').val(),'divconve_id','tippo_id','beko_documentocabecera','',0,0,0,0,0,'<?php echo $rs_clientes->fields["conve_id"]; ?>'); 



<?php
}
else
{
?>
alert("Alerta cliente o cedula incorrecta...");

<?php
}
?>
//  End -->
</script>

<?php

}
?>
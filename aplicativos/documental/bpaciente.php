<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="4445000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$sqltotal="";

$doccab_identificacionpaciente=$_POST["doccab_identificacionpaciente"];

$busca_paciente="select * from app_cliente where clie_rucci='".$doccab_identificacionpaciente."'";
$rs_bpaciente = $DB_gogess->executec($busca_paciente);
if($rs_bpaciente->fields["clie_id"]>0)
{
?>
<script type="text/javascript">
<!--
$('#siguarda_val').val(1);
//  End -->
</script>
<?php
}
else
{
?>
<script type="text/javascript">
<!--
$('#siguarda_val').val(0);
//  End -->
</script>
<?php
}

}

?>
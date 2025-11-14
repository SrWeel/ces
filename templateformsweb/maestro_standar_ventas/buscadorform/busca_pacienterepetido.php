<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$provee_cedula=$_POST["provee_cedula"];
$provee_ruc=$_POST["provee_ruc"];


$obtine_data="select * from app_proveedor where provee_cedula='".$provee_cedula."' or provee_ruc='".$provee_ruc."'";
$rs_obtdata = $DB_gogess->executec($obtine_data,array());

$provee_id=$rs_obtdata->fields["provee_id"];


?>
<script type="text/javascript">
<!--

ver_editformencontrado('<?php echo $provee_id; ?>');

//  End -->
</script>


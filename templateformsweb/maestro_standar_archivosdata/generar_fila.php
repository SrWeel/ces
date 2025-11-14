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
$obj_funciones=new util_funciones();


if($_SESSION['ces1313777_sessid_inicio'])
{

$tiparch_id=$_POST["tiparch_id"];

$busca_fila="select tiparch_fila from cmb_tipoarchivo where tiparch_id='".$tiparch_id."'";
$rs_fila= $DB_gogess->executec($busca_fila,array());

}

?>
<script type="text/javascript">
<!--

$('#archdt_fila').val('<?php echo $rs_fila->fields["tiparch_fila"]; ?>');

//  End -->
</script>

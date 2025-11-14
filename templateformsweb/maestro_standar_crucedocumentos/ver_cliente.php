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
$client_id=$_POST["client_id"];

if($_SESSION['ces1313777_sessid_inicio'])
{

$busca_clientes="select * from efacfactura_cliente where client_id='".$client_id."'";
$rs_clientes = $DB_gogess->executec($busca_clientes,array());

?>
<script type="text/javascript">
<!--

$('#tipoident_codigo').val('<?php echo $rs_clientes->fields["tipoident_codigocl"]; ?>');
$('#doccab_rucci_cliente').val('<?php echo $rs_clientes->fields["client_ciruc"]; ?>');
$('#doccab_nombrerazon_cliente').val('<?php echo $rs_clientes->fields["client_nombre"]; ?>');
$('#doccab_direccion_cliente').val('<?php echo $rs_clientes->fields["client_direccion"]; ?>');
$('#doccab_telefono_cliente').val('<?php echo $rs_clientes->fields["client_telefono"]; ?>');
$('#doccab_email_cliente').val('<?php echo $rs_clientes->fields["client_mail"]; ?>');

//  End -->
</script>

<?php

}
?>
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
$proveeve_id=$_POST["proveeve_id"];

if($_SESSION['ces1313777_sessid_inicio'])
{

$busca_clientes="select * from app_proveedor where provee_id='".$proveeve_id."'";
$rs_clientes = $DB_gogess->executec($busca_clientes,array());


?>
<script type="text/javascript">
<!--

<?php
switch ($rs_clientes->fields["tipoident_codigocl"]) {
    case '04':
        {
		?>
		  $('#doccab_rucci_cliente').val('<?php echo $rs_clientes->fields["provee_ruc"]; ?>');
		<?php  
		}
        break;
    case '05':
        {
		?>
		  $('#doccab_rucci_cliente').val('<?php echo $rs_clientes->fields["provee_cedula"]; ?>');
		<?php  
		}
        break;
    default:
       {
	      if($rs_clientes->fields["provee_cedula"])
		  {
		  ?>
		   $('#doccab_rucci_cliente').val('<?php echo $rs_clientes->fields["provee_cedula"]; ?>');
		  <?php 
		  }
		  
		  if($rs_clientes->fields["provee_ruc"])
		  {
		  ?>
		   $('#doccab_rucci_cliente').val('<?php echo $rs_clientes->fields["provee_ruc"]; ?>');
		   <?php
		  }
		  
	   }
}

?>

$('#tipoident_codigo').val('<?php echo $rs_clientes->fields["tipoident_codigocl"]; ?>');
$('#doccab_nombrerazon_cliente').val('<?php echo $rs_clientes->fields["provee_nombre"]; ?>');
$('#doccab_direccion_cliente').val('<?php echo preg_replace("[\n|\r|\n\r]", "", $rs_clientes->fields["provee_direccion"]); ?>');
$('#doccab_telefono_cliente').val('<?php echo $rs_clientes->fields["provee_telefono"]; ?>');
$('#doccab_email_cliente').val('<?php echo $rs_clientes->fields["provee_email"]; ?>');

//  End -->
</script>

<?php

}
?>
<?php
$tiempossss=455550000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");


$buscacliente="select * from app_proveedor where emp_id=".$_SESSION['ces1313777_sessid_emp_id']." and (provee_ruc like '%".$_POST["pbusca_cliente_val"]."%' or provee_nombre like '%".$_POST["pbusca_cliente_val"]."%')";
  
  $rs_bcliente = $DB_gogess->executec($buscacliente,array());
  

?>
<script type="text/javascript">
<!--
function busca_cliente_more(ci_cliente)
{
        //actualiza_cmb();
        funcion_cerrar_pop('divDialog_proveedor');
	    $('#proveevar_id').val(ci_cliente);
		abrir_standar("templateformsweb/maestro_standar_compras/proveedor_d/grid_nuevo_proveedor.php","Proveedor","divBody_proveedor","divDialog_proveedor",750,450,0,ci_cliente,0,0,0,0,0);
		
}



//  End -->
</script>
<table border="0" cellpadding="2" cellspacing="1">
  <tr>
    <td bgcolor="#F0F0F0"><strong>RUC-CI</strong></td>
    <td bgcolor="#F0F0F0"><strong>NOMBRES</strong></td>
    <td bgcolor="#F0F0F0"><strong>APELLIDOS</strong></td>
	  <td bgcolor="#F0F0F0"><strong></strong></td>
  </tr>
  <?php
  if($rs_bcliente)
  {
     	while (!$rs_bcliente->EOF) {
		
		$provee_id=$rs_bcliente->fields["provee_id"];
		$provee_ruc=$rs_bcliente->fields["provee_ruc"];
		$provee_nombre=str_replace('"',"",$rs_bcliente->fields["provee_nombre"]);

       ?>
	   <tr>
    <td bgcolor="#F0F0F0"><?php echo $provee_ruc ?></td>
    <td bgcolor="#F0F0F0"><?php echo $provee_nombre ?></td>
	<td bgcolor="#F0F0F0" onClick="busca_cliente_more('<?php echo $provee_id; ?>')" style="cursor:pointer"><img src="images/seleccionacliente.png"></td>
  </tr>
		<?php
		$rs_bcliente->MoveNext();
		}
		
   }	
  
  ?>
  
</table>
<?php
}
?>
<?php
ini_set("session.gc_maxlifetime","14400");
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{
$director="../../../../";
include ("../../../../cfgclases/clases.php");


$buscacliente="select * from ca_proveedor where prov_ciruc like '%".$_POST["pbusca_cliente_val"]."%' or prov_nombre like '%".$_POST["pbusca_cliente_val"]."%' or prov_apellido like '%".$_POST["pbusca_cliente_val"]."%'";
  
  $rs_bcliente = $DB_gogess->Execute($buscacliente);
  

?>
<script type="text/javascript">
<!--
function busca_cliente_more(ci_cliente)
{
       funcion_cerrar_pop('divDialog_proveedor');
	   
	   $("#div_cbusca").load("aplications/usuario/opciones/extras/busca_proveedor.php",{
    pruc:ci_cliente
  },function(result){  
  
  
        $('#comcab_nombrerazon_cliente').val($('#nombreapellido_enc').val());
		$('#comcab_direccion_cliente').val($('#direccion_enc').val());
		$('#comcab_telefono_cliente').val($('#telefono_enc').val());
		$('#comcab_email_cliente').val($('#email_enc').val());
		$('#comcab_rucci_cliente').val($('#rucci_enc').val());
		
	    abrir_standar("aplications/usuario/opciones/grid/grid_nuevo_proveedor.php","Proveedor","divBody_proveedor","divDialog_proveedor",750,450,0,ci_cliente,0,0,0,0,0);
	  });  
  $("#div_cbusca").html("Espere un momento...");     

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
		
		
		$prov_ciruc=$rs_bcliente->fields["prov_ciruc"];
		$prov_nombre=$rs_bcliente->fields["prov_nombre"];
		$prov_apellido=$rs_bcliente->fields["prov_apellido"];
		$prov_direccion=$rs_bcliente->fields["prov_direccion"];
		$prov_telefono=$rs_bcliente->fields["prov_telefono"];
		$prov_mail=$rs_bcliente->fields["prov_mail"];

       ?>
	   <tr>
    <td bgcolor="#F0F0F0"><?php echo $prov_ciruc ?></td>
    <td bgcolor="#F0F0F0"><?php echo $prov_nombre ?></td>
    <td bgcolor="#F0F0F0"><?php echo $prov_apellido ?></td>
	<td bgcolor="#F0F0F0" onClick="busca_cliente_more('<?php echo $prov_ciruc; ?>')" style="cursor:pointer"><img src="images/seleccionacliente.png"></td>
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
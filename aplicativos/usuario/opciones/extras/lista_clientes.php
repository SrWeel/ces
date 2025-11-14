<?php
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{
$director="../../../../";
include ("../../../../cfgclases/clases.php");


$buscacliente="select * from ca_cliente where em_id=".$_SESSION['ces1313777_sessid_idempresa']." and (client_ciruc like '%".$_POST["pbusca_cliente_val"]."%' or client_nombre like '%".$_POST["pbusca_cliente_val"]."%' or client_apellido like '%".$_POST["pbusca_cliente_val"]."%')";
  
  $rs_bcliente = $DB_gogess->Execute($buscacliente);
  

?>
<script type="text/javascript">
<!--
function busca_cliente_more(ci_cliente)
{
       funcion_cerrar_pop('divDialog_cliente');
	   
	   $("#div_cbusca").load("aplications/usuario/opciones/extras/busca_cliente.php",{
    pruc:ci_cliente
  },function(result){  
  
  
        $('#comcab_nombrerazon_cliente').val($('#nombreapellido_enc').val());
		$('#comcab_direccion_cliente').val($('#direccion_enc').val());
		$('#comcab_telefono_cliente').val($('#telefono_enc').val());
		$('#comcab_email_cliente').val($('#email_enc').val());
		$('#comcab_rucci_cliente').val($('#rucci_enc').val());
		$('#tipodoc_codigo').val($('#tipodoc_enc').val());
		
	    abrir_standar("aplications/usuario/opciones/grid/grid_nuevo_cliente.php","Cliente","divBody_cliente","divDialog_cliente",750,450,0,ci_cliente,0,0,0,0,0);
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
		
		
		$client_ciruc=$rs_bcliente->fields["client_ciruc"];
		$client_nombre=str_replace('"',"",$rs_bcliente->fields["client_nombre"]);
		$client_apellido=str_replace('"',"",$rs_bcliente->fields["client_apellido"]);
		$client_direccion=str_replace('"',"",$rs_bcliente->fields["client_direccion"]);
		$client_telefono=$rs_bcliente->fields["client_telefono"];
		$client_mail=$rs_bcliente->fields["client_mail"];

       ?>
	   <tr>
    <td bgcolor="#F0F0F0"><?php echo $client_ciruc ?></td>
    <td bgcolor="#F0F0F0"><?php echo $client_nombre ?></td>
    <td bgcolor="#F0F0F0"><?php echo $client_apellido ?></td>
	<td bgcolor="#F0F0F0" onClick="busca_cliente_more('<?php echo $client_ciruc; ?>')" style="cursor:pointer"><img src="images/seleccionacliente.png"></td>
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
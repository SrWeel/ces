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

//lpin_productocompra
//lpin_cuentacompra
//dns_activosfijos

$compra_enlace=$_POST["campo_enlace"];
$conc_fechacorte=$_POST["conc_fechacorte"];
$conc_cuenta=$_POST["conc_cuenta"];
$conc_saldobanco=$_POST["conc_saldobanco"];
		
		

$bloque_registro=0;


?>
<table class="table table-bordered" style="width:100%">
  <tbody><tr>
   <td bgcolor="#DFE9EE"></td>
   <td bgcolor="#DFE9EE">Fecha</td>
   <td bgcolor="#DFE9EE">Detalle</td>
   <td bgcolor="#DFE9EE">Referencia</td>
   <td bgcolor="#DFE9EE">Tipo</td>
   <td bgcolor="#DFE9EE">Monto</td>
   </tr>
   
<?php
$suma_valort=0;
$lista_renta="select * from lpin_comprobantecontable inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.comcont_enlace=lpin_detallecomprobantecontable.comcont_enlace where comcont_fecha<='".$conc_fechacorte."' and detcc_cuentacontable='".$conc_cuenta."' and comcont_anulado=0 order by comcont_fecha asc";
$rs_listadata = $DB_gogess->executec($lista_renta,array());
if($rs_listadata)
 {
	  while (!$rs_listadata->EOF) {	
	  
	 
	 $detalle='';
	 $referencia='';
	 $tipo='';
	 
	 $comcont_tabla=$rs_listadata->fields["comcont_tabla"];
	 
	 if(!($comcont_tabla))
	 {
	    $detalle=$rs_listadata->fields["comcont_concepto"];
	    $referencia=$rs_listadata->fields["comcont_numeroc"];
		
		$tipoa_id=$rs_listadata->fields["tipoa_id"];
		
		$busca_tipo="select * from lpin_tipoasiento where tipoa_id='".$tipoa_id."'";
		$rs_btipo= $DB_gogess->executec($busca_tipo,array());		
		$tipo=strtoupper($rs_btipo->fields["tipoa_nombre"]);
		
	 }
	 else
	 {
	 
	     switch ($comcont_tabla) {
				case 'app_anticipos':
					{
					
					   $busca_datos="select * from app_anticipos where anti_id='".$rs_listadata->fields["comcont_idtabla"]."'";
					   $rs_bd = $DB_gogess->executec($busca_datos,array());
					   $detalle=$rs_bd->fields["anti_descripcion"];
	                   $referencia=$rs_bd->fields["anti_comprobante"];
					   
					    $detantic_id=$rs_bd->fields["detantic_id"];
					    $busca_tipo="select * from cesdb_arcombos.cmd_tipodetallemovanticipo where detantic_id='".$detantic_id."'";
						$rs_btipo= $DB_gogess->executec($busca_tipo,array());		
						$tipo=strtoupper($rs_btipo->fields["detantic_nombre"]);
					
					}
					break;
				case 'lpin_cobropago':
					{
					   if($rs_listadata->fields["comcont_tablas"]=='dns_compras')
					   {
					    $busca_datos="select * from lpin_cobropago inner join lpin_cobropagodetalle on lpin_cobropago.crb_enlace=lpin_cobropago.crb_enlace where crb_id='".$rs_listadata->fields["comcont_idtabla"]."' and  compracp_id='".$rs_listadata->fields["comcont_idtablas"]."'";
					   
					   }
					   
					   if($rs_listadata->fields["comcont_tablas"]=='beko_documentocabecera')
					   {
					     $busca_datos="select * from lpin_cobropago inner join lpin_cobropagodetalle on lpin_cobropago.crb_enlace=lpin_cobropago.crb_enlace where crb_id='".$rs_listadata->fields["comcont_idtabla"]."' and  doccabcp_id='".$rs_listadata->fields["comcont_idtablas"]."'";
					   
					   }
					   
					   $rs_bd = $DB_gogess->executec($busca_datos,array());
					   
					   $frocob_id=$rs_bd->fields["frocob_id"];
					   $busca_tipo="select * from lpin_formadecobro where frocob_id='".$frocob_id."'";
					   $rs_btipo= $DB_gogess->executec($busca_tipo,array());		
					   $tipo=strtoupper($rs_btipo->fields["frocob_nombre"]);
					   
					   $doccab_id=$rs_bd->fields["doccabcp_id"];
					   $compra_id=$rs_bd->fields["compracp_id"];
					   
					   $ndoc='';
					   
					   if($doccab_id)
					   {
					      $busca_datos2="select * from beko_documentocabecera where doccab_id='".$doccab_id."'";
					      $rs_bd2 = $DB_gogess->executec($busca_datos2,array());
						  $ndoc=$rs_bd->fields["crb_ncomprobante"];
					      $dscrip=$rs_bd2->fields["doccab_adicional"];
					   }
					   
					   if($compra_id)
					   {
					      $busca_datos2="select * from dns_compras where compra_id='".$compra_id."'";
					      $rs_bd2 = $DB_gogess->executec($busca_datos2,array());
					      $ndoc=$rs_bd->fields["crb_ncomprobante"];
						  $dscrip=$rs_bd2->fields["compra_descripcion"];
					   }
					   
					   $detalle=$dscrip.' '.$rs_bd->fields["crb_descripcion"];
	                   $referencia=$ndoc;
					   
					   
					    
					
					}
					break;
				case 'app_movimientobancos':
					{
					    
					   $busca_datos="select * from app_movimientobancos inner join app_proveedor on app_movimientobancos.proveemovban_id=app_proveedor.provee_id where movban_id='".$rs_listadata->fields["comcont_idtabla"]."'";
					   $rs_bd = $DB_gogess->executec($busca_datos,array());
					   
					   $detmov_id=$rs_bd->fields["detmov_id"];
					   $busca_tipo="select * from cesdb_arcombos.cmd_tipodetallemovbancos where detmov_id='".$detmov_id."'";
					   $rs_btipo= $DB_gogess->executec($busca_tipo,array());		
					   $tipo=strtoupper($rs_btipo->fields["detmov_nombre"]);
					   
					   
					   $detalle=$rs_bd->fields["movban_descripcion"].' '.$rs_bd->fields["provee_nombre"];
	                   $referencia=$rs_bd->fields["movban_comprobante"];				   
					   
					
					
					}
					break;
			}
	 
	 
	 }
	  
  ?> 
  <tr>
	<td>
	<?php
	$comulla_simple="'";
    $tabla_valordata="";
    $tabla_valordata="'lpin_detallecomprobantecontable'";
	
	$campo_valor="";
	$campo_valor="'detcc_id'";
	$ide_producto='detcc_id';
	$ncampo_val='detcc_conciliacion';
	
	if($rs_listadata->fields["detcc_conciliacion"]==1)
	{
	
  // if($bloque_registro==0)
   //{
	echo '<input class="form-control" name="cmb_'.$ncampo_val.$rs_listadata->fields[$ide_producto].'" type="checkbox" id="cmb_'.$ncampo_val.$rs_listadata->fields[$ide_producto].'" value="'.$rs_listadata->fields[$ide_producto].'" onclick="guardar_camposf('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listadata->fields[$ide_producto].','.$comulla_simple.$ide_producto.$comulla_simple.')";  checked />';	
	//}
	//else
	//{
	
	//	echo 'X';	
	
	//}
	

		}
	else
	{
	
	//if($bloque_registro==0)
  // {
	echo '<input class="form-control" name="cmb_'.$ncampo_val.$rs_listadata->fields[$ide_producto].'" type="checkbox" id="cmb_'.$ncampo_val.$rs_listadata->fields[$ide_producto].'" value="'.$rs_listadata->fields[$ide_producto].'" onclick="guardar_camposf('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listadata->fields[$ide_producto].','.$comulla_simple.$ide_producto.$comulla_simple.')"; />';	
	//}
	//else
	//{
	
	//echo '';	
	
	//}
	
	}	
//	$('input:checkbox[name=colorfavorito]:checked').val()

$monto=0;
$signo='';
if($rs_listadata->fields["detcc_debe"]>0)
{
  $monto=$rs_listadata->fields["detcc_debe"];
  $signo='<i class="fa fa-plus" style="color:#000000"></i>';
  $montosuma=$rs_listadata->fields["detcc_debe"];
}
if($rs_listadata->fields["detcc_haber"]>0)
{
  $monto=$rs_listadata->fields["detcc_haber"];
  $signo='<i class="fa fa-minus" style="color:#FF0000"></i>';
  $montosuma=$rs_listadata->fields["detcc_haber"]*-1;
}

//$rs_listadata->fields["comcont_id"]
	?>
	
  </td>
    <td nowrap="nowrap" ><?php echo $rs_listadata->fields["comcont_fecha"]; ?></td>
	<td><?php echo $detalle; ?></td>
	<td><?php echo $referencia; ?></td>
	<td nowrap="nowrap"><?php echo $signo.' '.$tipo; ?></td>
	<td><?php echo $monto; ?></td>
  </tr>
<?php
if($rs_listadata->fields["detcc_conciliacion"]==1)
{
$suma_valort=$suma_valort+$montosuma;
}

         $rs_listadata->MoveNext();
	  }
  }	

$diferencia=0;
$diferencia=$conc_saldobanco-$suma_valort;
?>  
 </td>
    <td></td>
	<td>SALDO</td>
	<td></td>
	<td></td>
	<td></td>
	<td><div id="stotal"><?php echo $suma_valort; ?></div></td>
  </tr>
  
  </tbody>
 </table>
<div id="campo_valorx"></div>  

<script language="javascript">
<!--

function guardar_camposf(tabla,campo,id,campoidtabla)
{

$("#campo_valorx").load("templateformsweb/maestro_standar_conciliacionbancos/guarda_campocon.php",{
tabla:tabla,
campo:campo,
id:id,
valor:$('#cmb_'+campo+id).is(":checked"),
campoidtabla:campoidtabla,
compra_enlace:'<?php echo $compra_enlace; ?>',
conc_fechacorte:$('#conc_fechacorte').val(),
conc_cuenta:$('#conc_cuenta').val(),
conc_saldobanco:$('#conc_saldobanco').val()
 },function(result){   



  }); 

$("#campo_valorx").html("Espere un momento...");

}


$('#conc_saldocontable').val('<?php echo $suma_valort; ?>');
$('#conc_diferencia').val('<?php echo $diferencia; ?>')

//-->
</script>  
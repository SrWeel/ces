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

$bloque_registro=0;
$busca_comprax="select * from dns_compras where compra_enlace='".$_POST["campo_enlace"]."'";
$rs_cmpx = $DB_gogess->executec($busca_comprax,array());

$busca_cp="select count(*) as totalcobro from  lpin_comprobantecontable inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.comcont_enlace=lpin_detallecomprobantecontable.comcont_enlace   where comcont_tablas='dns_compras' and  comcont_idtablas='".$rs_cmpx->fields["compra_id"]."' and comcont_tabla in ('lpin_cobropago','lpin_crucedocumentos')";
$xml_cp = $DB_gogess->executec($busca_cp,array());
$hay_cobropago='';
$hay_cobropago=$xml_cp->fields["totalcobro"];


$busca_xmlexistentex="select compretcab_estadosri from comprobante_retencion_cab where compretcab_anulado!='1' and compra_id='".$rs_cmpx->fields["compra_id"]."'";
$rs_xmlexternox = $DB_gogess->executec($busca_xmlexistentex,array());
$xml_sri=$rs_xmlexternox->fields["compretcab_estadosri"];

if($xml_sri=='AUTORIZADO' or $xml_sri=='RECIBIDA' or $hay_cobropago>0)
{
$bloque_registro=1;
}

$lista_comp="select * from dns_compras where compra_enlace='".$compra_enlace."'";
$rs_comp = $DB_gogess->executec($lista_comp,array());

$compra_id=$rs_comp->fields["compra_id"];

?>
<table class="table table-bordered" style="width:100%">
  <tbody><tr>
   <td bgcolor="#DFE9EE">Gasto</td>
   <td bgcolor="#DFE9EE">Retenci&oacute;n</td>
   <td bgcolor="#DFE9EE">Tipo</td>
   <td bgcolor="#DFE9EE">Cod.SRI</td>
   <td bgcolor="#DFE9EE">Base</td>
   <td bgcolor="#DFE9EE">%</td>
   <td bgcolor="#DFE9EE">Valor</td>
   </tr>
   
<?php
$lista_renta="select * from comprobante_retencion_detalle  where compra_enlace='".$compra_enlace."'";
$rs_listadata = $DB_gogess->executec($lista_renta,array());
if($rs_listadata)
 {
	  while (!$rs_listadata->EOF) {	
	  
	  $ntipo='';
	  if($rs_listadata->fields["impur_id"]==1)
	  {
	    $ntipo='Imp. a la Renta';
	  }
	  
	  if($rs_listadata->fields["impur_id"]==2)
	  {
	    $ntipo='IVA';
	  }
	  
	 
	  
  ?> 
  <tr>
	<td>
	<?php
	$comulla_simple="'";
    $tabla_valordata="";
    $tabla_valordata="'comprobante_retencion_detalle'";
	
	$campo_valor="";
	$campo_valor="'compretdet_id'";
	$ide_producto='compretdet_id';
	$ncampo_val='compretdet_gasto';
	
	if($rs_listadata->fields["compretdet_gasto"]==1)
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
	?>
	
	</td>
    <td><?php echo $rs_listadata->fields["compretdet_nombreret"]; ?></td>
	<td><?php echo $ntipo; ?></td>
	<td><?php echo $rs_listadata->fields["porcentaje_id"]; ?></td>
	<td><?php echo $rs_listadata->fields["compretdet_baseimponible"]; ?></td>
	<td><?php echo $rs_listadata->fields["compretdet_porcentaje"]; ?></td>
	<td><?php echo $rs_listadata->fields["compretdet_valorretenido"]; ?></td>
  </tr>
<?php
         $rs_listadata->MoveNext();
	  }
  }	

?>  
  </tbody>
 </table>
<div id="campo_valorx"></div>  

<script language="javascript">
<!--

function guardar_camposf(tabla,campo,id,campoidtabla)
{

$("#campo_valorx").load("templateformsweb/maestro_standar_compras/guarda_camporet.php",{
tabla:tabla,
campo:campo,
id:id,
valor:$('#cmb_'+campo+id).is(":checked"),
campoidtabla:campoidtabla,
compra_enlace:'<?php echo $compra_enlace; ?>'
 },function(result){   


genera_asientocompra();


  }); 

$("#campo_valorx").html("Espere un momento...");

}




//-->
</script>  
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

$tpliq_enlace=$_POST["campo_enlace"];

$bloque_registro=0;
$busca_comprax="select * from lpin_lqtarjetacredito where tpliq_enlace='".$_POST["campo_enlace"]."'";
$rs_cmpx = $DB_gogess->executec($busca_comprax,array());


//IVA
$lista_valor=array();
$lista_valorrenta=array();
//IVA


 
//print_r($lista_valorrenta);

//RENTA
$bandera_lista=0;

?>


<table class="table table-bordered" style="width:100%">
  <tbody><tr>
   <td bgcolor="#DFE9EE">Fecha Emisi&oacute;n</td>
   <td bgcolor="#DFE9EE">N&uacute;mero Retenci&oacute;n</td>
   <td bgcolor="#DFE9EE">Autorizaci&oacute;n</td>
   <td bgcolor="#DFE9EE">Retenci&oacute;n</td>
   <td bgcolor="#DFE9EE">Tipo</td>
   <td bgcolor="#DFE9EE">Cod.SRI</td>
   <td bgcolor="#DFE9EE">Base</td>
   <td bgcolor="#DFE9EE">%</td>
   <td bgcolor="#DFE9EE">Valor</td>
   </tr>
   
<?php
$comulla_simple="'";	
$tabla_valordata="";
$campo_valor="";	
$tabla_valordata="'tarjeta_retencion_detalle'";
$campo_valor="'compretdet_id'";
$ide_producto='compretdet_id';

$lista_renta="select * from tarjeta_retencion_detalle  where tpliq_enlace='".$tpliq_enlace."'";
$rs_listadata = $DB_gogess->executec($lista_renta,array());
if($rs_listadata)
 {
	  while (!$rs_listadata->EOF) {	
	  
	 $bandera_lista++; 
	  
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
	<?php $ncampo_val='compretdet_fechaemision'; 
	$link_gambia='';
	$link_gambia=' onChange="guardar_camposgridpx('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listadata->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listadata->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" ';
	?>
	<input name="cmb_compretdet_fechaemision<?php echo $rs_listadata->fields["compretdet_id"]; ?>" type="text" id="cmb_compretdet_fechaemision<?php echo $rs_listadata->fields["compretdet_id"]; ?>" <?php echo $link_gambia; ?>  class="form-control" value='<?php echo $rs_listadata->fields[$ncampo_val]; ?>' /></td>
	<td>
	<?php $ncampo_val='compretdet_numeroretencion';
	$link_gambia='';
	$link_gambia=' onChange="guardar_camposgridpx('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listadata->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listadata->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" ';
	 ?>
	<input name="cmb_compretdet_numeroretencion<?php echo $rs_listadata->fields["compretdet_id"]; ?>" type="text" id="cmb_compretdet_numeroretencion<?php echo $rs_listadata->fields["compretdet_id"]; ?>" <?php echo $link_gambia; ?>  class="form-control" value='<?php echo $rs_listadata->fields[$ncampo_val]; ?>' /></td>
	<td>
	<?php $ncampo_val='compretdet_autorizacion'; 
	$link_gambia='';
	$link_gambia=' onChange="guardar_camposgridpx('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listadata->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listadata->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" ';
	?>
	<input name="cmb_compretdet_autorizacion<?php echo $rs_listadata->fields["compretdet_id"]; ?>" type="text" id="cmb_compretdet_autorizacion<?php echo $rs_listadata->fields["compretdet_id"]; ?>" <?php echo $link_gambia; ?>  class="form-control" value='<?php echo $rs_listadata->fields[$ncampo_val]; ?>' />   </td>	
	
	<td><?php echo utf8_decode($rs_listadata->fields["compretdet_nombreret"]); ?></td>
	<td><?php echo $ntipo; ?></td>
	<td><?php echo $rs_listadata->fields["porcentaje_id"]; ?></td>
	<td><?php echo $rs_listadata->fields["compretdet_baseimponible"]; ?></td>
	<td><?php echo $rs_listadata->fields["compretdet_porcentaje"]; ?></td>
	<td><?php echo $rs_listadata->fields["compretdet_valorretenido"]; ?>
	
    <?php
	echo '<script language="javascript">
    <!--
	  $("#cmb_compretdet_fechaemision'.$rs_listadata->fields["compretdet_id"].'").datepicker({dateFormat: "yy-mm-dd"});
	//-->
    </script> ';
	?>
	
	
	</td>
  </tr>
<?php
         $rs_listadata->MoveNext();
	  }
  }	

?>  
  </tbody>
 </table>
<div id="asiento_retencion"></div>
<script language="javascript">
<!--

function genera_asientoretenciondata()
{

   $("#asiento_retencion").load("aplicativos/documental/asientos/ventas/ejecuta_ventasretencion.php",{
      valor_id:$('#doccab_id').val(),
	  nombre_campoid:'doccab_id',
	  tabla:'lpin_lqtarjetacredito',
	  mnupan_id:'183'

  },function(result){  

     
  });  
  $("#asiento_retencion").html("......");  


}

<?php
if($bandera_lista>0)
{

//echo ' genera_asientoretenciondata(); ';

}
?>

//-->
</script>
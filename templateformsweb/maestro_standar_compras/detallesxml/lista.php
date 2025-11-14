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

$compra_claveacceso=$_POST["pVar2"];
$compra_numeroproceso=$_POST["compra_numeroproceso"];

?>
<style type="text/css">
<!--
.css_txt3 {color: #000000; font-size: 11px; font-family:Verdana, Arial, Helvetica, sans-serif; }
.css_titulo3 {font-weight: bold;font-size: 11px; font-family:Verdana, Arial, Helvetica, sans-serif; }

.TableScroll2 {
        z-index:99;
		width:100%;
        height:450px;	
        overflow: auto;
      }
      
-->
</style>
<table width="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>TIPO </td>
    <td>
	<?php
	echo '<select class="form-control" style="width:120px" id="cmb_allid" name="cmb_allid" >
	<option value="" >--</option>';
    $objformulario->fill_cmb('lpin_tipo','lpti_id,lpti_nombre',$rs_data->fields[$ncampo_val],"",$DB_gogess);
    echo '</select>';	
	?>
	</td>
    <td>&nbsp;</td>
    <td><input type="button" name="Button" value="ASIGNAR A TODOS" onClick="seleccionar_todasval()" ></td>
  </tr>
</table>
<br><br>

<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#D0E4EE" class="css_titulo3">No.</td>
	<td bgcolor="#D0E4EE" class="css_titulo3">&nbsp;CODE&nbsp;</td>
	<td bgcolor="#D0E4EE" class="css_titulo3">&nbsp;CANTIDAD&nbsp;</td>
	<td bgcolor="#D0E4EE" class="css_titulo3">&nbsp;DESCRIPCION:&nbsp;</td>
    <td bgcolor="#D0E4EE" class="css_titulo3">&nbsp;PRECIO UNITARIO&nbsp;</td>
    <td bgcolor="#D0E4EE" class="css_titulo3" nowrap="nowrap">&nbsp;DESCUENTO&nbsp;</td>
    <td bgcolor="#D0E4EE" class="css_titulo3" nowrap="nowrap">&nbsp;IVA&nbsp;</td>
	<td bgcolor="#D0E4EE" class="css_titulo3" nowrap="nowrap">&nbsp;TOTAL&nbsp;</td>
    <td bgcolor="#D0E4EE" class="css_titulo3" nowrap="nowrap">&nbsp;TIPO&nbsp;</td>	
	<td bgcolor="#D0E4EE" class="css_titulo3" nowrap="nowrap">&nbsp;ASIGNAR&nbsp;</td>
  </tr>
   <?php
   $contador_lista=0;
   $numera_id=0;
   
   
   
 $lista_data="select * from dns_comprasdetallexml where cdxml_claveacceso='".$compra_claveacceso."' and cdxml_id not in (select cdxml_id from lpin_productocompra where compra_enlace='".$compra_numeroproceso."' UNION select cdxml_id from lpin_cuentacompra where compra_enlace='".$compra_numeroproceso."' UNION select cdxml_id from dns_activosfijos where compra_enlace='".$compra_numeroproceso."')";
   $rs_data = $DB_gogess->executec($lista_data,array());
   if($rs_data)
   {
	  while (!$rs_data->EOF) {	
	  
	 $comulla_simple="'";	
	 $tabla_valordata="";
	 $campo_valor="";	
	 $tabla_valordata="'dns_comprasdetallexml'";
	 $campo_valor="'cdxml_id'";
	 $ide_producto='cdxml_id';  
	 
	$contador_lista++;  
	echo "<tr>";  
	
	echo "<td>".$contador_lista."</td>";  
	  
	echo '<td  nowrap="nowrap" >';	
	$ncampo_val='cdxml_codigo';	
	echo $rs_data->fields[$ncampo_val];	
	echo '</td>';
	
	echo '<td  nowrap="nowrap" >';	
	$ncampo_val='cdxml_cantidad';	
	echo $rs_data->fields[$ncampo_val];	
	echo '</td>';
	
	echo '<td>';	
	$ncampo_val='cdxml_descripcion';	
	echo $rs_data->fields[$ncampo_val];	
	echo '</td>';	
	
	echo '<td  nowrap="nowrap" >';	
	$ncampo_val='cdxml_preciounitario';	
	echo $rs_data->fields[$ncampo_val];	
	echo '</td>';
	
	echo '<td  nowrap="nowrap" >';	
	$ncampo_val='cdxml_descuento';	
	echo $rs_data->fields[$ncampo_val];	
	echo '</td>';
	
	echo '<td  nowrap="nowrap" >';	
	$ncampo_val='cdxml_iva';	
	echo $rs_data->fields[$ncampo_val];	
	echo '</td>';
	
	echo '<td  nowrap="nowrap" >';	
	$ncampo_val='cdxml_totalsinimpuestos';	
	echo $rs_data->fields[$ncampo_val];	
	echo '</td>';
	
	$ncampo_val='lpti_id';	
	
	//$sacatxt=array();
	//$sacatxt=explode(" ",$rs_data->fields["cdxml_descripcion"]);
	
	echo '<td><select class="form-control" style="width:120px" id="cmb_'.$ncampo_val.$rs_data->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_data->fields[$ide_producto].'"  onChange="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_data->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_data->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" >
	<option value="" >--</option>';
    $objformulario->fill_cmb('lpin_tipo','lpti_id,lpti_nombre',$rs_data->fields[$ncampo_val],"",$DB_gogess);
    echo '</select></td>';
	
	
	echo '<td  nowrap="nowrap" ><div id="btndata_'.$rs_data->fields[$ide_producto].'">';	
    echo '<input type="button" name="Submit" value="Asignar" onclick="asignar_detalle('.$rs_data->fields[$ide_producto].')" />';
	echo '</div></td>';
	
	
	  
	echo "</tr>";   
	
	   $rs_data->MoveNext();	 
	  }
  }	  
   ?>  
</table>  

<br>
<br>

<div id="campo_valor"></div>
<div id="asigna_detalle"></div>

<div id="asigna_todasprim"></div>



<SCRIPT LANGUAGE=javascript>
<!--

function guardar_campos(tabla,campo,id,valor,campoidtabla)
{

$("#campo_valor").load("templateformsweb/maestro_standar_compras/guarda_campo.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor,
campoidtabla:campoidtabla

 },function(result){       

  });  

$("#campo_valor").html("Espere un momento...");

}


//detalle

function asignar_detalle(cdxml_id)
{

if($('#compra_id').val()=='')
{
  alert("Guarde el registro para asignar items");
  return false;

}

if($('#cmb_lpti_id'+cdxml_id).val()=='')
{
  alert("Seleccione el tipo");
  return false;
}

var archivo_envia='';
var tipo;

tipo=$('#cmb_lpti_id'+cdxml_id).val();

if(tipo==1)
{
  archivo_envia='asigna_detalle.php';

}
if(tipo==2)
{
  archivo_envia='asigna_detallecuenta.php';
}

if(tipo==3)
{
  archivo_envia='asigna_detalleaf.php';
}

$('#btndata_'+cdxml_id).html('');

$("#asigna_detalle").load("templateformsweb/maestro_standar_compras/"+archivo_envia,{
  cdxml_id:cdxml_id,
  compra_numeroproceso:$('#compra_enlace').val(),
  compra_nfactura:$('#compra_nfactura').val(),
  compra_id:$('#compra_id').val(),
  tipo:$('#cmb_lpti_id'+cdxml_id).val()

 },function(result){       

   despliega_lista();
   grid_extras_9652($('#compra_enlace').val(),0,0);
   grid_extras_9654($('#compra_enlace').val(),0,0);
   grid_extras_9901($('#compra_enlace').val(),0,0);

  });  

$("#asigna_detalle").html("Espere un momento...");

}


function seleccionar_todasval()
{

if($('#cmb_allid').val()=='')
{
  alert("Seleccione una ocpion");
  return false;
}

if($('#compra_id').val()=='')
{
  alert("Guarde el registro para asignar items");
  return false;

}

$("#asigna_todasprim").load("templateformsweb/maestro_standar_compras/detallesxml/asigna_t.php",{

pVar2:'<?php echo $compra_claveacceso; ?>',
compra_numeroproceso:'<?php echo $compra_numeroproceso; ?>',
cmb_allid:$('#cmb_allid').val(),
compra_nfactura:$('#compra_nfactura').val(),
compra_id:$('#compra_id').val()


 },function(result){       

despliega_lista();

grid_extras_9652($('#compra_enlace').val(),0,0);
   grid_extras_9654($('#compra_enlace').val(),0,0);
   grid_extras_9901($('#compra_enlace').val(),0,0);

  });  

$("#asigna_todasprim").html("Espere un momento...");

}


//-->
</SCRIPT>
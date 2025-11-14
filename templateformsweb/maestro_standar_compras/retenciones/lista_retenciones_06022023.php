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

$busca_xmlexistentex="select compretcab_estadosri from comprobante_retencion_cab where compra_id='".$rs_cmpx->fields["compra_id"]."'";
$rs_xmlexternox = $DB_gogess->executec($busca_xmlexistentex,array());
$xml_sri=$rs_xmlexternox->fields["compretcab_estadosri"];

if($xml_sri=='AUTORIZADO' or $xml_sri=='RECIBIDA')
{
$bloque_registro=1;
}

//compra_fecha

$lista_comp="select * from dns_compras where compra_enlace='".$compra_enlace."'";
$rs_comp = $DB_gogess->executec($lista_comp,array());

$compra_id=$rs_comp->fields["compra_id"];

//IVA
$lista_valor=array();
$lista_valorrenta=array();


$lista_detalles="select sum(prcomp_subtotal) as total,porcei_id  from lpin_productocompra where compra_enlace='".$compra_enlace."' and porcei_id>0 and prcomp_taricodigo=2 group by prcomp_taricodigo";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $valor_iva=0;
		 $valor_iva=($rs_data->fields["total"]*12)/100;
	  
	     $lista_valor[$rs_data->fields["porcei_id"]]["valor"]=$lista_valor[$rs_data->fields["porcei_id"]]["valor"]+$valor_iva;		 
		 $lista_valor[$rs_data->fields["porcei_id"]]["codigo"]=$rs_data->fields["porcei_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	  


$lista_detalles="select sum(cuecomp_subtotal) as total,porceci_id  from lpin_cuentacompra where compra_enlace='".$compra_enlace."' and porceci_id>0 and taric_id=1 group by porceci_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
		 $valor_iva=0;
		 $valor_iva=($rs_data->fields["total"]*12)/100;
		 
	     $lista_valor[$rs_data->fields["porceci_id"]]["valor"]=$lista_valor[$rs_data->fields["porceci_id"]]["valor"]+$valor_iva;
		 $lista_valor[$rs_data->fields["porceci_id"]]["codigo"]=$rs_data->fields["porceci_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 
 
$lista_detalles="select sum(acfi_subtotal) as total,porcefi_id  from dns_activosfijos where compra_enlace='".$compra_enlace."' and porcefi_id>0 and tarif_id=1 group by porcefi_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	  
		 
		 $valor_iva=0;
		 $valor_iva=($rs_data->fields["total"]*12)/100;
		 
	     $lista_valor[$rs_data->fields["porcefi_id"]]["valor"]=$lista_valor[$rs_data->fields["porcefi_id"]]["valor"]+$valor_iva;
		 $lista_valor[$rs_data->fields["porcefi_id"]]["codigo"]=$rs_data->fields["porcefi_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 


//IVA


//RENTA
$lista_valorrenta=array();

$lista_detalles="select sum(prcomp_subtotal) as total,porcer_id  from lpin_productocompra where compra_enlace='".$compra_enlace."' and porcer_id>0 group by porcer_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $lista_valorrenta[$rs_data->fields["porcer_id"]]["valor"]=$lista_valorrenta[$rs_data->fields["porcer_id"]]["valor"]+$rs_data->fields["total"];
		 $lista_valorrenta[$rs_data->fields["porcer_id"]]["codigo"]=$rs_data->fields["porcer_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	  


 $lista_detalles="select sum(cuecomp_subtotal) as total,porcecr_id  from lpin_cuentacompra where compra_enlace='".$compra_enlace."' and porcecr_id>0 group by porcecr_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
		 
	     $lista_valorrenta[$rs_data->fields["porcecr_id"]]["valor"]=$lista_valorrenta[$rs_data->fields["porcecr_id"]]["valor"]+$rs_data->fields["total"];
		 $lista_valorrenta[$rs_data->fields["porcecr_id"]]["codigo"]=$rs_data->fields["porcecr_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 
 
$lista_detalles="select sum(acfi_subtotal) as total,porcefr_id  from dns_activosfijos where compra_enlace='".$compra_enlace."' and porcefr_id>0 group by porcefr_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    
	     $lista_valorrenta[$rs_data->fields["porcefr_id"]]["valor"]=$lista_valorrenta[$rs_data->fields["porcefr_id"]]["valor"]+$rs_data->fields["total"];
		 $lista_valorrenta[$rs_data->fields["porcefr_id"]]["codigo"]=$rs_data->fields["porcefr_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 
 
//print_r($lista_valorrenta);

//RENTA

//listar valores renta
//factur_porcentajes
//porce_id,porce_codigo
$genra_listado=array();
$contador=0;

$lista_renta="select * from factur_porcentajes";
$rs_renta = $DB_gogess->executec($lista_renta,array());
if($rs_renta)
 {
	  while (!$rs_renta->EOF) {	
	   
       
	    // $lista_valorrenta[]
		if(count($lista_valor[$rs_renta->fields["porce_id"]])>0)
		{
		$contador++;
		$genra_listado[$contador]["retencion"]=$rs_renta->fields["porce_nombre"];
		$genra_listado[$contador]["tipo"]=$rs_renta->fields["id_impuesto"];
		$genra_listado[$contador]["codigo"]=$rs_renta->fields["porce_codigo"];
		$genra_listado[$contador]["base"]=$lista_valor[$rs_renta->fields["porce_id"]]["valor"];
		$genra_listado[$contador]["porcentaje"]=$rs_renta->fields["porce_valor"];
		$calculov=0;
		$calculov=($lista_valor[$rs_renta->fields["porce_id"]]["valor"]*$rs_renta->fields["porce_valor"])/100;
		$genra_listado[$contador]["valor"]=round($calculov,2);		
		}
		
		
		if(count($lista_valorrenta[$rs_renta->fields["porce_id"]])>0)
		{
		$contador++;
		$genra_listado[$contador]["retencion"]=$rs_renta->fields["porce_nombre"];
		$genra_listado[$contador]["tipo"]=$rs_renta->fields["id_impuesto"];
		$genra_listado[$contador]["codigo"]=$rs_renta->fields["porce_codigo"];
		$genra_listado[$contador]["base"]=$lista_valorrenta[$rs_renta->fields["porce_id"]]["valor"];
		$genra_listado[$contador]["porcentaje"]=$rs_renta->fields["porce_valor"];
		$calculov=0;
		$calculov=($lista_valorrenta[$rs_renta->fields["porce_id"]]["valor"]*$rs_renta->fields["porce_valor"])/100;
		$genra_listado[$contador]["valor"]=round($calculov,2);		
		}
	  
	    $rs_renta->MoveNext();
	  }
  }	


//listar valores iva
//factur_porcentajes
//porce_id,porce_codigo

//print_r($genra_listado);


//saca iva
$busca_retg="select * from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compra_id='".$compra_id."'";
$rsvdata_acdata = $DB_gogess->executec($busca_retg,array());

//if($rsvdata_acdata->fields["compretcab_id"]!='')
//{


//}
//else
//{

//busca retencion generada

$vacia_data="delete from comprobante_retencion_detalle  where compra_enlace='".$compra_enlace."'";
$rsvdata = $DB_gogess->executec($vacia_data,array());

for($i=1;$i<=count($genra_listado);$i++)
{

$compra_fecha=explode("-",$rs_comp->fields["compra_fecha"]);


$compretcab_id=0;
$compretdet_ejerfiscal=$compra_fecha[1]."/".$compra_fecha[0];
$compretdet_baseimponible=$genra_listado[$i]["base"];
$impur_id=$genra_listado[$i]["tipo"];
$porcentaje_id=$genra_listado[$i]["codigo"];
$compretdet_porcentaje=$genra_listado[$i]["porcentaje"];
$compretdet_valorretenido=$genra_listado[$i]["valor"];
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$compretdet_archivo='';
$compretdet_accesolote='';
$compretdet_adicional1='';
$compretdet_nombreret=$genra_listado[$i]["retencion"];

$insreta_retenc="INSERT INTO comprobante_retencion_detalle ( compretcab_id, compretdet_ejerfiscal, compretdet_baseimponible, impur_id, porcentaje_id, compretdet_porcentaje, compretdet_valorretenido, usua_id, compretdet_archivo, compretdet_accesolote, compretdet_adicional1, compretdet_nombreret, compra_enlace) VALUES ('".$compretcab_id."','".$compretdet_ejerfiscal."','".$compretdet_baseimponible."','".$impur_id."','".$porcentaje_id."','".$compretdet_porcentaje."','".$compretdet_valorretenido."','".$usua_id."','".$compretdet_archivo."','".$compretdet_accesolote."','".$compretdet_adicional1."','".$compretdet_nombreret."','".$compra_enlace."');";

$inserta_data = $DB_gogess->executec($insreta_retenc,array());

}


//}

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
	  
	  
	
	
	$busca_gastosino="select * from comprobante_retencion_gasto where porcentaje_id='".$rs_listadata->fields["porcentaje_id"]."' and compra_enlace='".$compra_enlace."'";
	$rs_bgsino = $DB_gogess->executec($busca_gastosino,array());
    
	
	  
  ?> 
  <tr>
	<td>
	<?php
	$comulla_simple="'";
    $tabla_valordata="";
    $tabla_valordata="'comprobante_retencion_gasto'";
	
	$campo_valor="";
	$campo_valor="'porcentaje_id'";
	$ide_producto='porcentaje_id';
	$ncampo_val='compretdet_gasto';
	
	if($rs_bgsino->fields["compretdet_gasto"]==1)
	{
	
   if($bloque_registro==0)
   {
	echo '<input class="form-control" name="cmb_'.$ncampo_val.$rs_listadata->fields["porcentaje_id"].'" type="checkbox" id="cmb_'.$ncampo_val.$rs_listadata->fields["porcentaje_id"].'" value="'.$rs_listadata->fields["porcentaje_id"].'" onclick="guardar_camposf('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listadata->fields["porcentaje_id"].','.$comulla_simple.$ide_producto.$comulla_simple.')";  checked />';	
	}
	else
	{
	
		echo 'X';	
	
	}
	

		}
	else
	{
	
	if($bloque_registro==0)
   {
	echo '<input class="form-control" name="cmb_'.$ncampo_val.$rs_listadata->fields["porcentaje_id"].'" type="checkbox" id="cmb_'.$ncampo_val.$rs_listadata->fields["porcentaje_id"].'" value="'.$rs_listadata->fields["porcentaje_id"].'" onclick="guardar_camposf('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listadata->fields["porcentaje_id"].','.$comulla_simple.$ide_producto.$comulla_simple.')"; />';	
	}
	else
	{
	
	echo '';	
	
	}
	
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



  }); 

$("#campo_valorx").html("Espere un momento...");

}




//-->
</script>  
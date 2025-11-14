<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$table='dns_varioscompras'; 
$subindice='_compras';
$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");

$insu_valorx=$_POST["pVar7"];
$centro_id=$_POST["pVar6"];


//leer con json
$lista_tbldata=array('gogess_sisfield','gogess_sistable');
$contenido = file_get_contents(@$director."jason_files/tablas/".$table.".json");
$gogess_sistable = json_decode($contenido, true);

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");
$gogess_sisfield = json_decode($contenido, true);
//leer con json 

//echo $table;
 
if ($table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }

$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";

$lista_tabla="select * from gogess_sistable where tab_name='dns_varioscompras'";
$rs_tabla = $DB_gogess->executec($lista_tabla,array());


	$campos_tipo=Array
	(
	'tare_id'=> 'hidden3',
	'caucab_id'=> 'hidden3',
	'caucab_nregistro'=> 'hidden2',
	'categ_id'=> 'hidden2'		
	);


	$variableb=0;

			if($_POST["pVar1"]=='undefined')
				  {
					 $variableb=0;
				  }
				  else
				  {
					 $variableb=$_POST["pVar1"];
                     $_REQUEST["opcion_".$table]="buscar";
			         $csearch=$_POST["pVar1"];
				  }


//busca_cierre
$busca_cierre=0;
if($csearch)
{
$busca_cierre=$objformulario->replace_cmb("dns_varioscompras","compra_id,compra_procesado"," where compra_id=",$csearch,$DB_gogess);

if($busca_cierre==1)
{
  $campos_tipo=Array
	(
	'categ_id'=> 'hidden2',
	'compra_numeroproceso'=> 'hidden2',
	'proveevar_id'=> 'hidden2',
	'tipop_id'=> 'hidden2',
	'compra_nfactura'=> 'hidden2',	
	'compra_fecha'=> 'hidden2',
	'compra_valorfactura'=> 'hidden2',
	'compra_recibe'=> 'hidden2',
	'compra_rtecnico'=> 'hidden2',
	'compra_admcontrato'=> 'hidden2',
	'frm_id'=> 'hidden2',
	'compra_descripcion'=> 'hidden2',
	'compra_fechaaprobacion'=> 'hidden2',
	'compra_documento'=> 'txtarchivovergrafico',
	'tipom_id'=> 'hidden2',
	'tipomov_id'=> 'hidden2',
	'tipdoc_id'=>'hidden3',
	'subtgen_id'=>'hidden3',
	'compra_vencimiento'=>'hidden3',
	'compra_claveacceso'=>'hidden3',
	'compra_xml'=>'hidden3',
	'compra_ordendecompra'=>'hidden3',
	'compra_autorizacion'=>'hidden3',
	'prcomp_afijo'=>'hidden3',
	'prcomp_grcuenta'=>'hidden3',
	'prcomp_grdfpago'=>'hidden3',
	'prcomp_grproducto'=>'hidden3',
	'compra_subtotaliva'=>'hidden3',
	'compra_subtotalceroiva'=>'hidden3',
	'compra_descuento'=>'hidden3',
	'compra_iva'=>'hidden3',
	'compra_total'=>'hidden3',
	'compra_cuentacajachica'=>'hidden3',
	'compra_pagacajachica'=>'hidden3',
	'compra_ice'=>'hidden3'
	
	);

}
else
{
 $campos_tipo=Array
	(
	 'tipop_id'=>'hidden3',
	 'compra_ndocumento'=>'hidden3',
	 'compra_nfactura'=> 'hidden2',
	 'frm_id'=>'hidden3',
	 'compra_valorfactura'=>'textvalorfactura',
	 'compra_admcontrato'=>'hidden3',
	 'proveevar_id'=>'hidden3',
	 'centroor_id'=>'hidden3',
	 'tipdoc_id'=>'hidden3',
	 'subtgen_id'=>'hidden3',
	 'compra_vencimiento'=>'hidden3',
	 'compra_claveacceso'=>'hidden3',
	 'compra_xml'=>'hidden3',
	 'compra_ordendecompra'=>'hidden3',
	 'compra_autorizacion'=>'hidden3',
	 'prcomp_afijo'=>'hidden3',
	 'prcomp_grcuenta'=>'hidden3',
	 'prcomp_grdfpago'=>'hidden3',
	 'prcomp_grproducto'=>'hidden3',
	 'compra_subtotaliva'=>'hidden3',
	 'compra_subtotalceroiva'=>'hidden3',
	 'compra_descuento'=>'hidden3',
	 'compra_iva'=>'hidden3',
	 'compra_total'=>'hidden3',
	 'compra_cuentacajachica'=>'hidden3',
	 'compra_pagacajachica'=>'hidden3',
	 'compra_ice'=>'hidden3',
	 'compra_descripcion'=>'textareapr'
	 
	);
  
}


}
else
{

   $campos_tipo=Array
	(
	 'tipom_id'=> 'hidden2',
	 'tipomov_id'=> 'selectrecibe',
	 'tipop_id'=>'hidden3',
	 'frm_id'=>'hidden3',
	 'compra_ndocumento'=>'hidden3',
	 'compra_valorfactura'=>'textvalorfactura',
	 'compra_admcontrato'=>'hidden3',
	 'proveevar_id'=>'hidden3',
	 'centroor_id'=>'hidden3',
	  'tipdoc_id'=>'hidden3',
	  'subtgen_id'=>'hidden3',
	  'compra_vencimiento'=>'hidden3',
	  'compra_claveacceso'=>'hidden3',
	  'compra_xml'=>'hidden3',
	  'compra_ordendecompra'=>'hidden3',
	  'compra_autorizacion'=>'hidden3',
	  'prcomp_afijo'=>'hidden3',
	  'prcomp_grcuenta'=>'hidden3',
	  'prcomp_grdfpago'=>'hidden3',
	  'prcomp_grproducto'=>'hidden3',
	  'compra_subtotaliva'=>'hidden3',
	  'compra_subtotalceroiva'=>'hidden3',
	  'compra_descuento'=>'hidden3',
	  'compra_iva'=>'hidden3',
	  'compra_total'=>'hidden3',
	  'compra_cuentacajachica'=>'hidden3',
	  'compra_pagacajachica'=>'hidden3',
	  'compra_ice'=>'hidden3',
	  'compra_descripcion'=>'textareapr'
	  
	  
	 
	);


}
//busca_cierre
				  

$comillasimple="'";

if($busca_cierre==0)
{
$botonenvio='<div align="center">

<table border="0" cellpadding="0" cellspacing="3">

			  <tr>

				<td><button type="submit" class="btn btn-primary">Guardar / Actualizar</button></td>

			  </tr>

			</table>

</div>';	

}

$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';

 //$funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";

$funcionextrag="listado_facturas();";

$template_reemplazo='templateformsweb/maestro_standar_ingresos3/';			  



?>
<style type="text/css">
<!--
table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {

    padding: 2px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;

}

.btn {
    display: inline-block;
    padding: 4px 4px;
    margin-bottom: 0;
    font-size: 11px;
    font-weight: 400;
	}

.form-control {
    display: block;
    width: 100%;
    height: 27px;
    padding: 6px 6px;
    font-size: 12px;
}	
-->
</style>

<?php
$busca_sinporcesar="select count(*) sinprocesar from dns_varioscompras where compra_procesado=0";
$rs_sinproce = $DB_gogess->executec($busca_sinporcesar,array()); 

$valida_existe=0;
if(!($csearch))
{
 $valida_existe=$rs_sinproce->fields["sinprocesar"];
}
?>

<div align="center" >	 

<?php
if($valida_existe>0)
{

echo "<center><br><br><br><b>No se puede crear un egreso ya que tiene pendientes por procesar...</b><br></center>";
}
else
{
?>

<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="">
<table  border="0" cellpadding="4" cellspacing="0">
  <tr>
    <td valign="top"><?php	
		include("../../../../tablascell.php");	

?></td>
    </tr>
</table>
</form>	
<?php
}
?>


</div>

<div id=div_alias >

  <input name="alias_valor" type="hidden" id="alias_valor" value="" />

</div>

<div id=div_ncontenido ></div>



<script type="text/javascript">

<!--

//CKEDITOR.disableAutoInline = true;

	//$( 'textarea#introtext' ).ckeditor();

//  End -->



</script>

<script type="text/javascript">

<!--

//$( "#tare_fechainicio" ).datepicker({dateFormat: 'yy-mm-dd'});

//$( "#tare_fechafin" ).datepicker({dateFormat: 'yy-mm-dd'});




//  End -->

</script>




<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$table='dns_egresocentros'; 
$subindice='_egresocentros';
$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");

$insu_valorx=$_POST["pVar7"];


//leer con json
$lista_tbldata=array('gogess_sisfield','gogess_sistable');
$contenido = file_get_contents(@$director."jason_files/tablas/".$table.".json");
$gogess_sistable = json_decode($contenido, true);

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");
$gogess_sisfield = json_decode($contenido, true);
//leer con json 

 
if ($table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }

$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";

$lista_tabla="select * from gogess_sistable where tab_name='dns_egresocentros'";
$rs_tabla = $DB_gogess->executec($lista_tabla,array());



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

				  

	 $comillasimple="'";
	 
	 $egrec_procesado=0;
	 if($csearch)
	 {
	   $busca_procesado="select * from dns_egresocentros where egrec_id='".$csearch."'";
	   $rs_proceso = $DB_gogess->executec($busca_procesado,array()); 
	   $egrec_procesado=$rs_proceso->fields["egrec_procesado"];
	 }
	 
	 
   if($egrec_procesado==1)
    {
		$campos_tipo=Array
		(	
		'egrec_ncomprobante'=> 'hidden3',
		'egrec_nmemo'=> 'hidden2',
		'centrod_id'=> 'hidden3',
		'egrec_representante'=> 'hidden2',
		'egrec_fecha'=> 'hidden2',	
		'egrec_responsableentrega'=> 'hidden2',
		'egrec_cedula'=> 'hidden2',
		'egrec_personalrecibe'=> 'hidden2',
		'egrec_cedularecibe'=> 'hidden2',
		'egrec_motivo'=> 'hidden2',
		'egrec_otrosdestino'=> 'hidden2',
		'destv_id'=> 'hidden2'
		);	
	}
	else
	{
	   $campos_tipo=Array
		(	
			'tipomov_id'=> 'selectegre',
			'centrod_id'=> 'hidden3',
			'destv_id'=> 'select',
			'egrec_motivo'=> 'text',
			'egrec_otrosdestino'=> 'text'				
					
		);	
	
	}
	

if($egrec_procesado==1)
    {
	
  

    $botonenvio='<div align="center">
<table border="0" cellpadding="0" cellspacing="3">					  
			   <tr>
				<td><br></td>
			  </tr>			  
			  <tr>
				<td><button type="button" class="btn btn-primary" style="width:150px" onclick="imprimir_despacho()" >Imprimir</button></td>
			  </tr>			  
			  <tr>
				<td><br></td>
			  </tr>	  
			 
</table>
</div>';	
	
	}
	else
	{
	
	$botonenvio='<div align="center">
<table border="0" cellpadding="0" cellspacing="3">
			  <tr>
				<td><button type="submit" class="btn btn-primary" style="width:150px" >Guardar / Actualizar</button></td>
			  </tr>			  
			   <tr>
				<td><br></td>
			  </tr>			  
			  <tr>
				<td><button type="button" class="btn btn-primary" style="width:150px" onclick="imprimir_despacho()" >Imprimir</button></td>
			  </tr>			  
			  <tr>
				<td><br></td>
			  </tr>			  
			  <tr>
				<td><button type="button" class="btn btn-success" style="width:150px" onclick="procesar_despacho()" >Procesar</button></td>
			  </tr>
</table>
</div>';
	
	
	}


	



$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';

 //$funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";

$funcionextrag="listado_despachos();";

$template_reemplazo='templateformsweb/maestro_standar_egresovarios2/';			  



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

<div id="proceso_divval">

<div align="center" >	 

<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action=""> 

<table  border="0" cellpadding="4" cellspacing="0">

  <tr>

    

    <td valign="top"><?php		

		include("../../../../tablascell.php");

		

?></td>

    </tr>

</table>



</form>	
</div>

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




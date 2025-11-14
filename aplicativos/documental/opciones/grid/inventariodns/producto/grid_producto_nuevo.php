<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$table='dns_cuadrobasicomedicamentos'; 
$subindice='_producto';
$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)

 {

  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

 } 

$objformulario= new  ValidacionesFormulario();

$objtableform= new templateform();

 if ($table)

  {

  $objtableform->select_templateform(@$table,$DB_gogess);	

  }

$objformulario->sisfield_arr=$gogess_sisfield;

$objformulario->sistable_arr=$gogess_sistable;

$comillasimple="'";

$lista_tabla="select * from gogess_sistable where tab_name='dns_cuadrobasicomedicamentos'";
$rs_tabla = $DB_gogess->executec($lista_tabla,array());

if(@$_SESSION['ces1313777_usua_subadm']==1)
{
$campos_tipo=Array
(
	'usua_id'=> 'hidden3',
	'tare_id'=> 'hidden3',
	'caucab_id'=> 'hidden3',
	'caucab_nregistro'=> 'hidden2'
);

}
else
{
	$campos_tipo=Array
(
	'usua_id'=> 'hidden3',
	'tare_id'=> 'hidden3',
	'caucab_id'=> 'hidden3',
	'caucab_nregistro'=> 'hidden2',
	'categ_id'=> 'hidden2',
	'cuadrobm_codigoatc'=> 'hidden2',
	'cuadrobm_stockminimo'=> 'hidden2',
	'cuadrobm_nombrecomercial'=> 'hidden2peke',
	'cuadrobm_principioactivo'=> 'hidden2peke',
	'cuadrobm_planillable'=> 'hidden2',
	'cuadrobm_preciocaja'=> 'hidden2',
	'cuadrobm_primerniveldesagregcion'=> 'hidden2peke',
	'cuadrobm_tercerniveldesagregcion'=> 'hidden2peke',
	'cuadrobm_concentracion'=> 'hidden2peke',
	'cuadrobm_presentacion'=> 'hidden2peke',
	'cuadrobm_preciotecho'=> 'hidden2peke',
	'cuadrobm_preciotechomenosporcentaje'=> 'hidden2peke',
	'cuadrobm_registrosanitario'=> 'hidden2peke',
	'cuadrobm_numerodispositivo'=> 'hidden2',
	'cuadrobm_nombredispositivo'=> 'hidden2',
	'cuadrobm_especificaciontecnica'=> 'hidden2',
	'despliegue_cuadrobm_especificaciontecnica'=> 'hidden2',
	'nivelr_nombre'=> 'hidden2',
	'cuadrobm_especialidad'=> 'hidden2',
	'cuadrobm_apicacionuso'=> 'hidden2',
	'cuadrobm_preciodispositivo'=> 'hidden2',
	'nivelat_ia'=> 'checkboxver',
	'nivelat_ib'=> 'checkboxver',
	'nivelat_ic'=> 'checkboxver',
	'nivelat_ii'=> 'checkboxver',
	'nivelat_iii'=> 'checkboxver',
	'cuadrobm_preciomedicamento'=> 'hidden2peke',
	'cuadrobm_codigoispol'=> 'hidden2',
	'cuadrobm_valorplanilladispositivos'=> 'hidden2peke'
		
);

	
}



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

if(@$_SESSION['ces1313777_usua_subadm']==1)
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

$funcionextrag="listado_buscainventario($('#cuadrobm_principioactivo').val(),$('#cuadrobm_nombredispositivo').val());";

$template_reemplazo='templateformsweb/maestro_standar_inventario2/';			  



?>
<style type="text/css">
<!--
table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {

    padding: 2px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;

}
-->
</style>


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




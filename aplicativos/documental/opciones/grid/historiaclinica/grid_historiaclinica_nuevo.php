<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$table='corpo_historiaclinica'; 
$subindice='_historiaclinica';
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

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



$campos_tipo=Array
(
	
	'usua_id'=> 'hidden3',
	'tare_id'=> 'hidden3',
	'caucab_id'=> 'hidden3',
	'caucab_nregistro'=> 'hidden2'
	

	
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
				  
	 $comillasimple="'";
		 $botonenvio='


<div align="center">
		 <div class="form-group">
         <div class="col-xs-12">
		   
			<button type="submit" class="mb-sm btn btn-primary" >GUARDAR</button>
			<button type="button" class="mb-sm btn btn-danger"  onClick="funcion_cerrar_pop('.$comillasimple.'divDialog'.$subindice.$comillasimple.')"  >Cancelar</button>
		
		</div>
		</div>
		
</div>


';	

$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';
 //$funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";
$funcionextrag="desplegar_grid()";
$template_reemplazo='templateformsweb/maestro_standar_cliente/';			  

?>

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:900px;">
<div class="alert alert-success"> <B>PERFIL CLIENTE</B> </div>

 <form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal"  > 
<?php		
		include("../../../tablas.php");
		
?>

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
$( "#clie_fechanacimiento" ).datepicker({dateFormat: 'yy-mm-dd'});
//  End -->
</script>

zzzz
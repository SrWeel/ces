<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$table='beko_producto'; 
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

		 $botonenvio='<div align="center">

<table border="0" cellpadding="0" cellspacing="3">

			  <tr>

				<td><button type="submit" class="btn btn-primary">Guardar / Actualizar</button></td>

			    <td>&nbsp;</td>

			    <td><button type="button" class="mb-sm btn btn-danger"  onClick="funcion_cerrar_pop('.$comillasimple.'divDialog'.$subindice.$comillasimple.')"  >Cancelar</button></td>

			  </tr>

			</table>

</div>';	



$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';

 //$funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";

$funcionextrag="lista_productos()";

$template_reemplazo='templateformsweb/maestro_standar_producto/';			  



?>



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




<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$table='dns_temporalovimientoinventario'; 
$subindice='_movimiento';
$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");

$insu_valorx=$_POST["pVar7"];
$compra_id=$_POST["compra_id"];

//$tipom_idx=1;
//$tipomov_idx=6;

//leer con json
$lista_tbldata=array('gogess_sisfield','gogess_sistable');
$contenido = file_get_contents(@$director."jason_files/tablas/".$table.".json");
$gogess_sistable = json_decode($contenido, true);

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");
$gogess_sisfield = json_decode($contenido, true);
//leer con json 


$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

 if ($table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }

$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";

$busca_cierre=$objformulario->replace_cmb("dns_compras","compra_id,compra_procesado"," where compra_id=",$compra_id,$DB_gogess);



if($busca_cierre==0)
{

$campos_tipo=Array
(
	'usua_id'=> 'hidden3',
	'tare_id'=> 'hidden3',
	'caucab_id'=> 'hidden3',
	'caucab_nregistro'=> 'hidden2',
	'tipom_id'=>'hidden2peke2',
	'tipomov_id'=>'hidden2peke2'

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
	'tipom_id'=>'hidden2peke2',
	'tipomov_id'=>'hidden2peke2',
	'cuadrobm_id'=>'hidden2peke2',
	'moviin_nlote'=>'hidden2peke2',
	'moviin_rsanitario'=>'hidden2peke2',
	'moviin_fechadecaducidad'=>'hidden2peke2',
	'moviin_fechadeelaboracion'=>'hidden2peke2',
	'moviin_nombrefabricante'=>'hidden2peke2',
	'moviin_presentacioncomercial'=>'hidden2peke2',	
	'centrorecibe_cantidad'=>'hidden2peke2',
	'moviin_preciocompra'=>'hidden2peke2',
	'centrorecibe_documento'=>'txtarchivovergrafico'	

);

}

//centrorecibe_documento

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
if($busca_cierre==0)
{
		 $botonenvio='<div align="center">
<table border="0" cellpadding="0" cellspacing="3">
			  <tr>
				<td><button type="submit" class="btn btn-primary">Aceptar</button></td>
				<td>&nbsp;</td>
				<td><button type="button" class="btn btn-primary" onclick="desplegar_formulario(0);" >Nuevo</button></td>
			
			  </tr>
			</table>
</div>';	

}
else
{
       $botonenvio='<div align="center">
<table border="0" cellpadding="0" cellspacing="3">
			  <tr>				
				<td></td>
			  </tr>
			</table>
</div>';


}

$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';

 //$funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";
$funcionextrag="desplegar_grid_su();
listado_facturas();
actualiza_unidad();

";

$template_reemplazo='templateformsweb/maestro_standar_mcompras2/';			  



?>
<style type="text/css">
<!--
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
 <div align="center" >	 

 <form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" autocomplete="off"  > 
 


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

<script type="text/javascript">

<!--

//$( "#tare_fechainicio" ).datepicker({dateFormat: 'yy-mm-dd'});

//$( "#tare_fechafin" ).datepicker({dateFormat: 'yy-mm-dd'});

function desplegar_movimientos()
{

   abrir_standar("../../../../../templateformsweb/maestro_standar_movimiento2/panel_movimiento.php","Movimientos","divBody_lista","divDialog_lista",700,400,'<?php echo $_POST["pVar7"]; ?>','<?php echo $_POST["centro_id"]; ?>',0,0,0,0,0);
   
}



//  End -->

</script>

<style type="text/css">
<!--
.form-control
{
	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-size: 11px;

	height: 24px;

    padding: 3px 6px;

}

.form-group {

    margin-bottom: 5px;

}
-->
</style>




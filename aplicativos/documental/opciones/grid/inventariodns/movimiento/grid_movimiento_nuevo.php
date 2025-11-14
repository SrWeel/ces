<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$table='dns_movimientoinventario'; 
$subindice='_movimiento';
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
				<td><button type="submit" class="btn btn-primary">Aceptar</button></td>
				<td>&nbsp;</td>
				<td><button type="button" class="btn btn-primary" onclick="desplegar_formulario(0);" >Nuevo</button></td>
				<td>&nbsp;</td>
				<td><button type="button" class="btn btn-primary" onclick="desplegar_movimientos();" >Ver Movimientos</button></td>
			  </tr>
			</table>
</div>';	



$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';

 //$funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";

$funcionextrag="desplegar_grid_su();
listado_inventario();
";

$template_reemplazo='templateformsweb/maestro_standar_movimiento2/';			  



?>



 <div align="center" >	 

 <form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" autocomplete="off"  > 
 
 <?php
 $nproducto_sql="select * from dns_cuadrobasicomedicamentos where cuadrobm_id=".$_POST["pVar7"];
 $rs_npsql = $DB_gogess->executec($nproducto_sql);
 
	$nom='';					
	if($rs_npsql->fields["cuadrobm_principioactivo"])
	{
	$nom=$rs_npsql->fields["cuadrobm_principioactivo"].' ';
	}
	
	$nom1='';					
	if($rs_npsql->fields["cuadrobm_nombrecomercial"])
	{
	$nom1=$rs_npsql->fields["cuadrobm_nombrecomercial"].' ';
	}
	
	$nom2='';					
	if($rs_npsql->fields["cuadrobm_primerniveldesagregcion"])
	{
	$nom2=$rs_npsql->fields["cuadrobm_primerniveldesagregcion"].' ';
	}
	
	$nom3='';					
	if($rs_npsql->fields["cuadrobm_tercerniveldesagregcion"])
	{
	$nom3=$rs_npsql->fields["cuadrobm_tercerniveldesagregcion"].' ';
	}
	
	$nom4='';					
	if($rs_npsql->fields["cuadrobm_concentracion"])
	{
	$nom4=$rs_npsql->fields["cuadrobm_concentracion"].' ';
	}
	
	$nom5='';					
	if($rs_npsql->fields["cuadrobm_nombredispositivo"])
	{
	$nom5=$rs_npsql->fields["cuadrobm_nombredispositivo"].' ';
	}
	 
	
	$concatena_nom=$nom;
 
 echo "<b>".utf8_encode($concatena_nom)."</b>";
 ?>

<table width="1100" border="0" cellpadding="4" cellspacing="0">

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




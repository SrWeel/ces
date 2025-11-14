<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444544000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//saca datos de la tabla
$atenc_id=$_POST["pVar1"];
$mnupan_id=$_POST["pVar2"];
$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($_POST["pVar2"]));
$lista_atencion="select * from dns_atencion where atenc_id=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));
$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());

$tab_id=$rs_datosmenu->fields["tab_id"];
//busca datos del paciente
$datos_cliente="select * from app_cliente where clie_id=".$rs_atencion->fields["clie_id"];
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());


//mira el utlimo registro

$clie_id=$rs_atencion->fields["clie_id"];
$busca_sihaydata="select * from faesa_evolucion where atenc_id=? and clie_id=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($atenc_id,@$clie_id));
$evolu_id_valor=0;
$evolu_id_valor=@$rs_sihaydata->fields["evolu_id"];

//mira el ultimo registro



//busca evaluacion
//echo $rs_atencion->fields["atenc_enlace"];
$busca_evaluaciondatos="select * from dns_atencionevaluacion where atenc_enlace='".$rs_atencion->fields["atenc_enlace"]."' order by eteneva_id asc limit 1";
$rs_evaluaciondatos = $DB_gogess->executec($busca_evaluaciondatos,array());
$eteneva_id=0;
$eteneva_id=@$rs_evaluaciondatos->fields["eteneva_id"];


if($eteneva_id)
{

$busca_docfecha="select * from faesa_asigahorario where eteneva_id=".@$eteneva_id." and atenc_id=".$atenc_id;
$rs_docfecha = $DB_gogess->executec($busca_docfecha,array($atenc_id,@$clie_id));

$especi_id=$areas_id[$table];
$tipp_id=0;
if($especi_id==0)
{
$tipp_id=1;
}
else
{
$tipp_id=2;
}
$grup_id=$rs_docfecha->fields["grup_id"];

if($especi_id==0)
{

$buscadatos_fecha="select * from faesa_integragrupo inner join faesa_asigahorario on faesa_integragrupo.grup_id=faesa_asigahorario.grup_id where faesa_asigahorario.grup_id=".$grup_id." and tipp_id=".$tipp_id." and clie_id=".$clie_id;

}
else
{
$buscadatos_fecha="select * from faesa_integragrupo inner join faesa_asigahorario on faesa_integragrupo.grup_id=faesa_asigahorario.grup_id where faesa_asigahorario.grup_id=".$grup_id." and tipp_id=".$tipp_id." and especi_id=".$especi_id." and clie_id=".$clie_id;

}
$rs_buscadatos_fecha = $DB_gogess->executec($buscadatos_fecha,array());


}


//busca evaluacion


//saca datos de la tabla

//echo $_POST["pVar1"];

//Llamando objetos



$table=$rs_tabla->fields["tab_name"];  





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



//para cambiar el formato de algunos campos



$lista_camposv=explode(';',$rs_datosmenu->fields["mnupan_camposforma"]);

$campos_tipo=array();

for($i=0;$i<count($lista_camposv);$i++)

{

    $separa_campo=explode(',',$lista_camposv[$i]);

	if($separa_campo[0])

	{

	$campos_tipo[$separa_campo[0]]=$separa_campo[1];

    }

}



//para cambiar el formato de algunos campos     

	

	$em_id_val=0;	

	$csearch=0;	

	$variableb=0;

			if($evolu_id_valor=='0')

				  {

					 $variableb=0;

				  }

				  else

				  {

					 $variableb=$evolu_id_valor;

					 $_REQUEST["opcion_".$table]="buscar";

			         $csearch=$evolu_id_valor;				 

				  }

		 

		 $comillasimple="'";

		 $botonenvio='<br><br>



<div align="center">

		 <div class="form-group">

         <div class="col-xs-12">

		   

			<button type="submit" class="mb-sm btn btn-primary" >GUARDAR '.strtoupper(utf8_encode($rs_tabla->fields["tab_title"])).'</button>

		

		</div>

		</div>

</div>





';	

		$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';

        @$funciones_cuandoguarda="$('#".@$divresultado."').html('".@$mensajege."')";

		

		

		if($rs_datosmenu->fields["mnupan_templatetabla"])

		{

  		$template_reemplazo='templateformsweb/'.$rs_datosmenu->fields["mnupan_templatetabla"].'/';

		}

		else

		{

		$template_reemplazo='templateformsweb/maestro_standar_standar/';

		

		}

		

		//echo $template_reemplazo;

?>	

<style>

label.error{

color:red;

font-family:Verdana, Arial, Helvetica, sans-serif;

font-style:italic;

font-size:11px;

}

div.error{

display:none;

}

input{

}

input.checkbox{

border:none

}

input:focus{

border:1px dotted black;

}

input.error{

border:1px dotted red;

}



</style> 

<style type="text/css">

<!--

.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }

.espacio_css {

	font-size: 7px;

	font-family: Arial, Helvetica, sans-serif;

}

-->

</style>

<br>



<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">





<button type="button" class="mb-sm btn btn-success" onclick="ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_terapia.php','Perfil','divBody_ext',0,'41',0,0,0,0,0)" style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar </button>

<p></p>


<?php


$linkimprimir='onClick=imprimir_datos();';
echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>';


?>

<?php
//verificar pagos de terapias

echo $objvarios->lista_terapias_porpagar($clie_id,$DB_gogess);

?>

<div class="form-group">

<div class="col-xs-3">
<div class="alert alert-success"> <B> <?php echo strtoupper(utf8_encode($rs_tabla->fields["tab_title"])); ?> </B> </div>
</div>



<div class="col-xs-3">


<?php
if($_SESSION['ces1313777_sessid_inicio']==75 or $_SESSION['ces1313777_sessid_inicio']==78)
{
?> 
	<label>Desde:</label>
	<input name="fechai" class="form-control" type="text" id="fechai" value="">
	</div>
	
	<div class="col-xs-3">
	<label>Hasta:</label>
	<input name="fechaf" class="form-control" type="text" id="fechaf" value="">
	</div>
<?php
}
else
{
?>
	<label>Desde:</label>
	<input name="fechai" class="form-control" type="text" id="fechai" value="<?php echo date("Y-m-d"); ?>">
	</div>
	
	<div class="col-xs-3">
	<label>Hasta:</label>
	<input name="fechaf" class="form-control" type="text" id="fechaf" value="<?php echo date("Y-m-d"); ?>">
	</div>
<?php
}
?>



<div class="col-xs-3">
<label>&nbsp;</label>
<button type="button" class="mb-sm btn btn-primary" style="background-color:#000066" onclick="actualiza_form()">Actualizar lista inferior por fechas</button>
</div>

</div>






<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 

<?php		

if(!(@$ver_boton))

{

 echo $botonenvio;

}


		include("tablas.php");

		

?>	

</form>

</div>

<?php

}			
else
{
echo '<div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Su sesi&oacute;n a caducado de precione F5 para continuar...</div>';
	
}
?>


<script type="text/javascript">

<!--
$( "#fechai" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#fechaf" ).datepicker({dateFormat: 'yy-mm-dd'});

$( "#usua_fechanacimiento" ).datepicker({dateFormat: 'yy-mm-dd'});

function imprimir_datos()
{

if($('#evolu_id').val()=='')
{
   alert('Guarde el resgitros para imprimir datos');
   return false;

}


   myWindow3=window.open('aplicativos/documental/reportes/datos_substandarformterapia_print.php?pVar1='+$('#evolu_id').val()+'&pVar2=<?php echo @$_SESSION['ces1313777_sessid_inicio']; ?>'+'&fechai='+$( "#fechai" ).val()+'&fechaf='+$("#fechaf").val(),'ventana_evolucion','width=850,height=700,scrollbars=YES');

   myWindow3.focus();



}




//  End -->

</script>
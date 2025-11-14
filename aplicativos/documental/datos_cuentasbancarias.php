<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$tipofor_id=0;
$clie_id=$_POST["pVar2"];
$mnupan_id=$_POST["pVar3"];

$eteneva_id=@$_POST["pVar5"];
$centro_id=@$_POST["pVar7"];
$tipofor_id=@$_POST["pVar6"];

$namemodulo="cuentasbancarias";

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//saca datos de la tabla

$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));



$lista_tabla="select * from gogess_sistable,gogess_styletable where gogess_sistable.st_id=gogess_styletable.st_id and tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());

$tab_id=$rs_datosmenu->fields["tab_id"];
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"];
$campo_primario=$rs_tabla->fields["tab_campoprimario"];
$table=$rs_tabla->fields["tab_name"];


$titulo_formualario='';
$titulo_formualario=$rs_tabla->fields["tab_title"];

//saca datos de la tabla
//Llamando objetos
//buca registro unico por cliente
$bloque_registro=0;

//include(@$director."libreria/estructura/aqualis_master.php");
$lista_tbldata=array('gogess_sisfield','gogess_sistable');

$contenido = file_get_contents(@$director."jason_files/tablas/".$table.".json");
$gogess_sistable = json_decode($contenido, true);
 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

//leer con json
$contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");
$gogess_sisfield = json_decode($contenido, true);
//leer con json 
 
//include(@$director."libreria/estructura/".$table.".php");

if($table)
  {
    //$objtableform->select_templateform(@$table,$DB_gogess);
    $objtableform->select_templateform_rs(@$table,@$rs_tabla,$DB_gogess);	
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

		//echo $csearch; 

		 $comillasimple="'";

		 $botonenvio='<br><br>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12">
			<button type="submit" class="mb-sm btn btn-primary" > GRABAR Y PLANILLAR </button>
		</div>
		</div>
</div>

';	


 $botonenvio='
<div class="form-group">
         <div class="col-xs-'.$ancho_valor.'"> 
<div class="alert alert-info" role="alert">
  <p><b>Nota importante!</b>
  Por favor no olvide guardar el registro cuando termine de ingresar datos, si no lo hace los datos se perder&aacute;n</p>
</div>
          </div>	  
		  '.$mensaje_alergia.'  
		  
</div>

<div align="center">
		 <div class="form-group">
         <div class="col-xs-12"><div id="boton_guardarformdata">
			<button type="button" class="mb-sm btn btn-primary" onclick="enviar_formulariodata('.$comillasimple.'form_'.$table.$comillasimple.')"  > GRABAR  </button>
		</div></div>
		</div>
		
	<div id="mensaje_gsistema" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" ></div>		
		
</div>
';

$botonenvio2='<br><br>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12"><div id="boton_guardarformdata2">
			<button type="button" class="mb-sm btn btn-primary" onclick="enviar_formulariodata('.$comillasimple.'form_'.$table.$comillasimple.')"  > GRABAR  </button>
		</div></div>
		</div>
		
	<div id="mensaje_gsistema2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" ></div>		
		
</div>

<div class="form-group">
         <div class="col-xs-12">

<div class="alert alert-info" role="alert">
  <p><b>Nota importante!</b>
  Por favor no olvide guardar el registro cuando termine de ingresar datos, si no lo hace los datos se perder&aacute;n.</p>
</div>

           </div>

</div>
';

if($bloque_registro==1)
{
   $botonenvio='';
   $botonenvio2='';
}


		$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';

        @$funcionextrag=" 
		setTimeout(function () { $('#mensaje_gsistema').fadeIn(); },1);
		setTimeout(function () { $('#mensaje_gsistema2').fadeIn(); },1);
		
		$('#mensaje_gsistema').html('Registro guardado con exito...');
		$('#mensaje_gsistema2').html('Registro guardado con exito...');
		
		setTimeout(function () { $('#mensaje_gsistema').fadeOut(); }, 2000);
		setTimeout(function () { $('#mensaje_gsistema2').fadeOut(); }, 2000);

		$('#div_".$table."').html('.');
		
		desplegar_grid_".$namemodulo."();

		";
		
		if($rs_datosmenu->fields["mnupan_templatetabla"])
		{
  		$template_reemplazo='templateformsweb/'.$rs_datosmenu->fields["mnupan_templatetabla"].'/';
		}
		else
		{
		$template_reemplazo='templateformsweb/maestro_standar_substandar/';
		}

		//echo $template_reemplazo;

?>
<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">

<div class="panel panel-default">
 <div class="panel-heading">

    <h3 class="panel-title" style="color:#000033" ><?php echo $titulo_formualario; ?></h3>

 </div>
<div class="panel-body">
<?php

$linkimprimir='onClick=imprimir_datos();';
//$linkimprimir='onClick=genera_pdf();';

echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>';


echo '<div id="divBody_foto"></div>';
//cambio de fecha registro

?>
<br />
<div id="lista_turnosval">
</div>

<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 

<?php		

		echo $botonenvio;

		include("tablas_unico.php");

		echo $botonenvio2;

?>	

</form>

<?php
$linkimprimir='onClick=imprimir_datos();';
//$linkimprimir='onClick=genera_pdf();';
echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>';

?>
</div>
</div>

<?php

}			
else
{
echo '<center><div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Tu sesi&oacute;n ha expirado</div></center>';
echo '
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession","divDialog_acsession",400,400,"",0,0,0,0,0,0);
//  End -->
</script>

<div id="divBody_acsession"></div>
';

 
}	

?>
<div id="divBodypop_ext" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></div>
<div id="verifica_sess"></div>

<script type="text/javascript">
<!--



$( "#usua_fechanacimiento" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#lab_fechasolicitud" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#lab_fechatoma" ).datepicker({dateFormat: 'yy-mm-dd'});

function guarda_data()
{
  <?php
    $comillasimple="'";
    echo 'enviar_formulario('.$comillasimple.'form_'.$table.$comillasimple.')';
   ?>

}


function imprimir_datos()
{
   if($('#<?php echo $campo_primariodata; ?>').val()>0)
	 {
   myWindow3=window.open('aplicativos/documental/datos_substandarformunico_print.php?iddata=<?php echo $tab_id ?>&pVar2=<?php echo @$clie_id; ?>&pVar4=<?php echo $atenc_id; ?>&pVar5=<?php echo $eteneva_id; ?>&pVar3=<?php echo $mnupan_id; ?>&pVar9=' + $('#<?php echo $campo_primariodata; ?>').val(),'ventana_reporteunico','width=850,height=700,scrollbars=YES');

   myWindow3.focus();
     }
   else
   {
   alert("Por favor guarde el resgistro para imprimir");     
   }
}

<?php
$campos_data='';
$campos_data64='';
$campos_data='iddata='.$tab_id.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar5='.$eteneva_id.'&pVar3='.$mnupan_id;
$campos_data64=base64_encode($campos_data);

?>

function genera_pdf()
{
  if($('#<?php echo $campo_primariodata; ?>').val()>0)
	 {	 
	    location.href = "pdfformularios/pdformulariohospital.php?ssr=<?php echo $campos_data64."|" ?>"+$('#<?php echo $campo_primariodata; ?>').val();
	 }
	 else
	 {
       alert("Por favor guarde el resgistro para imprimir");	 
	 }

}
//  End -->
</script>
<div id="divBody_turnos"></div>
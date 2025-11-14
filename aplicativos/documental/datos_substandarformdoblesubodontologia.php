<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$clie_id=$_POST["pVar2"];
$mnupan_id=$_POST["pVar3"];
$atenc_id=$_POST["pVar4"];
$odonto_id=$_POST["pVar7"];

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//saca datos de la tabla

$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));

$titulo_btn='';
$titulo_btn='GRABAR Y PLANILLAR';
if($rs_datosmenu->fields["mnupan_nboton"])
{
  $titulo_btn=$rs_datosmenu->fields["mnupan_nboton"];	
}


$lista_atencion="select * from dns_atencion where atenc_id=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));

$enlace_atencion='';
$enlace_atencion=$rs_atencion->fields["atenc_enlace"];

$lista_tabla="select * from gogess_sistable,gogess_styletable where gogess_sistable.st_id=gogess_styletable.st_id and tab_id=".$rs_datosmenu->fields["tab_id"];
//$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());

$tab_id=$rs_datosmenu->fields["tab_id"];
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"];
//tabla secundaria

$lista_tablasec="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tabsecundario_id"];
$rs_tablasec = $DB_gogess->executec($lista_tablasec,array());

//tabla secundaria


//busca datos del paciente
$datos_cliente="select * from app_cliente where clie_id=".$clie_id;
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());
//busca datos del paciente

//saca datos de la tabla
//echo $_POST["pVar1"];
//Llamando objetos

$table=$rs_tabla->fields["tab_name"];  
$campo_primario=$rs_tabla->fields["tab_campoprimario"];  


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

 if ($table)
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
		
//----------------------------------------------------------
if($csearch)
{
    $fech_fecharegistro='';
    if($table=='dns_subsecuenteodontologia')
	{
	   $fech_fecharegistro='subsecodont_fecharegistro';
	
	}

	
	$busca_fecha="select *,DATE_ADD(".$fech_fecharegistro.",INTERVAL 3 DAY) as fechacierre from ".$table." where ".$campo_primariodata."='".$csearch."'";
	$rs_bufecha = $DB_gogess->executec($busca_fecha,array());
	
	$bloque_registro=0;
	if(@$rs_bufecha->fields["fechacierre"])
	{
	  //echo $rs_sihaydata->fields["fechacierre"];
	   if(date("Y-m-d")>$rs_bufecha->fields["fechacierre"])
	   {
	   
	   $bloque_registro=1;
	   }
	   
	}
	//echo $bloque_registro;
}
//----------------------------------------------------------
		
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

$botonenvio='<div class="alert alert-info" role="alert">
  <p><b>Nota importante!</b>
  Por favor no olvide guardar el registro cuando termine de ingresar datos, si no lo hace los datos se perder&aacute;n</p>
</div>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12"><div id="boton_guardarformdata">
			<button type="button" class="mb-sm btn btn-primary" onclick="guarda_data()"  > '.$titulo_btn.'  </button>
		</div></div>
		</div>
		
	<div id="mensaje_gsistema" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" ></div>		
		
</div>
';

$botonenvio2='<br><br>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12"><div id="boton_guardarformdata2">
			<button type="button" class="mb-sm btn btn-primary" onclick="guarda_data()"  > '.$titulo_btn.' </button>
		</div></div>
		</div>
		
	<div id="mensaje_gsistema2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" ></div>		
		
</div>
<div class="alert alert-info" role="alert">
  <p><b>Nota importante!</b>
  Por favor no olvide guardar el registro cuando termine de ingresar datos, si no lo hace los datos se perder&aacute;n</p>
</div>
';

if(@$bloque_registro==1)
{
   $botonenvio='';
   $botonenvio2='';
}


		$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';
        @$funciones_cuandoguarda="$('#".@$divresultado."').html('".@$mensajege."')";
		
		 @$funcionextrag=" 
		setTimeout(function () { $('#mensaje_gsistema').fadeIn(); },1);
		setTimeout(function () { $('#mensaje_gsistema2').fadeIn(); },1);
		
		$('#mensaje_gsistema').html('Registro guardado con exito...');
		$('#mensaje_gsistema2').html('Registro guardado con exito...');
		
		setTimeout(function () { $('#mensaje_gsistema').fadeOut(); }, 2000);
		setTimeout(function () { $('#mensaje_gsistema2').fadeOut(); }, 2000);

		$('#div_".$table."').html('.');

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
.texto_caja{
font-size: 11px; 
font-family: Verdana, Arial, Helvetica, sans-serif
}
-->
</style>
<br>

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">

<button type="button" class="mb-sm btn btn-success" onclick="ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_listasubsecuenteodontologia.php','Perfil','divBody_ext',0,'<?php echo @$clie_id; ?>','71','<?php echo $atenc_id; ?>',0,0,$('#odonto_id').val())" style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar </button>

<?php
$linkimprimir='onClick=imprimir_datos();';
echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>';


$linkimprimirpr='onClick=primeravez_datos();';
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary" '.$linkimprimirpr.'  style="cursor:pointer"> VER ODONTOGRAMA </button>';



//cambio de fecha registro
$linkcambior="onclick=abrir_standar('aplicativos/documental/cambio_fecha.php','CAMBIO','divBody_foto','divDialog_foto',500,300,'subodontologia',$('#subsecodont_id').val(),0,0,0,0,0) style='cursor:pointer'";
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-warning" '.$linkcambior.'  style="cursor:pointer"> CAMBIAR FECHA REGISTRO </button>';

$linkhistorialr="onclick=abrir_standar('aplicativos/documental/historial_fecha.php','CAMBIO','divBody_foto','divDialog_foto',790,300,'subodontologia',$('#subsecodont_id').val(),0,0,0,0,0) style='cursor:pointer'";
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-warning" '.$linkhistorialr.'  style="cursor:pointer"> HISTORIAL CAMBIO </button>';

//laboratorio
$linkeditar= 'onClick=abrir_laboratorio();';
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>PEDIDOS DE LABORATORIO</button>';


$linkeditar= 'onClick=abrir_imagenologia();';
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>IMAGENOLOGIA</button>';

echo '<div id="divBody_foto"></div>';
//cambio de fecha registro
?>




<p></p>



<div class="alert alert-success"> 



<div class="form-group">
     <div class="col-md-6">
	     <B> <?php echo $rs_tabla->fields["tab_title"]; ?> </B>
	 </div>
	 <div class="col-md-6">
	 
	  
		  
	 </div>
</div>

<br />
 </div>

<?php
$lista_turnos="select gridtur_id from cesdb_arextension.dns_gridturnos inner join dns_atencion on cesdb_arextension.dns_gridturnos.atenc_enlace=dns_atencion.atenc_enlace where especi_id=".$rs_datosmenu->fields["especi_id"]." and gridtur_fecha='".date("Y-m-d")."' and dns_atencion.centro_id=".$_SESSION['ces1313777_centro_id']." and gridtur_estado='' limit 1";
$lista_turnos="";
$rs_turnos = $DB_gogess->executec($lista_turnos,array());
if(@$rs_turnos->fields["gridtur_id"]>0)
{
	echo '<div align="right" onclick="ver_turnos()" style="cursor:pointer" ><span style="color:#FF0000; font-size:12px; font-weight:bold"><img src="images/notificacionicon.png" />Alerta!!! Tiene turnos para hoy</span></div>';
	
}
?>
 
<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 
<?php		
		echo $botonenvio;
		include("tablas.php");
		echo $botonenvio2;
?>	
</form>

<?php
$linkimprimir='onClick=imprimir_datos();';
echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>';

//laboratorio
$linkeditar= 'onClick=abrir_laboratorio();';
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>PEDIDOS DE LABORATORIO</button>';
?>

</div>
<?php

}			
?>
<div id="divBodypop_ext" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></div>
<script type="text/javascript">
<!--
//$( "#lab_fechasolicitud" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#lab_fechatoma" ).datepicker({dateFormat: 'yy-mm-dd'});


function abrir_imagenologia()
{

   if($('#<?php echo $campo_primario; ?>').val()=='')
   {
     alert("Guarde el registro para hacer el pedido de laboratorio");
     return false;
   }
 
<?php
$comill_s="'";
$link_imagen= 'abrir_standar('.$comill_s.'aplicativos/documental/opciones/panel/panel_substandarformimagen.php'.$comill_s.','.$comill_s.'IMAGEN'.$comill_s.','.$comill_s.'divBodypop_ext'.$comill_s.','.$comill_s.'divDialogpop_ext'.$comill_s.',900,700,'.$comill_s.$comill_s.','.$comill_s.@$clie_id.$comill_s.','.$comill_s.'61'.$comill_s.','.$comill_s.$atenc_id.$comill_s.',$('.$comill_s.'#'.$campo_primario.$comill_s.').val(),'.$comill_s.$table.$comill_s.','.$comill_s.$centro_id.$comill_s.');';   

echo $link_imagen;
?>



}


function abrir_laboratorio()
{
   if($('#<?php echo $campo_primario; ?>').val()=='')
   {
     alert("Guarde el registro para hacer el pedido de laboratorio");
     return false;
   }
 
<?php
$comill_s="'";
$link_laboratorio= 'abrir_standar('.$comill_s.'aplicativos/documental/opciones/panel/panel_substandarformlab.php'.$comill_s.','.$comill_s.'LABORATORIO'.$comill_s.','.$comill_s.'divBodypop_ext'.$comill_s.','.$comill_s.'divDialogpop_ext'.$comill_s.',900,700,'.$comill_s.$comill_s.','.$comill_s.@$clie_id.$comill_s.','.$comill_s.'60'.$comill_s.','.$comill_s.$atenc_id.$comill_s.',$('.$comill_s.'#'.$campo_primario.$comill_s.').val(),'.$comill_s.'dns_subsecuenteodontologia'.$comill_s.','.$comill_s.$centro_id.$comill_s.');';   

echo $link_laboratorio;
?>

}



function  abre_formulariosecundario()
{
  if($('#<?php echo $campo_primario; ?>').val()>0)
   {
     ver_formularioenpantalla('aplicativos/documental/datos_substandarformsecundario.php','SECUNDARIO','divBody_ext',0,'<?php echo @$clie_id; ?>','<?php echo $mnupan_id; ?>','<?php echo $atenc_id; ?>',0,0,$('#<?php echo $campo_primario; ?>').val());

   }
   else
   {
   
      alert("Guarde el registro para ingresar");
   }	

}
 

function imprimir_datos()
{
	
  if($('#<?php echo $campo_primariodata; ?>').val()>0)
	 {
   myWindow3=window.open('aplicativos/documental/datos_substandarformdoble_print.php?iddata=<?php echo $tab_id ?>&pVar2=<?php echo @$clie_id; ?>&pVar4=<?php echo $atenc_id; ?>&pVar5='+$('#<?php echo $campo_primariodata; ?>').val()+'&pVar3=<?php echo $mnupan_id; ?>','ventana_reporteunico','width=850,height=700,scrollbars=YES');

   myWindow3.focus();
   }
   else
   {
   alert("Por favor guarde el resgistro para imprimir");
     
   
   }

   
}

function ver_turnos()
{
	
	abrir_standar_pop("aplicativos/documental/listados_turnos.php","TURNOS","divBody_turnos","divDialog_turnos",400,400,"<?php echo $rs_datosmenu->fields["especi_id"]; ?>","<?php echo $_SESSION['ces1313777_centro_id']; ?>",0,0,0,0,0);
	
}

function guarda_data()
{
  <?php
    echo $rs_tabla->fields["tab_valextguardar"];
	
    $comillasimple="'";
    echo 'enviar_formulariodata('.$comillasimple.'form_'.$table.$comillasimple.')';
   ?>

}


function primeravez_datos()
{
	

   myWindow3=window.open('aplicativos/documental/datos_substandarformdoble_print.php?iddata=322&pVar2=<?php echo @$clie_id; ?>&pVar4=<?php echo $atenc_id; ?>&pVar5='+$('#odonto_id').val()+'&pVar3=62','ventana_reporteunico','width=850,height=700,scrollbars=YES');

   myWindow3.focus();


   
}

//  End -->
</script>
<div id="divBody_turnos"></div>
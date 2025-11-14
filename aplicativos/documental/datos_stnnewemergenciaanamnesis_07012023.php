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
$atenc_id=$_POST["pVar4"];
$eteneva_id=@$_POST["pVar5"];
$centro_id=@$_POST["pVar7"];
$tipofor_id=@$_POST["pVar6"];

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//saca datos de la tabla

$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));


$lista_atencion="select * from dns_atencion where atenc_id=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));

$enlace_atencion='';
$enlace_atencion=$rs_atencion->fields["atenc_enlace"];

$lista_tabla="select * from gogess_sistable,gogess_styletable where gogess_sistable.st_id=gogess_styletable.st_id and tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());

$tab_id=$rs_datosmenu->fields["tab_id"];
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"];
$campo_primario=$rs_tabla->fields["tab_campoprimario"];
$table=$rs_tabla->fields["tab_name"];


$titulo_formualario='';
if($rs_datosmenu->fields["tipofor_id"]==1 or $rs_datosmenu->fields["tipofor_id"]==0)
{
  $titulo_formualario=$rs_tabla->fields["tab_title"];
}
else
{
  $lista_tituloformulario="select * from cesdb_arextension.dns_tipoformulario where tipofor_id=?";
  $rs_datostituloformulario = $DB_gogess->executec($lista_tituloformulario,array($rs_datosmenu->fields["tipofor_id"]));
  $titulo_formualario=$rs_datostituloformulario->fields["tipofor_nombre"];
}



//busca datos del paciente
$datos_cliente="select * from app_cliente where clie_id=".$clie_id;
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());
//busca datos del paciente

//saca datos de la tabla
//Llamando objetos


//buca registro unico por cliente
$busca_sihaydata="select ".$campo_primariodata.",anam_fecharegistro,DATE_ADD(anam_fecharegistro,INTERVAL 3 DAY) as fechacierre from ".$table." where anam_id=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($_POST["pVar1"]));

$bloque_registro=0;
if(@$rs_sihaydata->fields["anam_fecharegistro"])
{
  //echo $rs_sihaydata->fields["fechacierre"];
   if(date("Y-m-d")>$rs_sihaydata->fields["fechacierre"])
   {
   
   $bloque_registro=1;
   }
   
}


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

//busca alergia medica
$ancho_valor='12';
$mensaje_alergia='';
$alergia_medica='';

$lista_dataalergia=array();
$lista_dataalergia=explode(",","dns_anamesisexamenfisico,dns_ginecologiaanamesis");

for($ik=0;$ik<count($lista_dataalergia);$ik++)
{
$busca_alerg="select anam_txtalergias from ".$lista_dataalergia[$ik]." where clie_id='".$clie_id."' and tipoaler_id=1";
$rs_balerg = $DB_gogess->executec($busca_alerg,array());
 if($rs_balerg)
 {
	  while (!$rs_balerg->EOF) {
	     if($rs_balerg->fields["anam_txtalergias"])
		 {
	     $alergia_medica.=$rs_balerg->fields["anam_txtalergias"].' ';
		 }
		 else
		 {
		 $alergia_medica.=' No Detalla ';
		 }
	  
	    $rs_balerg->MoveNext();	
	  }
}

}

	
if($alergia_medica)
{
 $mensaje_alergia='<div class="col-xs-6"><div class="alert alert-danger" role="alert"><b>Alerta!!!</b> Alergia a Medicamentos: '.$alergia_medica.'</div></div>';
 $ancho_valor='6';
}
//busca alergia medica	


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
$linkapaciente="onClick=ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_stnnewemergenciaanamnesis.php','Editar','divBody_ext','','".@$clie_id."','191','".$atenc_id."',0,'".$tipofor_id."','".$centro_id."');";
echo '<button type="button" class="mb-sm btn btn-success" '.$linkapaciente.'  style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar </button>&nbsp;&nbsp;&nbsp;';


$linkimprimir='onClick=imprimir_datos();';
$linkimprimir='onClick=genera_pdf();';

//echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span></button>';
echo '<a target="_blank" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span></a>';

$linkgayuda="onclick=abrir_standar('ayuda/ayuda.php','AYUDA','divBody_unico','divDialog_unico',900,600,3,0,0,0,0,0,0) style='cursor:pointer'";
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary" '.$linkgayuda.'  style="cursor:pointer"> AYUDA </button>';


$linksubsecuente="onClick=ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_stnnewemergenciasubsecuente.php','Perfil','divBody_ext','',".$clie_id.",'192',".$atenc_id.",0,'".$tipofor_id."',".$centro_id.");";

$linksubsecuente="onClick=abre_formulariosecundario()";

echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button style="width:380px" type="button" class="mb-sm btn btn-primary" '.$linksubsecuente.'  style="cursor:pointer">  <span class="glyphicon glyphicon-list"></span> EVOLUCI&Oacute;N Y PRESCRIPCIONES </button>';






$linkeditar= 'onClick=abrir_laboratorio();';
//echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>PEDIDOS DE LABORATORIO</button>';
echo '&nbsp;&nbsp;<a href="javascript:abrir_laboratorio();"><img src="images/labicon.png?dtt='.date("his").'"><span class="selected"></span></a>';

$linkeditar= 'onClick=abrir_imagenologia();';
//echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>IMAGENOLOGIA</button>';
echo '&nbsp;&nbsp;<a href="javascript:abrir_imagenologia();"><img src="images/imgicon.png?dtt='.date("his").'"><span class="selected"></span></a>';

$linkeditar= 'onClick=abrir_referencia();';

echo '&nbsp;&nbsp;<a href="javascript:abrir_referencia();"><img src="images/reficon.png?dtt='.date("his").'"><span class="selected"></span></a>';


$linkeditar= 'onClick=abrir_interconsulta();';
//echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>CERTIFICADO</button>';
echo '&nbsp;&nbsp;<a href="javascript:abrir_interconsulta();"><img src="images/intericon.png?dtt='.date("his").'"><span class="selected"></span></a>';

$linkeditar= 'onClick=abrir_certificado();';
//echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>CERTIFICADO</button>';
echo '&nbsp;&nbsp;<a href="javascript:abrir_certificado();"><img src="images/cericon.png?dtt='.date("his").'"><span class="selected"></span></a>';


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
$linkimprimir='onClick=genera_pdf();';
echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>';

//cambio de fecha registro
//$linkcambior="onclick=abrir_standar('aplicativos/documental/cambio_fecha.php','CAMBIO','divBody_foto','divDialog_foto',500,300,'anamnesis',$('#anam_id').val(),0,0,0,0,0) style='cursor:pointer'";
//echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-warning" '.$linkcambior.'  style="cursor:pointer"> CAMBIAR FECHA REGISTRO </button>';
//$linkhistorialr="onclick=abrir_standar('aplicativos/documental/historial_fecha.php','CAMBIO','divBody_foto','divDialog_foto',790,300,'anamnesis',$('#anam_id').val(),0,0,0,0,0) style='cursor:pointer'";
//echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-warning" '.$linkhistorialr.'  style="cursor:pointer"> HISTORIAL CAMBIO </button>';

//laboratorio
//$linkeditar= 'onClick=abrir_laboratorio();';
//echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>PEDIDOS DE LABORATORIO</button>';

//IMAGEN
//$linkeditar= 'onClick=abrir_imagenologia();';
//echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>IMAGENOLOGIA</button>';

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
function abrir_interconsulta()
{

   if($('#<?php echo $campo_primario; ?>').val()=='')
   {
     alert("Guarde el registro para hacer la interconsulta");
     return false;
   }
 
<?php
$comill_s="'";
$link_referencia= 'abrir_standar('.$comill_s.'aplicativos/documental/opciones/panel/panel_substandarformulariointerconsulta.php'.$comill_s.','.$comill_s.'INTERCONSULTA'.$comill_s.','.$comill_s.'divBodypop_ext'.$comill_s.','.$comill_s.'divDialogpop_ext'.$comill_s.',900,450,'.$comill_s.$comill_s.','.$comill_s.@$clie_id.$comill_s.','.$comill_s.'75'.$comill_s.','.$comill_s.$atenc_id.$comill_s.',$('.$comill_s.'#'.$campo_primario.$comill_s.').val(),'.$comill_s.$table.$comill_s.','.$comill_s.$centro_id.$comill_s.');';   

echo $link_referencia;
?>

}

function abrir_referencia()
{

   if($('#<?php echo $campo_primario; ?>').val()=='')
   {
     alert("Guarde el registro para hacer la referencia");
     return false;
   }
 
<?php
$comill_s="'";
$link_referencia= 'abrir_standar('.$comill_s.'aplicativos/documental/opciones/panel/panel_substandarformulariosenlref.php'.$comill_s.','.$comill_s.'REFERENCIA'.$comill_s.','.$comill_s.'divBodypop_ext'.$comill_s.','.$comill_s.'divDialogpop_ext'.$comill_s.',900,450,'.$comill_s.$comill_s.','.$comill_s.@$clie_id.$comill_s.','.$comill_s.'142'.$comill_s.','.$comill_s.$atenc_id.$comill_s.',$('.$comill_s.'#'.$campo_primario.$comill_s.').val(),'.$comill_s.$table.$comill_s.','.$comill_s.$centro_id.$comill_s.');';   

echo $link_referencia;
?>



}

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
$link_laboratorio= 'abrir_standar('.$comill_s.'aplicativos/documental/opciones/panel/panel_substandarformlab.php'.$comill_s.','.$comill_s.'LABORATORIO'.$comill_s.','.$comill_s.'divBodypop_ext'.$comill_s.','.$comill_s.'divDialogpop_ext'.$comill_s.',900,700,'.$comill_s.$comill_s.','.$comill_s.@$clie_id.$comill_s.','.$comill_s.'60'.$comill_s.','.$comill_s.$atenc_id.$comill_s.',$('.$comill_s.'#'.$campo_primario.$comill_s.').val(),'.$comill_s.$table.$comill_s.','.$comill_s.$centro_id.$comill_s.');';   

echo $link_laboratorio;
?>
}

function  abre_formulariosecundario()
{
  if($('#<?php echo $campo_primario; ?>').val()>0)
   {
     ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_stnnewemergenciasubsecuente.php','SECUNDARIO','divBody_ext',0,'<?php echo @$clie_id; ?>','192','<?php echo $atenc_id; ?>','<?php echo $tipofor_id; ?>',$('#<?php echo $campo_primario; ?>').val(),'<?php echo $centro_id; ?>');

   }
   else
   {
   
      alert("Guarde el registro para ingresar");
   }	

}



function verl_turno()
{
  $("#lista_turnosval").load("aplicativos/documental/opciones/panel/turnos_alert.php",{
    especi_id:'<?php echo $rs_datosmenu->fields["especi_id"]; ?>',
	centro_id:'<?php echo $centro_id; ?>'
  },function(result){  

  });  

  $("#lista_turnosval").html("Espere un momento");  

}

verl_turno();

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

function ver_turnos()
{
	
	abrir_standar_pop("aplicativos/documental/listados_turnos.php","TURNOS","divBody_turnos","divDialog_turnos",400,400,"<?php echo $rs_datosmenu->fields["especi_id"]; ?>","<?php echo $centro_id; ?>",0,0,0,0,0);
	
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
	    location.href = "pdfformularios/pdformularionewemergencia.php?ssr=<?php echo $campos_data64."|" ?>"+$('#<?php echo $campo_primariodata; ?>').val();
	 }
	 else
	 {
       alert("Por favor guarde el resgistro para imprimir");	 
	 }

}


function abrir_certificado()
{
  
   if($('#<?php echo $campo_primariodata; ?>').val()=='')
   {
     alert("Guarde el registro para hacer el certificado");
     return false;
   }
  
  abrir_standar_pop("aplicativos/documental/certificados.php","CERTIFICADOS","divBody_turnos","divDialog_turnos",750,400,"<?php echo $clie_id; ?>","<?php echo $table; ?>","<?php echo $campo_primariodata; ?>",$('#<?php echo $campo_primariodata; ?>').val(),0,0,0);

}


//  End -->
</script>
<div id="divBody_turnos"></div>
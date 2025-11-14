<?php
ini_set('display_errors',1);
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
$centro_id=$_POST["pVar7"];
$anam_id=$_POST["pVar6"];
$tipofor_id=$_POST["pVar5"];

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

//busca datos del paciente
$datos_cliente="select * from app_cliente where clie_id=".$clie_id;
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());
//busca datos del paciente

//saca datos de la tabla
//echo $_POST["pVar1"];
//Llamando objetos

$table=$rs_tabla->fields["tab_name"];  

$lista_tbldata=array('gogess_sisfield','gogess_sistable');
//include(@$director."libreria/estructura/aqualis_master.php");

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
		 $comillasimple="'";

$bloque_registro=0;
if($csearch)
{

$busca_sihaydata="select *,DATE_ADD(conext_fecharegistro,INTERVAL 3 DAY) as fechacierre from ".$table." where ".$campo_primariodata."=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array(@$csearch));

$bloque_registro=0;

  //echo $rs_sihaydata->fields["fechacierre"];
   if(date("Y-m-d")>$rs_sihaydata->fields["fechacierre"])
   {
   
   $bloque_registro=1;
   }
	


}	 
		 
$botonenvio='<br><br>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12">
		   
			<button type="submit" class="mb-sm btn btn-primary" >'.$titulo_btn.'</button>
		
		</div>
		</div>
</div>
';	

$botonenvio='
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

if($bloque_registro==1)
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

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">

<div class="panel panel-default">
 <div class="panel-heading">

    <h3 class="panel-title" style="color:#000033" ><?php echo $rs_tabla->fields["tab_title"]; ?></h3>

 </div>
<div class="panel-body">



<button type="button" class="mb-sm btn btn-success" onclick="ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_substandarginecologiasubsecuente.php','Perfil','divBody_ext',0,'<?php echo @$clie_id; ?>','106','<?php echo $atenc_id; ?>','<?php echo $tipofor_id; ?>','<?php echo $anam_id; ?>','<?php echo $centro_id; ?>')" style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar </button>


<?php
//$linkimprimir='onClick=imprimir_datos();';
//echo '&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span></button>';

$linkimprimir='onClick=genera_pdfevolucion();';

echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span></button>&nbsp;&nbsp;';


?>

<?php
//$linkimprimiran='onClick=imprimir_datosan();';
$linkimprimir='onClick=imprimir_datos();';
$linkimprimir='onClick=genera_pdf();';

//echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span></button>';

echo '&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> VER GINECOLOG&Iacute;A ANAMNESIS Y EXAMEN FISICO </button>';
//echo '&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary" '.$linkimprimiran.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> VER GINECOLOG&Iacute;A ANAMNESIS Y EXAMEN FISICO </button>';
?>

<?php
//cambio de fecha registro
$linkcambior="onclick=abrir_standar('aplicativos/documental/cambio_fecha.php','CAMBIO','divBody_foto','divDialog_foto',500,300,'ginecologiaexterna',$('#conext_id').val(),0,0,0,0,0) style='cursor:pointer'";
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-warning" '.$linkcambior.'  style="cursor:pointer"> CAMBIAR FECHA REGISTRO </button>';

$linkhistorialr="onclick=abrir_standar('aplicativos/documental/historial_fecha.php','CAMBIO','divBody_foto','divDialog_foto',790,300,'ginecologiaexterna',$('#conext_id').val(),0,0,0,0,0) style='cursor:pointer'";
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-warning" '.$linkhistorialr.'  style="cursor:pointer"> HISTORIAL CAMBIO </button>';

$linkeditar= 'onClick=abrir_laboratorio();';
echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>PEDIDOS DE LABORATORIO</button>';

echo '<div id="divBody_foto"></div>';
//cambio de fecha registro


//busca alergia medica
$columna_css=12;
$alergia_medica='';
$mensaje_alergias='';
$busca_alerg="select anam_txtalergias from dns_anamesisexamenfisico where clie_id='".$clie_id."' and tipoaler_id=1";
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

$busca_alerg="select anam_txtalergias from dns_ginecologiaanamesis where clie_id='".$clie_id."' and tipoaler_id=1";
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


if($alergia_medica)
{
$mensaje_alergias='<div class="col-xs-6"><div class="alert alert-danger" role="alert"><b>Alerta!!!</b> Alergia a Medicamentos: '.$alergia_medica.'</div></div>';
$columna_css=6;
}
//busca alergia medica
?>	 

<p></p>


<div class="form-group">
         <?php echo $mensaje_alergias; ?>
		 <div class="col-xs-<?php echo $columna_css; ?>">
		 
		    <div class="alert alert-info" role="alert">
			  <p><b>Nota importante!</b>
			  Por favor no olvide guardar el registro cuando termine de ingresar datos, si no lo hace los datos se perder&aacute;n</p>
			</div>
		 
		 
		 </div>
		 
</div>		 




<div id="lista_turnosval">

</div>


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
</div>
<?php
}			
?>
<div id="divBodypop_ext" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></div>
<script type="text/javascript">
<!--

function abrir_laboratorio()
{
   if($('#<?php echo $campo_primariodata; ?>').val()=='')
   {
     alert("Guarde el registro para hacer el pedido de laboratorio");
     return false;
   }
 
<?php
$comill_s="'";
$link_laboratorio= 'abrir_standar('.$comill_s.'aplicativos/documental/opciones/panel/panel_substandarformlab.php'.$comill_s.','.$comill_s.'LABORATORIO'.$comill_s.','.$comill_s.'divBodypop_ext'.$comill_s.','.$comill_s.'divDialogpop_ext'.$comill_s.',900,700,'.$comill_s.$comill_s.','.$comill_s.@$clie_id.$comill_s.','.$comill_s.'60'.$comill_s.','.$comill_s.$atenc_id.$comill_s.',$('.$comill_s.'#'.$campo_primariodata.$comill_s.').val(),'.$comill_s.'dns_ginecologiaconsultaexterna'.$comill_s.','.$comill_s.$centro_id.$comill_s.');';   

echo $link_laboratorio;
?>

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


function guarda_data()
{
  // if($('#tarif_numval').val()==0)
 // {
  //  alert("Por favor agrege al menos una registro en TARIFARIO");
	//return false;  
 // }
  
  if($('#diagn_numval').val()==0)
  {
    alert("Por favor agrege al menos un DIAGNOSITCO");
    return false;
  }
  
  <?php
    echo $rs_tabla->fields["tab_valextguardar"];
	
    $comillasimple="'";
    echo 'enviar_formulariodata('.$comillasimple.'form_'.$table.$comillasimple.')';
   ?>

}

function ver_turnos()
{
	
	abrir_standar_pop("aplicativos/documental/listados_turnos.php","TURNOS","divBody_turnos","divDialog_turnos",400,400,"<?php echo $rs_datosmenu->fields["especi_id"]; ?>","<?php echo $_SESSION['ces1313777_centro_id']; ?>",0,0,0,0,0);
	
}

  
function imprimir_datosan()
{
  

   myWindow3=window.open('aplicativos/documental/datos_substandarformunico_print.php?iddata=378&pVar2=<?php echo @$clie_id; ?>&pVar4=<?php echo $atenc_id; ?>&pVar5=0&pVar3=105&pVar9=<?php echo $anam_id; ?>','ventana_reporteunico','width=850,height=700,scrollbars=YES');

   myWindow3.focus();



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

//  End -->
</script>
<div id="divBody_turnos"></div>
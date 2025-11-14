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

$proviene_de=0;
$proviene_de=@$_POST["pVar10"];

$id_llega=$_POST["pVar5"];
$tabla_llega=$_POST["pVar6"];

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
$bloque_registro=0;
if($csearch)
{
    $fech_fecharegistro='';
    if($table=='dns_histopatologia')
	{
	   $fech_fecharegistro='histopa_fecharegistro';
	
	}
	if($table=='dns_fisioterapia')
	{
	   $fech_fecharegistro='fisiot_fecharegistro';
	
	}
	
	if($table=='dns_enfermeria')
	{
	   $fech_fecharegistro='enferm_fecharegistro';
	
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
	
	if($table=='dns_fisioterapia')
	{
	   $bloque_registro=0;
	
	}
	//echo $bloque_registro;
}
//----------------------------------------------------------	
		
		 $comillasimple="'";
		 
		 
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
 <br>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12"><div id="boton_guardarformdata">
			<button type="button" class="mb-sm btn btn-primary" onclick="guarda_data'.$id_llega.'()"  > '.$titulo_btn.'  </button>
		</div></div>
		</div>
		
	<div id="mensaje_gsistema" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" ></div>		
		
</div>
';

$botonenvio2='<br><br>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12"><div id="boton_guardarformdata2">
			<button type="button" class="mb-sm btn btn-primary" onclick="guarda_data'.$id_llega.'()"  > '.$titulo_btn.' </button>
		</div></div>
		</div>
		
	<div id="mensaje_gsistema2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" ></div>		
		
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
	//	echo $template_reemplazo;
	
?>	


<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">
<button type="button" class="mb-sm btn btn-success" onclick="ver_formularioenpantallapreconsulta('aplicativos/documental/opciones/panel/panel_substandarformulariosenlref.php','Perfil','divBodyref_ext',0,'<?php echo @$clie_id; ?>','<?php echo $mnupan_id; ?>','<?php echo $atenc_id; ?>','<?php echo $id_llega; ?>','<?php echo $tabla_llega; ?>',0,0,0,'<?php echo $proviene_de; ?>')" style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar </button>

<?php

if($table=='dns_newreferencia')
{

$linkimprimir='onClick=genera_pdf'.$id_llega.'();';
echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>';

}
else
{
$linkimprimir='onClick=imprimir_datosref();';
echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>';
}
?>
<span class="alert alert-success"> <B> REFERENCIA/DERIVACION</B> </span>
<div id="lista_turnosval">
</div>
<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 
<?php		
		echo $botonenvio;
		include("tablas.php");
		echo $botonenvio2;
		
?>	
</form>
</div>


<?php
}			
?>
<script type="text/javascript">
<!--


function imprimir_datosref()
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


function guarda_data<?php echo $id_llega; ?>()
{
 <?php 
 if($table=='dns_histopatologia' or $table=='dns_fisioterapia' or $table=='dns_enfermeria')
 {
 ?>
  
  
  if($('#diagn_numval').val()==0)
  {
    alert("Por favor agrege al menos un DIAGNOSITCO");
    return false;
  }
 <?php
 }
 ?> 
 

 <?php 
 if($table=='dns_fisioterapia' or $table=='dns_enfermeria')
 {
 ?>
   if($('#tarif_numval').val()==0)
  {
    alert("Por favor agrege al menos una registro en TARIFARIO");
	return false;
  
  }
 <?php
 }
 ?>  
  
  <?php
    echo $rs_tabla->fields["tab_valextguardar"];
	
    $comillasimple="'";
    echo 'enviar_formulariodata('.$comillasimple.'form_'.$table.$comillasimple.')';
   ?>

}

function verl_turno<?php echo $id_llega; ?>()
{
  $("#lista_turnosval").load("aplicativos/documental/opciones/panel/turnos_alert.php",{
    especi_id:'<?php echo $rs_datosmenu->fields["especi_id"]; ?>',
	centro_id:'<?php echo $_SESSION['ces1313777_centro_id']; ?>'
  },function(result){  

  });  

  $("#lista_turnosval").html("Espere un momento");  

}

verl_turno<?php echo $id_llega; ?>();

function ver_turnos<?php echo $id_llega; ?>()
{
	
	abrir_standar_pop("aplicativos/documental/listados_turnos.php","TURNOS","divBody_turnos","divDialog_turnos",400,400,"<?php echo $rs_datosmenu->fields["especi_id"]; ?>","<?php echo $_SESSION['ces1313777_centro_id']; ?>",0,0,0,0,0);
	
}

<?php

$campos_data='';
$campos_data64='';
$campos_data='iddata='.$tab_id.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id;
$campos_data64=base64_encode($campos_data);

?>

function genera_pdf<?php echo $id_llega; ?>()
{
  if($('#<?php echo $campo_primariodata; ?>').val()>0)
	 {
	 
	    //location.href = "pdfformularios/pdfreferencia.php?ssr=<?php echo $campos_data64."|" ?>"+$('#<?php echo $campo_primariodata; ?>').val();
				
		var link_valor;
		
		link_valor="pdfformularios/pdfreferencia.php?ssr=<?php echo $campos_data64."|" ?>"+$('#<?php echo $campo_primariodata; ?>').val();
		
		location.href =link_valor;
		
		//myWindow2=window.open(link_valor,'ventana_refepdf','width=750,height=500,scrollbars=YES');
        //myWindow2.focus();
		
		
	 }
	 else
	 {
       alert("Por favor guarde el resgistro para imprimir"); 	 
	 
	 }

}





//  End -->
</script>
<div id="divBody_turnos"></div>
<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=54445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$clie_id=$_POST["pVar2"];
$mnupan_id=$_POST["pVar3"];
$atenc_id=$_POST["pVar4"];

@$protoop_idenlace=$_POST["pVar11"]; 
@$protoop_tblprincipal=$_POST["pVar12"];

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//saca datos de la tabla

$centro_id=$_SESSION['ces1313777_centro_id'];

$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));
$titulo_btn='';
$titulo_btn='GRABAR';
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

$obtiene_enlacearray=array();
$obtiene_enlacearray=explode("_",$campo_primariodata);
$obtiene_enlace='';
$obtiene_enlace=$obtiene_enlacearray[0]."_enlace";



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
 <div class="alert alert-info" role="alert">
  <p><b>Nota importante!</b>
  Por favor no olvide guardar el registro cuando termine de ingresar datos, si no lo hace los datos se perder&aacute;n</p>
</div>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12"><div id="boton_guardarformdata">
			<button type="button" class="mb-sm btn btn-primary" onclick="guarda_datalocal()"  > '.$titulo_btn.'  </button>
		</div></div>
		</div>
		
	<div id="mensaje_gsistema" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" ></div>		
		
</div>
';

$botonenvio2='<br><br>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12"><div id="boton_guardarformdata2">
			<button type="button" class="mb-sm btn btn-primary" onclick="guarda_datalocal()"  > '.$titulo_btn.' </button>
		</div></div>
		</div>
		
	<div id="mensaje_gsistema2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" ></div>		
		
</div> <div class="alert alert-info" role="alert">
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
		
		genera_cobro();

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

<br>



<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">

<div class="panel panel-default">
 <div class="panel-heading">

    <h3 class="panel-title" style="color:#000033" ><?php echo $rs_tabla->fields["tab_title"]; ?></h3>

 </div>
<div class="panel-body">

<button type="button" class="mb-sm btn btn-success" onclick="ver_formularioenpantallaextendida('aplicativos/documental/opciones/panel/panel_substandarformularios.php','Perfil','divBody_ext',0,'<?php echo @$clie_id; ?>','<?php echo $mnupan_id; ?>','<?php echo $atenc_id; ?>',0,0,0,0,0,0,'<?php echo $protoop_idenlace; ?>','<?php echo $protoop_tblprincipal; ?>')" style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar </button>

<?php


//if($table=='dns_referencia')
//{

//$linkimprimir='onClick=genera_pdf();';
//echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>';

//}
//else
//{

//$linkimprimir='onClick=imprimir_datos();';
//echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>';

//}

///////
$linkimprimir='onClick=genera_pdfevolucion();';
$medicationadmin='onClick=genera_medicationadmin();';
$preoperative='onClick=genera_preoperative();';
$acgnlnursing='onClick=genera_actgeneralnursing();';

echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span>NOTAS ENFERMERIA</button>&nbsp;&nbsp;';
echo '<button type="button" class="mb-sm btn btn-info" '.$medicationadmin.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span>ADM MEDICAMENTOS</button>&nbsp;&nbsp;';
echo '<button type="button" class="mb-sm btn btn-info" '.$preoperative .'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span>PREOPERATORIO</button>&nbsp;&nbsp;';
echo '<button type="button" class="mb-sm btn btn-info" '.$acgnlnursing .'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span>ACTIVIDADES GENERALES</button>&nbsp;&nbsp;';
//////


switch ($table) {
    case 'dns_referencia':
        {
		   $linkimprimir='onClick=genera_pdf();';
echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>';

		}
        break;
    case 'dns_interconsulta':
        {
		  $linkimprimir='onClick=genera_interconsultapdf();';
echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>';

		}
        break;
    default:
       {
	     $linkimprimir='onClick=imprimir_datos();';
echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>';
	   
	   }
}

?>

<br />
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
</div>
<?php
}			
?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
<!--


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


function guarda_datalocal()
{
 <?php 
 if($table=='dns_histopatologia' or $table=='dns_fisioterapia' or $table=='dns_enfermeria')
 {
 ?>
  
  
  if($('#diagn_numval').val()==0)
  {
    //alert("Por favor agrege al menos un DIAGNOSITCO");
   // return false;
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
    //alert("Por favor agrege al menos una registro en TARIFARIO");
	//return false;
  
  }
 <?php
 }
 ?>  
  
  <?php
    echo $rs_tabla->fields["tab_valextguardar"];
	
    $comillasimple="'";
    echo 'enviar_formulariodatadirecto('.$comillasimple.'form_'.$table.$comillasimple.')';
   ?>

}

function verl_turno()
{
  $("#lista_turnosval").load("aplicativos/documental/opciones/panel/turnos_alert.php",{
    especi_id:'<?php echo $rs_datosmenu->fields["especi_id"]; ?>',
	centro_id:'<?php echo $_SESSION['ces1313777_centro_id']; ?>'
  },function(result){  

  });  

  $("#lista_turnosval").html("Espere un momento");  

}

verl_turno();

function ver_turnos()
{
	
	abrir_standar_pop("aplicativos/documental/listados_turnos.php","TURNOS","divBody_turnos","divDialog_turnos",400,400,"<?php echo $rs_datosmenu->fields["especi_id"]; ?>","<?php echo $_SESSION['ces1313777_centro_id']; ?>",0,0,0,0,0);
	
}


<?php

$campos_data='';
$campos_data64='';
$campos_data='iddata='.$tab_id.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id;
$campos_data64=base64_encode($campos_data);

?>

function genera_pdf()
{
  if($('#<?php echo $campo_primariodata; ?>').val()>0)
	 {
	 
	    location.href = "pdfformularios/pdfreferencia.php?ssr=<?php echo $campos_data64."|" ?>"+$('#<?php echo $campo_primariodata; ?>').val();
	 }
	 else
	 {
       alert("Por favor guarde el resgistro para imprimir"); 	 
	 
	 }

}

function genera_cobro()
{
  $("#genera_pro").load("aplicativos/documental/g_cuentas.php",{
    clie_id:'<?php echo $clie_id; ?>',
	mnupan_id:'<?php echo $mnupan_id; ?>',
	atenc_id:'<?php echo $atenc_id; ?>',
	centro_id:'<?php echo $centro_id; ?>',
	anam_id:$('#<?php echo $campo_primariodata; ?>').val()
  },function(result){  

  });  

  $("#genera_pro").html("Espere un momento");  


}


//interconsulta
<?php

$campos_data='';
$campos_data64='';
$campos_data='iddata='.$tab_id.'&pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id;
$campos_data64=base64_encode($campos_data);

?>

function genera_interconsultapdf()
{
  if($('#<?php echo $campo_primariodata; ?>').val()>0)
	 {
	 
	    location.href = "pdfformularios/pdformulariointerconsulta.php?ssr=<?php echo $campos_data64."|" ?>"+$('#<?php echo $campo_primariodata; ?>').val();
	 }
	 else
	 {
       alert("Por favor guarde el resgistro para imprimir"); 	 
	 
	 }

}

//////////
function genera_pdfevolucion()
{
    var id_registro = $('#<?php echo $campo_primariodata; ?>').val();

    if (!id_registro || id_registro <= 0) {
        Swal.fire({
            icon: 'warning',
            title: '¡Espera!',
            html: 'Por favor <b>guarda el registro</b> antes de imprimir las notas de enfermería.',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    var url = "pdfformularios/pdfformenfermeria.php?ssr=<?php echo $campos_data64; ?>|" + id_registro;
    window.open(url, '_blank');
}
//////////
function genera_medicationadmin()
{
    var id_registro = $('#<?php echo $campo_primariodata; ?>').val();

    if (!id_registro || id_registro <= 0) {
        Swal.fire({
            icon: 'warning',
            title: '¡Espera!',
            html: 'Por favor <b>guarda el registro</b> antes de imprimir .',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    var url = "pdfformularios/genera_medicationadmin.php?ssr=<?php echo $campos_data64; ?>|" + id_registro;
    window.open(url, '_blank');
}
///////////
//////////
function genera_preoperative()
{
    var id_registro = $('#<?php echo $campo_primariodata; ?>').val();

    if (!id_registro || id_registro <= 0) {
        Swal.fire({
            icon: 'warning',
            title: '¡Espera!',
            html: 'Por favor <b>guarda el registro</b> antes de imprimir .',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    var url = "pdfformularios/generate_preoperative.php?ssr=<?php echo $campos_data64; ?>|" + id_registro;
    window.open(url, '_blank');
}
///////////

//////////
function genera_actgeneralnursing()
{
    var id_registro = $('#<?php echo $campo_primariodata; ?>').val();

    if (!id_registro || id_registro <= 0) {
        Swal.fire({
            icon: 'warning',
            title: '¡Espera!',
            html: 'Por favor <b>guarda el registro</b> antes de imprimir .',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    var url = "pdfformularios/generate_acgnlnursing.php?ssr=<?php echo $campos_data64; ?>|" + id_registro;
    window.open(url, '_blank');
}
///////////

//  End -->
</script>
<div id="divBody_turnos"></div>
<div    id="genera_pro"></div>
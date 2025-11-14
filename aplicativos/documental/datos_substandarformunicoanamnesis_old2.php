<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{



$clie_id=$_POST["pVar2"];
$mnupan_id=$_POST["pVar3"];
$atenc_id=$_POST["pVar4"];
$eteneva_id=@$_POST["pVar5"];
$centro_id=@$_POST["pVar7"];

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$areas_id=array();

$areas_id["faesa_psicologia"]=1;
$areas_id["faesa_lenguaje"]=2;
$areas_id["faesa_terapiafisica"]=3;
$areas_id["faesa_pedagogia"]=4;
$areas_id["faesa_anamnesisclinica"]=0;
$areas_id["faesa_ocupacional"]=7;
//saca datos de la tabla

$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));


$lista_atencion="select * from dns_atencion where atenc_id=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));

$enlace_atencion='';
$enlace_atencion=$rs_atencion->fields["atenc_enlace"];

$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];

$rs_tabla = $DB_gogess->executec($lista_tabla,array());



//busca datos del paciente

$datos_cliente="select * from app_cliente where clie_id=".$clie_id;

$rs_dcliente = $DB_gogess->executec($datos_cliente,array());

//busca datos del paciente



//saca datos de la tabla

//echo $_POST["pVar1"];

//Llamando objetos



$table=$rs_tabla->fields["tab_name"];  

$campo_primariodata=$rs_tabla->fields["tab_campoprimario"];  



//buca registro unico por cliente

$busca_sihaydata="select *,DATE_ADD(anam_fecharegistro,INTERVAL 3 DAY) as fechacierre from ".$table." where clie_id=? and centro_id=? and atenc_id=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array(@$clie_id,@$centro_id,@$atenc_id));

$bloque_registro=0;
if(@$rs_sihaydata->fields["anam_fecharegistro"])
{
  //echo $rs_sihaydata->fields["fechacierre"];
   if(date("Y-m-d")>$rs_sihaydata->fields["fechacierre"])
   {
   
   $bloque_registro=1;
   }
   
}
else
{

}

//echo $bloque_registro;
//echo $busca_sihaydata;
$psic_id_valor=0;
$psic_id_valor=@$rs_sihaydata->fields[$campo_primariodata];


include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
   if($lista_tbldata[$itbl]=='gogess_sistable')
   {
    include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
   }
 } 
include(@$director."libreria/estructura/".$table.".php");

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

			if($psic_id_valor==0)

				  {

					 $variableb=0;

				  }

				  else

				  {

					 $variableb=$psic_id_valor;

					 $_REQUEST["opcion_".$table]="buscar";

			         $csearch=$psic_id_valor;				 

				  }

		//echo $csearch; 

		 $comillasimple="'";

		 $botonenvio='<br><br>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12">
			<button type="submit" class="mb-sm btn btn-primary" > GRABAR Y PLANILLAR '.utf8_encode($rs_tabla->fields["tab_title"]).'</button>
		</div>
		</div>
</div>

';	


 $botonenvio='<br><br>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12"><div id="boton_guardarformdata">
			<button type="button" class="mb-sm btn btn-primary" onclick="enviar_formulariodata('.$comillasimple.'form_'.$table.$comillasimple.')"  > GRABAR Y PLANILLAR </button>
		</div></div>
		</div>
		
	<div id="mensaje_gsistema" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" ></div>		
		
</div>
';

$botonenvio2='<br><br>
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12"><div id="boton_guardarformdata2">
			<button type="button" class="mb-sm btn btn-primary" onclick="enviar_formulariodata('.$comillasimple.'form_'.$table.$comillasimple.')"  > GRABAR Y PLANILLAR </button>
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
<?php
$lista_turnos="select * from dns_gridturnos inner join dns_atencion on dns_gridturnos.atenc_enlace=dns_atencion.atenc_enlace where especi_id=".$rs_datosmenu->fields["especi_id"]." and gridtur_fecha='".date("Y-m-d")."' and dns_atencion.centro_id=".$centro_id." and gridtur_estado=''";
$lista_turnos="";
$rs_turnos = $DB_gogess->executec($lista_turnos,array());
if($rs_turnos->fields["gridtur_id"]>0)
{
	echo '<div align="right" onclick="ver_turnos()" style="cursor:pointer" ><span style="color:#FF0000; font-size:12px; font-weight:bold"><img src="images/notificacionicon.png" />Alerta!!! Tiene turnos para hoy</span></div>';
	
}
?>


<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">

<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 

<?php		

		echo $botonenvio;

		include("tablas_unico.php");

		echo $botonenvio2;

?>	

</form>

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

function ver_turnos()
{
	
	abrir_standar_pop("aplicativos/documental/listados_turnos.php","TURNOS","divBody_turnos","divDialog_turnos",400,400,"<?php echo $rs_datosmenu->fields["especi_id"]; ?>","<?php echo $centro_id; ?>",0,0,0,0,0);
	
}


//  End -->

</script>
<div id="divBody_turnos"></div>
<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44564000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{
//echo $_POST["pVar7"];

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//busca paciente
$lista_bpaciente="select * from app_cliente where clie_rucci='".$_POST["pVar7"]."'";
$rs_bpaciente = $DB_gogess->executec($lista_bpaciente);
if($rs_bpaciente->fields["clie_id"]>0)
{
$_POST["pVar1"]=$rs_bpaciente->fields["clie_id"];
}
else
{
$_POST["pVar1"]=0;
}
//busca paciente


$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($_POST["pVar2"]));

$lista_tabla="select * from gogess_sistable,gogess_styletable where gogess_sistable.st_id=gogess_styletable.st_id and tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());
$table=$rs_tabla->fields["tab_name"]; 
$lista_tbldata=array('gogess_sisfield','gogess_sistable');

$contenido = file_get_contents(@$director."jason_files/tablas/".$table.".json");
$gogess_sistable = json_decode($contenido, true);

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform(); 
//leer con json
$contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");
$gogess_sisfield = json_decode($contenido, true);
//leer con json 

if ($table)
  {    
     $objtableform->select_templateform_rs(@$table,@$rs_tabla,$DB_gogess);	
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;

$comillasimple="'";
//para cambiar el formato de algunos campos
$lista_camposv=explode(';',$rs_datosmenu->fields["mnupan_camposforma"]."clie_foto,hidden3;centro_id,hidden3;clie_registrado,hidden3;");
$campos_tipo=array();
for($i=0;$i<count($lista_camposv);$i++)
{

    $separa_campo=explode(',',$lista_camposv[$i]);
	if($separa_campo[0])
	{

	$campos_tipo[$separa_campo[0]]=$separa_campo[1];

    }

}

if(@$_POST["pVar1"]>0)
{
   $campos_tipo=Array
	(
		'clie_token'=> 'hidden3',
		'clie_rucci'=> 'textpekereadonly',
		'clie_foto'=> 'hidden3',
		'centro_id'=> 'hidden3',
		'clie_registrado'=> 'hidden3',
		'grp_id'=> 'hidden3'
			
	);
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
	  
$comillasimple="'";
$botonenvio='<br><br>

<div align="center">
		 <div class="form-group">
         <div class="col-xs-12">
			<button type="button" class="mb-sm btn btn-primary" onclick="enviar_formulariopaciente()"  > GUARDAR '.strtoupper($rs_tabla->fields["tab_title"]).'</button>
		</div>
		</div>
</div>
';
//maestro_standar_dpacientes

$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';
@$funciones_cuandoguarda="$('#".@$divresultado."').html('".@$mensajege."')";
@$funcionextrag=" guardar_atencion();";
$template_reemplazo='templateformsweb/maestro_standar_dpacientes/';
?>
<br>
<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">
<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 
<?php
$ver_boton=1;	
include("tablas.php");
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
<script type="text/javascript">
<!--

jQuery.event.special.touchstart = {
  setup: function( _, ns, handle ){
    if ( ns.includes("noPreventDefault") ) {
      this.addEventListener("touchstart", handle, { passive: false });
    } else {
      this.addEventListener("touchstart", handle, { passive: true });
    }
  }
};

if($('#doccab_rucci_cliente').val()==$('#doccab_identificacionpaciente').val())
{

$('#clie_rucci').val($('#doccab_identificacionpaciente').val());
$('#clie_apellido').val($('#doccab_apellidorazon_cliente').val());
$('#clie_nombre').val($('#doccab_nombrerazon_cliente').val());
$('#clie_direccion').val($('#doccab_direccion_cliente').val());
$('#clie_celular').val($('#doccab_telefono_cliente').val());
$('#clie_email').val($('#doccab_email_cliente').val());


}
else
{

$('#clie_rucci').val($('#doccab_identificacionpaciente').val());

}


function enviar_formulariopaciente()
{
  if($('#clie_fechanacimiento').val()=='')
  {  
     alert("Ingrese la fecha de nacimiento...");
	 return false;
  }
  
  if($('#clie_fechanacimiento').val()=='00000-00-00')
  {  
     alert("Ingrese la fecha de nacimiento...");
	 return false;
  }
  
  $( "#form_<?php echo $table; ?>").submit();  
  
}

$( "#clie_rucci" ).change(function() {
   $('#doccab_identificacionpaciente').val($('#clie_rucci').val());
});

//  End -->
</script>
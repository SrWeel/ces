<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$table='app_usuario'; 
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

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





  
			//$em_id_val=0;		
	
	
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
	
	
if($csearch)
{
$campos_tipo=Array
(
	
	'usua_fecha_uingreso'=> 'hidden3',
	'usua_hora_uingreso'=> 'hidden3',
	'usua_fecha_cambioclv'=> 'hidden3',
	'usua_estado'=> 'hidden3',
	'usua_id'=> 'hidden3',
	'usua_adm'=> 'hidden2',
	'tipo_id'=> 'hidden2',
	'emp_id'=> 'hidden3',
	'usua_fechanacimiento'=> 'hidden3',
	'usua_apruebapolitica'=> 'hidden3'

);

}
else
{

$campos_tipo=Array
(
	
	'usua_fecha_uingreso'=> 'hidden3',
	'usua_hora_uingreso'=> 'hidden3',
	'usua_fecha_cambioclv'=> 'hidden3',
	'usua_estado'=> 'hidden3',
	'usua_id'=> 'hidden3',
	'usua_adm'=> 'hidden2',
	'emp_id'=> 'hidden3',
	'usua_esproveedor'=> 'hidden3',
	'usua_esusuario'=> 'hidden3',
	'usua_archivo'=> 'hidden3',
	'usua_celular'=> 'hidden3',
	'usua_direcciondom'=> 'hidden3',
    'usua_telefonodom'=> 'hidden3',
	'usua_fechanacimiento'=> 'hidden3',
	'usua_apruebapolitica'=> 'hidden3',
	'usua_ciruc'=> 'hidden3'
);

}	
	
				  
	 $comillasimple="'";
		 $botonenvio='<div align="center">
		 <div class="form-group">
         <div class="col-xs-12">
		    <button type="button" class="mb-sm btn btn-primary"  onClick="guardar_form_app_usuario()"  >REGISTRARSE</button>
		
		</div>
		</div>

</div>
<center>Ya tienes una cuenta? <a href="index.php?snp=WVhCc1BURTNKbk5sWTJNOU55WnpaV05qYVc5dWNEMHo=666">Iniciar sesi&oacute;n</a></center>';	

$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';



        //$funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";
		
		$funcionextrag="resgistrado($('#usua_usuario').val())";
  		$template_reemplazo='templateformsweb/maestro_standar_usproveedor/';			  

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
<script type="text/javascript">
<!--

function asignar_valor()
{
  
if($("#acepta_pol").is(':checked')==true)
{

  $("#usua_apruebapolitica").val(1);
}
else
{
   $("#usua_apruebapolitica").val(0);

}

}

//  End -->
</script>
<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 
<?php		
		include("../../../tablas.php");
		
?>
</form>	

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
<script language="javascript">
<!--

function guardar_form_app_usuario()
{
   if($("#acepta_pol").is(':checked')==false)
   {
    alert("Para registrarse debe aceptar las politicas de privacidad");
	return false;
   }
   ejecuta_validacion();
}


function ejecuta_validacion()
{
	
	var validator = $( "#form_app_usuario" ).validate();
    if(validator.form())
	{
		ejecutar_formulario_app_usuario();
		
	}
	else
	{
	  alert("Todos los campos con * son obligatorios...");	
	}
	
	
}

function ejecutar_formulario_app_usuario(){
    var options = {
        target: '#div_app_usuario',
        type: 'post',
        url:'libreria/ejecuta/procesar.php',
        data: {opcion:$('#opcion_app_usuario').val(),tabla:'app_usuario',pusua_id:$('#usua_id').val()},
        success: function(result) {		
		eval(result);
            if(result_global=="1") 
			{
			   
			   
		   
		   			if($('#opcion_app_usuario').val()!='actualizar')
			   {			   
			      $('#opcion_app_usuario').val('actualizar');					  
			      $('#usua_id').val(result_insertado);
				  $('#despliegue_usua_id').html(result_insertado);
			   }
			
			   
			
			
	 $("#div_app_usuario").html("<span style='font-size:11px; color:green;'>Guardado con exito...</span>");  
	 resgistrado($('#usua_usuario').val());		  
			}
			else
			{
				  if(result_lote=="1")
				  {
					$("#div_app_usuario").html("<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;' >Alerta!! Asignar nuevo lote el actual se ha terminado...</span>");
				  }
				  if(result_lote=="2")
				  {
					 $("#div_app_usuario").html("<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;' >Alerta Lote no asignado al sistema...</span>");
				  } 
				   if(result_lote=="0")
				  {
				 $("#div_app_usuario").html("<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;' >Error al realizar el proceso, por favor intente mas tarde...</span>");
				   }
				   
				   if(result_global=="0") 
			        {
					   $("#div_app_usuario").html("<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;' >Registro ya existe...</span>");
					}
				  
				    
			   
			}
		
		}
    };

   $("#div_app_usuario").html("<table border=0><tr><td><img src='images/progress/progress_2.gif'></td><td><span style='font-size:11px; color:green;'>Ejecutando...</span></td></tr></table>");
   $("#form_app_usuario").ajaxSubmit(options);	
   
}
//  End -->
</script>

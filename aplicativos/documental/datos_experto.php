<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

@$_POST["pVar1"]=@$_SESSION['ces1313777_sessid_inicio'];
if($_POST["pVar1"])
{
//echo $_POST["pVar1"];
//Llamando objetos
$table='app_usuario';  
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

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
	'usua_apruebapolitica'=> 'hidden3',
	'usua_clave'=> 'hidden3',
	'usua_nombre'=> 'hidden3',
	'usua_apellido'=> 'hidden3',
	'usua_usuario'=> 'hidden3'
		
);
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
		   
			<!-- <button type="submit" class="mb-sm btn btn-primary" >Registrarse como experto</button> -->
			
			<button type="button" class="mb-sm btn btn-primary"  onClick="guardar_form_app_usuario()"  >REGISTRARSE COMO EXPERTO</button>
		
		</div>
		</div>
</div>


';	
		$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';
        @$funciones_cuandoguarda="$('#".@$divresultado."').html('".@$mensajege."')";
  		$template_reemplazo='templateformsweb/maestro_standar_experto/';
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

function asignar_valore()
{
  
if($("#acepta_polex").is(':checked')==true)
{

  $("#usua_esproveedor").val(1);
}
else
{
   $("#usua_esproveedor").val(0);

}

}

//  End -->
</script>
<?php
$busca_datosus="select usua_archivo,usua_nombre,usua_apellido,usua_esproveedor from app_usuario where usua_id=?";
$rs_usuarios = $DB_gogess->executec($busca_datosus,array(@$_SESSION['ces1313777_sessid_inicio']));

if($rs_usuarios->fields["usua_esproveedor"]==1)
{

echo "<center><b>Usted ya es experto sus opciones ya estan activas</b></center>";
}
else
{

?>
<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:900px;">
<div class="alert alert-success"> <B>PERFIL EXPERTO</B> </div>


<div id="ya_esexperto">
<center><b>Para ser uno de nuestros expertos debes completar los siguientes datos:</b></center><br>
<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 
<?php		
		include("tablas.php");
		
?>	
</form>
</div>

</div>
</div>

<?php
}
?>
<?php
}			
?>
<script type="text/javascript">
<!--
$( "#usua_fechanacimiento" ).datepicker({dateFormat: 'yy-mm-dd'});

//  End -->
</script>

<script language="javascript">
<!--
function yaes_experto()
{
  $('#ya_esexperto').html("<br><br><center><b>Bienvenido a la Red de expertos. Espere un momento y apareceran las opciones...</b></center> ");
  window.setTimeout("ir_pagina()",3000);


  
}

function ir_pagina()
{
window.location.assign("index.php?snp=WVhCc1BURTNKbk5sWTJNOU55WjBhWEJ2UFRFPQ==652")
}

function guardar_form_app_usuario()
{
   if($("#acepta_polex").is(':checked')==false)
   {
    alert("Para registrarse debe aceptar las politicas de privacidad");
	return false;
   }
   
   if($("#si_oficio").val()==0)
   {
    alert("Debe registrar al menos un oficio");
	return false;
   
   }
   
   
   if($("#si_referencia").val()==0)
   {
    alert("Debe registrar al menos una referencia");
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
	 yaes_experto();		  
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


<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
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
	'usua_archivoruc'=> 'hidden3'
		
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
		   
			<button type="submit" class="mb-sm btn btn-primary" >GUARDAR PERFIL</button>
		
		</div>
		</div>
</div>


';	
		$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';
        @$funciones_cuandoguarda="$('#".@$divresultado."').html('".@$mensajege."')";
  		$template_reemplazo='templateformsweb/maestro_standar_usuario/';
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
<br>

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:900px;">
<div class="alert alert-success"> <B>PERFIL CLIENTE</B> </div>

<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 
<?php		
		include("tablas.php");
		
?>	

</form>
</div>
<?php
}			
?>
<script type="text/javascript">
<!--
$( "#usua_fechanacimiento" ).datepicker({dateFormat: 'yy-mm-dd'});

//  End -->
</script>
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

//echo $_POST["pVar1"];
//Llamando objetos
$table='corpo_historiaclinica';  
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


if($csearch)
{
$busca_datosus="select * from corpo_historiaclinica where clie_id=?";
$rs_usuarios = $DB_gogess->executec($busca_datosus,array(@$csearch));
}	
		 
		 $comillasimple="'";
		 $botonenvio='<br><br>

<div align="center">
		 <div class="form-group">
         <div class="col-xs-12">
		   
			<button type="submit" class="mb-sm btn btn-primary" >GUARDAR</button>
		
		</div>
		</div>
</div>


';	
		$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';
        @$funciones_cuandoguarda="$('#".@$divresultado."').html('".@$mensajege."')";
  		$template_reemplazo='templateformsweb/maestro_standar_hcadm/';
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

<button type="button" class="mb-sm btn btn-success" onclick="ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_historiaclinica.php','Perfil','divBody_ext',0,0,0,0,0,0,0)" style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar </button>
<p></p>


<div class="alert alert-success"> <B>MIEMBROS</B> </div>

<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 
<?php	


if(@$rs_usuarios->fields["clie_foto"])
{
 $foto_img=@$rs_usuarios->fields["clie_foto"];
}
else
{

// $foto_img="person.png";
}

//echo '<div class="showImageusua_archivo" align="center"><img src="archivo/'.$foto_img.'" width="100" height="100"></div>';
include("tablas.php");
		
?>	

</form>
</div>

<script type="text/javascript">
<!--


function activar_tablas()
{

   var sumador1;
   var sumador2;
   var sumador3;
   var total;
   
   sumador1=0;
   sumador2=0;
   sumador3=0;
   total=0;
   
   if($("#clie_binaabc1").is(':checked'))
   {
    sumador1=1;
   
   }
   
   
   
    if($("#clie_binaabc2").is(':checked'))
	  {
    sumador2=1;
   
   }

	
  if($("#clie_binaabc3").is(':checked'))
  {
    sumador3=1;
   
   }
 
	total= sumador1+sumador2+sumador3;
   
    if(total>0)
	{
	  $('#vista_panelx').show();
	
	}
	else
	{
	  $('#vista_panelx').hide();
	
	}
}




$( "#clie_fechanacimiento" ).datepicker({dateFormat: 'yy-mm-dd'});

activar_tablas();

//  End -->
</script>
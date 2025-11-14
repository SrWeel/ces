<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44564000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$atenc_id=0;
$atenc_id=@$_POST["pVar4"];
//saca datos de la tabla

$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($_POST["pVar2"]));
$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());
//saca datos de la tabla

//echo $_POST["pVar1"];
//Llamando objetos
$table=$rs_tabla->fields["tab_name"];  
//leer con json

$lista_tbldata=array('gogess_sisfield','gogess_sistable');
$contenido = file_get_contents(@$director."jason_files/tablas/".$table.".json");
$gogess_sistable = json_decode($contenido, true);
$contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");
$gogess_sisfield = json_decode($contenido, true);
//leer con json

$react_id=$rs_datosmenu->fields["react_id"];
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



$campo_cmb1=''; 

if(@$_SESSION['ces1313777_sessid_inicio']=='74')
{
 //$campo_cmb1='';  
 //$campo_cmb1='usua_id,selectpeke;';
}

$lista_camposv=explode(';',$rs_datosmenu->fields["mnupan_camposforma"].$campo_cmb1);

$campos_tipo=array();
for($i=0;$i<count($lista_camposv);$i++)
{

    $separa_campo=explode(',',$lista_camposv[$i]);

	if($separa_campo[0])

	{



	$campos_tipo[$separa_campo[0]]=$separa_campo[1];



    }



}



//print_r($campos_tipo);



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
			<button type="submit" class="mb-sm btn btn-primary" >GUARDAR '.strtoupper($rs_tabla->fields["tab_title"]).'</button>
		</div>
		</div>
</div>

';	

		$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';
        @$funciones_cuandoguarda="$('#".@$divresultado."').html('".@$mensajege."')";
		@$funcionextrag=" activa_tab(); ";


		if($rs_datosmenu->fields["mnupan_templatetabla"])
		{
  		$template_reemplazo='templateformsweb/'.$rs_datosmenu->fields["mnupan_templatetabla"].'/';
		}
		else
		{
		$template_reemplazo='templateformsweb/maestro_standar_standar/';
		}

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

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">


<button type="button" class="mb-sm btn btn-success" onclick="ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_empleado.php','Perfil','divBody_ext',0,'<?php echo $_POST["pVar2"]; ?>',0,0,0,0,0)" style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar </button>


<div class="alert alert-success"> <B>PERFIL <?php echo strtoupper($rs_tabla->fields["tab_title"]); ?>   



</B> </div>



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

$( "#clie_fechaingreso" ).datepicker({dateFormat: 'yy-mm-dd'});

$( "#usua_fechanacimiento" ).datepicker({dateFormat: 'yy-mm-dd'});



//  End -->

</script>
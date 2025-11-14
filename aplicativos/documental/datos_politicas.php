<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';

include("../../cfg/clases.php");

include("../../cfg/declaracion.php");



//saca datos de la tabla



$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($_POST["pVar2"]));

$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];

$rs_tabla = $DB_gogess->executec($lista_tabla,array());





//saca datos de la tabla

//echo $_POST["pVar1"];

//Llamando objetos



$table=$rs_tabla->fields["tab_name"];  





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

		

		

		if($rs_datosmenu->fields["mnupan_templatetabla"])

		{

  		$template_reemplazo='templateformsweb/'.$rs_datosmenu->fields["mnupan_templatetabla"].'/';

		}

		else

		{

		$template_reemplazo='templateformsweb/maestro_standar_standar/';

		

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

-->

</style>

<br>



<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">





<button type="button" class="mb-sm btn btn-success" onclick="ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_standarpoliticas.php','Perfil','divBody_ext',0,'<?php echo $_POST["pVar2"]; ?>',0,0,0,0,'<?php echo $_POST["pVar7"]; ?>')" style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar </button>

<p></p>







<div class="alert alert-success"> <B> <?php echo strtoupper($rs_tabla->fields["tab_title"]); ?> </B> </div>



<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 

<?php		

		include("tablas.php");

		

?>	

</form>

</div>

<?php

}

else

{

echo '<div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Su sesi&oacute;n a caducado de precione F5 para continuar...</div>';

	

}		

?>

<script type="text/javascript">

<!--

$( "#vaca_fecha" ).datepicker({dateFormat: 'yy-mm-dd'});



//  End -->

</script>
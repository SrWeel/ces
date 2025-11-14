<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
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

$config_imp="select imp_id,imp_desarrollo from app_impresion where emp_id=? and tipocmp_id=1";
$rs_cfgimp = $DB_gogess->executec($config_imp,array(1));

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



//Datos de empresa

$idempresa=$_SESSION['ces1313777_sessid_emp_id'];

$empresa_id_val=$idempresa;	

$objimpuestos->datos_cfg($empresa_id_val,$DB_gogess);

$objCfgSistema->sistema_data_cfg($empresa_id_val,$DB_gogess);





if(@$objimpuestos->et_imp_valot==1)

{

	

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

		   
          <div id="guardab_btn" >
			<!-- <button type="submit" class="mb-sm btn btn-primary" >GUARDAR '.strtoupper($rs_tabla->fields["tab_title"]).'</button> -->
			<button type="button" class="mb-sm btn btn-primary" onclick="ejecutar_submit()" >GUARDAR '.strtoupper($rs_tabla->fields["tab_title"]).'</button>
          </div>
		

		</div>

		</div>

</div>

<p>&nbsp;</p><p>&nbsp;</p>



';	

		$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';

        @$funciones_cuandoguarda="$('#".@$divresultado."').html('".@$mensajege."')";

				

		$funcionextrag=" 
		 guardar_cliente_data();
		 genera_turnovalor();
		";

		

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





<button type="button" class="mb-sm btn btn-success" onclick="ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_facturas.php','Perfil','divBody_ext',0,'<?php echo $_POST["pVar2"]; ?>',0,0,0,0,0)" style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar </button>

<?php

$comill_s="'";
$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/datos_cabecera.php'.$comill_s.','.$comill_s.'MEDICOS'.$comill_s.','.$comill_s.'divBody_ext'.$comill_s.','.$comill_s.$comill_s.','.$comill_s.$_POST["pVar2"].$comill_s.',0,0,0,0,0)" style=cursor:pointer';	

echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVA FACTURA</button>';

?>
<p></p>
<?php

$nestab=$objformulario->replace_cmb("efacsistema_establecimiento","estab_id,estab_codigo","where estab_id=",$_SESSION['ces1313777_pestab_id'],$DB_gogess);

$nepemi=$objformulario->replace_cmb("efacsistema_puntoemision","pemision_id,pemision_num","where pemision_id=",$_SESSION['ces1313777_pemision_id'],$DB_gogess);

?>



<div class="alert alert-success"> <B> <?php echo strtoupper($rs_tabla->fields["tab_title"]); ?> - ESTABLECIMIENTO: <?php echo $nestab; ?> PUNTO EMISI&Oacute;N: <?php echo $nepemi; ?> </B> </div>



<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 

<?php		

		include("tablas.php");
        echo $botonenvio;
		

?>	

</form>

</div>

<p>&nbsp;</p>

<?php

	}

	else

	{

	echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000'><b>Alerta sistema debe estar parametrizado para usar esta opci&oacute;n (Config. Impuestos) </b></div>";

	

	}





}			
else
{
    
	echo $_POST["pVar2"];
   $varable_enviafunc='';
   $varable_enviafunc=base64_encode("ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_facturas.php','Perfil','divBody_ext','','".$_POST["pVar2"]."',0,0,0,0,0)");
	
		
	//enviar
	echo '
	<script type="text/javascript">
	<!--
	abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession","divDialog_acsession",400,400,"'.$varable_enviafunc.'",0,0,0,0,0,0);
	//  End -->
	</script>
	
	<div id="divBody_acsession"></div>
	';


}
?>

<div id="grid_clientef"></div>
<div id="genrap_tvalor"></div>

<script type="text/javascript">
<!--

$( "#usua_fechanacimiento" ).datepicker({dateFormat: 'yy-mm-dd'});

function ejecutar_submit()
{

if($('#tippo_id').val()==1)
{
   if($('#doccab_autorizacion').val()=='')
   {
     alert('PARA CUENTAS POR COBRAR ES OBLIGATORIO INGRESAR EL CODIGO AUT.');
	 return false;
   }
}

$("#ver_puntoesta").load("aplicativos/documental/verifica_sessfac.php",{
      
 },function(result){ 
       
		if($('#estapunto').val()==1)
		{
		  $( "#form_<?php echo $table; ?>" ).submit();
		}
		else
		{
		  alert("Ingrese el usario, clave y vuelva a intentar (Despues de guardar verifique que No.Doc: este correcto), Si el problema persiste verifique que este con el usario correcto");
		}

  });  
$("#ver_puntoesta").html("Espere un momento...");


}




//  End -->
</script>
<div id="ver_puntoesta"></div>
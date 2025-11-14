<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

//saca datos de la tabla
$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($_POST["pVar3"]));
$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());
//busca datos del paciente
$datos_cliente="select * from app_cliente where clie_id=".$_POST["pVar2"];
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());
//----busca atenion cerrada
$busca_aten="select count(*) as tlnocerrado from dns_atencion where clie_id=".$_POST["pVar2"]." and estaatenc_id=0";
$rs_aten = $DB_gogess->executec($busca_aten,array());

if(@$_POST["pVar1"])
{
$cantidad_valor=0;
}
else
{
$cantidad_valor=$rs_aten->fields["tlnocerrado"];
}

if ($cantidad_valor>0)
{
?>

<style type="text/css">
<!--
.css_textovalor {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="400" border="0" align="center" cellpadding="4" cellspacing="3">
  <tr>
    <td bgcolor="#DEEBEB"><p>&nbsp;</p>
      <p align="center" class="css_textovalor"><strong>Para crear una nueva atenci&oacute;n debe estar cerrada la actual:</strong></p>
      <p align="center" class="css_textovalor"><strong>Para cerrar la actual, la atenci&oacute;n debe estar en ALTA o en DESERCION</strong></p>
    <p>&nbsp; </p></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
}
else
{
//---busca atencion cerrada

//busca datos del paciente
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

		//echo $csearch; 

		 $comillasimple="'";

		 $botonenvio='
<div align="center">
		 <div class="form-group">
         <div class="col-xs-12">
			<button type="submit" class="mb-sm btn btn-primary" >Guardar Registro</button>
		</div>
		</div>
</div>

';	

		$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';
        @$funciones_cuandoguarda="$('#".@$divresultado."').html('".@$mensajege."')";
		@$funcionextrag=" crear_hc(); 

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
<br>
<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">
<p></p>
<div class="alert alert-success"> <B> <?php //echo utf8_encode($rs_tabla->fields["tab_title"]); ?>
<div class="row">
<?php
			if($csearch)
			{
					$enlace_cli="$('#clie_id').val()";
					//cliente
					//--------------------------------
					$lista_menu="select * from gogess_menupanel where mnupan_activo=1 and posp_id=2 and mnupan_id in (SELECT per_codobj FROM app_usuariosperfil WHERE per_activo=1 and usua_id=".@$_SESSION['ces1313777_sessid_inicio'].") order by mnupan_orden asc ";
					$rs_listamenu = $DB_gogess->executec($lista_menu,array());
					  if($rs_listamenu)
                        {
						        while (!$rs_listamenu->EOF) {
								echo '<div class="col-sm-3">';
								switch ($rs_listamenu->fields["opcionpa_id"]) {
										case 1:
											echo '<a href="javascript:ver_formularioenpantalla(\'aplicativos/documental/opciones/panel/'.$rs_listamenu->fields["mnupan_archivo"].'\',\'Perfil\',\'divBody_ext\',\'\','.$enlace_cli.',\''.$rs_listamenu->fields["mnupan_id"].'\',\''.$csearch.'\',0,0,0)" >

												<img src="archivo/'.$rs_listamenu->fields["mnupan_grafico"].'"   />

												<span class="selected"></span>

											</a>';

											break;

										case 5:

											echo '<a href="javascript:ver_formularioenpantalla(\'aplicativos/documental/datos_clave.php\',\'Clave\',\'divBody_ext\',\'\',\''.$csearch.'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0)">

												<img src="archivo/'.$rs_listamenu->fields["mnupan_grafico"].'"  />

												<span class="selected"></span>

											</a>';

											break;

										case 6:

										   echo '<a href="javascript:salir_sistema()">

												<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>

												<span class="menu-text">'.utf8_decode($rs_listamenu->fields["mnupan_nombre"]).'</span>

												<span class="selected"></span>

											</a>';

											break;

										case 7:

										   echo '<a href="javascript:ver_formularioenpantalla(\'aplicativos/documental/datos_contenido.php\',\'Perfil\',\'divBody_ext\',\'\',\''.$csearch.'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0)">

												<img src="archivo/'.$rs_listamenu->fields["mnupan_grafico"].'"   />

												<span class="selected"></span>

											</a>';

										   break;	

										case 8:

											echo '<a href="javascript:ver_formularioenpantalla(\'aplicativos/documental/datos_standar.php\',\'Pago\',\'divBody_ext\',\'\',\''.$csearch.'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0)" >

												<img src="archivo/'.$rs_listamenu->fields["mnupan_grafico"].'"   />

												<span class="selected"></span>

											</a>';

											break;   	

										default:

										   echo "";

									}

								

								echo '</div>';

								

								$rs_listamenu->MoveNext(); 

								}

						}		

					//--------------------------------

		}			

?>
					

<?php
if($csearch)
{
?>
<div class="col-sm-5">
<table width="300" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="142" onclick="abrir_standar('templateformsweb/maestro_standar_atencion/informe_alta.php','INFORME_ALTA','divBody_informes','divDialog_informes',950,600,$('#clie_id').val(),$('#atenc_id').val(),'','','','','');" style="cursor:pointer"><div align="center"><img src="images/informes_alta1.png?wp=1" /></div></td>
    <td width="21">&nbsp;</td>
    <td width="137" onclick="abrir_standar('templateformsweb/maestro_standar_atencion/informe_desercion.php','INFORME_DESERCION','divBody_informes','divDialog_informes',950,600,$('#clie_id').val(),$('#atenc_id').val(),'','','','','');" style="cursor:pointer" ><div align="center"><img src="images/informes_desercion1.png?wp=1"  /></div></td>
	
	<td width="21">&nbsp;</td>

<?php
//busca la primera evaluacion para integral
$lista_atencionx="select * from dns_atencion where atenc_id=?";
$rs_atencionx = $DB_gogess->executec($lista_atencionx,array($csearch));

$busca_evx="select * from dns_atencionevaluacion where atenc_enlace='".$rs_atencionx->fields['atenc_enlace']."' order by eteneva_id asc limit 1";
$rs_buscaevx = $DB_gogess->executec($busca_evx,array($csearch));
//busca la primera evaluacion para integral
?>	
	
	<!-- <td width="137" onClick="ver_informe(1,'<?php echo $rs_buscaevx->fields["eteneva_id"]; ?>')" style="cursor:pointer" ><div align="center"><img src="images/informes_evolucionintegral1.png?wp=1" /></div></td>
	 
	 <td width="21">&nbsp;</td>-->
	 
	  <td width="137" onClick="ver_informepdf(1,'<?php echo $rs_buscaevx->fields["eteneva_id"]; ?>')" style="cursor:pointer" ><div align="center"><img src="images/informes_evaluacionintegralpdf.png?wp=1" /></div></td>
	
	<td width="21">&nbsp;</td>
	 <td width="137" onclick="abrir_standar('templateformsweb/maestro_standar_atencion/informe_evolucion.php','INFORME_EVOLUCION','divBody_informes','divDialog_informes',950,600,$('#clie_id').val(),$('#atenc_id').val(),'','','','','');" style="cursor:pointer" ><div align="center"><img src="images/informes_evolucion1.png?wp=1" /></div></td>
	
  </tr>
</table>
</div>
<?php
}
?>

</div>

 </B> </div>

<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="" class="form-horizontal" > 
<?php		
		include("../../../tablas.php");
?>	
</form>
</div>
<?php
}

}	
else
{
echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; ">Tu sesi&oacute;n ha expirado</div>';
//enviar
//$varable_enviafunc=base64_encode("desplegar_grid_atencion();");
$varable_enviafunc='';
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

<script type="text/javascript">

<!--

$( "#atenc_fecha" ).datepicker({dateFormat: 'yy-mm-dd'});

$( "#atenc_fechasalida" ).datepicker({dateFormat: 'yy-mm-dd'});

$( "#atenc_fechaentrega" ).datepicker({dateFormat: 'yy-mm-dd'});



function crear_hc()
{

   desplegar_grid_atencion();

   ver_formularioenpantalla('aplicativos/documental/opciones/grid/atencion/grid_atencion_nuevo.php','ATENCION','divBody_interno_atencion',$('#atenc_id').val(),$('#clie_id').val(),'39',0,0,0,0);

  
}

//  End -->

</script>

<?php
//echo numero_secuencialhc('1711467884','atenc_hc','dns_atencion',$DB_gogess);

?>
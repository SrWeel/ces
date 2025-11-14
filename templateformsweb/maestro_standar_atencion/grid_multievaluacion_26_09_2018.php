<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
?>
<style type="text/css">
<!--
.txt_titulo {

	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	border: 1px solid #666666;			
 }

.txt_txt {

	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border: 1px solid #666666;			
 }

.Estilo1 {font-size: 10px}
-->
</style>
<?php

$objformulario= new  ValidacionesFormulario();

//busca si ya tiene evaluaciones
$lista_hay="select count(*) as total from dns_atencionevaluacion where atenc_enlace='".$_POST['enlace']."' and centro_id='".$_POST['centro_id']."' order by eteneva_id asc";
$rs_hay = $DB_gogess->executec($lista_hay,array());
//echo $rs_hay->fields["total"];
$estees_uno=0;
if($rs_hay->fields["total"]==0)
{
  $estees_uno=1;
}
//busca si ya tiene evaluaciones

if($_POST["opcion"]==2)
{

 $borra_reg="delete from dns_atencionevaluacion where atenc_enlace='".$_POST["enlace"]."' and eteneva_id=".$_POST["idgrid"];
 $rs_borra = $DB_gogess->executec($borra_reg,array());

}

if($_POST["opcion"]==1)
{

if($_POST["eteneva_idx"]>0)
{

$sql_actualiza="update dns_atencionevaluacion set eteneva_observacion='".$_POST["eteneva_observacionx"]."',eteneva_ps='".$_POST["eteneva_psx"]."',eteneva_p='".$_POST["eteneva_px"]."',eteneva_l='".$_POST["eteneva_lx"]."',eteneva_tf='".$_POST["eteneva_tfx"]."',eteneva_to='".$_POST["eteneva_tox"]."',eteneva_fechaentrega='".$_POST["eteneva_fechaentregax"]."',eteneva_fecharegistro='".date("Y-m-d")."',usua_id='".$_POST['sess_id']."' where eteneva_id=".$_POST["eteneva_idx"];

$rs_inserta = $DB_gogess->executec($sql_actualiza,array());

}
else
{

$lista_paciente="select distinct tipopac_id,clie_nombre,clie_apellido from app_cliente where clie_id=".$_POST["clie_id"];
$rs_datahijos = $DB_gogess->executec($lista_paciente,array());
if($rs_datahijos)
 {

	  while (!$rs_datahijos->EOF) {	

		$tipopac_id=$rs_datahijos->fields["tipopac_id"];
        $rs_datahijos->MoveNext();	   
	  }

  }


$valor_precio='prod_precio';

	switch ($tipopac_id) {

    case 1:

        $valor_precio="prod_precioisfa";

        break;

    case 2:

        $valor_precio="prod_precio";

        break;

    case 3:

        $valor_precio="prod_precioconvenio";

        break;

	case 4:

        $valor_precio="prod_precioconveniohermano";

        break;	

	case 5:

        $valor_precio="prod_preciopolicia";

        break;

	case 6:

        $valor_precio="prod_preciomilitar";

        break;				

    }

  

//busca producto

$busca_producto="select prod_id,prod_codigo,".$valor_precio." as  prod_precio from efacsistema_producto where prod_paraevaluacion=1 and prod_activo=1";
$rs_serial = $DB_gogess->executec($busca_producto,array());
//busca producto



 $sql_inserta="INSERT INTO `dns_atencionevaluacion` (eteneva_observacion,eteneva_ps,eteneva_p,eteneva_l,eteneva_tf,eteneva_to,eteneva_fechaentrega,eteneva_fecharegistro,atenc_enlace,usua_id,prod_id,prod_precio,clie_id,centro_id,eteneva_num) VALUES ('".$_POST["eteneva_observacionx"]."','".$_POST["eteneva_psx"]."', '".$_POST["eteneva_px"]."','".$_POST["eteneva_lx"]."','".$_POST["eteneva_tfx"]."','".$_POST["eteneva_tox"]."','".$_POST["eteneva_fechaentregax"]."','".date("Y-m-d")."','".$_POST["enlace"]."','".$_POST['sess_id']."','".$rs_serial->fields["prod_id"]."','".$rs_serial->fields["prod_precio"]."','".$_POST["clie_id"]."','".$_POST['centro_id']."','".$estees_uno."')";



$rs_inserta = $DB_gogess->executec($sql_inserta,array());

if($rs_inserta)

{

 /*if($_POST["eteneva_numautorizacionx"])

 {

  $actualiza_cod="update faesa_nautorizaciones set aut_usado=1 where aut_codigo='".$_POST["eteneva_numautorizacionx"]."'";

  $rs_cod = $DB_gogess->executec($actualiza_cod,array());

  }*/

}

}

}

?>

<div class="table-responsive">
<table class="table table-bordered"  style="width:100%" >
  <tr>
    <td>Eliminar</td>
	<td>Editar</td>
	<td>Horario</td>
	<td>Reporte</td>
	<td>Observaci&oacute;n</td>
	<td>Psicolog&iacute;a</td>
	<td>Pedagog&iacute;a</td>
    <td>Lenguaje</td>
	<td>Terapia F&iacute;sica</td>
	<td>Terapia Ocupacional</td>
	<td>Fecha Entrega</td>
    <td># Factura</td>
  </tr>
  <?php

    $cuenta=0;
 $lista_servicios="select * from dns_atencionevaluacion where atenc_enlace='".$_POST['enlace']."' and centro_id='".$_POST['centro_id']."' order by eteneva_id asc";

 $rs_data = $DB_gogess->executec($lista_servicios,array());

 if($rs_data)
 {

	  while (!$rs_data->EOF) {	

	  $busca_factura="select * from beko_documentocabecera inner join beko_documentodetalle on beko_documentocabecera.doccab_id=beko_documentodetalle.doccab_id where eteneva_id=".$rs_data->fields["eteneva_id"];

	   $rs_bfactura = $DB_gogess->executec($busca_factura,array());

	    $cuenta++;

$link_horario=" abrir_standar('templateformsweb/maestro_standar_atencion/asignarhorario.php','HORARIO','divBody_calendario','divDialog_calendario',700,500,'',$('#clie_id').val(),'',$('#atenc_id').val(),'".$rs_data->fields["eteneva_id"]."','".$_POST["fie_id"]."','".$_POST["enlace"]."'); ";

  ?>
  <tr>
<?php
if(!($rs_bfactura->fields["doccab_ndocumento"]))
{
?>
<td onClick="grid_extras_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields["atenc_enlace"]; ?>','<?php echo $rs_data->fields["eteneva_id"]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-ban-circle"></span></td>
<?php
}
else
{
    echo '<td onClick="mensaje_bo()" style="cursor:pointer" ><span class="glyphicon glyphicon-ban-circle"></span></td>';
}

if(!($rs_bfactura->fields["doccab_ndocumento"]))
{
?>	

<td onClick="editar_extras_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields["atenc_enlace"]; ?>','<?php echo $rs_data->fields["eteneva_id"]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-pencil"></span></td>

<?php

}

else

{

    echo '<td onClick="mensaje_no()" style="cursor:pointer" ><span class="glyphicon glyphicon-pencil"></span></td>';



}

?>	





<td onClick="<?php echo $link_horario; ?>" style="cursor:pointer" ><span class="glyphicon glyphicon-calendar"></span>



<?php

$busca_asigancionh="select * from faesa_asigahorario where eteneva_id=".$rs_data->fields["eteneva_id"];

$rs_asigatench = $DB_gogess->executec($busca_asigancionh,array());



if(!(@$rs_asigatench->fields["asighor_id"]))

{



  echo '<img src="images/alerta.gif" width="20" height="20" />';

}

?>

</td>

<td onClick="ver_informepdf(1,'<?php echo $rs_data->fields["eteneva_id"]; ?>')" style="cursor:pointer" ><span class="glyphicon glyphicon-list-alt"></span></td>
	<td><?php echo utf8_encode($rs_data->fields["eteneva_observacion"]); ?></td>

	

	<td>

	<?php

	if($rs_data->fields["eteneva_ps"]=='true')

	{

	  $url_ps='';

	  $url_ps="ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_substandarformunico.php','Perfil','divBody_ext','',$('#clie_id').val(),'33',$('#atenc_id').val(),'".$rs_data->fields["eteneva_id"]."',0,0)";

	

	  $link_ps=' onclick="'.$url_ps.'" style="cursor:pointer" ';

	  echo '<div '.$link_ps.' ><img src="images/iconos/psicologia_on.png" width="35"  /></div>';

	}

	else

	{

	  echo '<div><img src="images/iconos/psicologia_off.png" width="35"  /></div>';

	}

	?>

	</td>

	<td>

	<?php

	if($rs_data->fields["eteneva_p"]=='true')

	{  

	

	$url_p='';

	$url_p="ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_substandarformunico.php','Perfil','divBody_ext','',$('#clie_id').val(),'35',$('#atenc_id').val(),'".$rs_data->fields["eteneva_id"]."',0,0)";

	

	$link_p=' onclick="'.$url_p.'" style="cursor:pointer" ';

	

	echo '<div '.$link_p.' ><img src="images/iconos/pedagogia_on.png" width="35"  /></div>';

	}

	else

	{

	

	echo '<div><img src="images/iconos/pedagogia_off.png" width="35"  /></div>';

	}

	

	?>

	</td>

	<td>

	<?php

	if($rs_data->fields["eteneva_l"]=='true')

	{

	

	$url_l='';

	$url_l="ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_substandarformunico.php','Perfil','divBody_ext','',$('#clie_id').val(),'36',$('#atenc_id').val(),'".$rs_data->fields["eteneva_id"]."',0,0)";

	

	$link_l=' onclick="'.$url_l.'" style="cursor:pointer" ';

	

	echo '<div '.$link_l.' ><img src="images/iconos/lenguaje_on.png" width="35"  /></div>';

	

	}

	else

	{

	echo '<div><img src="images/iconos/lenguaje_off.png" width="35"  /></div>';

	

	}

	?>

	</td>

    <td>

	<?php

	if($rs_data->fields["eteneva_tf"]=='true')

	{

	

	$url_tf='';

	$url_tf="ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_substandarformunico.php','Perfil','divBody_ext','',$('#clie_id').val(),'40',$('#atenc_id').val(),'".$rs_data->fields["eteneva_id"]."',0,0)";

	

	$link_tf=' onclick="'.$url_tf.'" style="cursor:pointer" ';

	

	echo '<div '.$link_tf.' ><img src="images/iconos/terapia_on.png" width="35"  /></div>';

	

	}

	else

	{

	echo '<div><img src="images/iconos/terapia_off.png" width="35"  /></div>';

	

	}

	

	?>

	</td>



    <td>

	<?php

	if($rs_data->fields["eteneva_to"]=='true')
	{

	$url_tf='';
	$url_tf="ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_substandarformunico.php','Perfil','divBody_ext','',$('#clie_id').val(),'52',$('#atenc_id').val(),'".$rs_data->fields["eteneva_id"]."',0,0)";
	$link_tf=' onclick="'.$url_tf.'" style="cursor:pointer" ';
	echo '<div '.$link_tf.' ><img src="images/iconos/ocupacional_on.png" width="35"  /></div>';
	}
	else
	{
	echo '<div><img src="images/iconos/ocupacional_off.png" width="35"  /></div>';
	}

	

	?>

	</td>
	

	<td><?php echo $rs_data->fields["eteneva_fechaentrega"]; ?></td>

    <td><?php echo $rs_bfactura->fields["doccab_ndocumento"]; ?></td>

    

  </tr>



  <?php



   $rs_data->MoveNext();	   



	  }



  }



  ?>



</table>



<input name="si_capacitacion" type="hidden" id="si_capacitacion" value="<?php echo $cuenta ?>">



</div>



<div id='divBody_calendario' ></div>

<?php
if(!(@$_SESSION['ces1313777_sessid_inicio']))
{


//echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; ">Tu sesi&oacute;n ha expirado</div>';
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



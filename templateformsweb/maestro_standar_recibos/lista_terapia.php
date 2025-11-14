<?php
$tiempossss=4444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
if($_SESSION['ces1313777_sessid_inicio'])
{


$objformulario= new  ValidacionesFormulario();
$busca_cantidadt="select psic_nterapias,pedago_nterapias,lenguaj_nterapias,terfisic_nterapias from dns_atencion 

left join faesa_psicologia on dns_atencion.atenc_id=faesa_psicologia.atenc_id 

left join faesa_pedagogia on dns_atencion.atenc_id=faesa_pedagogia.atenc_id

left join faesa_lenguaje on dns_atencion.atenc_id=faesa_lenguaje.atenc_id

left join faesa_terapiafisica on dns_atencion.atenc_id=faesa_terapiafisica.atenc_id

where atenc_hc='".$_POST["valor_b"]."' limit 1";

$rs_cantidadt = $DB_gogess->executec($busca_cantidadt,array());



$total_terapiassug=$rs_cantidadt->fields["psic_nterapias"]+$rs_cantidadt->fields["pedago_nterapias"]+$rs_cantidadt->fields["lenguaj_nterapias"]+$rs_cantidadt->fields["terfisic_nterapias"];





$psicologia=$rs_cantidadt->fields["psic_nterapias"]*1;

$pedagogia=$rs_cantidadt->fields["pedago_nterapias"]*1;

$lenguaje=$rs_cantidadt->fields["lenguaj_nterapias"]*1;

$fisica=$rs_cantidadt->fields["terfisic_nterapias"]*1;



?>

<style type="text/css">

<!--

.Estilo5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }

-->

</style>




<!--
<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td width="299" bgcolor="#E0E6ED"><span class="Estilo5">SUGERIDAS</span></td>

    <td width="301" bgcolor="#E0E6ED"><span class="Estilo5">FACTURADAS</span></td>

  </tr>

  <tr>

    <td valign="top" bgcolor="#EBEBEB"><span class="css_cantidadterapia">PSICOLOGIA:<?php echo $psicologia; ?></span><br>

<span class="css_cantidadterapia">PEDAGOGIA:<?php echo $pedagogia; ?></span><br>

<span class="css_cantidadterapia">LENGUAJE:<?php echo $lenguaje; ?></span><br>

<span class="css_cantidadterapia">TERAPIA FISICA:<?php echo $fisica; ?></span><br>

<strong class="css_cantidadterapia">TOTAL SUGERIDAS:<?php echo $total_terapiassug; ?></strong></td>

    <td valign="top" bgcolor="#E0E0DE"><input name="val_afacturar" type="hidden" id="val_afacturar" value="" /></td>

  </tr>

</table> -->

<input name="val_afacturar" type="hidden" id="val_afacturar" value="" />
<div class="table-responsive">
<div id="num_terapias" ></div>

<!-- <p>Marcar Todos
  <input type="checkbox" name="marcarTodo" id="marcarTodo" />
    <label for="marcarTodo"></label>
</p> -->

<div id="diasHabilitados">
<b>Solo se mostraran los ultimos dos meses las terapias para evitar acumulaci&oacute;n de datos en pantalla</b>
<table class="table table-bordered"  style="width:100%" >

  <tr>
    <td>No</td>
    <td>Facturar</td>
	<td>Area</td>
	<td>Fecha</td>
	<td>Hora</td>
	<td>Estado</td>
    <td>Autorizaci&oacute;n</td>
	<td>N.Factura</td>
	<td>ID</td>
	<td>Registra</td>
  </tr>

  <?php
$itme_fac=array(); 
$condatos_fac=array();
$busca_facturadas="select terap_id,doccab_id from beko_recibodetalle where atenc_hc='".$_POST["valor_b"]."'";
$rs_facturadas = $DB_gogess->executec($busca_facturadas,array());
$vb=0;
$cuenta_p=0;
if($rs_facturadas)
{
  while (!$rs_facturadas->EOF) {	
   
   $itme_fac=explode(",",$rs_facturadas->fields["terap_id"]);
   
   
   
   for($i=0;$i<count($itme_fac);$i++)
   {
    if($itme_fac[$i]>0)
	{
	 
	 $condatos_fac[$itme_fac[$i]]["doccab_id"]=$rs_facturadas->fields["doccab_id"];
	 $cuenta_p++;

	}

   }
   

   
   $rs_facturadas->MoveNext();
  }


}




    $cuenta=0;

 $lista_servicios="select * from  faesa_terapiasregistro where atenc_hc='".$_POST["valor_b"]."' and DATE_ADD(terap_fecha,INTERVAL 40 DAY)>=NOW() order by usua_id,terap_fecha asc";

 $rs_data = $DB_gogess->executec($lista_servicios,array());

 if($rs_data)

 {

	  while (!$rs_data->EOF) {	

	    $cuenta++;
		
		$link_borrar="borrar_registro('faesa_terapiasregistro','terap_id','".$rs_data->fields["terap_id"]."');";
		$link_asignarquitar="asignaquita_campos('".$rs_data->fields["terap_id"]."','checkbox_terp".$rs_data->fields["terap_id"]."')";


         
  ?>

  <tr>
  <td><?php echo $cuenta; ?></td>

  <?php
 if(@$condatos_fac[$rs_data->fields["terap_id"]]["doccab_id"])
 {
   if($_POST["doccab_id"]==@$condatos_fac[$rs_data->fields["terap_id"]]["doccab_id"])
   {
 
 ?>
<td style="cursor:pointer" ><input name="checkbox_terp<?php echo $rs_data->fields["terap_id"]; ?>" type="checkbox" id="checkbox_terp<?php echo $rs_data->fields["terap_id"]; ?>" value="1" onclick="<?php echo $link_asignarquitar; ?>"  checked="checked" />
<script language="javascript">
<!--
     <?php echo $link_asignarquitar; ?>
//-->
</script>
</td>
 <?php
   }
   else
   {
   ?>
   <td>Facturado</td>
   <?php
   }
 }
 else
 { 
  ?>
    <td style="cursor:pointer" ><input name="checkbox_terp<?php echo $rs_data->fields["terap_id"]; ?>" type="checkbox" id="checkbox_terp<?php echo $rs_data->fields["terap_id"]; ?>" value="1" onclick="<?php echo $link_asignarquitar; ?>"  /></td>
<?php
}
?>
<?php


 $lista_area="select especi_nombre from  app_usuario inner join dns_especialidad on app_usuario.especi_id=dns_especialidad.especi_id where usua_id='".$rs_data->fields["usua_id"]."'";
 $rs_area = $DB_gogess->executec($lista_area,array());


?>
	<td><?php echo $rs_area->fields["especi_nombre"]; ?></td>
	<td><?php echo $rs_data->fields["terap_fecha"]; ?></td>
	<td><?php echo $rs_data->fields["terap_hora"]; ?></td>
	<td><?php echo $rs_data->fields["terap_estado"]; ?></td>
	<td><?php echo $rs_data->fields["terap_autorizacion"]; ?></td>
	<?php
	$detalle_fac='';
	if(@$condatos_fac[$rs_data->fields["terap_id"]]["doccab_id"])
	{
	  $detalle_fac='Facturado Temporal<br>'.$condatos_fac[$rs_data->fields["terap_id"]]["doccab_id"];
	}
	$busca_factura="select * from beko_recibocabecera where doccab_id='".@$condatos_fac[$rs_data->fields["terap_id"]]["doccab_id"]."'";
	$rs_bfactura = $DB_gogess->executec($busca_factura,array());
	
	if($rs_bfactura->fields["doccab_ndocumento"])
	{	
	   $detalle_fac=$rs_bfactura->fields["doccab_ndocumento"];
	}
	
	$usuarior_n=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre","where usua_id=",$rs_data->fields["usuar_id"],$DB_gogess);
	?>
	<td><?php echo $detalle_fac; ?></td>
    <td><?php echo $rs_data->fields["terap_id"]; ?></td>
	<td><?php echo $usuarior_n; ?></td>
    
  </tr>

  <?php

   $rs_data->MoveNext();	   

	  }

  }

  ?>

</table>
</div>

</div>



<?php
if($_POST["autorizado"]==0)
{
?>
<input type="button" name="Submit" value="Agregar a Factura" onclick="facturar_terapia()" />
<table width="300" border="1">
<?php
$cuenta_v=0;
$busca_seriall="select usua_id,prod_codigo,prod_id,prod_nombre,prod_precio from efacsistema_producto where prod_paraterapia=1 order by prod_id asc";
$rs_seriall = $DB_gogess->executec($busca_seriall,array());
if($rs_seriall)
 {
	  while (!$rs_seriall->EOF) {	
	  $cuenta_v++;
	  $check_val='';
	  if($cuenta_v==1)
	  {
	    $check_val='checked="checked"';
	  }
?>
        <tr>
          <td><?php echo $rs_seriall->fields["prod_nombre"]; ?></td>
		  <td><?php echo $rs_seriall->fields["prod_precio"]; ?> $</td>
          <td><input name="radiobutton_preio" id="radiobutton_preio<?php echo $rs_seriall->fields["prod_id"]; ?>" type="radio" value="<?php echo $rs_seriall->fields["prod_id"]; ?>"  <?php echo $check_val; ?> /></td>
        </tr>      
<?php
	  
	   $rs_seriall->MoveNext();	   
	  }
  }
?>
</table>
<?php
}
?>

<script language="javascript">
<!--
$('#num_terapias').html('<?php echo "<b>N&uacute;mero Terapias: ".$cuenta."</b>";  ?>');

$("#marcarTodo").change(function () {
    if ($(this).is(':checked')) {
        //$("input[type=checkbox]").prop('checked', true); //todos los check
        $("#diasHabilitados input[type=checkbox]").prop('checked', true); //solo los del objeto #diasHabilitados
    } else {
        //$("input[type=checkbox]").prop('checked', false);//todos los check
        $("#diasHabilitados input[type=checkbox]").prop('checked', false);//solo los del objeto #diasHabilitados
    }
	
	
	    var selectedItems = new Array();
		
		$("input[@name='itemSelect[]']:checked").each(function(){
			selectedItems.push($(this).val());
		});
		
		alert(selectedItems);
	
});
//-->
</script>

<?php

}
else
{

$varable_enviafunc='';
   $varable_enviafunc=base64_encode("buscar_terapia()");
	
		
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





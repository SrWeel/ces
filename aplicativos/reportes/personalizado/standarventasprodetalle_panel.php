<?php
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles


$director="../../../director/";
include ("../../../director/cfgclases/clases.php");


$ireport=$_POST["ireport"];

?>
<SCRIPT LANGUAGE=javascript>
<!--
function ejecuta_reporte()
{
 
 if($('#fecha_inicio').val()=='' && $('#fecha_fin').val()=='')
 {
  //alert("seleccione el rango de fecha");
  //return false;
 }

  
 $("#ver_reporte").load("lospinos/listastandar_ventasdetalle.php",{
	compretcab_rucci_cliente:$('#compretcab_rucci_cliente').val(),
	clie_institucionval:$('#clie_institucionval').val(),
	fecha_inicio:$('#fecha_inicio').val(),
	fecha_fin:$('#fecha_fin').val(),
	previsual:'1',
	ireport:'<?php echo $ireport; ?>',
	codigo_producto:$('#codigo_producto').val(),
	codigo_varios:$('#codigo_varios').val(),
	codigo_cuentas:$('#codigo_cuentas').val(),
	nombre_p:$('#nombre_p').val()
	
	
  },function(result){  

  });  
  $("#ver_reporte").html("Espere un momento...");  

}

function a_excel()
{
	var fecha_inicio=$('#fecha_inicio').val();
	var fecha_fin=$('#fecha_fin').val();
	var tipopac_id=$('#tipopac_id').val();
	
//window.open('lista_faltaronexel.php?fecha_inicio=' + fecha_inicio +'&fecha_fin='+fecha_fin+'&tipopac_id='+tipopac_id,'ventana1','width=750,height=500,scrollbars=YES');

}
//-->
</SCRIPT>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
-->
</style>
<?php

$reporte_pg="select * from sth_report where rept_id=".$ireport;
$rs_reportepg = $DB_gogess->Execute($reporte_pg);

$rept_nombre=$rs_reportepg->fields["rept_nombre"];

?>

<div align="center" class="style1"><?php echo $rept_nombre; ?></div>
<p align="center">
<?php
echo $rs_reportepg->fields["rept_observacion"];
?></p>
<table width="500" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
     <td bgcolor="#E6F1F2" class="style1">FECHA INICIO </td>
     <td bgcolor="#E6F1F2" class="style1">FECHA FIN </td>
     <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	 <td bgcolor="#E6F1F2" class="style1">PRODUCTO</td>
	 <td bgcolor="#E6F1F2" class="style1">VARIOS</td>
	 <td bgcolor="#E6F1F2" class="style1">CUENTAS</td>
	 <td bgcolor="#E6F1F2" class="style1">NOMBRE</td>
     <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	 <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	 <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	 <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	 <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
  </tr>
  <tr>
    <td><input name="fecha_inicio" type="text" id="fecha_inicio"></td>
    <td><input name="fecha_fin" type="text" id="fecha_fin"></td>	
    <td><input name="clie_institucionval" type="hidden" id="clie_institucionval" value="" /></td>	
	<td>
	<select name="codigo_producto" id="codigo_producto" style="width:170px">
      <option value="">--seleccionar--</option>
	  <?php
	   	$busca_usuarios="select distinct  docdet_codprincipal,docdet_descripcion from beko_documentodetalle order by docdet_descripcion asc";
	    $rs_gogessform = $DB_gogess->Execute($busca_usuarios,array());
        if($rs_gogessform)
        {
			while (!$rs_gogessform->EOF) {
			
			if(trim($rs_gogessform->fields["docdet_descripcion"]))
			{
			echo '<option value="'.$rs_gogessform->fields["docdet_codprincipal"].'">'.$rs_gogessform->fields["docdet_descripcion"].'</option>';
			}
			
			$rs_gogessform->MoveNext();
			}
		}
	  
	  ?> 
    </select>	  	  </td>
	
	<td>
	<select name="codigo_varios" id="codigo_varios" style="width:170px" >
      <option value="">--seleccionar--</option>
	  <?php
	   	$busca_usuarios="select distinct  mhdetfac_codprincipal,mhdetfac_descripcion from beko_mhdetallefactura order by mhdetfac_descripcion asc";
	    $rs_gogessform = $DB_gogess->Execute($busca_usuarios,array());
        if($rs_gogessform)
        {
			while (!$rs_gogessform->EOF) {
			
			if(trim($rs_gogessform->fields["mhdetfac_descripcion"]))
			{
			echo '<option value="'.$rs_gogessform->fields["mhdetfac_codprincipal"].'">'.$rs_gogessform->fields["mhdetfac_descripcion"].'</option>';
			}
			
			$rs_gogessform->MoveNext();
			}
		}
	  
	  ?> 
    </select>	  	  </td>
	
	<td>
	<select name="codigo_cuentas" id="codigo_cuentas" style="width:170px" >
      <option value="">--seleccionar--</option>
	  <?php
	   	$busca_usuarios="select distinct  planv_codigoc,planc_nombre from lpin_cuentaventa inner join lpin_plancuentas on lpin_cuentaventa.planv_codigoc=lpin_plancuentas.planc_codigoc order by planc_nombre asc";
	    $rs_gogessform = $DB_gogess->Execute($busca_usuarios,array());
        if($rs_gogessform)
        {
			while (!$rs_gogessform->EOF) {
			if(trim($rs_gogessform->fields["planc_nombre"]))
			{
			echo '<option value="'.$rs_gogessform->fields["planv_codigoc"].'">'.$rs_gogessform->fields["planc_nombre"].'</option>';
			}
			
			$rs_gogessform->MoveNext();
			}
		}
	  
	  ?> 
    </select>	  	  </td>
	<td>
	<input name="nombre_p" type="text" id="nombre_p" value="" />
	</td>
	
	<td onclick="ejecuta_reporte()" style="cursor:pointer"><img src="prev.png" width="147" height="43" /></td>
    <td>&nbsp;</td>
    <td onclick="ver_excel()" style="cursor:pointer"><img src="excel.png" width="147" height="43" border="0" /></td>
    <td>&nbsp;</td>
    <td onclick="ver_pdf()" style="cursor:pointer"><img src="pdf.png" width="147" height="43" /></td>
  </tr>
</table>
<br><br>
<div id="ver_reporte" ></div>


<p>&nbsp;</p>

<script type="text/javascript">
<!--
$( "#fecha_inicio" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#fecha_fin" ).datepicker({dateFormat: 'yy-mm-dd'});


function ver_excel()
{
 if($('#fecha_inicio').val()=='' && $('#fecha_fin').val()=='')
 {
  alert("seleccione el rango de fecha");
  return false;
 }


  location.href = "lospinos/listastandar_ventaspro.php?nombre_p="+$('#nombre_p').val()+"&codigo_cuentas="+$('#codigo_cuentas').val()+"&codigo_varios="+$('#codigo_varios').val()+"&codigo_producto="+$('#codigo_producto').val()+"&compretcab_rucci_cliente="+$('#compretcab_rucci_cliente').val()+"&fecha_inicio="+$('#fecha_inicio').val()+"&fecha_fin="+$('#fecha_fin').val()+"&previsual=2&clie_institucionval="+$('#clie_institucionval').val()+"&ireport=<?php echo $ireport; ?>";

}


function ver_pdf()
{
  
 if($('#fecha_inicio').val()=='' && $('#fecha_fin').val()=='')
 {
  alert("seleccione el rango de fecha");
  return false;
 }


   window.open("lospinos/listastandar_ventaspro.php?nombre_p="+$('#nombre_p').val()+"&codigo_cuentas="+$('#codigo_cuentas').val()+"&codigo_varios="+$('#codigo_varios').val()+"&codigo_producto="+$('#codigo_producto').val()+"&compretcab_rucci_cliente="+$('#compretcab_rucci_cliente').val()+"&fecha_inicio="+$('#fecha_inicio').val()+"&fecha_fin="+$('#fecha_fin').val()+"&previsual=3&clie_institucionval="+$('#clie_institucionval').val()+"&ireport=<?php echo $ireport; ?>", '_blank');  
 
}


//  End -->
</script>
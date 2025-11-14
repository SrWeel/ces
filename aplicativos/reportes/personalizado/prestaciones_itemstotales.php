<?php
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();
$fecha_dhoy=date("Y-m-d");
?>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
-->
</style>
<div align="center" class="style1">REGISTRO MENSUAL</div>
<p>&nbsp;</p>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#E6F1F2" class="style1"><strong>A&ntilde;o </strong></td>
	<td bgcolor="#E6F1F2" class="style1"><strong>Mes </strong></td>
    <td bgcolor="#E6F1F2" class="style1"><strong>Profesional </strong></td>
    <td bgcolor="#E6F1F2" class="style1">Personal</td>
    <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
    <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
  </tr>
  <tr>
    <td>
	<select name="anio_id" id="anio_id">
      <option value="">--seleccionar--</option>
	  <?php
	   	$busca_anio="select * from app_anio order by anio_id asc";
	    $rs_anio = $DB_gogess->executec($busca_anio,array());
        if($rs_anio)
        {
			while (!$rs_anio->EOF) {
			
			echo '<option value="'.$rs_anio->fields["anio_nombre"].'">'.$rs_anio->fields["anio_nombre"].'</option>';
			
			
			$rs_anio->MoveNext();
			}
		}
	  
	  ?> 
    </select>
	</td>
	<td>
	
	<select name="mes_id" id="mes_id">
      <option value="">--seleccionar--</option>
	  <?php
	   	$busca_mes="select * from app_mes order by mes_id asc";
	    $rs_mes = $DB_gogess->executec($busca_mes,array());
        if($rs_mes)
        {
			while (!$rs_mes->EOF) {
			
			echo '<option value="'.$rs_mes->fields["mes_id"].'">'.$rs_mes->fields["mes_nombre"].'</option>';
			
			
			$rs_mes->MoveNext();
			}
		}
	  
	  ?> 
    </select>
	
	</td>
     <td><select name="usua_id" id="usua_id">
      <option value="">--seleccionar--</option>
	  <?php
	   	$busca_usuarios="select distinct app_usuario.usua_id,usua_apellido,usua_nombre from app_usuario inner join dns_gridfuncionprofesional on app_usuario.usua_enlace=dns_gridfuncionprofesional.usua_enlace where usua_estado=1 and dns_gridfuncionprofesional.prof_id not in (38,77,777) order by usua_apellido asc ";
	    $rs_gogessform = $DB_gogess->executec($busca_usuarios,array());
        if($rs_gogessform)
        {
			while (!$rs_gogessform->EOF) {
			
			echo '<option value="'.$rs_gogessform->fields["usua_id"].'">'.$rs_gogessform->fields["usua_apellido"].' '.$rs_gogessform->fields["usua_nombre"].'</option>';
			$rs_gogessform->MoveNext();
			}
		}
	  
	  ?> 
    </select>
    </td>
	
    <td><input type="button" name="Button" value="Buscar" onClick="ejecuta_reporte()"></td>
    <td><input type="button" name="Button" value="Excel" onClick="a_excel()"></td>
  </tr>
</table><br><br>
<div id="ver_reporte" ></div>


<p>&nbsp;</p>

<script type="text/javascript">
<!--
$( "#fecha_inicio" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#fecha_fin" ).datepicker({dateFormat: 'yy-mm-dd'});
//  End -->
</script>
<SCRIPT LANGUAGE=javascript>
<!--
function ejecuta_reporte()
{
 if($('#anio_id').val()=='')
 {
  alert("Ingrese todos los campos porfavor");
  return false;
 }
 
 if($('#mes_id').val()=='')
 {
  alert("Ingrese todos los campos porfavor");
  return false;
 }
 
 if($('#usua_id').val()=='')
 {
  alert("Ingrese todos los campos porfavor");
  return false;
 }
 
  
 $("#ver_reporte").load("pichincha/prestaciones_itemstotales.php",{
    anio_id:$('#anio_id').val(),
	mes_id:$('#mes_id').val(),
	usua_id:$('#usua_id').val()
  },function(result){  

  });  
  $("#ver_reporte").html("Espere un momento...");  

}


//-->
</SCRIPT>

<script>
<!--

function a_excel() {
window.open('pichincha/prestaciones_itemsexceltotales.php?excel=1&anio_id='+$('#anio_id').val()+'&mes_id='+$('#mes_id').val()+'&usua_id='+$('#usua_id').val(),'ventana_excel','width=750,height=500,scrollbars=YES');

}
				
//-->
</script>
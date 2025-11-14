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
$ireport=$_POST["ireport"];


$reporte_pg="select * from sth_report where rept_id=".$ireport;
$rs_reportepg = $DB_gogess->executec($reporte_pg,array());

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
<div align="center" class="style1"><?php echo $rs_reportepg->fields["rept_nombre"]; ?></div>
<p>&nbsp;</p>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#E6F1F2" class="style1"><strong>Fecha inicio </strong></td>
    <td bgcolor="#E6F1F2" class="style1"><strong>Fecha fin </strong></td>
    <td bgcolor="#E6F1F2" class="style1">Tipo Seguro</td>
    <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
    <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
  </tr>
  <tr>
    <td><input name="fecha_inicio" type="text" id="fecha_inicio" value="<?php echo $fecha_dhoy; ?>" autocomplete="off" ></td>
    
     <td><input name="fecha_fin" type="text" id="fecha_fin" value="<?php echo $fecha_dhoy; ?>" autocomplete="off" ></td>
     <td><select name="conve_id" id="conve_id">
      <option value="">--seleccionar--</option>
	  <?php
	   	$busca_usuarios="select * from cesdb_arextension.dns_convenios where conve_id=2 order by conve_nombre asc ";
	    $rs_gogessform = $DB_gogess->executec($busca_usuarios,array());
        if($rs_gogessform)
        {
			while (!$rs_gogessform->EOF) {
			
			echo '<option value="'.$rs_gogessform->fields["conve_id"].'">'.$rs_gogessform->fields["conve_nombre"].'</option>';
			$rs_gogessform->MoveNext();
			}
		}
	  
	  ?> 
    </select>    </td>
	
    <td><input type="button" name="Button" value="Buscar" onClick="ejecuta_reporte()"></td>
     <td><input type="button" name="btnExport" id="btnExport" value="Excel" onclick="ver_excel()" /></td>
  </tr>
</table>
<br><br>
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
 if($('#fecha_inicio').val()=='')
 {
  alert("Ingrese la fecha de inicio");
  return false;
 }

 if($('#fecha_fin').val()=='')
 {
  alert("Ingrese la fecha de inicio");
  return false;
 } 
 
  if($('#conve_id').val()=='')
 {
  alert("Ingrese el tipo seguro");
  return false;
 } 
 
  
 $("#ver_reporte").load("pichincha/lista_agendamiento.php",{
    fecha_inicio:$('#fecha_inicio').val(),
	fecha_fin:$('#fecha_fin').val(),
	conve_id:$('#conve_id').val(),
	previsual:'1',
	ireport:'<?php echo $ireport; ?>'
  },function(result){  

  });  
  $("#ver_reporte").html("Espere un momento...");  

}


function ver_excel()
{
  location.href = "pichincha/lista_agendamiento.php?conve_id="+$('#conve_id').val()+"&fecha_inicio="+$('#fecha_inicio').val()+"&fecha_fin="+$('#fecha_fin').val()+"&previsual=2&ireport=<?php echo $ireport; ?>";

}


//-->
</SCRIPT>

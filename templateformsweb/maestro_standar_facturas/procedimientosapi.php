<?php
$tiempossss=44400000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
if($_SESSION['ces1313777_sessid_inicio'])
{

?>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.css_cantidad {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}

-->
</style>
<script language="javascript">
<!--
function procesar_api()
{

$("#list_prdata").load("templateformsweb/maestro_standar_facturas/lista_prapi.php",{

 },function(result){       
			 
  });  
$("#list_prdata").html("Espere un momento...");

}
 
function buscar_procedimientosapi()
{

if($('#valor_b').val()=='')
{
  alert("Ingrese el CODIGO");
  return false;

}


$("#list_insumo").load("templateformsweb/maestro_standar_facturas/lista_procedimientosapi.php",{
valor_b:$('#valor_b').val(),
prof_idval:$('#prof_idval').val(),
ci_paga:$('#doccab_rucci_cliente').val(),
tippo_id:'<?php echo $_POST["pVar5"]; ?>',
conve_id:'<?php echo $_POST["pVar6"]; ?>',
doccab_autorizacion:'<?php echo $_POST["pVar7"]; ?>',
usua_idfacval:$('#usua_idfacval').val()
 },function(result){       
			 
  });  
  $("#list_insumo").html("Espere un momento...");

}

//=================================

function agregar_insumo(idinsumo,ci,prof_idval)
{
	if(ci=='')
	{
	        alert("Por favor seleccione el profesional");
			return false;
	}
	
	if($('#cant_val').val()<=0)
		{
			
			alert("Por favor para cantidad el valor debe ser minimo 1");
			return false;
		}
	
$("#agregar_insumo").load("templateformsweb/maestro_standar_facturas/agregar_procedimientoapi.php",{
cant_val:$('#cant_val').val(),
prod_id:idinsumo,
enlace:'<?php echo $_POST["pVar1"]; ?>',
usua_idfacval:ci,
tippo_id:'<?php echo $_POST["pVar5"]; ?>',
conve_id:'<?php echo $_POST["pVar6"]; ?>',
doccab_autorizacion:'<?php echo $_POST["pVar7"]; ?>',
prof_idval:prof_idval
 },function(result){       
			
			grid_factura(0);
			 
  });  
  $("#agregar_insumo").html("Espere un momento...");


}


//-->
</script>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
	 <td><strong class="css_cantidad">AREA:</strong>     
	 <select name="prof_idval" id="prof_idval" style="width:120px" >
      <option value="">--seleccionar--</option>
	  <?php
	   	$busca_usuarios="select * from cesdb_arextension.dns_profesion where prof_nosalir=0  order by prof_nombre asc ";
	    $rs_gogessform = $DB_gogess->executec($busca_usuarios,array());
        if($rs_gogessform)
        {
			while (!$rs_gogessform->EOF) {
			
			echo '<option value="'.$rs_gogessform->fields["prof_id"].'">'.$rs_gogessform->fields["prof_nombre"].'</option>';
			$rs_gogessform->MoveNext();
			}
		}	  
	  ?> 
    </select></td>
    <td><input name="valor_b" type="text" id="valor_b" size="30"></td>
    <td><input type="button" name="Submit" value="C&oacute;digo Producto" onClick="buscar_procedimientosapi()" ></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="Submit2" value="Procesar Producto" onclick="procesar_api()"></td>
  </tr>
</table>
<div align="center"><br>
    <strong class="css_cantidad">CANTIDAD:</strong>
  <input name="cant_val" type="text" class="css_cantidad" id="cant_val" value="1" size="10">
 
</div>

<div id="list_prdata"></div>
<div id="list_evaluacion" ></div>
<div id="list_insumo"> </div>
<div id="agregar_insumo"> </div>

<?php
}
?>

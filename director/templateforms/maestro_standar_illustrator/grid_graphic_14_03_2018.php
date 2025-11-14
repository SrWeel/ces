<?php

ini_set('display_errors',0);
error_reporting(E_ALL);
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(isset($_SESSION['sessidadm1777_pichincha']))
{
$director="../../";
include("../../cfgclases/clases.php");
/*SACAR GRID*/
?>

<style type="text/css">
<!--
.titulo_table {
	font-size: 13px; 
	font-family: Arial, Verdana; 
	font-weight: bold; 
	border:solid; 
border-width:1px;
border-color:#000;
	}

.txt_table {
	font-size: 13px; 
	font-family: Arial, Verdana; 
	border:solid; 
border-width:1px;
border-color:#000;
	}	

-->
</style>
<?phP
	 
if($_POST["opcion"]==1)
{
	
 $inserta_data="insert into  rose_graph (varillu_id,graph_table,graph_fieldsx,graph_fieldsy,typeg_name,graph_groupx,graph_formula,graph_decimals) values ('".$_POST["varillu_id"]."','".$_POST["ltablas"]."','".$_POST["x_campo_id"]."','".$_POST["y_campo_id"]."','".$_POST["typeg_name"]."','".$_POST["x_group_id"]."','".$_POST["graph_formula"]."','".$_POST["graph_decimals"]."')";
 $result_data = $DB_gogess->Execute($inserta_data);	
	
}

if($_POST["opcion"]==2)
{
   $borra_reg="delete from rose_graph where graph_id=".$_POST["graph_id"];
  $result_data = $DB_gogess->Execute($borra_reg);	
}

?>

<table width="400" border="0">
  <tr>
    <td><input name="btn_refresh" type="button" id="btn_refresh" value="Refresh" onclick="grid_graph(0,0);" /></td>
    <td>&nbsp;</td>
    <td><input name="btn_refresh" type="button" id="btn_refresh" value="Save" onclick="grid_graph(0,0);" /></td>
  </tr>
</table>

 

<table id="tabla_lista" class="cell-border display compact" cellspacing="0" width="400px">
 <thead>
            <tr>
                <th>Delete</th>
                <th>Name</th>
                <th>Table</th>
                <th>Field X</th>
                <th>Group X</th>
                <th>Title</th>
                <th>Operation Y</th>
				<th>Decimals</th>
				<th>Scale min</th>
				<th>Scale max</th>
                <th>Type Graphic</th>
                <th>Active</th>
                <th>See</th>
				<th>Order</th>
            </tr>
            
  </thead>
  
  <tfoot>
            <tr>
                <th>Delete</th>
                <th>Name</th>
                <th>Table</th>
                <th>Field X</th>
                <th>Group X</th>
                <th>Title</th>
                <th>Operation Y</th>
				<th>Decimals</th>
				<th>Scale min</th>
				<th>Scale max</th>
                <th>Type Graphic</th>
                <th>Active</th>
                <th>See</th>
				<th>Order</th>
            </tr>
   </tfoot>
    <tbody>
<?php
$lista_tabla="select * from rose_graph inner join rose_variableillustrator on rose_graph.varillu_id=rose_variableillustrator.varillu_id where rose_graph.varillu_id=".$_POST["varillu_id"]." order by graph_order asc";

$result_data= $DB_gogess->Execute($lista_tabla);
if($result_data)
{
 while (!$result_data->EOF) {	
 $nombre_tabla='';
 $campox='';
 $campoy='';
 $nombre_tabla=$objformulario->replace_cmb("rose_variabledeveloper","vardev_id,vardev_nombre"," where vardev_id=",$result_data->fields["graph_table"],$DB_gogess);
 
 
 
 $campox=$objformulario->replace_cmb("sth_vddetalle","vardevdet_id,vardevdet_campo"," where vardevdet_id=",$result_data->fields["graph_fieldsx"],$DB_gogess);
 
 if(is_numeric(trim($campox)))
{

   $lista_virtualc="select * from gogess_virtualfields where virtfields_id=".trim($campox);
   $result_camposc = $DB_gogess->Execute($lista_virtualc);
   $campox=$result_camposc->fields["virtfields_namefield"];
}

 
 
 
 $campoy=$objformulario->replace_cmb("sth_vddetalle","vardevdet_id,vardevdet_campo"," where vardevdet_id=",$result_data->fields["graph_fieldsy"],$DB_gogess);
 
 
 $list_campos=explode(",",$result_data->fields["graph_groupx"]);
 for($g_v=0;$g_v<count($list_campos);$g_v++)
  {
	  if(trim($list_campos[$g_v])!='')
	  {
		// $saca_ncampo_grupo="select vardevdet_campo from sth_vddetalle where vardevdet_id='".$list_campos[$g_v]."'";
         //$result_ncampo_grupo = $DB_gogess->Execute($saca_ncampo_grupo);
		$groupx=$list_campos[$g_v];	 
		
	  }
	  
  }

$estado_g='';
 if($result_data->fields["graph_activo"]==0)
 {
	 
	 $estado_g='<img src="images/check_off.png" width="32" height="32">';
	 
	 
 }
 else
 {
	  $estado_g='<img src="images/check_on.png" width="32" height="32">';
 }
 $operationy='';
 $operationy=$result_data->fields["graph_formula"];
 $id_val=0;
 $id_val=$result_data->fields["graph_id"];
?>  
  <tr>
    <td bgcolor="#FFFFFF" class="txt_table" onClick="grid_graph('2','<?php echo $result_data->fields["graph_id"]; ?>');" style="cursor:pointer" ><img src="images/delete.png" width="32" height="32"></td>
    <td bgcolor="#FFFFFF" class="txt_table" ><?php echo $result_data->fields["varillu_name"]; ?></td>
    <td bgcolor="#FFFFFF" class="txt_table" ><?php echo $nombre_tabla; ?></td>
    <td bgcolor="#FFFFFF" class="txt_table" ><?php echo $campox; ?></td>
    
    <td bgcolor="#FFFFFF" class="txt_table" ><?php echo $groupx; ?></td>
    
    <td bgcolor="#FFFFFF" class="txt_table" ><input name="graph_title<?php echo $id_val; ?>" id="graph_title<?php echo $id_val; ?>" type="text" value="<?php echo $result_data->fields["graph_title"]; ?>" size="10" onblur="guarda_data('<?php echo $id_val; ?>','graph_id')" /></td>
    
    <td bgcolor="#FFFFFF" class="txt_table" ><?php echo $operationy; ?></td>
	
	<td bgcolor="#FFFFFF" class="txt_table" >
	
	<input name="graph_decimals<?php echo $id_val; ?>" id="graph_decimals<?php echo $id_val; ?>" type="text" value="<?php echo $result_data->fields["graph_decimals"]; ?>" size="3" onblur="guarda_decimals('<?php echo $id_val; ?>','graph_id')" />
	
	</td>
	
	<td bgcolor="#FFFFFF" class="txt_table" >
	
	<input name="graph_min<?php echo $id_val; ?>" id="graph_min<?php echo $id_val; ?>" type="text" value="<?php echo $result_data->fields["graph_min"]; ?>" size="3" onblur="guarda_min('<?php echo $id_val; ?>','graph_id')" />
	
	</td>
	
	
		<td bgcolor="#FFFFFF" class="txt_table" >
	
	<input name="graph_max<?php echo $id_val; ?>" id="graph_max<?php echo $id_val; ?>" type="text" value="<?php echo $result_data->fields["graph_max"]; ?>" size="3" onblur="guarda_max('<?php echo $id_val; ?>','graph_id')" />
	
	</td>
	
    
    <td bgcolor="#FFFFFF" class="txt_table" ><?php echo $result_data->fields["typeg_name"]; ?></td>
    
    <td bgcolor="#FFFFFF" class="txt_table" onClick="activar_descativar('<?php echo $result_data->fields["graph_id"]; ?>')" style="cursor:pointer" ><div id="div_ac<?php echo $result_data->fields["graph_id"]; ?>" ><?php echo $estado_g; ?></div></td>
    <td bgcolor="#FFFFFF" class="txt_table" onClick="ver_grafico_eject('<?php echo $result_data->fields["graph_fieldsx"]; ?>','<?php echo $result_data->fields["graph_fieldsy"]; ?>','<?php echo $result_data->fields["typeg_name"]; ?>','<?php echo $result_data->fields["graph_groupx"];  ?>','<?php echo $result_data->fields["graph_formula"]; ?>','<?php echo $result_data->fields["graph_decimals"]; ?>','<?php echo $result_data->fields["graph_min"]; ?>','<?php echo $result_data->fields["graph_max"]; ?>')" style="cursor:pointer" ><img src="images/chart2.png" width="32" height="32"></td>
 
 <td bgcolor="#FFFFFF" class="txt_table" >
	
	<input name="graph_order<?php echo $id_val; ?>" id="graph_order<?php echo $id_val; ?>" type="text" value="<?php echo $result_data->fields["graph_order"]; ?>" size="3" onblur="guarda_order('<?php echo $id_val; ?>','graph_id')" />
	
	</td>
 
  </tr>
<?php
   $result_data->MoveNext();
 }
}

?>  
 <tbody>
</table>

<script language="javascript">
<!--
function guarda_data(id_val,graph_id)
{
	
	 $("#div_gdatosgrid").load("templateforms/maestro_standar_illustrator/gdatos_val.php",{		 
	 
	  valor:$('#graph_title'+id_val).val(),
	  graph_id:id_val
	 
	 },function(result){  
    
	
     });  
    $("#div_gdatosgrid").html("...");
	
}

function guarda_decimals(id_val,graph_id)
{
	
	 $("#div_gdatosgrid").load("templateforms/maestro_standar_illustrator/gdecimals_val.php",{		 
	 
	  valor:$('#graph_decimals'+id_val).val(),
	  graph_id:id_val
	 
	 },function(result){  
    
	
     });  
    $("#div_gdatosgrid").html("...");
	
}


function guarda_min(id_val,graph_id)
{
	
	 $("#div_gdatosgrid").load("templateforms/maestro_standar_illustrator/gmin_val.php",{		 
	 
	  valor:$('#graph_min'+id_val).val(),
	  graph_id:id_val
	 
	 },function(result){  
    
	
     });  
    $("#div_gdatosgrid").html("...");
	
}

function guarda_max(id_val,graph_id)
{
	
	 $("#div_gdatosgrid").load("templateforms/maestro_standar_illustrator/gmax_val.php",{		 
	 
	  valor:$('#graph_max'+id_val).val(),
	  graph_id:id_val
	 
	 },function(result){  
    
	
     });  
    $("#div_gdatosgrid").html("...");
	
}


function guarda_order(id_val,graph_id)
{
	
	 $("#div_gdatosgrid").load("templateforms/maestro_standar_illustrator/gorder_val.php",{		 
	 
	  valor:$('#graph_order'+id_val).val(),
	  graph_id:id_val
	 
	 },function(result){  
    
	
     });  
    $("#div_gdatosgrid").html("...");
	
}




$(document).ready(function() {
    $('#tabla_lista').DataTable();
} );
//-->
</script>
<?php
}
?>
<div id="div_gdatosgrid" ></div>

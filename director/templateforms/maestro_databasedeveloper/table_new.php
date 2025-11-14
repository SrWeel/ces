<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=4440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['sessidadm1777_pichincha'])
{
$director='../../';
include("../../cfgclases/clases.php");

$virtual_id=$_POST["virtual_id"];
$obt_datos="select * from gogess_virtualtable where virtual_id=".$virtual_id;
$rs_obtiene = $DB_gogess->Execute($obt_datos);


$nombre_tabla=strtolower(str_replace(' ','',$rs_obtiene->fields["virtual_name"]));
$nombre_tabla=str_replace('.','',$nombre_tabla);
$nombre_tabla=str_replace('_','',$nombre_tabla);
$nombre_tabla=str_replace('&','',$nombre_tabla);
$nombre_tabla="db_".$nombre_tabla;
}
?>
<br />
<style type="text/css">
<!--
.font_data {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }


-->
</style>
<input type="button" name="Button" value="Create Table" onclick="genera_datax()" />
<table width="680" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="288">
	
<div id="TableScroll_table">	
<table width="250" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FFFFFF" colspan="2"><span class="font_data">
      <center><?php echo $nombre_tabla; ?>
      </center></span></td>
  </tr>
  <?php
  $lista_campos="select * from gogess_virtualfields where virtual_id='".$rs_obtiene->fields["virtual_id"]."'";
  $rs_campos = $DB_gogess->Execute($lista_campos);
  if($rs_campos)
  {
	  while (!$rs_campos->EOF) {
	  
	  $nombre_campo='';
	  $nombre_campo=strtolower($rs_campos->fields["virtfields_namefield"]);
	  
	  $nombre_type='';
	  if($rs_campos->fields["virtfields_typefield"])
	  {
	  $nombre_type=strtolower($rs_campos->fields["virtfields_typefield"]);
	  }
	  else
	  {
	  $nombre_type='STRING';
	  }
	  
  ?>
  <tr>
    <td bgcolor="#FFFFFF"><span class="font_data"><?php echo $nombre_campo; ?></span></td>
	<td bgcolor="#FFFFFF"><span class="font_data"><?php echo $nombre_type; ?></span></td>
  </tr>
  <?php
       $rs_campos->MoveNext();	   
	  }
  }
  ?>
</table>
</div>
	
	
	
	</td>
    <td width="392" valign="top">
	<div id="genera_d" style="background:#000000; padding-left:3px; padding-right:3px; color:#FFFFFF"></div>
	
	</td>
  </tr>
</table>

<script language="javascript">
<!--
function genera_datax()
{
 $("#genera_d").load("templateforms/maestro_databasedeveloper/generate_data.php",{
   virtual_id:'<?php echo $virtual_id; ?>'

  },function(result){  
 

  });  
  $("#genera_d").html("Espere un momento"); 
} 
//-->
</script>
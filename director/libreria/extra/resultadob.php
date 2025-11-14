<?php
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director="../../";
include ("../../cfgclases/clases.php");


$desarmacampos=explode(",",$_POST["camposbusca"]);

//print_r($desarmacampos);

for($i=0;$i<count($desarmacampos);$i++)
{
   
   $verificab=explode(" ",$desarmacampos[$i]);
   
   if($verificab[1]=='like')
   {
      $concatenabscar=$concatenabscar.$verificab[0]." ".$verificab[1]."'%".$_POST["buscar_val"]."%' or ";
   }
   else
   {
      $concatenabscar=$concatenabscar.$verificab[0]." ".$verificab[1]."".$_POST["buscar_val"]." or ";
   
   }
 
}

 $concatenabscar=substr($concatenabscar,0,-3);

$sqlbusca="select * from ".$_POST["tablabusca"]." where ".$concatenabscar;
//echo $sqlbusca;

$camposver=explode(",",$_POST["campodevuelve"]);

 $rs_gogessform = $DB_gogess->Execute($sqlbusca);

		

?>
<style type="text/css">
<!--
.Estilo3 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo6 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
<table width="400" border="0" align="center" cellpadding="2" cellspacing="1">
  <tr>
    <td bgcolor="#C4D7DF"><div align="center"></div></td>
    
	<?php
	for($i=1;$i<count($camposver);$i++)
	{
	   $objformulario->campo_gogess($_POST["tablabusca"],$camposver[$i],$DB_gogess);
	   echo '<td bgcolor="#C4D7DF"><div align="center"><span class="Estilo3">'.$objformulario->tab_title.'</span></div></td>';
	}
	?>
	
  </tr>
  
 <?php
  if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
 ?>   
  <tr>
  
 
    <td bgcolor="#FFFFFF" onClick="seleccionar_valor('<?php echo $rs_gogessform->fields[$camposver[0]] ?>')"><img src="images/seleccionar.png" width="30" height="24"></td>
	
	
    
	<?php
	for($i=1;$i<count($camposver);$i++)
	{
	   
	   echo '<td bgcolor="#FFFFFF"><span class="Estilo6">'.$rs_gogessform->fields[$camposver[$i]].'</span></td>';
	}
	?>
	
	
  </tr>
  <?php
  		$rs_gogessform->MoveNext(); 
		}
	}	
  ?>
  
</table>
<?php
$tiempossss=44600000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["produ_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if($_SESSION['ces1313777_sessid_inicio'])
{

//echo $_POST["pVar1"]."<br>";


$busca_lesiones="select * from dns_registrolesioneshospi inner join cesdb_arextension.dns_lesioneshospi on dns_registrolesioneshospi.les_id=cesdb_arextension.dns_lesioneshospi.les_id where anam_enlace='".$_POST["anam_enlace"]."'"; 
$rs_lesiones = $DB_gogess->executec($busca_lesiones);
?>
<style type="text/css">
<!--
.css_data {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_txt {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif;  }
-->
</style>	
<table width="500" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#DBE6EE"><span class="css_data">CODIGO</span></td>
	<td bgcolor="#DBE6EE"><span class="css_data">NOMBRE</span></td>
    <td bgcolor="#DBE6EE"><span class="css_data"></span></td>	
  </tr>
  <?php
  if($rs_lesiones)
				   {
						while (!$rs_lesiones->EOF) {					
						
  ?>
  <tr>
    <td bgcolor="#E6F3F9" class="css_txt" ><?php echo $rs_lesiones->fields["les_id"]; ?></td>
	<td bgcolor="#F2F2F2" class="css_txt" ><?php echo $rs_lesiones->fields["les_nombre"]; ?></td>
    <td bgcolor="#F2F2F2" class="css_txt" ><input type="button" name="Submit" value="Eliminar" onclick="borrar_lesiones('<?php echo $rs_lesiones->fields["less_id"]; ?>')" /></td>
  </tr>
  <?php
                          $rs_lesiones->MoveNext();
						}
					}
  
  ?>
</table>  
<?php
}
?>
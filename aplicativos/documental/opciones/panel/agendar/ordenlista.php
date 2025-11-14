<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44540000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();


$buscat="select * from app_cliente where clie_id=".$_POST["pVar1"];
$rs_clientet = $DB_gogess->executec($buscat,array());


$lista_terapias="select distinct terap_fecharegistro from faesa_terapiasregistro where clie_id=".$_POST["pVar1"]." order by terap_fecharegistro desc";

?>
<style type="text/css">
<!--
.css_textoc {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.css_tituloc {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<?php
echo "<center><span class='css_tituloc'><b>Paciente:</b>".utf8_encode($rs_clientet->fields["clie_nombre"]." ".$rs_clientet->fields["clie_apellido"])."</span></center>";
?>

<table width="300" border="1" align="center">
  <tr>
    <td colspan="3"><span class="css_tituloc">TERAPIAS</span></td>
  </tr>
  <tr>
    <td class="css_tituloc">FECHA</td>
    <td class="css_tituloc">IMPRIMIR</td>
  </tr>
  <?php
  $rs_listat = $DB_gogess->executec($lista_terapias,array());
  if($rs_listat)
         {
	                  while (!$rs_listat->EOF) {	
  ?>
  <tr>
    <td class="css_textoc"><?php  echo $rs_listat->fields["terap_fecharegistro"]; ?></td>
    <td class="css_textoc"><input type="button" name="Submit" value="Imprimir" onClick="ver_imprimir('<?php  echo $rs_listat->fields["terap_fecharegistro"]; ?>','<?php echo $_POST["pVar1"]; ?>')">
    </td>
  </tr>
  <?php  
                        $rs_listat->MoveNext();
                         }
	   }
  
  ?>
</table>

<?php

}


?>
<script language="javascript">
<!--
function ver_imprimir(fecha,clie_id) {
 myWindow2=window.open('aplicativos/documental/opciones/panel/agendar/orden.php?clie_id='+clie_id+'&fecha='+fecha,'ventana_evaluacion','width=750,height=500,scrollbars=YES');
 myWindow2.focus();

}
//-->
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Orden</title>
<style type="text/css">
<!--
.Estilo5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.Estilo8 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
<style type="text/css">
<!--
.css_textoc {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.css_tituloc {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</head>

<body>
<div align="center">
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

$buscat="select * from app_cliente where clie_id=".$_GET["clie_id"];
$rs_clientet = $DB_gogess->executec($buscat,array());


?>
  <?php
//echo "<center><span class='css_tituloc'><b>Paciente:</b>".utf8_encode($rs_clientet->fields["clie_nombre"]." ".$rs_clientet->fields["clie_apellido"])."</span></center>";

$lista_terapias="select * from faesa_terapiasregistro where clie_id=".$_GET["clie_id"]." and terap_fecharegistro='".$_GET["fecha"]."' order by terap_fecharegistro desc";

?>
  <strong>ORDEN DE PAGO</strong></div><br />
   <?php
echo "<center><span class='css_tituloc'><b>Paciente:</b>".utf8_encode($rs_clientet->fields["clie_nombre"]." ".$rs_clientet->fields["clie_apellido"])."</span></center>";

?>
<br /><table width="400" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#E0E7F1" class="Estilo5"><div align="center">TERAPIA FECHA </div></td>
    <td bgcolor="#E0E7F1" class="Estilo5"><div align="center">HORA</div></td>
    <td bgcolor="#E0E7F1" class="Estilo5"><div align="center">TERAPEUTA</div></td>
  </tr>
  <?php
   $rs_listat = $DB_gogess->executec($lista_terapias,array());
  if($rs_listat)
         {
	                  while (!$rs_listat->EOF) {
  ?>
  <tr>
    <td class="Estilo8"><?php echo $rs_listat->fields["terap_fecha"]; ?></td>
    <td class="Estilo8"><?php echo $rs_listat->fields["terap_hora"]; ?></td>
    <td class="Estilo8"><?php 
	
	
	$buscausuario="select * from app_usuario where usua_id=".$rs_listat->fields["usua_id"];
    $rs_busuario = $DB_gogess->executec($buscausuario,array());
	echo $rs_busuario ->fields["usua_nombre"];
	 ?></td>
  </tr>
  <?php
           $rs_listat->MoveNext();
                         }
	   }
  ?>
</table>

<p>&nbsp; </p>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="201">&nbsp;</td>
    <td width="199">&nbsp;</td>
  </tr>
  <tr>
    <td class="css_textoc"><p align="center">&nbsp;</p>
      <p align="center">__________________</p>
      <p align="center"><strong>Representante</strong></p>
    <p align="center">&nbsp;</p></td>
    <td class="css_textoc"><p align="center">__________________</p>
    <p align="center"><strong>Dr. Carla Adulcir Guerrero Pozo </strong></p></td>
  </tr>
</table>

<div align="center"><span class="css_tituloc">Nota: Esta orden de pago tiene vigencia de 24 horas, vencido este plazo los horarios ser&aacute;n usados en otros pacientes.</span>
</div>
<p>
  <?php
}
?>
</p>
</body>
</html>

<?php
ini_set("session.gc_maxlifetime","14400");
session_start();
//echo $_POST["pVar1"];
//Llamando objetos
$director="../../";
include ("../../cfgclases/clases.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Libro Diario</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style></head>
<body>
<p align="center"><b>LIBRO DIARIO</b></p>
<table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center"><strong>FECHA</strong></div></td>
    <td><div align="center"><strong>DETALLE</strong></div></td>
    <td><div align="center"><strong>DEBE</strong></div></td>
    <td><div align="center"><strong>HABER</strong></div></td>
  </tr>
<?php

$fecha_i=$_POST["fecha_i"];
$fecha_f=$_POST["fecha_f"];
 
$listadiario="select * from lpin_comprobantecontable where comcont_fecha>='".$fecha_i."' and comcont_fecha<='".$fecha_f."' order by comcont_fecha asc";
$rs_listadiario = $DB_gogess->Execute($listadiario);
$ib=0;
 if($rs_listadiario)
 {
     while (!$rs_listadiario->EOF) {	
	 
	 $listadbehaberc="select count(*) as total from lpin_detallecomprobantecontable where comcont_id='".$rs_listadiario->fields["comcont_id"]."' and detcc_debe>0"; 
	 $rs_debehaberc = $DB_gogess->Execute($listadbehaberc);
	 
	 if( $rs_debehaberc->fields["total"]>0)
	 {
	 //==========================================================
	 echo '<tr>
			<td nowrap="nowrap" bgcolor="#F0F0F0" >'.$rs_listadiario->fields["comcont_fecha"].'</td>
			<td bgcolor="#F0F0F0" >'.$rs_listadiario->fields["comcont_concepto"].' '.$rs_listadiario->fields["comcont_concepto"].' N.Comprobante:'.$rs_listadiario->fields["comcont_numeroc"].'</td>
			<td bgcolor="#F0F0F0" >&nbsp;</td>
			<td bgcolor="#F0F0F0" >&nbsp;</td>
		  </tr>';
	 
	 $listadbehaber="select * from lpin_detallecomprobantecontable where comcont_id='".$rs_listadiario->fields["comcont_id"]."' and detcc_debe>0"; 
	 $rs_debehaber = $DB_gogess->Execute($listadbehaber);
	 
	 if($rs_debehaber)
     {
       while (!$rs_debehaber->EOF) {
	     ?>
		  <tr>
			<td nowrap="nowrap">&nbsp;</td>
			<td><?php echo $rs_debehaber->fields["detcc_cuentacontable"].' '.$rs_debehaber->fields["detcc_descricpion"];	 ?></td>
			<td><?php echo $rs_debehaber->fields["detcc_debe"]; ?></td>
			<td>&nbsp;</td>
		  </tr>
		 <?php
		 $rs_debehaber->MoveNext();
	   }
	 }
	 //=====================================================================
	 
	 $listadbehaber="select * from lpin_detallecomprobantecontable where comcont_id='".$rs_listadiario->fields["comcont_id"]."' and detcc_haber>0"; 
	 $rs_debehaber = $DB_gogess->Execute($listadbehaber);
	 
	 if($rs_debehaber)
     {
       while (!$rs_debehaber->EOF) {
	     ?>
		  <tr>
			<td>&nbsp;</td>
			<td><?php echo $rs_debehaber->fields["detcc_cuentacontable"].' '.$rs_debehaber->fields["detcc_descricpion"];	 ?></td>
			<td>&nbsp;</td>
			<td><?php echo $rs_debehaber->fields["detcc_haber"]; ?></td>
		  </tr>
		 <?php
		 $rs_debehaber->MoveNext();
	   }
	 } 
	 
	 //==========================================================
	 }  

	$rs_listadiario->MoveNext();	
		} 
 
 }  
?>
</table>
<p>&nbsp;</p>
</body>
</html>

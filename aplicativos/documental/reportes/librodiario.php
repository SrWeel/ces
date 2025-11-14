<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_GET["exls"]==1)
{

header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."ld_".$fechahoy.".xls");

}
if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");


$objformulario= new  ValidacionesFormulario(); 

$contador=0;

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
    <td><div align="center"><strong>No</strong></div></td>
	<td><div align="center"><strong>FECHA</strong></div></td>
	<td><div align="center"><strong>CODIGO ASIENTO</strong></div></td>
	<td><div align="center"><strong>CUENTA</strong></div></td>
    <td><div align="center"><strong>DETALLE</strong></div></td>
    <td><div align="center"><strong>DEBE</strong></div></td>
    <td><div align="center"><strong>HABER</strong></div></td>
  </tr>
<?php

$fecha_i=$_POST["fecha_i"];
$fecha_f=$_POST["fecha_f"];

$suma_debetotal=0;
$suma_habertotal=0;
 
$listadiario="select * from lpin_comprobantecontable where comcont_anulado=0 and comcont_fecha>='".$fecha_i."' and comcont_fecha<='".$fecha_f."' order by comcont_fecha,comcont_id asc";
$rs_listadiario = $DB_gogess->executec($listadiario,array());
$ib=0;
 if($rs_listadiario)
 {
     while (!$rs_listadiario->EOF) {	
	 
	 $listadbehaberc="select count(*) as total from lpin_detallecomprobantecontable where 	comcont_enlace='".$rs_listadiario->fields["comcont_enlace"]."'"; 
	 $rs_debehaberc = $DB_gogess->executec($listadbehaberc,array());
	 
	 if($rs_debehaberc->fields["total"]>0)
	 {
	 $suma_debe=0;
	 $suma_haber=0;
	 $contador++;
	 //==========================================================
	 echo '<tr>
			<td nowrap="nowrap" bgcolor="#F0F0F0" >'.$contador.'</td>
			<td nowrap="nowrap" bgcolor="#F0F0F0" >'.$rs_listadiario->fields["comcont_fecha"].'</td>
			<td nowrap="nowrap" bgcolor="#F0F0F0" >'.$rs_listadiario->fields["comcont_id"].'</td>
			<td nowrap="nowrap" bgcolor="#F0F0F0" ></td>
			<td bgcolor="#F0F0F0" >'.$rs_listadiario->fields["comcont_concepto"].' <br>'.' N.Comprobante:'.$rs_listadiario->fields["comcont_numeroc"].'</td>
			<td bgcolor="#F0F0F0" >&nbsp;</td>
			<td bgcolor="#F0F0F0" >&nbsp;</td>
		  </tr>';
	 
	 $listadbehaber="select * from lpin_detallecomprobantecontable where comcont_enlace='".$rs_listadiario->fields["comcont_enlace"]."' and detcc_debe>0"; 
	 $rs_debehaber = $DB_gogess->executec($listadbehaber,array());
	 
	 if($rs_debehaber)
     {
       while (!$rs_debehaber->EOF) {
	     ?>
		  <tr>
			<td nowrap="nowrap">&nbsp;</td>
			<td nowrap="nowrap">&nbsp;</td>
			<td nowrap="nowrap">&nbsp;</td>
			<td nowrap="nowrap"><?php echo $rs_debehaber->fields["detcc_cuentacontable"]; ?></td>
			<td><?php echo $rs_debehaber->fields["detcc_descricpion"];	 ?></td>
			<td><?php echo $rs_debehaber->fields["detcc_debe"]; ?></td>
			<td>&nbsp;</td>
		  </tr>
		 <?php
		 
		  $suma_debe=$suma_debe+$rs_debehaber->fields["detcc_debe"];
		  $suma_debetotal=$suma_debetotal+$rs_debehaber->fields["detcc_debe"];
		 
		 $rs_debehaber->MoveNext();
	   }
	 }
	 //=====================================================================
	 
	 $listadbehaber="select * from lpin_detallecomprobantecontable where comcont_enlace='".$rs_listadiario->fields["comcont_enlace"]."' and detcc_haber>0"; 
	 $rs_debehaber = $DB_gogess->executec($listadbehaber,array());
	 
	 if($rs_debehaber)
     {
       while (!$rs_debehaber->EOF) {
	     ?>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><?php echo $rs_debehaber->fields["detcc_cuentacontable"]; ?></td>
			<td><?php echo $rs_debehaber->fields["detcc_descricpion"];	 ?></td>
			<td>&nbsp;</td>
			<td><?php echo $rs_debehaber->fields["detcc_haber"]; ?></td>
		  </tr>
		 <?php
		 
		   $suma_haber=$suma_haber+$rs_debehaber->fields["detcc_haber"];
		   
		   $suma_habertotal=$suma_habertotal+$rs_debehaber->fields["detcc_haber"];
		   
		 $rs_debehaber->MoveNext();
	   }
	 } 
	 
	 $alertavalor='#F0F0F0';
	 if(trim($suma_debe)!==trim($suma_haber))
	 {
	   $alertavalor=' #F9D2E2 ';
	 }
	  echo '<tr>			
			<td bgcolor="'.$alertavalor.'" ></td>
			<td nowrap="nowrap" bgcolor="'.$alertavalor.'" >Total</td>
			<td bgcolor="'.$alertavalor.'" ></td>
			<td bgcolor="'.$alertavalor.'" ></td>
			<td bgcolor="'.$alertavalor.'" ></td>
			<td bgcolor="'.$alertavalor.'" >'.$suma_debe.'</td>
			<td bgcolor="'.$alertavalor.'" >'.$suma_haber.'</td>
		  </tr>';
		  
	 
	 //==========================================================
	 }  

	$rs_listadiario->MoveNext();	
		} 
 
 }  
?>
<?php
  echo '<tr>			
			<td bgcolor="#B7B7B7" ></td>
			<td nowrap="nowrap" bgcolor="#B7B7B7" ><b>Total</b></td>
			<td bgcolor="#B7B7B7" ></td>
			<td bgcolor="#B7B7B7" ></td>
			<td bgcolor="#B7B7B7" ></td>
			<td bgcolor="#B7B7B7" ><b>'.$suma_debetotal.'</b></td>
			<td bgcolor="#B7B7B7" ><b>'.$suma_habertotal.'</b></td>
		  </tr>';

?>
</table>
<p>&nbsp;</p>
</body>
</html>

<?php
}
?>

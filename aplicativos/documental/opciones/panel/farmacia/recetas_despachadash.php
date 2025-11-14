<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44040000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$fecha_hoydia=date('Y-m-d H:i:s');
 	//dns_recetaanamesisexamenfisico
	//dns_recetaconsultaexterna
	//dns_odontoplantra 
	 
?>
<style type="text/css">
<!--
.style1 {
	font-size: 10px;
	font-weight: bold;
}
.style2 {font-size: 10px}
-->
</style>
<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>MEDICAMENTO PRIMERA VEZ </strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
	<td bgcolor="#E2EFF3"><span class="style1"><strong>Consentraci&oacute;n</strong></span></td>
	<td bgcolor="#E2EFF3"><span class="style1"><strong>Indicaciones</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_anamesisexamenfisico';
$tablareceta='dns_recetaanamesisexamenfisico';  
$enlace="anam_enlace";

$lista_campos='';
$lista_campos='plantra_id,plantra_codigo,plantra_medicamento,plantra_concentracion,plantra_indicaciones,plantra_cantidad,plantra_fecharegistro,plantra_fechadespacho';

  
$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantra_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
   <td></td>
    <td><?php echo $rs_medi1->fields["plantra_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantra_medicamento"]; ?></td>
	<td><?php echo $rs_medi1->fields["plantra_concentracion"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_indicaciones"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_cantidad"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>

<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS PRIMERA VEZ </strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="221" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="252" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_anamesisexamenfisico';
$tablareceta='dns_dispositivomedicoexafisico';
$enlace="anam_enlace";

$lista_campos='';
$lista_campos='plantrai_id,plantrai_codigo,plantrai_nombredispositivo,plantrai_cantidad,plantrai_fecharegistro,plantrai_fechadespacho';


$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td></td>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>MEDICAMENTO SUBSECUENTE</strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
	<td width="109" bgcolor="#E2EFF3"><span class="style1"><strong>Consentraci&oacute;n</strong></span></td>
	<td width="126" bgcolor="#E2EFF3"><span class="style1"><strong>Presentaci&oacute;n</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="123" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_consultaexterna';
$tablareceta='dns_recetaconsultaexterna';
$enlace="conext_enlace";

$lista_campos='';
$lista_campos='plantra_id,plantra_codigo,plantra_medicamento,plantra_concentracion,plantra_indicaciones,plantra_cantidad,plantra_fecharegistro,plantra_fechadespacho';


$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantra_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
   <td></td>
    <td><?php echo $rs_medi1->fields["plantra_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantra_medicamento"]; ?></td>
	<td><?php echo $rs_medi1->fields["plantra_concentracion"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_presentacion"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_cantidad"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>


<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS SUBSECUENTE</strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="221" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="252" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_consultaexterna';
$tablareceta='dns_dispositivomedicoexterno';
$enlace="conext_enlace";

$lista_campos='';
$lista_campos='plantrai_id,plantrai_codigo,plantrai_nombredispositivo,plantrai_cantidad,plantrai_fecharegistro,plantrai_fechadespacho';


$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
   <td></td>
   <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
	<td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantrai_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>


<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>MEDICAMENTO ODONTOLOGIA</strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
	<td width="109" bgcolor="#E2EFF3"><span class="style1"><strong>Consentraci&oacute;n</strong></span></td>
	<td width="126" bgcolor="#E2EFF3"><span class="style1"><strong>Presentaci&oacute;n</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="123" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_odontologia';
$tablareceta='dns_odontoplantra';
$enlace="odonto_enlace";

$lista_campos='';
$lista_campos='plantra_id,plantra_codigo,plantra_medicamento,plantra_concentracion,plantra_indicaciones,plantra_cantidad,plantra_fecharegistro,plantra_fechadespacho';

  
$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantra_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
   <td></td>
    <td><?php echo $rs_medi1->fields["plantra_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantra_medicamento"]; ?></td>
	<td><?php echo $rs_medi1->fields["plantra_concentracion"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_presentacion"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_cantidad"];  ?></td>
	<td><?php echo $rs_medi1->fields["plantra_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>

<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS ODONTOLOGIA </strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="221" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="252" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_odontologia';
$tablareceta='dns_dispositivomedicoodontologia';
$enlace="odonto_enlace";

$lista_campos='';
$lista_campos='plantrai_id,plantrai_codigo,plantrai_nombredispositivo,plantrai_cantidad,plantrai_fecharegistro,plantrai_fechadespacho';


$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td></td>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>MEDICAMENTO SUBSECUENTE ODONTOLOGIA</strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
    <td width="109" bgcolor="#E2EFF3"><span class="style1"><strong>Consentraci&oacute;n</strong></span></td>
    <td width="126" bgcolor="#E2EFF3"><span class="style1"><strong>Presentaci&oacute;n</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="123" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_subsecuenteodontologia';
$tablareceta='dns_recetasodontologia';
$enlace="subsecodont_enlace";

$lista_campos='';
$lista_campos='plantra_id,plantra_codigo,plantra_medicamento,plantra_concentracion,plantra_indicaciones,plantra_cantidad,plantra_fecharegistro,plantra_fechadespacho';

  
$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantra_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td></td>
    <td><?php echo $rs_medi1->fields["plantra_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantra_medicamento"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantra_concentracion"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantra_presentacion"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantra_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantra_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS SUBSECUENTE ODONTOLOGIA </strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="95" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="223" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="249" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_subsecuenteodontologia';
$tablareceta='dns_dispositivosodontologia';
$enlace="subsecodont_enlace";

$lista_campos='';
$lista_campos='plantrai_id,plantrai_codigo,plantrai_nombredispositivo,plantrai_cantidad,plantrai_fecharegistro,plantrai_fechadespacho';


$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td></td>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS PSICOLOGIA </strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="221" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="252" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_psicologia';
$tablareceta='dns_dispositivospsicologia';
$enlace="psicolo_enlace";

$lista_campos='';
$lista_campos='plantrai_id,plantrai_codigo,plantrai_nombredispositivo,plantrai_cantidad,plantrai_fecharegistro,plantrai_fechadespacho';


$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td></td>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>


<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS SUBSECUENTE PSICOLOGIA </strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="221" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="252" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_subsecuentepsicologia';
$tablareceta='cesdb_arextension.dns_subsecuentedispositivospsicologia';
$enlace="subsecpsico_enlace";

$lista_campos='';
$lista_campos='plantrai_id,plantrai_codigo,plantrai_nombredispositivo,plantrai_cantidad,plantrai_fecharegistro,plantrai_fechadespacho';


$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td></td>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>


<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS LABORATORIO </strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="221" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="252" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_laboratorioinforme';
$tablareceta='dns_dispositivoslaboratorio';
$enlace="labinfor_enlace";

$lista_campos='';
$lista_campos='plantrai_id,plantrai_codigo,plantrai_nombredispositivo,plantrai_cantidad,plantrai_fecharegistro,plantrai_fechadespacho';


$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td></td>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS IMAGENOLOGIA </strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="221" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="252" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_imagenologiainfo';
$tablareceta='dns_dispositivosimagen';
$enlace="imginfo_enlace";

$lista_campos='';
$lista_campos='plantrai_id,plantrai_codigo,plantrai_nombredispositivo,plantrai_cantidad,plantrai_fecharegistro,plantrai_fechadespacho';


$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td></td>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS REHABILITACI&Oacute;N</strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="221" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="252" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_fisioterapia';
$tablareceta='dns_dispositivosfisioterapia';
$enlace="fisiot_enlace";

$lista_campos='';
$lista_campos='plantrai_id,plantrai_codigo,plantrai_nombredispositivo,plantrai_cantidad,plantrai_fecharegistro,plantrai_fechadespacho';


$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td></td>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS PROCEDIMIENTOS INVASIVOS</strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="221" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="252" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_procediminetosinvasivos';
$tablareceta='dns_dispositivosinvasivos';
$enlace="prinvas_enlace";

$lista_campos='';
$lista_campos='plantrai_id,plantrai_codigo,plantrai_nombredispositivo,plantrai_cantidad,plantrai_fecharegistro,plantrai_fechadespacho';


$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td></td>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS ENFERMERIA</strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="221" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="252" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_enfermeria';
$tablareceta='dns_dispositivosenfermeria';
$enlace="enferm_enlace";

$lista_campos='';
$lista_campos='plantrai_id,plantrai_codigo,plantrai_nombredispositivo,plantrai_cantidad,plantrai_fecharegistro,plantrai_fechadespacho';


$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td></td>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>MEDICAMENTO PRE HOSPITALARIO</strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="111" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
    <td width="109" bgcolor="#E2EFF3"><span class="style1"><strong>Consentraci&oacute;n</strong></span></td>
    <td width="126" bgcolor="#E2EFF3"><span class="style1"><strong>Presentaci&oacute;n</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="123" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_prehospitalario';
$tablareceta='dns_recetaprehospitalario';
$enlace="prehosp_enlace";

$lista_campos='';
$lista_campos='plantra_id,plantra_codigo,plantra_medicamento,plantra_concentracion,plantra_indicaciones,plantra_cantidad,plantra_fecharegistro,plantra_fechadespacho';

  
$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantra_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td></td>
    <td><?php echo $rs_medi1->fields["plantra_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantra_medicamento"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantra_concentracion"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantra_presentacion"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantra_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantra_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS PRE HOSPITALARIO</strong></div></td>
  </tr>
  <tr>
    <td width="30" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="94" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="221" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="252" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_prehospitalario';
$tablareceta='dns_dispositivomedicoprehospitalario';
$enlace="prehosp_enlace";

$lista_campos='';
$lista_campos='plantrai_id,plantrai_codigo,plantrai_nombredispositivo,plantrai_cantidad,plantrai_fecharegistro,plantrai_fechadespacho';


$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td></td>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<table width="650" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" bgcolor="#A0CBD8"><div align="left"><strong>DISPOSITIVOS ACTIVIDADES EXTRAMURALES</strong></div></td>
  </tr>
  <tr>
    <td width="31" bgcolor="#E2EFF3"><span class="style1"></span></td>
    <td width="96" bgcolor="#E2EFF3"><span class="style1"><strong>C&oacute;digo</strong></span></td>
    <td width="223" bgcolor="#E2EFF3"><span class="style1"><strong>Medicamento</strong></span></td>
    <td width="41" bgcolor="#E2EFF3"><span class="style1"><strong>Cantidad</strong></span></td>
    <td width="247" bgcolor="#E2EFF3"><span class="style1"><strong>Fecha Despacho</strong></span></td>
  </tr>
  <?php
$tablaprincipa='dns_visitadomiciliaria';
$tablareceta='dns_dispositivosvisitadom';
$enlace="vidomici_enlace";

$lista_campos='';
$lista_campos='plantrai_id,plantrai_codigo,plantrai_nombredispositivo,plantrai_cantidad,plantrai_fecharegistro,plantrai_fechadespacho';


$lista_medicametos="select ".$lista_campos." from dns_atencion inner join ".$tablaprincipa." on dns_atencion.atenc_id=".$tablaprincipa.".atenc_id inner join  ".$tablareceta." on  ".$tablaprincipa.".".$enlace."=".$tablareceta.".".$enlace." where dns_atencion.atenc_hc='".$_POST["nhc"]."' and plantrai_despachado='SI' ";  

$rs_medi1 = $DB_gogess->executec($lista_medicametos,array());

  if($rs_medi1)
 {
	  while (!$rs_medi1->EOF) {	
  ?>
  <tr>
    <td></td>
    <td><?php echo $rs_medi1->fields["plantrai_codigo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_nombredispositivo"]; ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_cantidad"];  ?></td>
    <td><?php echo $rs_medi1->fields["plantrai_fechadespacho"];  ?></td>
  </tr>
  <?php
  $rs_medi1->MoveNext();	   

	  }

  }
  ?>
</table>
<div id="grid_ejecuta_quitar"></div>
<script type="text/javascript">


function ejecuta_quitar(id,tabla)
{
  
  $("#grid_ejecuta_quitar").load("aplicativos/documental/opciones/panel/farmacia/quitar.php",{

  plantra_id:id,
  tabla:tabla

  },function(result){  
ejecutaz_data();

  });  

  $("#grid_ejecuta_quitar").html("Espere un momento...");  


}

function ejecuta_quitardispositivo(id,tabla)
{
  
  $("#grid_ejecuta_quitar").load("aplicativos/documental/opciones/panel/farmacia/quitard.php",{

  plantra_id:id,
  tabla:tabla

  },function(result){  
ejecutaz_data();

  });  

  $("#grid_ejecuta_quitar").html("Espere un momento...");  


}


</script>

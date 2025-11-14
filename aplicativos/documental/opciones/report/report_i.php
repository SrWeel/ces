<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {

  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

 } 
 
function calculaedad($date2){
$diff = abs(strtotime($date2) - strtotime('1999-11-04'));
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
return $years;
} 
 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

?><style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
<?php
$lista_servicios1="select * from  dns_atencion where atenc_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%' and atenc_id=".$_GET["id"];
$rs_data1 = $DB_gogess->executec($lista_servicios1,array());

$busca_cliente="select * from app_cliente where clie_id=".$rs_data1->fields["clie_id"];
$rs_cliente = $DB_gogess->executec($busca_cliente,array());

$busca_centro="select * from dns_centrosalud where centro_id=".$rs_data1->fields["centro_id"];
$rs_centro = $DB_gogess->executec($busca_centro,array());

$busca_detallesexterno="select * from dns_consultaexterna inner join dns_diagnosticoexterna on dns_consultaexterna.conext_enlace=dns_diagnosticoexterna.conext_enlace where atenc_id=".$rs_data1->fields["atenc_id"];
 $rs_externo = $DB_gogess->executec($busca_detallesexterno,array());
?>

<table width="600" border="0" align="center" cellpadding="3" cellspacing="2">
  <tr>
    <td colspan="2"><div align="center"><strong>MINISTERIO DE SALUD P&Uacute;BLICA DEL ECUADOR </strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="600" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td><strong>NOMBRE DEL PRESTADOR: </strong></td>
        <td nowrap="nowrap"><?php echo $rs_centro->fields["centro_nombre"] ?></td>
        <td><strong>CEDULA:</strong></td>
        <td nowrap="nowrap"><?php echo $rs_cliente->fields["clie_rucci"]; ?></td>
      </tr>
      <tr>
        <td><strong>NOMBRES Y APELLIDOS:</strong></td>
        <td nowrap="nowrap"><?php echo $rs_cliente->fields["clie_nombre"]." ".$rs_cliente->fields["clie_apellido"]; ?></td>
        <td><strong>HISTORIA CLINICA: </strong></td>
        <td nowrap="nowrap"><?php echo $rs_data1->fields["atenc_hc"] ?></td>
      </tr>
      <tr>
        <td><strong>FECHA DE INGRESO:</strong></td>
        <td nowrap="nowrap"> <?php echo $rs_data1->fields["atenc_fecha"]; ?> <strong>FECHA DE EGRESO:</strong> <?php echo $rs_data1->fields["atenc_fechasalida"]; ?> </td>
        <td><strong>EDAD</strong></td>
        <td nowrap="nowrap"><?php echo calculaedad($rs_cliente->fields["clie_fechanacimiento"]); ?></td>
      </tr>
      <tr>
        <td><strong>FORMA INGRESO </strong></td>
        <td nowrap="nowrap"><?php echo $rs_externo->fields["diagn_descripcion"]; ?></td>
        <td>&nbsp;</td>
        <td nowrap="nowrap">&nbsp;</td>
      </tr>
    </table></td>
    <td><div align="center"><img src="../../../../images/logo2.png" width="123" height="98" /></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
INFORME CONSOLIDADO DE LIQUIDACI&Oacute;N No. <?php echo $_GET["mes_valor"]."-".$_GET["anio_valor"]; ?>-HQ-HOSP-001
<table width="200" border="0" cellpadding="3" cellspacing="1">
  <tr>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>FECHA</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>PROCEDIMIENTO QUIR&Uacute;RGICO</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>C&Oacute;DIGO</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>NIVEL</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>DETALLE/DESCRIPCI&Oacute;N</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>PAQ / SES</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>CANTIDAD</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>VALOR UNITARIO</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>SUBTOTAL</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>10% </strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>IVA</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>VALOR TOTAL</strong></div></td>

  </tr>
  <?php
 $lista_servicios="select * from  dns_atencion where atenc_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%' and atenc_id=".$_GET["id"];

 $rs_data = $DB_gogess->executec($lista_servicios,array());

 if($rs_data)
 {

	  while (!$rs_data->EOF) {	


 $busca_cliente="select * from app_cliente where clie_id=".$rs_data->fields["clie_id"];
 $rs_cliente = $DB_gogess->executec($busca_cliente,array());
 
 $busca_centro="select * from dns_centrosalud where centro_id=".$rs_data->fields["centro_id"];
 $rs_centro = $DB_gogess->executec($busca_centro,array());

  $busca_detallesexterno="select * from dns_consultaexterna inner join dns_diagnosticoexterna on dns_consultaexterna.conext_enlace=dns_diagnosticoexterna.conext_enlace where atenc_id=".$rs_data->fields["atenc_id"];
 $rs_externo = $DB_gogess->executec($busca_detallesexterno,array());
 
 /*
$busca_centro="select * from dns_centrosalud where centro_id=".$rs_externo->fields["centro_id"];
 $rs_centro = $DB_gogess->executec($busca_centro,array());
 
 */
  $busca_costos="select sum(prod_precio) as total from dns_cuadrobasico where atenc_id=".$rs_data->fields["atenc_id"];
 $rs_costos = $DB_gogess->executec($busca_costos,array());
 
 $busca_costos2="select sum(inven_valorunit * inven_cantidad) as total2 from dns_detalleconsultaexterna where atenc_id=".$rs_data->fields["atenc_id"];
 $rs_costos2 = $DB_gogess->executec($busca_costos2,array());
 
 $total_general=0;
 $total_general=$rs_costos->fields["total"]+$rs_costos2->fields["total2"];
 
 $saca_datasep=array();
  $saca_datasep=explode("-",$rs_data->fields["atenc_fecharegistro"]);
  
$fecha1 = new DateTime($rs_data->fields["atenc_fechasalida"]);
$fecha2 = new DateTime($rs_data->fields["atenc_fecha"]);
$fecha = $fecha1->diff($fecha2);

 $lista_servicios="select cuabas_id,atenc_id,prod_codigo,prod_descripcion,prod_precio from dns_cuadrobasico where atenc_id=".$rs_data->fields["atenc_id"];
 
 $rs_servicios = $DB_gogess->executec($lista_servicios,array());

  ?>
  <tr>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["atenc_fecha"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_servicios->fields["prod_codigo"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_servicios->fields["prod_descripcion"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"></td>
    <td nowrap bgcolor="#E9F1F5">1</td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_servicios->fields["prod_precio"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_servicios->fields["prod_precio"]*1; ?></td>
    <td nowrap bgcolor="#E9F1F5"></td>
	<td nowrap bgcolor="#E9F1F5"></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_servicios->fields["prod_precio"]*1; ?></td>
	
  </tr>

 <?php

   $rs_data->MoveNext();	   

	  }

  }

  ?></table>
<?php
}

?>
<p><p>

<table cellspacing="0" cellpadding="0">
  <col width="139" />
  <col width="62" />
  <col width="84" />
  <col width="58" />
  <col width="77" />
  <col width="126" />
  <col width="82" span="2" />
  <col width="72" />
  <col width="30" />
  <col width="39" />
  <col width="97" />
  <col width="55" />
  <col width="82" />
  <col width="82" span="2" />
  <col width="82" />
  <col width="94" />
  <tr height="24">
    <td height="24" width="139">ELABORADO    POR</td>
    <td width="62">&nbsp;</td>
    <td width="84">&nbsp;</td>
    <td width="58">&nbsp;</td>
    <td width="77">&nbsp;</td>
    <td width="126">&nbsp;</td>
    <td colspan="3" width="236">CONTROL    TECNICO MEDICO</td>
    <td width="30">&nbsp;</td>
    <td width="39">&nbsp;</td>
    <td width="97"></td>
    <td width="55"></td>
    <td width="82"></td>
    <td width="82"></td>
    <td width="82"></td>
    <td width="82"></td>
    <td width="94"></td>
  </tr>
  <tr height="19">
    <td height="19"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr height="19">
    <td height="19"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr height="19">
    <td height="19"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr height="19">
    <td height="19"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr height="19">
    <td height="19">Lcda. Edith Torres</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">DRA. VERONICA CAISA</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr height="19">
    <td height="19">C.I. 1710759059</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2">C.I. 802243022</td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr height="19">
    <td height="19" colspan="3">Cargo:    Control Documental y Tarifas&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">AUDITOR MEDICO</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr height="20">
    <td height="20"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr height="80">
    <td colspan="18" height="80" width="1003">SE CERTIFICA EL CUMPLIMIENTO CABAL DE LOS PROCEDIMIENTOS DE    AUDITOR&Iacute;A DE CALIDAD DE LA FACTURACI&Oacute;N DE LOS SERVICIOS DE SALUD, LA NO    EXISTENCIA DE SEGUROS PRIVADOS, NO DUPLICACI&Oacute;N DEL PAGO Y QUE LOS RESPALDOS    DOCUMENTALES DE LA AUDITOR&Iacute;A DE FACTURACI&Oacute;N DE LOS SERVICIOS DE SALUD SE    ENCUENTRAN EN EL DEPARTAMENTO DEL MISMO NOMBRE DEL HOSPITAL QUITO No. 1 DE LA    POLIC&Iacute;A NACIONAL</td>
  </tr>
</table>

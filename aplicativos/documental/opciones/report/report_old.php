<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44454000;
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

$centro_id=$_GET["centro_id"];
$numero_mes=$_GET["mes_valor"];
$anio_valor=$_GET["anio_valor"];
$nombremes=$nombre_mes[$_GET["mes_valor"]];

$nombre_establ=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$centro_id,$DB_gogess);

?><style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo1 {
	font-size: 10px;
	font-weight: bold;
}
.Estilo2 {font-size: 10px}
-->
</style>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="2">
  <tr>
    <td colspan="2"><div align="center">
      <p><strong>DIRECCI&Oacute;N NACIONAL DE SALUD DE LA POLICIA NACIONAL</strong><BR />
      <strong>PLANILLA CONSOLIDADA UNIDADES DE PRIMER NIVEL POLICIA NACIONAL </strong></p>
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="300" border="1" cellpadding="0" cellspacing="0">
        <tr>
          <td width="160"><span class="Estilo1">NUMERO DE PLANILLA </span></td>
          <td width="134"><span class="Estilo2"><?php echo $numero_mes."-".$nombremes."-".str_replace("ESTABLECIMIENTO DE ","",$nombre_establ)."-".$anio_valor; ?></span></td>
        </tr>
        <tr>
          <td><span class="Estilo2"><strong>SERVICIO AMBULATORIO: </strong></span></td>
          <td><span class="Estilo2">MEDICINA 100% </span></td>
        </tr>
        <tr>
          <td><span class="Estilo2"><strong>VALOR SOLICITADO 100% : </strong></span></td>
          <td><span class="Estilo2"></span></td>
        </tr>
        <tr>
          <td><span class="Estilo2"><strong>NUMERO DE EXPEDIENTES 100% : </strong></span></td>
          <td><span class="Estilo2"></span></td>
        </tr>
        <tr>
          <td><span class="Estilo2"><strong>ESTABLECIMIENTO DE SALUD: </strong></span></td>
          <td><span class="Estilo2"><?php echo str_replace("ESTABLECIMIENTO DE ","",$nombre_establ); ?></span></td>
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
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>NOMBRE</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>MES</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>A&Ntilde;O</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>ZONA QUE REFIERE</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>ZONA QUE RECIBE REFERENCIA</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>UNIDAD MEDICA QUE RECIBE LA REFERENCIA </strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>APELLIDOS</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>NOMBRES</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>CEDULA CIUDADANIA</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>SEXO</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>EDAD</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>DIAGN&Oacute;STICO PRINCIPAL </strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>CODIGO CIE 10      (DG. PRINCIPAL)</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>No. HISTORIA CLINICA</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>FECHA DE INGRESO </strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>FECHA DE EGRESO </strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>DIAS HOSPITALIZACI&Oacute;N </strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>DIAGN&Oacute;STICO DEFINITIVO </strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>CODIGO CIE 10</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>MONTO SOLICITADO</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>ASEGURADORA</strong></div></td>
  </tr>
  <?php
 $lista_servicios="select * from  dns_atencion where atenc_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%'";

 $rs_data = $DB_gogess->executec($lista_servicios,array());

 if($rs_data)
 {

	  while (!$rs_data->EOF) {	

//Anamnesis y Examen Físico

 $busca_anamesisexamenfisico="select  sum(prod_precio) as total from dns_anamesisexamenfisico inner join dns_cuadrobasico on dns_anamesisexamenfisico.anam_enlace=dns_cuadrobasico.anam_enlace where atenc_id =".$rs_data->fields["atenc_id"];
 $rs_anamesisexamenfisico = $DB_gogess->executec($busca_anamesisexamenfisico,array());

//Anamnesis y Examen Físico

//Consulta externa

 $dns_consultaexterna="select  sum(prod_precio) as total from dns_consultaexterna inner join dns_cuadrobasicocexterno on dns_consultaexterna.conext_enlace=dns_cuadrobasicocexterno.conext_enlace  where atenc_id =".$rs_data->fields["atenc_id"];
 $rs_consultaexterna = $DB_gogess->executec($dns_consultaexterna,array());

//Consulta externa

//Laboratorio
 $dns_laboratorio="select  sum(prod_precio) as total from dns_laboratorio inner join dns_cuadrobasicolab on dns_laboratorio.lab_enlace=dns_cuadrobasicolab.lab_enlace  where atenc_id =".$rs_data->fields["atenc_id"];
 $rs_laboratorio = $DB_gogess->executec($dns_laboratorio,array());

//Laboratorio

//Imagen
$dns_imagenologia="select  sum(prod_precio) as total from dns_imagenologia inner join dns_cuadrobasicoimagen on dns_imagenologia.imgag_enlace=dns_cuadrobasicoimagen.imgag_enlace  where atenc_id =".$rs_data->fields["atenc_id"];
 $rs_imagenologia = $DB_gogess->executec($dns_imagenologia,array());
//echo $rs_imagenologia->fields["total"];
//Imagen




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
  ?>
  <tr>
    <td nowrap bgcolor="#E9F1F5"><a href="report_i.php?mes_valor=<?php echo $_GET["mes_valor"]; ?>&anio_valor=<?php echo $_GET["anio_valor"]; ?>&id=<?php echo $rs_data->fields["atenc_id"]; ?>" target="_blank"><?php echo $rs_cliente->fields["clie_nombre"]." ".$rs_cliente->fields["clie_apellido"]; ?></a></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $saca_datasep[1]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $saca_datasep[0]; ?></td>
    <td nowrap bgcolor="#E9F1F5">9</td>
    <td nowrap bgcolor="#E9F1F5">&nbsp;</td>
    <td nowrap bgcolor="#E9F1F5"><?php echo @$rs_centro->fields["centro_nombre"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_cliente->fields["clie_apellido"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_cliente->fields["clie_nombre"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_cliente->fields["clie_rucci"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_cliente->fields["clie_genero"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo calculaedad($rs_cliente->fields["clie_fechanacimiento"]); ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_externo->fields["diagn_descripcion"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_externo->fields["diagn_cie"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["atenc_hc"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["atenc_fecha"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["atenc_fechasalida"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $fecha->y; ?></td>
	<td bgcolor="#E9F1F5"><?php echo $rs_externo->fields["diagn_descripcion"]; ?></td>
	<td bgcolor="#E9F1F5"><?php echo $rs_externo->fields["diagn_cie"]; ?></td>
	<td bgcolor="#E9F1F5"><?php echo number_format($total_general, 2, '.', ''); ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_cliente->fields["clie_aseguradora"]; ?></td>
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

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
$mes_valor=$_GET["mes_valor"];
$anio_valor=$_GET["anio_valor"];
$nombremes=$nombre_mes[$_GET["mes_valor"]];
$prase_valor=$_GET["prase_valor"];
$opcion=@$_GET["opcion"];

if($opcion=='e')
{
header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."planilla_msp_".$fechahoy.".xls");
}


$nivel_establ=0;
$nivel_establ=$objformulario->replace_cmb("dns_centrosalud","centro_id,permif_id"," where centro_id=",$centro_id,$DB_gogess); 

$nombre_establ=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$centro_id,$DB_gogess);

$periodo='';
$periodo=$mes_valor."-".$anio_valor;
$fecha_hoy=date("Y-m-d");

//lee planilla
$lee_plantilla=$objformulario->replace_cmb("dns_planillasplantillas","plapln_id,plapln_plantilla"," where plapln_id=",3,$DB_gogess); 
$lee_logo1=$objformulario->replace_cmb("dns_planillasplantillas","plapln_id,plapln_grafico1"," where plapln_id=",1,$DB_gogess);
$lee_logo2=$objformulario->replace_cmb("dns_planillasplantillas","plapln_id,plapln_grafico2"," where plapln_id=",1,$DB_gogess);
$lee_logo3=$objformulario->replace_cmb("dns_planillasplantillas","plapln_id,plapln_grafico3"," where plapln_id=",1,$DB_gogess);
$lee_logo4=$objformulario->replace_cmb("dns_planillasplantillas","plapln_id,plapln_grafico4"," where plapln_id=",1,$DB_gogess);
$lee_logo5=$objformulario->replace_cmb("dns_planillasplantillas","plapln_id,plapln_grafico5"," where plapln_id=",1,$DB_gogess);
//lee planilla


$cabecera_botones='

<link type="text/css" href="../../../../templates/page/css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	
<script src="../../../../templates/page/menu/js/1.11.2.jquery.min.js"></script>

<table width="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><a href="reportmsp.php?prase_valor='.$prase_valor.'&centro_id='.$centro_id.'&mes_valor='.$mes_valor.'&anio_valor='.$anio_valor.'&opcion=e" target="_top"><img src="icono_excel.png" width="50" height="49" /></a></td>
    <td>&nbsp;</td>
    <td>
	
	<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion"><img src="icono_print.png" width="50" height="49" class="botonExcel" /><input type="hidden" id="datos_a_enviar" name="datos_a_enviar" /></form>
	
	</td>
  </tr>
</table>';

if($opcion)
{
$cabecera_botones='';
}


$cabecera_plailla='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Planilla MSP</title>
</head>
<body>
<table  border="0" cellpadding="0" cellspacing="0" id="Exportar_a_Excel" style="border-collapse:collapse;">
<tr><td>
<style type="text/css">
<!--
.css_txtval {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.css_txttitulo {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<style type="text/css">
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
</style>'.$cabecera_botones;


$pie_planilla='</td></tr></table></body>
</html>
';

$lee_plantilla=$cabecera_plailla.$lee_plantilla.$pie_planilla;

$codigo_seguro=10;

//TARIFARIO

$tarifa_sql="select tabla, ttbl_id, tiposerv_id, atenc_fechaingreso, atenc_fechasalida, centro_numeroestablecimiento, centro_ruc, centro_nombre, tiposerv_nombre, atenc_condiciondeingreso, atenc_hc, sub_enlace, atenc_condiciondeegreso, clie_rucci, clie_nombre, clie_apellido, clie_fechanacimiento, clie_genero, clie_nombretitulardelseguro, clie_numerodecedulatitular, clie_paretesco, usua_ciruc, usua_nombre, usua_apellido, usua_formaciondelprofesional, nac_id, prod_famprod, cuabas_fecharegistro, prod_codigo, prod_descripcion, prod_precio, dns_especialidad, prod_cantidad, prod_techo, prod_iva, gestion_adm, valor_iva, clie_parentescopaciente, prod_clasificacionporcargo from cesdb_arreportes.planilla_tarifariodata where centro_id='".$_GET["centro_id"]."' and cuabas_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%' and  prod_nivel=".$nivel_establ."  and tipopac_id='".$codigo_seguro."' UNION ";

$receta_sql="select  tabla, ttbl_id, tiposerv_id, atenc_fechaingreso, atenc_fechasalida, centro_numeroestablecimiento, centro_ruc, centro_nombre, tiposerv_nombre, atenc_condiciondeingreso, atenc_hc, sub_enlace, atenc_condiciondeegreso, clie_rucci, clie_nombre, clie_apellido, clie_fechanacimiento, clie_genero, clie_nombretitulardelseguro, clie_numerodecedulatitular, clie_paretesco, usua_ciruc, usua_nombre, usua_apellido, usua_formaciondelprofesional, nac_id, prod_famprod, cuabas_fecharegistro, prod_codigo, prod_descripcion, prod_precio, dns_especialidad, prod_cantidad, prod_techo, prod_iva, gestion_adm, valor_iva, clie_parentescopaciente, prod_clasificacionporcargo from cesdb_arreportes.planilla_recetadata where centro_id='".$_GET["centro_id"]."' and cuabas_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%'  and tipopac_id='".$codigo_seguro."' UNION ";

$insumos_sql="select tabla, ttbl_id, tiposerv_id, atenc_fechaingreso, atenc_fechasalida, centro_numeroestablecimiento, centro_ruc, centro_nombre, tiposerv_nombre, atenc_condiciondeingreso, atenc_hc, sub_enlace, atenc_condiciondeegreso, clie_rucci, clie_nombre, clie_apellido, clie_fechanacimiento, clie_genero, clie_nombretitulardelseguro, clie_numerodecedulatitular, clie_paretesco, usua_ciruc, usua_nombre, usua_apellido, usua_formaciondelprofesional, nac_id, prod_famprod, cuabas_fecharegistro, prod_codigo, prod_descripcion, prod_precio, dns_especialidad, prod_cantidad, prod_techo, prod_iva, gestion_adm, valor_iva, clie_parentescopaciente, prod_clasificacionporcargo from cesdb_arreportes.planilla_insumodata where centro_id='".$_GET["centro_id"]."' and cuabas_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%' and tipopac_id='".$codigo_seguro."' UNION ";


 $union_data=$tarifa_sql.$receta_sql.$insumos_sql;
//TARIFARIO 


$union_data=substr($union_data,0,-6).' order by clie_apellido asc';

//echo $union_data;

//-------------------------------------------------------------------------------------------------
//$union_data=$busca_paratarifar.' UNION '.$busca_recetas." order by clie_apellido asc";
$cuenta_totales="select count(clie_rucci) as total from  (select distinct clie_rucci from (".$union_data.") as t1) as total";
$rs_tbltotales = $DB_gogess->executec($cuenta_totales,array());


$genera_sumado="select clie_rucci,clie_apellido,clie_nombre,sum(prod_precio * prod_cantidad) as prod_precio from ((".$union_data.") as dns) group by clie_apellido asc";

//echo $genera_sumado;

$nombre_establ=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$centro_id,$DB_gogess);

$cuadro_lista='';
$cuadro_lista.='<table width="800" border="1" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>No</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>CODIGO DE VALIDACION/CARGA</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>IDENTIFICACION No</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>BENEFICIARIO</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>VALOR TOTAL SOLICITADO</strong></div></td>
  </tr>';
  

$cuenta_val=array();
$numera=0;
$numeracion_exp=0;
$rs_btarifario = $DB_gogess->executec($genera_sumado,array());

$totalexp=0;

if($rs_btarifario)
	{
		while (!$rs_btarifario->EOF) {
		      
			  $totalexp++;
			  $cuadro_lista.='<tr>';
		      $cuadro_lista.='<td><span class="css_txtval">'.$totalexp.'</span></td>';
			  $cuadro_lista.='<td><span class="css_txtval"></span></td>';
			  $cuadro_lista.='<td style=mso-number-format:"@" ><span class="css_txtval">'.$rs_btarifario->fields["clie_rucci"].'</span></td>';
			  $cuadro_lista.='<td style=mso-number-format:"@" ><span class="css_txtval">'.$rs_btarifario->fields["clie_apellido"].' '.$rs_btarifario->fields["clie_nombre"].'</span></td>';
		      $cuadro_lista.='<td><span class="css_txtval">'.number_format($rs_btarifario->fields["prod_precio"], 2, '.', '').'</span></td>';
		      $cuadro_lista.='</tr>';
			  
			  
			  $valor_sumado=0;
	          $valor_sumado=number_format($rs_btarifario->fields["prod_precio"], 2, '.', '');
	          $total_sumado=$total_sumado+number_format($valor_sumado, 2, '.', '');
	
			$rs_btarifario->MoveNext();			
		}
	}	

$cuadro_lista.='<tr>
    <td colspan="3"><span class="css_txtval"><b>TOTAL VALOR SOLICITADO</b></span></td>
    <td>&nbsp;</td>
    <td><span class="css_txtval"><b>'.$total_sumado.'</b></span></td>
  </tr>';

$cuadro_lista.='</table>';

$logo_data1='<img src="../../../../archivo/'.$lee_logo1.'" style="height:98px; width:123px" />';
$logo_data2='<img src="../../../../archivo/'.$lee_logo2.'" style="height:98px; width:123px" />';

$lee_plantilla=str_replace("-grafico1-",$logo_data,$lee_plantilla);
$lee_plantilla=str_replace("-grafico2-",$logo_data,$lee_plantilla);

$lee_plantilla=str_replace("-listados-",$cuadro_lista,$lee_plantilla);
$lee_plantilla=str_replace("-numero-",$codigo_val,$lee_plantilla);
$lee_plantilla=str_replace("-totalsumado-",$total_sumado,$lee_plantilla);
$lee_plantilla=str_replace("-expediente-",$rs_tbltotales->fields["total"],$lee_plantilla);
$lee_plantilla=str_replace("-establecimiento-",$nombre_establ,$lee_plantilla);
$lee_plantilla=str_replace("-mesanio-",$periodo,$lee_plantilla);
$lee_plantilla=str_replace("-fecha-",$fecha_hoy,$lee_plantilla);


if($opcion=='e')
{
echo $lee_plantilla;
}
else
{
echo utf8_encode($lee_plantilla);
}

}
?>
<script language="javascript">
$(document).ready(function() {
	$(".botonExcel").click(function(event) {
		$("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
		$("#FormularioExportacion").submit();
});
});
</script>

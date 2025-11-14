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

 // include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

 } 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$opcion='';
$centro_id=$_GET["centro_id"];
$mes_valor=$_GET["mes_valor"];
$anio_valor=$_GET["anio_valor"];
$prase_valor=$_GET["prase_valor"];
$opcion=@$_GET["opcion"];

$mesnombre["01"]='ene.';
$mesnombre["02"]='feb.';
$mesnombre["03"]='mar.';
$mesnombre["04"]='abr.';
$mesnombre["05"]='may.';
$mesnombre["06"]='jun.';
$mesnombre["07"]='jul.';
$mesnombre["08"]='ago.';
$mesnombre["09"]='sep.';
$mesnombre["10"]='oct.';
$mesnombre["11"]='nov.';
$mesnombre["12"]='dic.';

if($opcion=='e')
{
header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."planilla_iess_".$fechahoy.".xls");
}


$nombremes=$nombre_mes[$_GET["mes_valor"]];

$nombre_establ=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$centro_id,$DB_gogess); 

$n_establgeneral=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_numeroestablecimiento"," where centro_id=",$centro_id,$DB_gogess); 
$nombre_unidad_general=$nombre_establ;



$nivel_establ=0;
$nivel_establ=$objformulario->replace_cmb("dns_centrosalud","centro_id,permif_id"," where centro_id=",$centro_id,$DB_gogess); 
$nivel_rom='';
$nivel_rom=$objformulario->replace_cmb("dns_permisofuncionmiento","permif_id,permif_rom"," where permif_id=",$nivel_establ,$DB_gogess); 



//$url="plantillas/planilla_isspol.php";
//$lee_plantilla=$objvarios->leer_contenido_completo($url);	

//lee planilla
$lee_plantilla=$objformulario->replace_cmb("dns_planillasplantillas","plapln_id,plapln_plantilla"," where plapln_id=",6,$DB_gogess); 
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
    <td><a href="report_ispol.php?prase_valor='.$prase_valor.'&centro_id='.$centro_id.'&mes_valor='.$mes_valor.'&anio_valor='.$anio_valor.'&opcion=e" target="_top"><img src="icono_excel.png" width="50" height="49" /></a></td>
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
<title>Planilla IESS</title>
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

$total_sumado=0;
//-------------------------------------------------------------------------------------------------
//codigo generico (TARIFARIO)
$codigo_seguro=2;


//codigo generico(DISPOSITIVOS)

$tarifa_sql="select tabla, ttbl_id, tiposerv_id, atenc_fechaingreso, atenc_fechasalida, centro_numeroestablecimiento, centro_ruc, centro_nombre, tiposerv_nombre, atenc_condiciondeingreso, atenc_hc, sub_enlace, atenc_condiciondeegreso, clie_rucci, clie_nombre, clie_apellido, clie_fechanacimiento, clie_genero, clie_nombretitulardelseguro, clie_numerodecedulatitular, clie_paretesco, usua_ciruc, usua_nombre, usua_apellido, usua_formaciondelprofesional, nac_id, prod_famprod, cuabas_fecharegistro, prod_codigo, prod_descripcion, prod_precio, dns_especialidad, prod_cantidad, prod_techo, prod_iva, gestion_adm, valor_iva, clie_parentescopaciente, prod_clasificacionporcargo from cesdb_arreportes.planilla_tarifariodata where centro_id='".$_GET["centro_id"]."' and cuabas_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%' and  prod_nivel=".$nivel_establ."  and tipopac_id='".$codigo_seguro."' UNION ";

$receta_sql="select  tabla, ttbl_id, tiposerv_id, atenc_fechaingreso, atenc_fechasalida, centro_numeroestablecimiento, centro_ruc, centro_nombre, tiposerv_nombre, atenc_condiciondeingreso, atenc_hc, sub_enlace, atenc_condiciondeegreso, clie_rucci, clie_nombre, clie_apellido, clie_fechanacimiento, clie_genero, clie_nombretitulardelseguro, clie_numerodecedulatitular, clie_paretesco, usua_ciruc, usua_nombre, usua_apellido, usua_formaciondelprofesional, nac_id, prod_famprod, cuabas_fecharegistro, prod_codigo, prod_descripcion, prod_precio, dns_especialidad, prod_cantidad, prod_techo, prod_iva, gestion_adm, valor_iva, clie_parentescopaciente, prod_clasificacionporcargo from cesdb_arreportes.planilla_recetadata where centro_id='".$_GET["centro_id"]."' and cuabas_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%'  and tipopac_id='".$codigo_seguro."' UNION ";

$insumos_sql="select tabla, ttbl_id, tiposerv_id, atenc_fechaingreso, atenc_fechasalida, centro_numeroestablecimiento, centro_ruc, centro_nombre, tiposerv_nombre, atenc_condiciondeingreso, atenc_hc, sub_enlace, atenc_condiciondeegreso, clie_rucci, clie_nombre, clie_apellido, clie_fechanacimiento, clie_genero, clie_nombretitulardelseguro, clie_numerodecedulatitular, clie_paretesco, usua_ciruc, usua_nombre, usua_apellido, usua_formaciondelprofesional, nac_id, prod_famprod, cuabas_fecharegistro, prod_codigo, prod_descripcion, prod_precio, dns_especialidad, prod_cantidad, prod_techo, prod_iva, gestion_adm, valor_iva, clie_parentescopaciente, prod_clasificacionporcargo from cesdb_arreportes.planilla_insumodata where centro_id='".$_GET["centro_id"]."' and cuabas_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%' and tipopac_id='".$codigo_seguro."' UNION ";


 $union_data=$tarifa_sql.$receta_sql.$insumos_sql;

//$union_data=$busca_paratarifar.' UNION '.$busca_recetas.' UNION '.$busca_dispositivo.' order by clie_apellido asc';

$union_data=substr($union_data,0,-6).' order by clie_rucci asc';

$cuenta_totales="select count(clie_rucci) as total from  (select distinct clie_rucci from (".$union_data.") as t1) as total";
$rs_tbltotales = $DB_gogess->executec($cuenta_totales,array());
//-------------------------------------------------------------------------------------------------

//echo $union_data;

$nombre_establ=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$centro_id,$DB_gogess);
$cuadro_lista='';
$cuadro_lista='<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td nowrap><div align="center"><span class="css_txttitulo">TIPO DE SERVICIO</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">MES Y A&Ntilde;O DE PRESTACION</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">NRO. DE EXPEDIENTES</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">FECHA</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">Nro. C&Eacute;DULA</span></div></td>
    <td nowrap><div align="center"><span class="css_txttitulo">BENEFICIARIO</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">COBERTURA</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">CIE 10</span></div></td>
    
	<td nowrap><div align="center"><span class="css_txttitulo">CLASIFICACION POR CARGO</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">C&Oacute;DIGO TNS</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">DESCRIPCI&Oacute;N</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">CANTIDAD</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">VALOR UNITARIO SOLICITADO</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">VALOR TOTAL SOLICITADO</span></div></td>
	
	<td nowrap><div align="center"><span class="css_txttitulo">OBSERVACIONES</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">CONDICION DE EGRESO</span></div></td>
	
	
  </tr>';

  //---------------------------------------------------------------------
// TARIFARIO
$cuenta_val=array();
$numera=0;
$numeracion_exp=0;

//echo $union_data;
//$union_data='';

$rs_btarifario = $DB_gogess->executec($union_data,array());

if($rs_btarifario)
	{
		while (!$rs_btarifario->EOF) {
	
		
$saca_datasep=array();
$saca_datasep=explode("-",$rs_btarifario->fields["cuabas_fecharegistro"]);
$mesanio=$mesnombre[$saca_datasep[1]]."-".$saca_datasep[0];

$numera++;
$cuenta_val[$numera]=$rs_btarifario->fields["clie_rucci"];
if($cuenta_val[$numera]!=$cuenta_val[$numera-1])
{
$numeracion_exp++;
}

$separa_datafecha=array();
$separa_datafecha=explode(" ",$rs_btarifario->fields["cuabas_fecharegistro"]);

$separa_datafechaF=array();
$separa_datafechaF=explode(" ",$rs_btarifario->fields["cuabas_fecharegistro"]);

$fecha_cambiadata=array();
$fecha_cambiadata=explode("-",$separa_datafecha[0]);
$formato_fecha='';
$formato_fecha=$fecha_cambiadata[2]."-".$fecha_cambiadata[1]."-".$fecha_cambiadata[0];

$ver_pt='';
if($rs_btarifario->fields["prod_famprod"]=='MEDICACION' )
{
   
   if($rs_btarifario->fields["prod_precio"]>$rs_btarifario->fields["prod_techo"])
   {
   
      $ver_pt='bgcolor="#FF0000"';
   }
   else
   {
   
      $ver_pt='';
   }
   
}

$solo_hora=array();
$solo_hora=explode(":",$separa_datafecha[1]);

//$rs_btarifario->fields["tabla"]
//$n_establgeneral=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_numeroestablecimiento"," where centro_id=",$centro_id,$DB_gogess); 
//$nombre_unidad_general=$nombre_establ;

	
	$cuadro_lista.='<tr '.$ver_pt.'>
	<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">AMBULATORIO</span></td>
	<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$mesanio.'</span></td>
	<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_tbltotales->fields["total"].'</span></td>	
	<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$formato_fecha.'</span></td>';
	$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["clie_rucci"].'</span></td>';
	$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["clie_apellido"].' '.$rs_btarifario->fields["clie_nombre"].'</span></td>';
	
	$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">IESS-ISSPOL</span></td>';
	
	//obtiene_diagostico
	
	$busca_tbldiagnositco="select * from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where ttbl_id in(1) and gogess_sistable.tab_name='".$rs_btarifario->fields["tabla"]."' and fie_type='campogrid'";
	
	$rs_tbldiag = $DB_gogess->executec($busca_tbldiagnositco,array());
	

	
	//------diagnostico
	$cuenta_cie=0;
	$lista_diag="select * from ".$rs_tbldiag->fields["fie_tablasubgrid"]." where ".$rs_tbldiag->fields["fie_campoenlacesub"]."='".$rs_btarifario->fields["sub_enlace"]."' limit 1";
	$rs_diag = $DB_gogess->executec($lista_diag,array());
	if($rs_diag)
	{
		while (!$rs_diag->EOF) {
		
		$separa_data=array();
		$separa_data=str_split(trim($rs_diag->fields["diagn_cie"]));
		//echo count($separa_data);
		
		if(count($separa_data)>3)
		{
			$num_punto='';
			for($ival=0;$ival<count($separa_data);$ival++)
			{
			   if($ival==2)
			   {
			   $num_punto.=$separa_data[$ival].".";
			   }
			   else
			   {
			   $num_punto.=$separa_data[$ival];
			   }
			   
			}
		}
		else
		{
		    $num_punto=trim($rs_diag->fields["diagn_cie"]);
		}
			
		$cuadro_lista.='<td><span class="css_txtval">'.$num_punto.'</span></td>';
		$cuenta_cie++;
		
		$rs_diag->MoveNext();	
		}
	}	
	//------diagnostico
	
	
	if($cuenta_cie==0)
	{
	  $cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval"></span></td>';
	  //$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval"></span></td>';
	}
	if($cuenta_cie==1)
	{
	  //$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval"></span></td>';
	}
	$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["prod_clasificacionporcargo"].'</span></td>';
	$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["prod_codigo"].'</span></td>';
	$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.utf8_decode($rs_btarifario->fields["prod_descripcion"]).'</span></td>';
	$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["prod_cantidad"].'</span></td>';
	$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.number_format($rs_btarifario->fields["prod_precio"], 3, '.', '').'</span></td>';
	
	
	$valor_sumado=0;
	$valor_sumado=number_format($rs_btarifario->fields["prod_precio"], 3, '.', '')*$rs_btarifario->fields["prod_cantidad"];
	
	$total_sumado=$total_sumado+number_format($valor_sumado, 2, '.', '');
	
	
	$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.number_format($valor_sumado, 2, '.', '').'</span></td>';	
	
	$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval"> </span></td>';	
	
	$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["atenc_condiciondeegreso"].'</span></td>';
	
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["centro_ruc"].'</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$n_establgeneral.'</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$nombre_unidad_general.'</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">NA</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">5</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["tiposerv_id"].'</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["clie_rucci"].'</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["dns_especialidad"].'</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval"></span></td>';

	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$solo_hora[0].":".$solo_hora[1].'</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$formato_fecha.'</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval"></span></td>';
	
	
	
	
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval"></span></td>';

   
   // $cuadro_lista.='<td style=mso-number-format:"@" ><span class="css_txtval">'.$rs_btarifario->fields["clie_fechanacimiento"].'</span></td>';
    
	$edad_val=array();
	//$edad_val=calculaedad();
	
	$edad_val=$objvarios->calcular_edad($rs_btarifario->fields["clie_fechanacimiento"],$rs_btarifario->fields["cuabas_fecharegistro"]);
   // $cuadro_lista.='<td style=mso-number-format:"@" ><span class="css_txtval">'.$edad_val["anio"].'</span></td>';
    //$cuadro_lista.='<td style=mso-number-format:"@" ><span class="css_txtval">'.$rs_btarifario->fields["clie_genero"].'</span></td>';
	$nombre_titulars='';
	$cedula_titulars='';
	
	if($rs_btarifario->fields["clie_numerodecedulatitular"]==$rs_btarifario->fields["clie_rucci"])
	{
	   $nombre_titulars=$rs_btarifario->fields["clie_apellido"].' '.$rs_btarifario->fields["clie_nombre"];
	   $cedula_titulars=$rs_btarifario->fields["clie_rucci"];
	   
	   // $nombre_titulars='';
	  // $cedula_titulars='';
	
	}
	else
	{
	   if($rs_btarifario->fields["clie_numerodecedulatitular"]=='')
	   {
	     $nombre_titulars='';
	     $cedula_titulars='';
		 if($rs_btarifario->fields["clie_parentescopaciente"]=='TITULAR')
			 {
				 
				 $nombre_titulars=$rs_btarifario->fields["clie_apellido"].' '.$rs_btarifario->fields["clie_nombre"];
	             $cedula_titulars=$rs_btarifario->fields["clie_rucci"];
			  } 
	   } 
	   else
	   {
	      $nombre_titulars=$rs_btarifario->fields["clie_nombretitulardelseguro"];
	      $cedula_titulars=$rs_btarifario->fields["clie_numerodecedulatitular"];
	   
	   }
	
	}
	
	$parentescos_data='';
	switch($rs_btarifario->fields["clie_paretesco"])
    {
		case 'ESPOSO';
		{
		  $parentescos_data='CONYUGE';
		}
		break;
		case 'ESPOSA';
		{
		  $parentescos_data='CONYUGE';
		}
		break;
		case 'PADRE';
		{
			$parentescos_data='PADRE';
		}
		break;
		case 'MADRE';
		{
		   $parentescos_data='MADRE';
		}
		break;
		case 'HIJO';
		{
		  $parentescos_data='HIJO';
		}
		break;
		case 'HIJA';
		{
		  $parentescos_data='HIJA';
		}
		break;
		case 'UNION LIBRE (F)';
		{
		
		   $parentescos_data='CONYUGE';
		}
		break;
		
		case 'UNION LIBRE (M)';
		{
		   $parentescos_data='CONYUGE';
		
		}
		break;
		
    }
	
	
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$nombre_titulars.'</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$cedula_titulars.'</span></td>';
	
	if($rs_btarifario->fields["clie_numerodecedulatitular"]==$rs_btarifario->fields["clie_rucci"])
	{
	
	  $parentescos_data='TITULAR';
	}
	else
	{
	   if($rs_btarifario->fields["clie_numerodecedulatitular"]=='')
	   {
	     $parentescos_data='TITULAR';
	   
	   }
	
	
	}
	
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$parentescos_data.'</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["usua_ciruc"].'</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.@$rs_btarifario->fields["usua_apellido"].' '.$rs_btarifario->fields["usua_nombre"].'</span></td>';
	
	//usua_formaciondelprofesional
	 
	
	
	
	$lista_nac="select * from dns_nacionalidad where nac_id='".$rs_btarifario->fields["nac_id"]."'";
	$rs_NAC = $DB_gogess->executec($lista_nac,array());
	
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["usua_formaciondelprofesional"].'</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_NAC->fields["nac_inicial"].'</span></td>';
	
	
	$separa_datafechax=explode(" ",$rs_btarifario->fields["cuabas_fecharegistro"]);
	$fecha_cambiadatax=array();
    $fecha_cambiadatax=explode("-",$separa_datafechax[0]);
    $formato_fechax='';
    $formato_fechax=$fecha_cambiadatax[2]."-".$fecha_cambiadatax[1]."-".$fecha_cambiadatax[0];
	
	
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$formato_fechax.'</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$nivel_rom.'</span></td>';
	
	
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["gestion_adm"].'</span></td>';
	
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["valor_iva"].'</span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval"></span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval"></span></td>';
	//$cuadro_lista.='<td style=mso-number-format:"@" nowrap="nowrap" ><span class="css_txtval">NO</span></td>';
    $cuadro_lista.='</tr>';				
						
						
			$rs_btarifario->MoveNext();			
		}
	}	



//---------------------------------------------------------------------

 $cuadro_lista.='
</table>';
  
  
}

//datos cabecera
$codigo_val='';
$codigo_val=$mes_valor."-".$nombremes."-".str_replace("ESTABLECIMIENTO DE ","",$nombre_establ)."-".$anio_valor; 
$nombesta=str_replace("ESTABLECIMIENTO DE ","",$nombre_establ);
$logo_data='<img src="../../../../archivo/'.$lee_logo1.'" style="height:98px; width:123px" />';
if($opcion=='e')
{
  $logo_data='';
}

$lee_plantilla=str_replace("-listados-",$cuadro_lista,$lee_plantilla);
$lee_plantilla=str_replace("-numero-",$codigo_val,$lee_plantilla);
$lee_plantilla=str_replace("-totalsumado-",$total_sumado,$lee_plantilla);
$lee_plantilla=str_replace("-expediente-",$rs_tbltotales->fields["total"],$lee_plantilla);
$lee_plantilla=str_replace("-establecimiento-",$nombesta,$lee_plantilla);
$lee_plantilla=str_replace("-establecimiento-",$nombesta,$lee_plantilla);
$lee_plantilla=str_replace("-grafico1-",$logo_data,$lee_plantilla);


$mesvalordata=$mesnombre[$mes_valor]."-".$anio_valor;


$lee_plantilla=str_replace("-mesanio-",$mesvalordata,$lee_plantilla);



if($opcion=='e')
{
echo $lee_plantilla;
}
else
{
echo utf8_encode($lee_plantilla);
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
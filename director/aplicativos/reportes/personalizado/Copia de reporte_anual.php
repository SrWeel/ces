<?php
include("../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(isset($_SESSION['sessidadm1777_pichincha']))
{
$director="../../../";
include("../../../cfgclases/clases.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>REPORTE ANUAL</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.Estilo3 {font-size: 11px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; }
.Estilo4 {font-size: 11px}
.Estilo5 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo6 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.Estilo8 {font-size: 11px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; }
.css_titulo{
	font-size: 11px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border: 1px solid #000000;
}
.css_txt
{
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border: 1px solid #000000;
}
-->
</style>


  
	
</head>

<body>
<table cellpadding="0" cellspacing="0">
  <tr>
    <td width="212"><span class="Estilo3">Tipo de Informe: </span></td>
    <td width="84" class="xl65 Estilo4 Estilo5">Anual </td>
    <td colspan="2"><span class="Estilo6">Art. 34 Resoluci&oacute;n No. 208 -2014 Consejo de la Judicatura </span></td>
  </tr>
  <tr>
    <td><span class="Estilo3">Nombre Centro de Mediaci&oacute;n: </span></td>
    <td class="xl65 Estilo4 Estilo5">NN </td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td><span class="Estilo3">No. Registro </span></td>
    <td class="xl65 Estilo4 Estilo5">1 </td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td><span class="Estilo3">Tipo (P&uacute;blico/Privado) </span></td>
    <td class="xl65 Estilo4 Estilo5"></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td><span class="Estilo3">Inicio de Gesti&oacute;n </span></td>
    <td class="xl66 Estilo4 Estilo5">jun-14 </td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td><span class="Estilo3">Per&iacute;odo: </span></td>
    <td class="xl65 Estilo4 Estilo5">2015 </td>
    <td><span class="Estilo6">(enero - Diciembre 2015) </span></td>
  </tr>
  <tr>
    <td><span class="Estilo3">Sede: </span></td>
    <td class="xl65 Estilo4 Estilo5">Quito </td>
	<td class="xl65 Estilo4 Estilo5"></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#366092"><span class="Estilo8">1 Reporte anual estad&iacute;stico de los casos atendidos y sus resultados</span></td>
  </tr>
</table>
<?php
//Número de casos ingresados
$ingresado["total"]=0;
		$listac_id="select count(*) as total,tipoing_id from media_causasdet inner join media_causascab on media_causasdet.caucab_id=media_causascab.caucab_id where 	year(caudet_fechaingreso)='".$_POST["anio_valor"]."' group by tipoing_id";
		$rs_rpcal = $DB_gogess->Execute($listac_id);
		 if($rs_rpcal)
		 {
			while (!$rs_rpcal->EOF) {	
			
			$ingresado[$rs_rpcal->fields["tipoing_id"]]=$rs_rpcal->fields["total"];
			$ingresado["total"]=$ingresado["total"]+$rs_rpcal->fields["total"];
			
			$rs_rpcal->MoveNext();	
			}

		}

//Número de audiencias intaladas
$audiencias["total"]=0;
		$listac_ida="select count(*) as total,tipoing_id from media_causasdet inner join media_causascab on media_causasdet.caucab_id=media_causascab.caucab_id where 	year(caudet_fechaaudiencia)='".$_POST["anio_valor"]."' group by tipoing_id";
		$rs_rpcala = $DB_gogess->Execute($listac_ida);
		 if($rs_rpcala)
		 {
			while (!$rs_rpcala->EOF) {	
			
			$audiencias[$rs_rpcala->fields["tipoing_id"]]=$rs_rpcala->fields["total"];
			$audiencias["total"]=$audiencias["total"]+$rs_rpcala->fields["total"];
			
			$rs_rpcala->MoveNext();	
			}

		}
//Número de acuerdos logrados 
$acuerdol["total"]=0;
		$listac_idal="select count(*) as total,tipoing_id from media_causasdet inner join media_causascab on media_causasdet.caucab_id=media_causascab.caucab_id where 	recau_id=1 and year(caudet_fechaingreso)='".$_POST["anio_valor"]."' group by tipoing_id";
		$rs_rpcalal = $DB_gogess->Execute($listac_idal);
		 if($rs_rpcalal)
		 {
			while (!$rs_rpcalal->EOF) {	
			
			$acuerdol[$rs_rpcalal->fields["tipoing_id"]]=$rs_rpcalal->fields["total"];
			$acuerdol["total"]=$acuerdol["total"]+$rs_rpcalal->fields["total"];
			
			$rs_rpcalal->MoveNext();	
			}

		}

		
		?>
<br><table width="100%" border="0" cellpadding="0" cellspacing="3">
  <tr>
    <td width="55%"><table width="600" border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse;" >
      <tr >
        <td class="css_titulo">Detalle</td>
        <td class="css_titulo">No. Casos ingresados por solicitud directa</td>
        <td class="css_titulo">No. de casos ingresados por derivaci&oacute;n judicial</td>
        <td class="css_titulo">No. Casos ingresados por remisi&oacute;n de tr&aacute;nsito</td>
        <td class="css_titulo">TOTAL</td>
      </tr>
      <tr>
        <td class="css_titulo">N&uacute;mero de casos ingresados</td>
        <td nowrap class="css_txt" ><?php
		echo @$ingresado[1];
		?></td>
        <td nowrap class="css_txt" ><?php
		echo @$ingresado[2];
		?></td>
        <td nowrap class="css_txt" ><?php
		echo @$ingresado[3];
		?></td>
        <td nowrap class="css_txt"><?php
		echo @$ingresado["total"];
		
		//arma grafico
		
		//arma grafico
		
		?></td>
      </tr>
      <tr>
        <td class="css_titulo">N&uacute;mero de audiencias intaladas</td>
        <td nowrap class="css_txt"><?php
		echo @$audiencias[1];
		?></td>
        <td nowrap class="css_txt"><?php
		echo @$audiencias[2];
		?></td>
        <td nowrap class="css_txt"><?php
		echo @$audiencias[3];
		?></td>
        <td nowrap class="css_txt"><?php
		echo @$audiencias["total"];
		
		?></td>
      </tr>
      <tr>
        <td class="css_titulo">% audiencias instaladas sobre el total de casos recibidos</td>
        <td nowrap class="css_txt"><?php  
		$porcentaje1=0;
		$porcentaje1=(@$audiencias[1]*100)/@$ingresado[1];
		echo number_format($porcentaje1, 2, '.', '')." %";		
		
		  ?></td>
        <td nowrap class="css_txt"><?php  
		$porcentaje2=0;
		$porcentaje2=(@$audiencias[2]*100)/@$ingresado[2];
		echo number_format($porcentaje2, 2, '.', '')." %";
		
		?></td>
        <td nowrap class="css_txt"><?php 
		$porcentaje3=0;
		$porcentaje3=(@$audiencias[3]*100)/@$ingresado[3];
		echo number_format($porcentaje3, 2, '.', '')." %";
		 ?></td>
        <td nowrap class="css_txt"><?php
		$porcentaje_total=0;
		$porcentaje_total=(@$audiencias["total"]*100)/@$ingresado["total"];
		echo number_format($porcentaje_total, 2, '.', '')." %";
		
		  ?></td>
      </tr>
      <tr>
        <td class="css_titulo">N&uacute;mero de acuerdos logrados </td>
        <td class="css_txt"><?php echo @$acuerdol[1]; ?></td>
        <td class="css_txt"><?php echo @$acuerdol[2]; ?></td>
        <td class="css_txt"><?php echo @$acuerdol[3]; ?></td>
        <td class="css_txt"><?php echo @$acuerdol["total"]; ?></td>
      </tr>
      <tr>
        <td class="css_titulo">% sobre el total de casos recibidos</td>
        <td class="css_txt"><?php
		$porcentaje1a=0;
		$porcentaje1a=(@$acuerdol[1]*100)/@$ingresado[1];
		echo number_format($porcentaje1a, 2, '.', '')." %";		
		
		?></td>
        <td class="css_txt"><?php
		$porcentaje1a=0;
		$porcentaje1a=(@$acuerdol[2]*100)/@$ingresado[2];
		echo number_format($porcentaje1a, 2, '.', '')." %";		
		
		?></td>
        <td class="css_txt"><?php
		$porcentaje1a=0;
		$porcentaje1a=(@$acuerdol[3]*100)/@$ingresado[3];
		echo number_format($porcentaje1a, 2, '.', '')." %";		
		
		?></td>
        <td class="css_txt"><?php
		$porcentaje1a=0;
		$porcentaje1a=(@$acuerdol["total"]*100)/@$ingresado["total"];
		echo number_format($porcentaje1a, 2, '.', '')." %";		
		
		?></td>
      </tr>
    </table></td>
    <td width="45%" valign="top"><table width="500" border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse;" >
      <tr>
        <td width="86" rowspan="2" class="css_titulo" >Resultados</td>
        <td width="307" class="css_titulo" >No. audiencias instaladas/No. casos ingresados</td>
        <td width="95" nowrap class="css_txt"><?php  
		$divisor1=0;
		if(@$ingresado["total"])
		{
		$divisor1=@$acuerdol["total"]/@$ingresado["total"];
		}
		else
		{
		$divisor1=0;
		}
		echo number_format($divisor1, 2, '.', '');
		?></td>
      </tr>
      <tr>
        <td class="css_titulo"> No. acuerdos logrados/No. audiencias instaladas</td>
        <td class="css_txt"><?php
		
		$divisor2=0;
		if(@$audiencias["total"])
		{
		$divisor2=@$acuerdol["total"]/@$audiencias["total"];
		}
		else
		{
		$divisor2=0;
		}
		echo number_format($divisor2, 2, '.', '');
		
		?></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div id="chart1" style="margin-top:20px; margin-left:20px; width:480px; height:470px;"></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<script class="code" type="text/javascript">

$(document).ready(function(){   
    var line1 = [['No. Casos ingresados por solicitud directa','<?php echo @$ingresado[1]; ?>'], ['No. de casos ingresados por derivaci\u00f3n judicial','<?php echo @$ingresado[2]; ?>'], 
    ['No. Casos ingresados por remisi\u00f3n de tr\u00e1nsito','<?php echo @$ingresado[3]; ?>'], ['Total','<?php echo @$ingresado["total"]; ?>']];
 
    var plot3 = $.jqplot('chart1', [line1], {
      series:[{renderer:$.jqplot.BarRenderer}],
      axes: {
        xaxis: {
          renderer: $.jqplot.CategoryAxisRenderer,
          label: 'Warranty Concern',
          labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
          tickRenderer: $.jqplot.CanvasAxisTickRenderer,
          tickOptions: {
              angle: -30,
              fontFamily: 'Courier New',
              fontSize: '9pt'
          }
           
        },
        yaxis: {
          label: 'Occurance',
          labelRenderer: $.jqplot.CanvasAxisLabelRenderer
        }
      }
    });
     
     
});


</script>
</body>
</html>
<?php
}
?>

<?php
header('Content-Type: text/html; charset=utf-8');
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
		$campos='Número de casos ingresados'."|".@$ingresado[1]."|".@$ingresado[2]."|".@$ingresado[3]."|".@$ingresado["total"];
		$envio_campo=base64_encode($campos);
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
		
		//arma grafico
		$campos1='Número de audiencias intaladas'."|".@$audiencias[1]."|".@$audiencias[2]."|".@$audiencias[3]."|".@$audiencias["total"];
		$envio_campo1=base64_encode($campos1);
		//arma grafico
		
		
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
        <td class="css_txt"><?php echo @$acuerdol["total"]; 
		
		//arma grafico
		$campos2='Número de acuerdos logrados '."|".@$acuerdol[1]."|".@$acuerdol[2]."|".@$acuerdol[3]."|".@$acuerdol["total"];
		$envio_campo2=base64_encode($campos2);
		//arma grafico
		
		?></td>
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
    <td>
	<img src="grafico_1.php?gb=<?php echo $envio_campo; ?>&sp=<?php echo rand(5, 95).date("Ymdhis"); ?>">
	
	</td>
    <td>
	<img src="grafico_1.php?gb=<?php echo $envio_campo1; ?>&sp=<?php echo rand(5, 95).date("Ymdhis"); ?>">
	
	</td>
    <td>
	<img src="grafico_1.php?gb=<?php echo $envio_campo2; ?>&sp=<?php echo rand(5, 95).date("Ymdhis"); ?>">

	</td>
  </tr>
</table>
<p>RESTULTADOS POR MATERIAS </p>
<?php
//Número de casos ingresados por materia
$ingresadom='';
$porcentaje='';
		$listac_idm="select count(*) as total,tipoing_id,mate_id from media_causasdet inner join media_causascab on media_causasdet.caucab_id=media_causascab.caucab_id where 	year(caudet_fechaingreso)='".$_POST["anio_valor"]."' group by tipoing_id,mate_id";
		$rs_rpcalm = $DB_gogess->Execute($listac_idm);
		 if($rs_rpcalm)
		 {
			while (!$rs_rpcalm->EOF) {	
			
			$ingresadom[$rs_rpcalm->fields["mate_id"]][$rs_rpcalm->fields["tipoing_id"]]=$rs_rpcalm->fields["total"];
			$ingresadom[$rs_rpcalm->fields["mate_id"]]["total"]=$ingresadom[$rs_rpcalm->fields["mate_id"]]["total"]+$rs_rpcalm->fields["total"];
			
			$totalvg=$totalvg+ $rs_rpcalm->fields["total"];
			
			$rs_rpcalm->MoveNext();	
			}

		}


//print_r($ingresadom);
		
		?>
		
	<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
	
	 <table border="0" align="left" cellpadding="0" cellspacing="1" style="border-collapse: collapse;" >
  <tr>
    <td bgcolor="#C5D9F1" class="css_titulo">MATERIAS</td>
    <td bgcolor="#C5D9F1" class="css_titulo">No. Casos <br> ingresados por <br>solicitud <br> directa</td>
    <td bgcolor="#C5D9F1" class="css_titulo">No. casos <br>ingresados por <br>derivaci&oacute;n <br>judicial</td>
    <td bgcolor="#C5D9F1" class="css_titulo">No. Casos <br>ingresados por <br>remisi&oacute;n <br>de tr&aacute;nsito</td>
    <td bgcolor="#C5D9F1" class="css_titulo">TOTAL </td>
	<td bgcolor="#C5D9F1" class="css_titulo">% Sobre el total</td>
  </tr>
  <?php
  $totalv[1]=0;
  $totalv[2]=0;
  $totalv[4]=0;
  $totalv["t"]=0;
  $lista_mat="select * from media_materia where mate_activo=1";
  $rs_lmateria = $DB_gogess->Execute($lista_mat);
		 if($rs_lmateria)
		 {
			while (!$rs_lmateria->EOF) {	
			
			
  ?>
  <tr>
    <td nowrap bgcolor="#C5D9F1" class="css_txt"><?php echo utf8_encode($rs_lmateria->fields["mate_nombre"]); ?></td>
    <td nowrap class="css_txt"><?php echo $ingresadom[$rs_lmateria->fields["mate_id"]][1]?></td>
    <td nowrap class="css_txt"><?php echo $ingresadom[$rs_lmateria->fields["mate_id"]][2]?></td>
    <td nowrap class="css_txt"><?php echo $ingresadom[$rs_lmateria->fields["mate_id"]][3]?></td>
    <td nowrap class="css_txt"><?php echo $ingresadom[$rs_lmateria->fields["mate_id"]]["total"]?></td>
	 <td nowrap class="css_txt"><?php
	 $porcentaje[$rs_lmateria->fields["mate_id"]]["porcentaje"]=($ingresadom[$rs_lmateria->fields["mate_id"]]["total"]*100)/$totalvg;
	 echo $porcentaje[$rs_lmateria->fields["mate_id"]]["porcentaje"]." %";
	
	 ?></td>
  </tr>
  <?php
  $totalv[1]=$totalv[1]+ $ingresadom[$rs_lmateria->fields["mate_id"]][1];
  $totalv[2]=$totalv[2]+ $ingresadom[$rs_lmateria->fields["mate_id"]][2];
  $totalv[3]=$totalv[3]+ $ingresadom[$rs_lmateria->fields["mate_id"]][3];
  $totalv["t"]=$totalv["t"]+ $ingresadom[$rs_lmateria->fields["mate_id"]]["total"];
  
  $rs_lmateria->MoveNext();	
			}

		}
		
		
  ?>
   <tr>
    <td nowrap bgcolor="#C5D9F1" class="css_txt"><b>TOTAL</b></td>
    <td nowrap class="css_txt"><?php echo $totalv[1];  ?></td>
    <td nowrap class="css_txt"><?php echo $totalv[2];  ?></td>
    <td nowrap class="css_txt"><?php echo $totalv[3];  ?></td>
    <td nowrap class="css_txt"><?php echo $totalv["t"];  ?></td>
	<td nowrap class="css_txt"><?php 
	$porcentaje[$rs_lmateria->fields["mate_id"]]["porcentajet"]=($totalv["t"]*100)/$totalvg;
	 echo $porcentaje[$rs_lmateria->fields["mate_id"]]["porcentajet"]." %";
	?></td>
  </tr>
</table>

</td>
<td valign="top">&nbsp;</td>
    <td valign="top">
	
	<img src="grafico_2.php?gb=<?php echo base64_encode($_POST["anio_valor"]); ?>&sp=<?php echo rand(5, 95).date("Ymdhis"); ?>">
	
	</td>
  </tr>
</table>



    <table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="grafico_casosisd.php?gb=<?php echo base64_encode($_POST["anio_valor"]); ?>&sp=<?php echo rand(5, 95).date("Ymdhis"); ?>"></td>
        <td>&nbsp;</td>
        <td><img src="grafico_casosidj.php?gb=<?php echo base64_encode($_POST["anio_valor"]); ?>&sp=<?php echo rand(5, 95).date("Ymdhis"); ?>"></td>
		<td>&nbsp;</td>
		<td><img src="grafico_casosirt.php?gb=<?php echo base64_encode($_POST["anio_valor"]); ?>&sp=<?php echo rand(5, 95).date("Ymdhis"); ?>"></td>
        
      </tr>
    </table>
    <p>&nbsp;</p>
	
	<?php
// resultados por materias y porcentajes	
//Número de casos ingresados por materia
$ingresadomx='';
$porcentajex='';
$totalvg=0;
		$listac_idm="select count(*) as total,mate_id from media_causasdet inner join media_causascab on media_causasdet.caucab_id=media_causascab.caucab_id where 	year(caudet_fechaingreso)='".$_POST["anio_valor"]."' group by mate_id";
		$rs_rpcalm = $DB_gogess->Execute($listac_idm);
		 if($rs_rpcalm)
		 {
			while (!$rs_rpcalm->EOF) {	
			
			$ingresadomx[$rs_rpcalm->fields["mate_id"]]["cantidad"]=$rs_rpcalm->fields["total"];
			$ingresadomx[$rs_rpcalm->fields["mate_id"]]["total"]=$ingresadomx[$rs_rpcalm->fields["mate_id"]]["total"]+$rs_rpcalm->fields["total"];
			
			$totalvg=$totalvg+ $rs_rpcalm->fields["total"];
			
			$rs_rpcalm->MoveNext();	
			}

		}



//audiencias instaladas

$ingresadomai='';
$porcentajeai='';
$totalvgai=0;
		$listac_idmai="select count(*) as total,mate_id from media_causasdet inner join media_causascab on media_causasdet.caucab_id=media_causascab.caucab_id where 	year(caudet_fechaaudiencia)='".$_POST["anio_valor"]."' group by mate_id";
		$rs_rpcalmai = $DB_gogess->Execute($listac_idmai);
		 if($rs_rpcalmai)
		 {
			while (!$rs_rpcalmai->EOF) {	
			
			$ingresadomai[$rs_rpcalmai->fields["mate_id"]]["cantidad"]=$rs_rpcalmai->fields["total"];
			$ingresadomai[$rs_rpcalmai->fields["mate_id"]]["total"]=$ingresadomai[$rs_rpcalmai->fields["mate_id"]]["total"]+$rs_rpcalmai->fields["total"];
			
			$totalvgai=$totalvgai + $rs_rpcalmai->fields["total"];
			
			$rs_rpcalmai->MoveNext();	
			}

		}


//acuerdos logrados 

$ingresadomal='';
$porcentajeal='';
$totalvgal=0;
		$listac_idmal="select count(*) as total,mate_id from media_causasdet inner join media_causascab on media_causasdet.caucab_id=media_causascab.caucab_id where 	recau_id=1 and year(caudet_fechaingreso)='".$_POST["anio_valor"]."' group by mate_id";
		$rs_rpcalmal = $DB_gogess->Execute($listac_idmal);
		 if($rs_rpcalmal)
		 {
			while (!$rs_rpcalmal->EOF) {	
			
			$ingresadomal[$rs_rpcalmal->fields["mate_id"]]["cantidad"]=$rs_rpcalmal->fields["total"];
			$ingresadomal[$rs_rpcalmal->fields["mate_id"]]["total"]=$ingresadomal[$rs_rpcalmal->fields["mate_id"]]["total"]+$rs_rpcalmal->fields["total"];
			
			$totalvgal=$totalvgal + $rs_rpcalmal->fields["total"];
			
			$rs_rpcalmal->MoveNext();	
			}

		}
		
		?>
	
	
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table border="0" align="left" cellpadding="0" cellspacing="1" style="border-collapse: collapse;" >
      <tr>
        <td bgcolor="#C5D9F1" class="css_titulo">MATERIAS</td>
        <td bgcolor="#C5D9F1" class="css_titulo">No. solicitudes <br>totales recibidas</td>
        <td bgcolor="#C5D9F1" class="css_titulo">No. Audiencias <br> Instaladas</td>
        <td bgcolor="#C5D9F1" class="css_titulo">% audiencias instaladas/solicitudes recibidas</td>
        <td bgcolor="#C5D9F1" class="css_titulo">No. Acuerdos <br> Logrados</td>
        <td bgcolor="#C5D9F1" class="css_titulo">% audiencias acuerdos logrados/audiencias instaladas </td>
      </tr>
      <?php
  $totalv[1]=0;
  $totalv[2]=0;
  $totalv[4]=0;
  $totalv["t"]=0;
  $porcen1=0;
  $porcen2=0;
  $porcent1=0;
  $porcent2=0;
  $lista_mat="select * from media_materia where mate_activo=1";
  $rs_lmateria = $DB_gogess->Execute($lista_mat);
		 if($rs_lmateria)
		 {
			while (!$rs_lmateria->EOF) {	
			
			$porcen1=0;
			$porcen2=0;
  ?>
      <tr>
        <td nowrap bgcolor="#C5D9F1" class="css_txt"><?php echo utf8_encode($rs_lmateria->fields["mate_nombre"]); ?></td>
        <td nowrap class="css_txt"><?php echo $ingresadomx[$rs_lmateria->fields["mate_id"]]["cantidad"]?></td>
        <td nowrap class="css_txt"><?php echo $ingresadomai[$rs_lmateria->fields["mate_id"]]["cantidad"]?></td>
        <td nowrap class="css_txt"><?php  
		if($ingresadomx[$rs_lmateria->fields["mate_id"]]["cantidad"])
		{
		$porcen1=$ingresadomai[$rs_lmateria->fields["mate_id"]]["cantidad"]/$ingresadomx[$rs_lmateria->fields["mate_id"]]["cantidad"];
		}
		echo $porcen1." %"; ?></td>
        <td nowrap class="css_txt"><?php echo $ingresadomal[$rs_lmateria->fields["mate_id"]]["cantidad"] ?></td>
        <td nowrap class="css_txt"><?php
		
		if($ingresadomai[$rs_lmateria->fields["mate_id"]]["cantidad"])
		{
		$porcen2=$ingresadomal[$rs_lmateria->fields["mate_id"]]["cantidad"]/$ingresadomai[$rs_lmateria->fields["mate_id"]]["cantidad"];
		}
		echo $porcen2." %";
		
		
		$concatena_num=$concatena_num.$rs_lmateria->fields["mate_id"]."-".$porcen1."-".$porcen2."|";
		
	?></td>
      </tr>
      <?php

  
  $rs_lmateria->MoveNext();	
			}

		}
		
		
  ?>
      <tr>
        <td nowrap bgcolor="#C5D9F1" class="css_txt"><b>TOTAL</b></td>
        <td nowrap class="css_txt"><?php echo $totalvg; ?></td>
        <td nowrap class="css_txt"><?php echo $totalvgai;  ?></td>
        <td nowrap class="css_txt"><?php 
		$porcen1t=$totalvgai/$totalvg;
		echo $porcen1t." %";
		 ?></td>
        <td nowrap class="css_txt"><?php  echo $totalvgal; ?></td>
        <td nowrap class="css_txt"><?php 
	$porcen2t=$totalvgal/$totalvgai;
	echo $porcen2t." %";
	?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><img src="grafico_barra.php?li=<?php echo base64_encode($concatena_num); ?>&gb=<?php echo base64_encode($_POST["anio_valor"]); ?>&sp=<?php echo rand(5, 95).date("Ymdhis"); ?>"></td>
  </tr>
</table>

	
	
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td bgcolor="#366092"><span class="Estilo8">2 Informaci&oacute;n actualizada sobre la capacitaci&oacute;n brindada y recibida</span></td>
  </tr>
</table>
<br>
<?php
  $lista_cursos="select * from media_capacitacionprestada inner join media_tipocurso on media_capacitacionprestada.tipocur_id=media_tipocurso.tipocur_id inner join media_tipocapacitacion on media_capacitacionprestada.tipocap_id=media_tipocapacitacion.tipocap_id where  year(capapr_fechainicio)='".$_POST["anio_valor"]."'";
  $rs_cursos = $DB_gogess->Execute($lista_cursos);
		 if($rs_cursos)
		 {
			while (!$rs_cursos->EOF) {
?>
<table width="600" border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse;" >
  <tr>
    <td width="247" class="css_titulo">Tipo (curso, taller):</td>
    <td width="342" class="css_txt"><?php  echo $rs_cursos->fields["tipocur_nombre"]; ?></td>
  </tr>
  <tr>
    <td class="css_titulo">Brindado/Recibido:</td>
    <td class="css_txt"><?php  echo $rs_cursos->fields["tipocap_nombre"]; ?></td>
  </tr>
  <tr>
    <td class="css_titulo">Tema:<br></td>
    <td class="css_txt"><?php  echo $rs_cursos->fields["capapr_tema"]; ?></td>
  </tr>
  <tr>
    <td class="css_titulo">Materia:</td>
    <td class="css_txt"><?php
	$lista_materias="select * from media_capacitamateria inner join media_materia on media_capacitamateria.mate_id=media_materia.mate_id where capapr_code='".$rs_cursos->fields["capapr_code"]."'";
	$rs_cmat = $DB_gogess->Execute($lista_materias);
		 if($rs_cmat)
		 {
			while (!$rs_cmat->EOF) {
			
			echo $rs_cmat->fields["mate_nombre"]."<br>";
			
			$rs_cmat->MoveNext();	
			}
	}		
	?></td>
  </tr>
  <tr>
    <td class="css_titulo">Horas de Duraci&oacute;n:</td>
    <td class="css_txt"><?php  echo $rs_cursos->fields["capapr_cargahoraria"]; ?></td>
  </tr>
  <tr>
    <td class="css_titulo">Fecha:</td>
    <td class="css_txt"><?php  echo $rs_cursos->fields["capapr_fechainicio"]; ?></td>
  </tr>
  <tr>
    <td class="css_titulo">Lugar:</td>
    <td class="css_txt"><?php  echo $rs_cursos->fields["capapr_lugar"]; ?></td>
  </tr>
  <tr>
    <td class="css_titulo">Observaciones:</td>
    <td class="css_txt"><?php  echo $rs_cursos->fields["capapr_observacion"]; ?></td>
  </tr>
</table>
<br>
<?php
$rs_cursos->MoveNext();	
			}

		}
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#366092"><span class="Estilo8">3  N&oacute;mina de la directiva, mediadoras o mediadores autorizados y personal administrativo a cargo del centro, con sus respectivos n&uacute;meros telef6oacute;nicos y direcciones domiciliarias y electr&oacute;nicas</span></td>
  </tr>
</table><br>
<table width="800" border="0" cellpadding="0" cellspacing="1" style="border-collapse: collapse;" >
  <tr>
  <td class="css_titulo" nowrap>Centro</td>
    <td class="css_titulo" nowrap>Nombre</td>
    <td class="css_titulo" nowrap>Cargo</td>
    <td class="css_titulo" nowrap>Tel&eacute;fono oficina </td>
    <td class="css_titulo" nowrap>Direcci&oacute;n oficina </td>
    <td class="css_titulo" nowrap>Tel&eacute;fono celular </td>
    <td class="css_titulo" nowrap>Direcci&oacute;n domicilio </td>
    <td class="css_titulo" nowrap>Tel&eacute;fono domicilio </td>
    <td class="css_titulo" nowrap>Correo electr&oacute;nico </td>
  </tr>
  <?php
  $lista_personal="select * from media_usuario inner join media_empresa on media_usuario.emp_id=media_empresa.emp_id inner join media_tipopersonal on  media_usuario.tipo_id=media_tipopersonal.tipo_id";
	$rs_personal = $DB_gogess->Execute($lista_personal);
		 if($rs_personal)
		 {
			while (!$rs_personal->EOF) {
  ?>
  <tr>
  <td class="css_txt"  nowrap><?php echo $rs_personal->fields["emp_nombre"]; ?></td>
    <td class="css_txt"  nowrap ><?php echo $rs_personal->fields["usua_nombre"]." ".$rs_personal->fields["usua_apellido"]; ?></td>
    <td class="css_txt" ><?php echo $rs_personal->fields["tipo_nombre"]; ?></td>
    <td class="css_txt" ><?php echo $rs_personal->fields["emp_telefono"]; ?></td>
    <td class="css_txt" ><?php echo $rs_personal->fields["emp_direccion"]; ?></td>
    <td class="css_txt" ><?php echo $rs_personal->fields["usua_celular"]; ?></td>
    <td class="css_txt" ><?php echo $rs_personal->fields["usua_direcciondom"]; ?></td>
    <td class="css_txt" ><?php echo $rs_personal->fields["usua_telefonodom"]; ?></td>
    <td class="css_txt" ><?php echo $rs_personal->fields["usua_email"]; ?></td>
  </tr>
  <?php
  $rs_personal->MoveNext();	
			}

		}
  ?>
</table>
</body>
</html>
<?php
}
?>

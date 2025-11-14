<?
$fechahoy=date("Y-m-d"); 
$anoInicial = '1900';
$anoFinal = '2100';
$funcionTratarFecha = 'document.location = "?dia="+dia+"&mes="+mes+"&ano="+ano;';
if (!($sessid))
{
 $sessid=0;
}
?><script>
function tratarFecha(dia,mes,ano){
   
   contenidoopen(0,22,7,0,14,<?php echo $sessid ?>,dia,mes,ano,0,0,0,0); 
}
</script>
<style>
.m1 {
   font-family:MS Sans Serif;
   font-size:8pt
}
a {
   text-decoration:none;
   color:#000000;
}
</style>

<form><table border="0" cellpadding="5" cellspacing="0" bgcolor="#D4D0C8">
  <tr>
    <td width="100%">
<?
$fecha = getdate(time());
if(isset($_GET["dia"]))$dia = $_GET["dia"];
else $dia = $fecha['mday'];
if(isset($_GET["mes"]))$mes = $_GET["mes"];
else $mes = $fecha['mon'];
if(isset($_GET["ano"]))$ano = $_GET["ano"];
else $ano = $fecha['year'];
$fecha = mktime(0,0,0,$mes,$dia,$ano);
$fechaInicioMes = mktime(0,0,0,$mes,1,$ano);
$fechaInicioMes = date("w",$fechaInicioMes);
?>
    <select size="1" name="mes" class="m1" onchange="document.location = '?sessid=<?=$sessid?>&system=14&dia=<?=$dia?>&mes=' + document.forms[0].mes.value + '&ano=<?=$ano?>';">
<?
$meses = Array ('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
for($i = 1; $i <= 12; $i++){
  echo '      <option ';
  if($mes == $i)echo 'selected ';
  echo 'value="'.$i.'">'.$meses[$i-1]."\n";
}
?>
    </select>&nbsp;&nbsp;&nbsp;<select size="1" name="ano" class="m1" onchange="document.location = '?sessid=<?=$sessid?>&system=14&dia=<?=$dia?>&mes=<?=$mes?>&ano=' + document.forms[0].ano.value;">
<?
for ($i = $anoInicial; $i <= $anoFinal; $i++){
  echo '      <option ';
  if($ano == $i)echo 'selected ';
  echo 'value="'.$i.'">'.$i."\n";
}
?>
    </select>
    <font size="1">&nbsp;</font><table border="0" cellpadding="2" cellspacing="0" width="100%" class="m1" bgcolor="#FFFFFF">
<?
$diasSem = Array ('L','M','M','J','V','S','D');
$ultimoDia = date('t',$fecha);
$numMes = 0;
for ($fila = 0; $fila < 7; $fila++){
  echo "      <tr>\n";
  for ($coln = 0; $coln < 7; $coln++){
    $posicion = Array (1,2,3,4,5,6,0);
    echo '        <td width="9%" height="10"';
    if($fila == 0)echo ' bgcolor="#808080"';   
	
	   $banderacal=0;
	   $fachacal=$ano."-".$mes."-".$numMes;
	   $selecTablacal="select * from con_slide where sli_fechai<='".$fachacal."' and  sli_fechaf>='".$fachacal."'";    
       $resultadocal = mysql_query($selecTablacal);
  		while($rowcal = mysql_fetch_array($resultadocal)) 
			{	
			  $banderacal=1;
			}
		if($dia-1 == $numMes)
		 {
		  echo ' bgcolor="#0A246A"';
		 }
			else
		 {
			  if ($banderacal==1)
			  {
			  
			    echo ' bgcolor="#9fda78"';
			   }	
		 }
	
	
	
    echo " align=\"center\">\n";
    echo '        ';
    if($fila == 0)echo '<font color="#D4D0C8">'.$diasSem[$coln];
    elseif(($numMes && $numMes < $ultimoDia) || (!$numMes && $posicion[$coln] == $fechaInicioMes)){
	
      echo '<div onclick="tratarFecha('.(++$numMes).','.$mes.','.$ano.')" class="slidlink">';
	  
      
	   $banderacal=0;
	   $fachacal=$ano."-".$mes."-".$numMes;
	   $selecTablacal="select * from con_slide where sli_fechai<='".$fachacal."' and  sli_fechaf>='".$fachacal."'";    
       $resultadocal = mysql_query($selecTablacal);
  		while($rowcal = mysql_fetch_array($resultadocal)) 
			{	
			  $banderacal=1;
			}
		if($dia == $numMes)
		 {
		  echo '<font color="#FFFFFF">';
		 }
			else
		 {
			  if ($banderacal==1)
			  {
			   echo '<font color="#FFFFFF">';
			   }	
		 }
	  
	 
	  
      echo ($numMes).'</div>'; 
	  
    }
    echo "</td>\n";
  }
  echo "      </tr>\n";
}
?>
    </table>
    </td>
  </tr>
</table></form>


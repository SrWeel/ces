
<style type="text/css">
<!--
.aqualis1form {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.aqualis1form1 {font-size: 11px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<form name="form1" method="post" action="">
  Fecha Inicial :
    <select name="fechabus" id="fechabus">
      <?php
	  fechalista($fechabus);
	  ?>	  
    </select>
    <input name="opcp" type="hidden" id="opcp" value="7">
    <input name="apl" type="hidden" id="apl" value="3">
    <input name="sessid" type="hidden" id="sessid" value="<?php echo $sessid; ?>">
<input type="submit" name="Submit" value="Enviar">
</form>


<?php
//echo date("y_m_d");
$selecTablalec="select * from siem_parametro where par_activo=1";    
$resultadolec = mysql_query($selecTablalec);
  		while($rowlec = mysql_fetch_array($resultadolec)) 
			{	
			  $pathlec=$rowlec["par_path"];
			}

if ($fechabus)
{
$archivo = $pathlec."/".$fechabus.".DLY";
$nombre_archivo=$archivo;
//Valor del Path y del archivo
$ing_nombrearch=$fechabus.".DLY";
$ing_path = $pathlec;

$buscandoregistrados="select * from sim_ingreso where ing_nombrearch like '".$ing_nombrearch."'";

		  $banderabu=0;
		  $resultadobu = mysql_query($buscandoregistrados);
  		  while($rowbu = mysql_fetch_array($resultadobu)) 
			{	
			  $banderabu=1;
			}
			//echo  $banderabu;
		 if (!($banderabu))
		 {	
		   		
//Detalle de insertar///////////////////////////////////////////////////////////////////////

if (file_exists($nombre_archivo)) {
 ///Verfica existencia de archivo   
echo $archivo."<br>";
$file = fopen($archivo, "r");
while(! feof($file))
  {  
  $linealec=fgets($file,4096);
  $linealec=str_replace("#","",$linealec);
  $linealec=str_replace(" ","*",$linealec);
  $linealec=chop($linealec);
 // $lineaarray=explode(" ",$linealec);
  	 if ($linealec)
	  {
		//print(count($lineaarray));
		//echo $linealec;
		$var1= substr($linealec, 0, 2);
		$var2= substr($linealec, 2, 2);
		$var3= substr($linealec, 4, 2);
		$var4= substr($linealec, 6, 2);
		$var5= substr($linealec, 8, 2);
		$var6= substr($linealec, 10, 2);
		$var7= substr($linealec, 12, 2);
		$var8= substr($linealec, 14, 2);
		$var9= substr($linealec, 16, 2);
		$var10= substr($linealec, 18, 12);
		$var11= substr($linealec, 30, 6);
		$var12= substr($linealec, 36, 10);
		$var13= substr($linealec, 46, 21);
        $var14= substr($linealec, 67, 5);
		$var15= substr($linealec, 72, 12);
		$var16= substr($linealec, 84, 3);
		$var17= substr($linealec, 87, 4);
		$var18= substr($linealec, 91, 3);
		$var19= substr($linealec, 94, 3);
		$var20= substr($linealec, 97, 1);
		$var21= substr($linealec, 98, 1);
		$var22= substr($linealec, 99, 2);		
		$var23= substr($linealec, 101, 1);
		$var24= substr($linealec, 102, 3);
		$var25= substr($linealec, 105, 2);
		$var26= substr($linealec, 107, 2);
		
		
		$var1=str_replace("*","",$var1);
		$var2=str_replace("*","",$var2);
		$var3=str_replace("*","",$var3);
		$var4=str_replace("*","",$var4);
		$var5=str_replace("*","",$var5);
		$var6=str_replace("*","",$var6);
		$var7=str_replace("*","",$var7);
		$var8=str_replace("*","",$var8);
		$var9=str_replace("*","",$var9);
		$var10=str_replace("*","",$var10);
		$var11=str_replace("*","",$var11);
		$var12=str_replace("*","",$var12);
		$var13=str_replace("*","",$var13);
		$var14=str_replace("*","",$var14);
		$var15=str_replace("*","",$var15);
		$var16=str_replace("*","",$var16);
		$var17=str_replace("*","",$var17);
		$var18=str_replace("*","",$var18);
		$var19=str_replace("*","",$var19);
		$var20=str_replace("*","",$var20);
		$var21=str_replace("*","",$var21);
		$var22=str_replace("*","",$var22);
		$var23=str_replace("*","",$var23);
		$var24=str_replace("*","",$var24);
		$var25=str_replace("*","",$var25);
		$var26=str_replace("*","",$var26);
		
		if (!($var1))
		{
		 $var1=0;
		}
		
	   if (!($var2))
		{
		 $var2=0;
		}
		
	  if (!($var3))
		{
		 $var3=0;
		}
		
	if (!($var4))
		{
		 $var4=0;
		}
		
	if (!($var5))
		{
		 $var5=0;
		}
		
	if (!($var6))
		{
		 $var6=0;
		}
		
   if (!($var7))
		{
		 $var7=0;
		}
		
	if (!($var8))
		{
		 $var8=0;
		}
		
	if (!($var9))
		{
		 $var9=0;
		}
		
	if (!($var10))
		{
		 $var10=0;
		}
		
	if (!($var11))
		{
		 $var11=0;
		}
		
	 if (!($var12))
		{
		 $var12=0;
		}
		
	if (!($var13))
		{
		 $var13=0;
		}
		
    if (!($var14))
		{
		 $var14=0;
		}
		
	if (!($var15))
		{
		 $var15=0;
		}
		
     if (!($var16))
		{
		 $var16=0;
		}
		
	if (!($var17))
		{
		 $var17=0;
		}
		
	if (!($var18))
		{
		 $var18=0;
		}
		
	if (!($var19))
		{
		 $var19=0;
		}
		
	if (!($var20))
		{
		 $var20=0;
		}
		
    if (!($var21))
		{
		 $var21=0;
		}
		
	 if (!($var22))
		{
		 $var22=0;
		}
		
	if (!($var23))
		{
		 $var23=0;
		}
		
	if (!($var24))
		{
		 $var24=0;
		}
		
	if (!($var25))
		{
		 $var25=0;
		}
		
	if (!($var26))
		{
		 $var26=0;
		}
		
		$anioarch=$var6+2000;
		$ing_fecha=$anioarch."-".$var5."-".$var4;
		//echo $var1."-".$var2."-".$var3."-".$var4."-".$var5."-".$var6."-".$var7."-".$var8."-".$var9."-".$var10."-".$var11."-".$var12."-".$var13."-".$var14."-".$var15."-".$var16."-".$var17."-".$var18."-".$var19."-".$var20."-".$var21."-".$var22."-".$var23."-".$var24."-".$var25."-".$var26;
		//echo "<br>";
		//echo "INSERT INTO sim_ingreso (ing_nombrearch,ing_path,tiempoh, tiempom, tiempos, fechad, fecham, fechaa, durah, duram, duras, extension, linea1, codruta, destinoorigen, cargos, pin, espacio1, linea2, ring, espacio2, t1, espacio3, tipo, t2, causa, info, au) VALUES ('".$ing_nombrearch."','".$ing_path."',".$var1.",".$var2.", ".$var3.",".$var4.",".$var5.",".$var6.",".$var7.",".$var8.",".$var9.", ".$var10.", '".$var11."', '".$var12."', '".$var13."', '".$var14."', '".$var15."', '".$var16."', '".$var17."', '".$var18."', ".$var19.", '".$var20."', '".$var21."', '".$var22."', '".$var23."', '0', '0', '".$var24."');"; 
		 
		 if ($var23=="T" and $var22=="IN")
		 {
		 $insertando= "INSERT INTO sim_ingreso (ing_fecha,ing_nombrearch,ing_path,tiempoh, tiempom, tiempos, fechad, fecham, fechaa, durah, duram, duras, extension, linea1, codruta, destinoorigen, cargos, pin, espacio1, linea2, ring, espacio2, t1, espacio3, tipo, t2, causa, info, au) VALUES ('".$ing_fecha."','".$ing_nombrearch."','".$ing_path."',".$var1.",".$var2.", ".$var3.",".$var4.",".$var5.",".$var6.",".$var7.",".$var8.",".$var9.", ".$var10.", '".$var11."', '".$var12."', '".$var13."', '".$var14."', '".$var15."', '".$var16."', '".$var17."', '".$var18."', ".$var19.", '".$var20."', '".$var21."', '".$var22."', '".$var23."', '0', '0', '".$var24."');"; 
		 }
		 else
		 {
		 $insertando= "INSERT INTO sim_ingreso (in_fecha,ing_nombrearch,ing_path,tiempoh, tiempom, tiempos, fechad, fecham, fechaa, durah, duram, duras, extension, linea1, codruta, destinoorigen, cargos, pin, espacio1, linea2, ring, espacio2, t1, espacio3, tipo, t2, causa, info, au) VALUES ('".$ing_fecha."','".$ing_nombrearch."','".$ing_path."',".$var1.",".$var2.", ".$var3.",".$var4.",".$var5.",".$var6.",".$var7.",".$var8.",".$var9.", ".$var10.", '".$var11."', '".$var12."', '".$var13."', '".$var14."', '".$var15."', '".$var16."', '".$var17."', '".$var18."', ".$var19.", '".$var20."', '".$var21."', '".$var22."', '".$var23."', '".$var24."', '".$var25."', '".$var26."');";
		 }
		$resultadoinsert = mysql_query($insertando);
		
		  
	  }
   }
fclose($file);
//Fin verifica existencia de archivo
echo "<br>Datos ya insertados correctamente<br>";
} 
else 
{
    echo "El archivo $nombre_archivo no existe";
}
 
//Fin Detalle de insertar///////////////////////////////////////////////////////////////////////
 }
 else
 {
 //Detalle ya encontrados
 echo "<br>Reporte directo<br>";
 echo "<br>Comparando registros de DB y Archivo Plano...<br>";
  //Fin Detalle ya encontrados
 
 }
}

if ($fechabus)
{

$desde="20".$fechabus;
$desde=str_replace("_","-",$desde);

echo'<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#C4D9DF">
  <tr>
    <td bgcolor="#C4D9DF"><div align="center"><span class="aqualis1form">REGISTROS ENCONTRADOS </span></div></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1">
      <tr bgcolor="#8DA4CD">
        <td colspan="3"><span class="aqualis1form1">Tiempo</span></td>
        <td colspan="3"><span class="aqualis1form1">Fecha</span></td>
        <td colspan="3"><span class="aqualis1form1">Duraci&oacute;n</span></td>
        <td><span class="aqualis1form1">Extensi&oacute;n</span></td>
        <td><span class="aqualis1form1">L&iacute;nea</span></td>
        <td><span class="aqualis1form1">C&oacute;digo Ruta</span></td>
        <td><span class="aqualis1form1">N&uacute;mero de Destino u origen</span></td>
        <td><span class="aqualis1form1">Cargos</span></td>
        <td><span class="aqualis1form1">PIN</span></td>
        <td><span class="aqualis1form1">Esp</span></td>
        <td><span class="aqualis1form1">L&iacute;nea</span></td>
        <td><span class="aqualis1form1">Ring</span></td>
        <td><span class="aqualis1form1">Esp</span></td>
        <td><span class="aqualis1form1">T</span></td>
        <td><span class="aqualis1form1">Esp</span></td>
        <td><span class="aqualis1form1">Tipo</span></td>
        <td><span class="aqualis1form1">T</span></td>
        <td><span class="aqualis1form1">Causa</span></td>
        <td><span class="aqualis1form1">Info</span></td>
        <td><span class="aqualis1form1">Answer<br>
          Unanswer</span></td>
        </tr>
      <tr bgcolor="#FFFFFF" class="aqualis1form">
        <td>HH</td>
        <td>MM</td>
        <td>SS</td>
        <td>DD</td>
        <td>MM</td>
        <td>AA</td>
        <td>HH</td>
        <td>MM</td>
        <td>SS</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>';
  $sqlconsu="select * from sim_ingreso where ing_fecha>='".$desde."'";    
  $resultadoconsu = mysql_query($sqlconsu);
  		while($rowconsu = mysql_fetch_array($resultadoconsu)) 
			{	
	    echo '<tr bgcolor="#FFFFFF">
		        <td>'.$rowconsu["tiempoh"].'</td>
        <td>'.$rowconsu["tiempom"].'</td>
        <td>'.$rowconsu["tiempos"].'</td>
        <td>'.$rowconsu["fechad"].'</td>
        <td>'.$rowconsu["fecham"].'</td>
        <td>'.$rowconsu["fechaa"].'</td>
        <td>'.$rowconsu["durah"].'</td>
        <td>'.$rowconsu["duram"].'</td>
        <td>'.$rowconsu["duras"].'</td>
        <td>'.$rowconsu["extension"].'</td>
        <td>'.$rowconsu["linea1"].'</td>
        <td>'.$rowconsu["codruta"].'</td>
        <td>'.$rowconsu["destinoorigen"].'</td>
        <td>'.$rowconsu["cargos"].'</td>
        <td>'.$rowconsu["pin"].'</td>
        <td>'.$rowconsu["espacio1"].'</td>
        <td>'.$rowconsu["linea2"].'</td>
        <td>'.$rowconsu["ring"].'</td>
        <td>'.$rowconsu["espacio2"].'</td>
        <td>'.$rowconsu["t1"].'</td>
        <td>'.$rowconsu["espacio3"].'</td>
        <td>'.$rowconsu["tipo"].'</td>
        <td>'.$rowconsu["t2"].'</td>
		<td>'.$rowconsu["causa"].'</td>
		<td>'.$rowconsu["info"].'</td>
		<td>'.$rowconsu["au"].'</td>
        </tr>';
		}
 echo'</table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>';
 
}

?>
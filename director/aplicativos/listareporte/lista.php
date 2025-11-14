<style type="text/css">
<!--
.aqualis1form {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.aqualis1form1 {font-size: 11px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; }
.Estilo1 {font-size: 11px}
-->
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CEE7E8" class="aqualis1form">Listado de reportes automaticos </td>
  </tr>
  <tr>
    <td bgcolor="#B5CBDB"><table width="100%" border="0" cellpadding="0" cellspacing="1">
      <tr bgcolor="#D8E8EB">
        <td width="16%" class="aqualis1form1">Nombre Reporte </td>
        <td width="14%" class="aqualis1form1">Desde</td>
        <td width="13%" class="aqualis1form1">Hasta</td>
        <td width="57%">&nbsp;</td>
      </tr>
	  
	  
     <?php
	 $i=1;
$sqlconsu="select * from sim_preporte where pre_activo=1";
  $resultadoconsu = mysql_query($sqlconsu);
while($rowconsu = mysql_fetch_array($resultadoconsu)) 
	{	
	$i++;
		echo '<tr bgcolor="#FFFFFF">
        <td class="aqualis1form1">'.$rowconsu[pre_titulo].'</td>
        <td class="aqualis1form1">'.$rowconsu[fechabus].'</td>
        <td class="aqualis1form1">'.$rowconsu[fechabus2].'</td>
        <td><form name="form1'.$i.'" method="post" action="index.php">
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>Desde:                
                <select name="fechabus" class="aqualis1form1" id="select">
                  <option value="">--Seleccionar--</option>';
           
	        fechalista($fechabus);

               echo ' </select></td>
              <td>Hasta:                
                <select name="fechabus2" class="aqualis1form1" id="select2">
                  <option value="">--Seleccionar--</option>';
     
	  fechalista($fechabus2);

                echo '</select>
                <input name="pre_id" type="hidden" id="pre_id" value='.$rowconsu[pre_id].'>
				  <input name="opcp" type="hidden" id="opcp2" value="7">
  <input name="apl" type="hidden" id="apl2" value="5">
  <input name="sessid" type="hidden" id="sessid2" value="'.$sessid.'">
  <input name="fecha1ev" type="hidden" id="fecha1ev" value="'.$rowconsu[fechabus].'">
  <input name="fecha2ev" type="hidden" id="fecha2ev" value="'.$rowconsu[fechabus2].'">
   <input name="enviodelista" type="hidden" id="enviodelista" value="1">
				</td>
              <td><input type="submit" name="Submit" value="Ver reporte"></td>
            </tr>
			
			
          </table>
        </form></td>
      </tr>';

  }
?>

     
    </table></td>
  </tr>
</table>
	 
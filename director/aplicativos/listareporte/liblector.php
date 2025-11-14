<?php
function fechalista($fechabus)
{
  $sqlfecha="select distinct ing_fecha from sim_ingreso";    
  $resultadofecha = mysql_query($sqlfecha);
  while($rowfecha = mysql_fetch_array($resultadofecha)) 
			{	
			  $fechalista=substr($rowfecha["ing_fecha"], 2, 8);
			  $fechalista=str_replace("-","_",$fechalista);
			  if ($fechabus==$fechalista)
			  {
			    echo  '<option value="'.$fechalista.'" selected>'.$rowfecha["ing_fecha"].'</option>';
			  }
			  else
			  {
			     echo  '<option value="'.$fechalista.'">'.$rowfecha["ing_fecha"].'</option>';
			  }
			}
}

function llenar_combo($tablecmb,$fieldcmb,$vbus,$orden)
{
  $selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." ".$orden;
  $resultado = mysql_query($selecTabla);
  if ($resultado)
  {
  		while($row = mysql_fetch_array($resultado)) 
			{	
               if ($row[0]== $vbus)
                {  
                   printf("<option value='%s' selected>%s %s %s %s %s</option>",$row[0],$row[1],$row[2],$row[3],$row[4],$row[5]);
                }
               else
                 {
					printf("<option value='%s'>%s %s %s %s %s</option>",$row[0],$row[1],$row[2],$row[3],$row[4],$row[5]);
                 }
			}   
  }
}
?>
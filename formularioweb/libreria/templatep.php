<?php
class templatep{
var $resultado;

function select_templatep($system)
{

  if ($system)
  {
	  $selecmenu1="select * from iba_ptemplate where temp_active=1 and sys_id = $system";  
	  $resultado1 = mysql_query($selecmenu1);
	  if($resultado1)
	  {
	  while($row1 = mysql_fetch_array($resultado1)) 
				{	
					$this->path_template=$row1[temp_path];			
	
				} 
	  mysql_free_result($resultado1);	
	  }		
				  
   }
  else
   {
         
			echo "<span class='inicioT'>Portal Inactivo...<br>Lista de portales a los que puede ingresar...</span>";
	  $selecmenu2="select * from iba_sys,iba_ptemplate where iba_sys.sys_id=iba_ptemplate.sys_id and temp_active=1";  
	  $resultado2 = mysql_query($selecmenu2);
	  
	  if ($resultado2)
	  {
	     echo "<ul>";
	    while($row2 = mysql_fetch_array($resultado2)) 
				{	
					$this->path_template=$row2[temp_path];			
					echo '<li><a class="inicioT" href="index.php?system='.$row2[sys_id].'" target="_top">'.$row2[sys_titulo].'</a></li>';
	
				}
			echo "</ul>";	
			mysql_free_result($resultado2);
		}	
		 			
			
   }
 
}

//Fecha
function fecha()
{  
  $mes = array (
                1 => "Enero",
                2 => "Febrero",
                3 => "Marzo",
                4 => "Abril",
                5 => "Mayo",
                6 => "Junio",
                7 => "Julio",
                8 => "Agosto",
                9 => "Septiembre",
                10 => "octubre",
                11 => "Noviembre",
                12 => "Diciembre"
   );
  printf ("%d de %s del %d",date("d"),$mes[date("n")],date("Y"));
}


}

?>

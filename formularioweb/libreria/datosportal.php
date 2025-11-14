<?php
class portal{
function datos_portal($system)
{
  $selecmenu="select * from iba_sys where sys_id = ".$system;  
  $resultado = mysql_query($selecmenu);
  if ($resultado)
  {
  while($row = mysql_fetch_array($resultado)) 
			{	
                $this->sys_titulo=$row["sys_titulo"];			
				$this->sys_detalle=$row["sys_detalle"];			
				$this->sys_pathfavicon=$row["sys_pathfavicon"];	
                
			}  
	}		
}
  
}


?>
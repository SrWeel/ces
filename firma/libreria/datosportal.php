<?php
class portal{

function maymin($txt)
{
   return $txt;
}
function datos_portal($system,$DB_gogess)
{
  $selecmenu="select * from sibase_sys where sys_id = ".$system;  
  
  $resultado = $DB_gogess->Execute($selecmenu);
  
  if ($resultado)
  {
           while (!$resultado->EOF) {



                $this->sys_titulo=$resultado->fields[$this->maymin("sys_titulo")];			
				$this->sys_detalle=$resultado->fields[$this->maymin("sys_detalle")];			
				$this->sys_pathfavicon=$resultado->fields[$this->maymin("sys_pathfavicon")];	
				
				$resultado->MoveNext();
				
                
			}  
	}		
}
  
}


?>
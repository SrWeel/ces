<?php
/**
 * Portal
 * 
 * Este archivo permite deplegar los datos del portal.
 * 
 * @author Ecohevea <franklin.aguas@hecoevea.com>
 * @version 1.0
 * @package portal
 */
class portal{
public $sys_titulo;
public $sys_detalle;
public $sys_pathfavicon;
function maymin($txt)
{
   return $txt;
}
function datos_portal($system,$DB_gogess)
{
  $selecmenu="select * from gogess_sys where sys_id = ?";  
  
  $resultado = $DB_gogess->executec($selecmenu,array($system));
  
  if ($resultado)
  {
           while (!$resultado->EOF) {



                $this->sys_titulo=$resultado->fields[$this->maymin("sys_titulo")];			
				$this->sys_detalle=$resultado->fields[$this->maymin("sys_detalle")];			
				$this->sys_pathfavicon=$resultado->fields[$this->maymin("sys_pathfavicon")];	
				$this->sys_texto1=$resultado->fields[$this->maymin("sys_texto1")];	
				$this->sys_texto2=$resultado->fields[$this->maymin("sys_texto2")];	
				$this->sys_texto3=$resultado->fields[$this->maymin("sys_texto3")];	
				$this->sys_texto4=$resultado->fields[$this->maymin("sys_texto4")];	
				$this->sys_texto5=$resultado->fields[$this->maymin("sys_texto5")];	
				$this->sys_texto6=$resultado->fields[$this->maymin("sys_texto6")];	
				$this->sys_texto7=$resultado->fields[$this->maymin("sys_texto7")];	
				$this->sys_texto8=$resultado->fields[$this->maymin("sys_texto8")];	
				$this->sys_facebook=$resultado->fields[$this->maymin("sys_facebook")];	
				$this->sys_twiter=$resultado->fields[$this->maymin("sys_twiter")];	
				$this->sys_google=$resultado->fields[$this->maymin("sys_google")];	
				
				$resultado->MoveNext();
				
                
			}  
	}		
}
  
}


?>
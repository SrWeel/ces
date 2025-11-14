<?php
class templateform{
var $resultado;

function select_templateform($table)
{
  $selecmenu1="select * from iba_sistable,iba_styletable where iba_sistable.st_id=iba_styletable.st_id and tab_name like '$table'";  
  $resultado1 = mysql_query($selecmenu1);
  if($resultado1)
  {
  while($row1 = mysql_fetch_array($resultado1)) 
			{	
                $this->path_templateform=$row1["st_pathweb"];			
				$this->tabla_activa=$row1["tab_actv"];	
				$this->tab_mdobuscar=$row1["tab_mdobuscar"];
				
				$this->tab_nameenlace=$row1["tab_nameenlace"];
				$this->tab_campoenlace=$row1["tab_campoenlace"];
				$this->tab_tipoenlace=$row1["tab_tipoenlace"];
				$this->tab_nombreenlace=$row1["tab_nombreenlace"];
				$this->tab_tablaregreso=$row1["tab_tablaregreso"];	

			}   
    mysql_free_result($resultado1);
	}
	
}

}

?>

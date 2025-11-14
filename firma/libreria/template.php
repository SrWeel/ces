<?php
class template{
var $resultado;

function select_template()
{

  $selecmenu1="select * from sibase_template where tem_active=1";  
  $resultado1 = mysql_query($selecmenu1);
  while($row1 = mysql_fetch_array($resultado1)) 
			{	
                $this->path_template=$row1[tem_path];			

			}   
 
}

}

?>
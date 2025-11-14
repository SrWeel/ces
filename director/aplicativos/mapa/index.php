<?php printf("<link href='%smapa.css' rel='stylesheet' type='text/css'>",$ap_path);?>
<?php
switch ($seccapl) 
	{
     case 1:
         {
            include("mapa.php");		
         }
         break;  
    
     default:	  
         include($ap_path."mapa.php");		 
    }  

?> 

<?php printf("<link href='%smante.css' rel='stylesheet' type='text/css'>",$ap_path);?>
<?php
switch ($seccapl) 
	{
     case 1:
         {
            include("mante.php");		
         }
         break;  
    
     default:	  
         include($ap_path."mante.php");		 
    }  

?> 

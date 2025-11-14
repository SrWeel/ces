<?php printf("<link href='%sfe.css' rel='stylesheet' type='text/css'>",$ap_path);?>
<?php
switch ($seccapl) 
	{
     case 1:
         {
            include("xmlf.php");		
         }
         break;  
    
     default:	  
         include($ap_path."despliegues.php");		 
    }  

?> 

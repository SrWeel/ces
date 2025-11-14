<?php printf("<link href='%sclave.css' rel='stylesheet' type='text/css'>",$ap_path);?>
<?php
switch ($seccapl) 
	{
     case 1:
         {
            include("ldiario.php");		
         }
         break;  
    
     default:	  
         include($ap_path."ldiario.php");		 
    }  

?> 

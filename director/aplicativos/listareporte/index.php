<?php printf("<link href='%sfe.css' rel='stylesheet' type='text/css'>",$ap_path);?>

<?php
include($ap_path."liblector.php");
switch ($seccapl) 
	{
     case 1:
         {
            include("lista.php");		
         }
         break;  
    
     default:	  
         include($ap_path."lista.php");		 
    }  

?> 

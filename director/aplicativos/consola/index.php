<?php
switch (@$seccapl) 
	{
     case 1:
         {
            include("consola.php");		
         }
         break;  
    
     default:	  
         include($ap_path."consola.php");		 
    }  

?> 

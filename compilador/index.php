<?php
switch (@$seccapl) 
	{
     case 1:
         {
            include("generadorcode.php");		
         }
         break;  
    
     default:	  
         include(@$ap_path."generadorcode.php");		 
    }  

?> 

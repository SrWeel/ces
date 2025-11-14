<?php
//variables recibe

switch (@$seccapl) 
	{
     case 1:
         {
            include("opciones.php");		
         }
         break;  
    
     default:	  
         include($ap_path."opciones.php");		 
    }  

//variables entrega
?> 

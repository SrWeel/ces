<?php
if (!(isset($seccapl))) {
$seccapl = "";
}

switch ($seccapl) 
	{
     case 1:
         {
            include("clave.php");		
         }
         break;  
    
     default:	  
         include($ap_path."reporte.php");		 
    }  

?> 

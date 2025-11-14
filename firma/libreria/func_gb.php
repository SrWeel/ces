<?php
  switch ($_REQUEST["opcion_".$table]) 
	{
   
     case "buscar":
      {
        
		   $objformulario->vatajo=$csearch;		   
		   $objformulario->campoorden=$campoorden;
			$objformulario->forden=$forden;
			$objformulario->id_inicio=$id_inicio;   
		   $objformulario->formulario_buscar($table,$csearch,$varsend,$listab,$campo,$obp,$DB_gogess);
			//echo $table."-";
			//echo $csearch."-";  
			//echo $varsend."-"; 
			//echo $listab."-";
			//echo $campo."-";
			//echo $obp."-";
       }	   
       break;   
    
     default:	           
    }
?>
<?php
  switch ($opcion) 
	{
     case "guardar":
      {
            $objformulario->tableant=$tableant;
			$objformulario->tableant1=$tableant1;
			$objformulario->campoant=$campoant;
			$objformulario->opcp=$opcp;
            $objformulario->formulario_guardar($table,$_POST,$HTTP_POST_FILES,$typesql,$varsend,$listab,$campo,$obp);
			
       }
       break;   
     case "actualizar":
      {            
              $objformulario->tableant=$tableant;
			  $objformulario->tableant1=$tableant1;
			$objformulario->campoant=$campoant;			
			$objformulario->opcp=$opcp;  
             $objformulario->formulario_update($table,$_POST,$HTTP_POST_FILES,$typesql,$idab,$varsend,$listab,$campo,$obp);
       }
     case "buscar":
      {
           $objformulario->vatajo=$csearch;		   
		   $objformulario->formulario_buscar($table,$csearch,$varsend,$listab,$campo,$obp);
			//echo $table."-";
			//echo $csearch."-";  
			//echo $varsend."-"; 
			//echo $listab."-";
			//echo $campo."-";
			//echo $obp."-";
       }	   
       break;   
     case "borrar":
      {
	        $objformulario->tableant=$tableant;
		    $objformulario->tableant1=$tableant1;
			$objformulario->campoant=$campoant;		
			$objformulario->opcp=$opcp;
            $objformulario->formulario_delete($table,$idab,$varsend,$listab,$campo,$obp);
		    
       }	   
       break;   
     default:	           
    }
?>
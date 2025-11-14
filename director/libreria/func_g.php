<?php
  $opcion_val="opcion_".str_replace(".","_",@$table); 
  switch (@$$opcion_val) 
	{
     case "guardar":
      {
            $objformulario->tableant=@$tableant;
			$objformulario->tableant1=@$tableant1;
			$objformulario->campoant=@$campoant;
			$objformulario->opcp=@$opcp;
			
			$objformulario->campoorden=@$campoorden;
			$objformulario->forden=@$forden;
			$objformulario->id_inicio=@$id_inicio;
			

            $objformulario->formulario_guardar(@$table,$_POST,@$typesql,@$varsend,@$listab,@$campo,@$obp,$DB_gogess);
			
       }
       break;   
     case "actualizar":
      {            
              $objformulario->tableant=@$tableant;
			  $objformulario->tableant1=@$tableant1;
			$objformulario->campoant=@$campoant;			
			$objformulario->opcp=@$opcp;  
			$objformulario->campoorden=@$campoorden;
			$objformulario->forden=@$forden;
			$objformulario->id_inicio=@$id_inicio;
             $objformulario->formulario_update(@$table,$_POST,@$typesql,@$idab,@$varsend,@$listab,@$campo,@$obp,$DB_gogess);
       }
     case "buscar":
      {
          
		  $objformulario->vatajo=@$csearch;		
		   $objformulario->campoorden=@$campoorden;
			$objformulario->forden=@$forden;
			$objformulario->id_inicio=@$id_inicio;   
		   $objformulario->formulario_buscar(@$table,@$csearch,@$varsend,@$listab,@$campo,@$obp,$DB_gogess);

       }	   
       break;   
     case "borrar":
      {
	        $objformulario->tableant=@$tableant;
		    $objformulario->tableant1=@$tableant1;
			$objformulario->campoant=@$campoant;		
			$objformulario->opcp=@$opcp;
			$objformulario->campoorden=@$campoorden;
			$objformulario->forden=@$forden;
			$objformulario->id_inicio=@$id_inicio;
            $objformulario->formulario_delete(@$table,@$idab,@$varsend,@$listab,@$campo,@$obp,$DB_gogess);
		    
       }	   
       break;   
     default:	           
    }
?>
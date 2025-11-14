<?php

if (!($objformulario->imprpt))
	   {
         //No impresión	  
	
		  if (!($objformulario->contenid[$nombre_campo]==""))
           {						
             
			 echo $objformulario->fie_title." ".$objformulario->fie_txtizq."<input name='".$nombre_campo."' type='text' class='".$objformulario->fie_styleobj."'  value='".$objformulario->contenid[$nombre_campo]."' maxlength='".$len."' ".$objformulario->fie_attrib." size='".$objformulario->fie_lencampo."'  >".$objformulario->fie_txtextra;
			 
           }
		  else
           {
         	if ($objformulario->fie_sendvar)				
             { 
			 echo $objformulario->fie_title." ".$objformulario->fie_txtizq."<input name='".$nombre_campo."' type='text' class='".$objformulario->fie_styleobj."'  value='".$objformulario->sendvar[$objformulario->fie_sendvar]."' maxlength='".$len."' ".$objformulario->fie_attrib." size='".$objformulario->fie_lencampo."'  >".$objformulario->fie_txtextra;
				 
              }
             else
              {
			    if ($objformulario->dedatos)
				{
			      echo $objformulario->fie_title." ".$objformulario->fie_txtizq."<input name='".$nombre_campo."' type='text' class='".$objformulario->fie_styleobj."'  value='".$objformulario->contenid[$nombre_campo]."' maxlength='".$len."' ".$objformulario->fie_attrib." size='".$objformulario->fie_lencampo."' >".$objformulario->fie_txtextra;				   
				}  
				else
				{
				
				////////////////////////////////////////////////////
				
				if ($typeSql=='int' or $typeSql=='real')
				{
                   echo $objformulario->fie_title." Desde:".$objformulario->fie_txtizq."<input name='".$nombre_campo."' type='text' class='".$objformulario->fie_styleobj."'  value='".$objformulario->fie_value."' maxlength='".$len."' ".$objformulario->fie_attrib." size='7' >".$objformulario->fie_txtextra;		
				   
				   echo "Hasta:".$objformulario->fie_txtizq."<input name='".$nombre_campo."2' type='text' class='".$objformulario->fie_styleobj."'  value='".$objformulario->fie_value."' maxlength='".$len."' ".$objformulario->fie_attrib." size='7' >".$objformulario->fie_txtextra;		
				   		   				  
				 }
				 else
				 {
				   echo $objformulario->fie_title." ".$objformulario->fie_txtizq."<input name='".$nombre_campo."' type='text' class='".$objformulario->fie_styleobj."'  value='".$objformulario->fie_value."' maxlength='".$len."' ".$objformulario->fie_attrib." size='".$objformulario->fie_lencampo."' >".$objformulario->fie_txtextra;				   				  
				 
				 } 
				///////////////////////////////////////////////////////
				}
              }  
           }
           //Fin no impresión
		   }
		   else
		   {
		   //Impresión
		   		 if ($objformulario->fie_activarprt)
		 {
		   if (!($objformulario->fie_tactive))
        {
			$objformulario->fie_title="";
		}
		   
		   if ($objformulario->contenid[$nombre_campo]<>'')
		{
				printf("<b>%s</b>%s%s  %s",$objformulario->fie_title,$objformulario->fie_txtizq,$objformulario->contenid[$nombre_campo],$objformulario->fie_txtextra);		   
				
		 }
		 
		 }  
		   //Impresión
		   
		   
		   
		   }
?>
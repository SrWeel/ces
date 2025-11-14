<?php
      if (!($objformulario->fie_tactive))
        {
			$objformulario->fie_title="";
		}
		  if (!($objformulario->contenid[$nombre_campo]==""))
           {						
             printf("%s  %s",$objformulario->fie_title,$objformulario->fie_txtizq);
			 if ($objformulario->contenid[$nombre_campo])
			 {			 
			   printf("<input name='%s' class='%s' type='checkbox' id='checkbox' value='1' checked %s>",$nombre_campo,$objformulario->fie_styleobj,$tabindx);
			 }
			 else
			 {
			    printf("<input name='%s' class='%s' type='checkbox' id='checkbox' value='1' %s>",$nombre_campo,$objformulario->fie_styleobj,$tabindx);
			 }			 
			 printf("%s",$objformulario->fie_txtextra);
			 			 
           }
		  else
           {
		     printf("%s %s",$objformulario->fie_title,$objformulario->fie_txtizq);
			
         	 if ($objformulario->fie_value)
			 {			 
			   printf("<input name='%s' class='%s' type='checkbox' id='checkbox' value='1' checked %s>",$nombre_campo,$objformulario->fie_styleobj,$tabindx);
			 }
			 else
			 {
			    printf("<input name='%s' class='%s' type='checkbox' id='checkbox' value='1' %s>",$nombre_campo,$objformulario->fie_styleobj,$tabindx);
			 }
			 printf("%s",$objformulario->fie_txtextra);
           }

?>
<?php
      if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {						
             printf("<div  class='%s'>%s</div>%s",$this->fie_style,$this->fie_title,$this->fie_txtizq);
			 if ($this->contenid[$nombre_campo])
			 {			 
			   printf("<input name='%s' class='%s' type='checkbox' id='checkbox' value='1' checked %s>",$nombre_campo,$this->fie_styleobj,$tabindx);
			 }
			 else
			 {
			    printf("<input name='%s' class='%s' type='checkbox' id='checkbox' value='1' %s>",$nombre_campo,$this->fie_styleobj,$tabindx);
			 }			 
			 printf("%s",$this->fie_txtextra);
			 			 
           }
		  else
           {
		     printf("<div  class='%s'>%s</div>%s",$this->fie_style,$this->fie_title,$this->fie_txtizq);
			
         	 if ($this->fie_value)
			 {			 
			   printf("<input name='%s' class='%s' type='checkbox' id='checkbox' value='1' checked %s>",$nombre_campo,$this->fie_styleobj,$tabindx);
			 }
			 else
			 {
			    printf("<input name='%s' class='%s' type='checkbox' id='checkbox' value='1' %s>",$nombre_campo,$this->fie_styleobj,$tabindx);
			 }
			 printf("%s",$this->fie_txtextra);
           }

?>
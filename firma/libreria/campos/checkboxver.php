<?php
      if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {						
             printf("<tr><td><div  class='%s'>%s</div></td><td> </td><td> </td><td class='txtextra'>%s",$this->fie_style,$this->fie_title,$this->fie_txtizq);
			 if ($this->contenid[$nombre_campo])
			 {			 
			   printf("<input name='%s' class='%s' type='hidden' id='checkbox' value='1'  %s>",$nombre_campo,$this->fie_styleobj,$tabindx);
			   echo '<img src="libreria/campos/imgchek/visto.jpg" width="20" height="21" border="0">';
			 }
			 else
			 {
			    printf("<input name='%s' class='%s' type='hidden' id='checkbox' value='1' %s>",$nombre_campo,$this->fie_styleobj,$tabindx);
				echo '<img src="libreria/campos/imgchek/sinvisto.jpg" width="20" height="21" border="0">';
			 }			 
			 printf("%s</td></tr>",$this->fie_txtextra);
			 			 
           }
		  else
           {
		     printf("<tr><td><div  class='%s'>%s</div></td><td> </td><td> </td><td class='txtextra'>%s",$this->fie_style,$this->fie_title,$this->fie_txtizq);
			
         	 if ($this->fie_value)
			 {			 
			   printf("<input name='%s' class='%s' type='hidden' id='checkbox' value='1'  %s>",$nombre_campo,$this->fie_styleobj,$tabindx);
			   echo '<img src="libreria/campos/imgchek/visto.jpg" width="20" height="21" border="0">';
			 }
			 else
			 {
			    printf("<input name='%s' class='%s' type='hidden' id='checkbox' value='1' %s>",$nombre_campo,$this->fie_styleobj,$tabindx);
				echo '<img src="libreria/campos/imgchek/sinvisto.jpg" width="20" height="21" border="0">';
			 }
			 printf("%s</td></tr>",$this->fie_txtextra);
           }

?>
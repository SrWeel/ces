<?php
  if (!($this->imprpt))
	   {
	   //No impresión
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
       if (!($this->contenid[$nombre_campo]==""))
           {						
             printf("<tr><td><div  class='%s'>%s</div></td><td></td><td></td><td><input name='%s' type='hidden' value='%s'></td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->contenid[$nombre_campo]);
           }
        else
          {
            if ($this->fie_sendvar)				
             {          
			  printf("<tr><td><div  class='%s'>%s</div></td><td></td><td></td><td><input name='%s' type='hidden' value='%s'></td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->sendvar["$this->fie_sendvar"]);
             }
            else
             {
			  printf("<tr><td><div  class='%s'>%s</div></td><td></td><td></td><td><input name='%s' type='hidden' value='%s'></td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->fie_value);
             }    
          }
		  //Fin No impresión
		  }
		  

?>
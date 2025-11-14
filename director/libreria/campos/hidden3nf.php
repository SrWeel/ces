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
             printf("<div  class='%s'></div><input name='%s' type='hidden' value='%s'>",$this->fie_style,$nombre_campo,$this->contenid[$nombre_campo]);
           }
        else
          {
            if ($this->fie_sendvar)				
             {          
			  printf("<div  class='%s'></div><input name='%s' type='hidden' value='%s'>",$this->fie_style,$nombre_campo,$this->sendvar["$this->fie_sendvar"]);
             }
            else
             {
			  printf("<div  class='%s'></div><input name='%s' type='hidden' value='%s'>",$this->fie_style,$nombre_campo,$this->fie_value);
             }    
          }
		  //Fin no impresión
		  }

?>
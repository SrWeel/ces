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
		 
							
             printf("<div  class='%s'>%s</div> <script>DateInput('%s', true, 'YYYY-MM-DD','%s')</script>  %s",$this->fie_style,$this->fie_title,$nombre_campo,$this->contenid[$nombre_campo],$this->fie_txtextra);
			
			 
           }
		  else
           {
         	if ($this->fie_sendvar)				
             { 
                 printf("<div  class='%s'>%s</div><script>DateInput('%s', true, 'YYYY-MM-DD','%s')</script> %s",$this->fie_style,$this->fie_title,$nombre_campo,$this->sendvar[$this->fie_sendvar],$this->fie_txtextra);
              }
             else
              {
				printf("<div  class='%s'>%s</div> <script>DateInput('%s', true, 'YYYY-MM-DD')</script>   %s ",$this->fie_style,$this->fie_title,$nombre_campo,$this->fie_txtextra);
              }  
           }
            //Fin no impresión
			}
			 else
			 {
			 //Impresión
			 
			 		 if ($this->fie_activarprt)
		 {
			 if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
			 		if ($this->contenid[$nombre_campo]<>'')
		{	
			 printf("<div  class='%s'><b>%s</b></div><div  class='%s'>&nbsp; %s  %s</div>",$this->fie_style,$this->fie_title,$this->fie_style,$this->contenid[$nombre_campo],$this->fie_txtextra);
			}
			}
			 //Impresión
			 }

?>
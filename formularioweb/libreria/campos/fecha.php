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
		 
							
             printf("<tr><td width='150'><div  class='%s'>%s</div></td><td> </td><td> </td><td> <script>DateInput('%s', true, 'YYYY-MM-DD','%s')</script>  %s</td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->contenid[$nombre_campo],$this->fie_txtextra);
			
			 
           }
		  else
           {
         	if ($this->fie_sendvar)				
             { 
                 printf("<tr><td width='150'><div  class='%s'>%s</div></td><td> </td><td> </td><td>  <script>DateInput('%s', true, 'YYYY-MM-DD','%s')</script> %s</td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->sendvar[$this->fie_sendvar],$this->fie_txtextra);
              }
             else
              {
				printf("<tr><td width='150'><div  class='%s'>%s</div></td><td> </td><td> </td><td>  <script>DateInput('%s', true, 'YYYY-MM-DD')</script>   %s   </td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->fie_txtextra);
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
			 printf("<tr><td width='150'><div  class='%s'><b>%s</b></div></td><td> </td><td><div  class='%s'> %s  %s</div></td></tr>",$this->fie_style,$this->fie_title,$this->fie_style,$this->contenid[$nombre_campo],$this->fie_txtextra);
			}
			}
			 //Impresión
			 }

?>
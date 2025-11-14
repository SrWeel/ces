<?php

if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
       if (!($this->contenid[$nombre_campo]==""))
           {						
             if ($this->fie_value=="replace")
				{
				   $valorbus=$this->contenid[$nombre_campo];
			       $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$valorbus);  
			       printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td></td><td></td><td valign='top'><input name='%s' type='hidden' value='%s'><div class='cuadrot'> %s </div></td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->contenid[$nombre_campo],$rmp);
				}
				else
				{
				  printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td></td><td></td><td valign='top'><input name='%s' type='hidden' value='%s'><div class='cuadrot'> %s</div></td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->contenid[$nombre_campo],$this->contenid[$nombre_campo]);
				}   
           }
        else
          {
            if ($this->fie_sendvar)				
             {  
			    if ($this->fie_value=="replace")
				{
				  $valorbus=$this->sendvar["$this->fie_sendvar"];
			      $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$valorbus);  				  
			      printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td></td><td></td><td valign='top'><input name='%s' type='hidden' value='%s'><div class='cuadrot'> %s </div></td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->sendvar["$this->fie_sendvar"],$rmp);
				}
				else
				{
			      printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td></td><td></td><td valign='top'><input name='%s' type='hidden' value='%s'><div class='cuadrot'> %s</div></td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->sendvar["$this->fie_sendvar"],$this->sendvar["$this->fie_sendvar"]);				
				}
             }
            else
             {
			  printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td></td><td></td><td valign='top'><input name='%s' type='hidden' value='%s'><div  class='cuadrot'> %s</div></td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->fie_value,$this->fie_value);
             }   
         
		  }
?>
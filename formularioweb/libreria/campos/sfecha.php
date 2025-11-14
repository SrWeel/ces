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
		     echo '<tr><td valign="top"><div  class="'.$this->fie_style.'">'.$this->fie_title.'</div></td><td></td><td><div  class="'.$this->fie_style.'"> '.$this->fie_txtizq.'</div></td><td class="txtextra"><input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'"  >'; 
			 echo  '<input type="reset" value=" ... " onclick= "return ';
			 echo  "showCalendar('".$nombre_campo."', '%Y-%m-%d', '24', true)";
			 echo '"; class="'.$this->fie_styleobj.'">'.$this->fie_txtextra.'</td></tr>';
		   	
        }
		  else
           {
         	if ($this->fie_sendvar)				
             { 
                 echo '<tr><td valign="top"><div  class="'.$this->fie_style.'">'.$this->fie_title.'</div></td><td></td><td><div  class="'.$this->fie_style.'"> '.$this->fie_txtizq.'</div></td><td class="txtextra"><input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->sendvar[$this->fie_sendvar].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'"  >'; 
				 echo  '<input type="reset" value=" ... " onclick= "return ';
				 echo  "showCalendar('".$nombre_campo."', '%Y-%m-%d', '24', true)";
				 echo '"; class="'.$this->fie_styleobj.'">'.$this->fie_txtextra.'</td></tr>';
					 	  
			  }
             else
              {
			    if ($this->dedatos)
				{
				  // printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td></td><td><div  class='%s'> %s</div></td><td class='txtextra'><input name='%s' type='text' class='%s'  value='%s' maxlength='%s' %s size='%s' %s > %s</td></tr>",$this->fie_style,$this->fie_title,$this->fie_style,$this->fie_txtizq,$nombre_campo,$this->fie_styleobj,$this->contenid[$nombre_campo],$len,$this->fie_attrib,$this->fie_lencampo,$tabindx,$this->fie_txtextra);
                     echo '<tr><td valign="top"><div  class="'.$this->fie_style.'">'.$this->fie_title.'</div></td><td></td><td><div  class="'.$this->fie_style.'"> '.$this->fie_txtizq.'</div></td><td class="txtextra"><input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'"  >'; 
					 echo  '<input type="reset" value=" ... " onclick= "return ';
					 echo  "showCalendar('".$nombre_campo."', '%Y-%m-%d', '24', true)";
					 echo '"; class="'.$this->fie_styleobj.'">'.$this->fie_txtextra.'</td></tr>';
				   
				}  
				else
				{
				  //printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td></td><td><div  class='%s'> %s</div></td><td class='txtextra'><input name='%s' type='text' class='%s'  value='%s' maxlength='%s' %s size='%s' %s > %s</td></tr>",$this->fie_style,$this->fie_title,$this->fie_style,$this->fie_txtizq,$nombre_campo,$this->fie_styleobj,$this->fie_value,$len,$this->fie_attrib,$this->fie_lencampo,$tabindx,$this->fie_txtextra);
                   
					 echo '<tr><td valign="top"><div  class="'.$this->fie_style.'">'.$this->fie_title.'</div></td><td></td><td><div  class="'.$this->fie_style.'"> '.$this->fie_txtizq.'</div></td><td class="txtextra"><input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->fie_value.'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'"  >'; 
					 echo  '<input type="reset" value=" ... " onclick= "return ';
					 echo  "showCalendar('".$nombre_campo."', '%Y-%m-%d', '24', true)";
					 echo '"; class="'.$this->fie_styleobj.'">'.$this->fie_txtextra.'</td></tr>';
				}
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
				printf("<tr><td valign='top'><div  class='%s'><b>%s</b></div></td><td> </td><td class='txtextra'>%s%s  %s</td></tr>",$this->fie_styleobj,$this->fie_title,$this->fie_txtizq,$this->contenid[$nombre_campo],$this->fie_txtextra);		   
		 }
		 
		 }  
		   //Impresión
		   
		   
		   
		   }
?>
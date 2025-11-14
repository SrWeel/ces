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
		     echo '<tr><td valign="top"><div  class="'.$this->fie_style.'">'.$this->fie_title.'</div></td><td>&nbsp;</td><td><div  class="'.$this->fie_style.'"> &nbsp;'.$this->fie_txtizq.'&nbsp;</div></td><td class="txtextra">&nbsp;<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'"  >'; 
			 echo  '<input type="reset" value=" ... " onclick= "return ';
			 echo  "showCalendar('".$nombre_campo."', '%Y-%m-%d %H:%M', '24', true)";
			 echo '"; class="'.$this->fie_styleobj.'">'.$this->fie_txtextra.'</td></tr>';
		   	
        }
		  else
           {
         	if ($this->fie_sendvar)				
             { 
                 echo '<tr><td valign="top"><div  class="'.$this->fie_style.'">'.$this->fie_title.'</div></td><td>&nbsp;</td><td><div  class="'.$this->fie_style.'"> &nbsp;'.$this->fie_txtizq.'&nbsp;</div></td><td class="txtextra">&nbsp;<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->sendvar[$this->fie_sendvar].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'"  >'; 
				 echo  '<input type="reset" value=" ... " onclick= "return ';
				 echo  "showCalendar('".$nombre_campo."', '%Y-%m-%d %H:%M', '24', true)";
				 echo '"; class="'.$this->fie_styleobj.'">'.$this->fie_txtextra.'</td></tr>';
					 	  
			  }
             else
              {
			    if ($this->dedatos)
				{
				  // printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td>&nbsp;</td><td><div  class='%s'> &nbsp;%s&nbsp;</div></td><td class='txtextra'>&nbsp;<input name='%s' type='text' class='%s'  value='%s' maxlength='%s' %s size='%s' %s > %s</td></tr>",$this->fie_style,$this->fie_title,$this->fie_style,$this->fie_txtizq,$nombre_campo,$this->fie_styleobj,$this->contenid[$nombre_campo],$len,$this->fie_attrib,$this->fie_lencampo,$tabindx,$this->fie_txtextra);
                     echo '<tr><td valign="top"><div  class="'.$this->fie_style.'">'.$this->fie_title.'</div></td><td>&nbsp;</td><td><div  class="'.$this->fie_style.'"> &nbsp;'.$this->fie_txtizq.'&nbsp;</div></td><td class="txtextra">&nbsp;<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'"  >'; 
					 echo  '<input type="reset" value=" ... " onclick= "return ';
					 echo  "showCalendar('".$nombre_campo."', '%Y-%m-%d %H:%M', '24', true)";
					 echo '"; class="'.$this->fie_styleobj.'">'.$this->fie_txtextra.'</td></tr>';
				   
				}  
				else
				{
				  echo $objformulario->fie_title.$objformulario->fie_txtizq.' Desde:<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$objformulario->fie_styleobj.'"  value="'.$objformulario->fie_value.'" maxlength="'.$len.'" '.$objformulario->fie_attrib.' size="12"  >'; 
					 echo  '<input type="reset" value=" ... " onclick= "return ';
					 echo  "showCalendar('".$nombre_campo."', '%Y-%m-%d', '24', true)";
					 echo '"; class="'.$objformulario->fie_styleobj.'">'.$objformulario->fie_txtextra;
					 
					 
					 
					 	 echo ' Hasta:<input name="'.$nombre_campo.'2" id="'.$nombre_campo.'2" type="text" class="'.$objformulario->fie_styleobj.'"  value="'.$objformulario->fie_value.'" maxlength="'.$len.'" '.$objformulario->fie_attrib.' size="12"  >'; 
					 echo  '<input type="reset" value=" ... " onclick= "return ';
					 echo  "showCalendar('".$nombre_campo."2', '%Y-%m-%d', '24', true)";
					 echo '"; class="'.$objformulario->fie_styleobj.'">'.$objformulario->fie_txtextra;
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
				printf("<tr><td valign='top'><div  class='%s'><b>%s</b></div></td><td> &nbsp;</td><td class='txtextra'>%s&nbsp;%s  %s</td></tr>",$this->fie_styleobj,$this->fie_title,$this->fie_txtizq,$this->contenid[$nombre_campo],$this->fie_txtextra);		   
		 }
		 
		 }  
		   //Impresión
		   
		   
		   
		   }
?>
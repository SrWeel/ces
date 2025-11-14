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
            printf("<tr><td valign='top' ><div  class='%s'>%s</div></td><td > </td><td valign='top'><div  class='%s'> %s</div></td><td class='txtextra' valign=top><textarea name='%s' class='%s' rows='%s' wrap='VIRTUAL' %s cols='%s' %s>%s</textarea> %s</td></tr>",$this->fie_style,$this->fie_title,$this->fie_style,$this->fie_txtizq,$nombre_campo,$this->fie_styleobj,$this->fie_lineas,$this->fie_attrib,$this->fie_lencampo,$tabindx,$this->contenid[$nombre_campo],$this->fie_txtextra);
           }
          else
  		   {
            if ($this->fie_sendvar)				
             {
 			  printf("<tr><td valign='top' ><div  class='%s'>%s</div></td><td > </td><td valign='top'><div  class='%s'> %s</div></td><td class='txtextra' valign=top><textarea name='%s' class='%s' rows='%s' wrap='VIRTUAL' %s cols='%s' %s>%s</textarea> %s</td></tr>",$this->fie_style,$this->fie_title,$this->fie_style,$this->fie_txtizq,$nombre_campo,$this->fie_styleobj,$this->fie_lineas,$this->fie_attrib,$this->fie_lencampo,$tabindx,$this->sendvar["$this->fie_sendvar"],$this->fie_txtextra);
             }
            else
             {  
 			  printf("<tr><td valign='top' ><div  class='%s'>%s</div></td><td> </td><td valign='top'><div  class='%s'> %s</div></td><td class='txtextra' valign=top><textarea name='%s' class='%s' rows='%s' wrap='VIRTUAL' %s cols='%s' %s>%s</textarea> %s</td></tr>",$this->fie_style,$this->fie_title,$this->fie_style,$this->fie_txtizq,$nombre_campo,$this->fie_styleobj,$this->fie_lineas,$this->fie_attrib,$this->fie_lencampo,$tabindx,$this->fie_value,$this->fie_txtextra);
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
//		printf("<tr ><td valign='top' width='150'><div  class='%s'><b>%s</b></div></td><td> </td><td class='txtextra' valign=top>%s%s %s<br><br></td></tr>",$this->fie_style,$this->fie_title,$this->fie_txtizq,$this->contenid[$nombre_campo],$this->fie_txtextra);
		printf("<tr><td valign='top'><div  class='%s'><b>%s</b></div></td><td> </td><td class='txtextra'>%s%s  %s</td></tr>",$this->fie_style,$this->fie_title,$this->fie_txtizq,$this->contenid[$nombre_campo],$this->fie_txtextra);		   
		}
		}
		//Fin impresión
		}
?>
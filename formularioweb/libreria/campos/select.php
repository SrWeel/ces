<?php
 if (!($this->imprpt))
	   {
	   //No impresión
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
				 
				if ($this->contenid[$nombre_campo]<>"")	
				{
								 printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td></td><td> </td><td class='txtextra' valign=top><select name='%s' class='%s' %s %s>",$this->fie_style,$this->fie_title,$nombre_campo,$this->fie_styleobj,$this->fie_attrib,$tabindx);          
								 printf("<option value='-1'>---Seleccionar--</option>");  
								 $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->contenid[$nombre_campo],$this->fie_sqlorder);
								 printf("</select> %s</td></tr>",$this->fie_txtextra);
				}
				else
				{
												 printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td></td><td> </td><td class='txtextra' valign=top><select name='%s' class='%s' %s %s>",$this->fie_style,$this->fie_title,$nombre_campo,$this->fie_styleobj,$this->fie_attrib,$tabindx);          
								 printf("<option value='-1'>---Seleccionar--</option>");  
								 $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->sendvar["$this->fie_sendvar"],$this->fie_sqlorder);
								 printf("</select> %s</td></tr>",$this->fie_txtextra);
				
				
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
		$rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$this->contenid[$nombre_campo]);
		printf("<tr><td valign='top'><div  class='%s'><b>%s</b></div></td><td> </td><td class='txtextra' valign=top>%s%s %s</td></tr>",$this->fie_style,$this->fie_title,$this->fie_txtizq,$rmp,$this->fie_txtextra);
		}
		}
		//Fin impresión
		}
?>
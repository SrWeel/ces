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
								 printf("<tr nowrap='nowrap'><td valign='top' class='%s'> %s</td><td>&nbsp;</td><td> &nbsp;</td><td class='txtextra' valign=top><div id='txtHint%s' style='float:left'><select name='%s' class='%s' %s %s>",$this->fie_style,$this->fie_title,$nombre_campo,$nombre_campo,$this->fie_styleobj,$this->fie_attrib,$tabindx);          
								 printf("<option value='-1'>---Seleccionar--</option>");  
								 $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->contenid[$nombre_campo],$this->fie_sqlorder);
								 printf("</select></div> %s",$this->fie_txtextra);								 
								
								 echo '<div id=bt style=float:left><input name="oc'.$nombre_campo.'"  type="Button" value="IC" onClick="ac'.$nombre_campo.'()"; onfocus=showUser'.$nombre_campo.'("'.$this->fie_style.'","'.$this->fie_title.'","'.$nombre_campo.'","'.$nombre_campo.'","'.$this->fie_styleobj.'","'.$this->fie_attrib.'","'.$tabindx.'","'.$this->fie_tabledb.'","'.$this->fie_datadb.'","'.$this->contenid[$nombre_campo].'","'.$this->fie_sqlorder.'")></div></td></tr>';
								
				}
				else
				{
								 printf("<tr nowrap='nowrap'><td valign='top' class='%s'>%s</td><td>&nbsp;</td><td> &nbsp;</td><td class='txtextra' valign=top nowrap='nowrap'><div id='txtHint%s' style='float:left'><select name='%s' class='%s' %s %s>",$this->fie_style,$this->fie_title,$nombre_campo,$nombre_campo,$this->fie_styleobj,$this->fie_attrib,$tabindx);          
								 printf("<option value='-1'>---Seleccionar--</option>");  
								 $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->sendvar["$this->fie_sendvar"],$this->fie_sqlorder);
								 printf("</select> </div>%s",$this->fie_txtextra);
								 echo '<div id=bt style=float:left><input name="oc'.$nombre_campo.'"  type="Button" value="IC" onClick="ac'.$nombre_campo.'()";  onfocus=showUser'.$nombre_campo.'("'.$this->fie_style.'","'.$this->fie_title.'","'.$nombre_campo.'","'.$nombre_campo.'","'.$this->fie_styleobj.'","'.$this->fie_attrib.'","'.$tabindx.'","'.$this->fie_tabledb.'","'.$this->fie_datadb.'","'.$this->contenid[$nombre_campo].'","'.$this->fie_sqlorder.'")></div></td></tr>';
			
				
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
		printf("<tr><td valign='top'><div  class='%s'><b>%s</b></div></td><td> &nbsp;</td><td class='txtextra' valign=top>%s&nbsp;%s %s</td></tr>",$this->fie_style,$this->fie_title,$this->fie_txtizq,$rmp,$this->fie_txtextra);
		}
		}
		//Fin impresión
		}
?>
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
					printf("<div class='%s'> %s</div><div id='txtHint%s' style='float:left'>",$this->fie_style,$this->fie_title,$nombre_campo);          					 
				    printf("<input name='%s' type='text' class='%s'  value='%s' maxlength='%s' %s size='%s' > ",$nombre_campo,$this->fie_styleobj,$this->contenid[$nombre_campo],$len,$this->fie_attrib,$this->fie_lencampo);
 				    printf("</div> %s",$this->fie_txtextra);								 
					echo '<div id=bt style=float:left><input name="oc'.$nombre_campo.'"  type="Button" value="Subir" onClick=subirarchiv("'.$nombre_campo.'") class='.$this->fie_styleobj.'> </div><a href="'.$this->contenid[$nombre_campo].'" target="_blank" ><img src="libreria/campos/imgtxtarchivo/descarga.jpg" width="20" height="21" border="0"></a>';
								
				}
				else
				{
					printf("<div class='%s'> %s</div><div id='txtHint%s' style='float:left'>",$this->fie_style,$this->fie_title,$nombre_campo);          					 
				    printf("<input name='%s' type='text' class='%s'  value='%s' maxlength='%s' %s size='%s' > ",$nombre_campo,$this->fie_styleobj,$this->sendvar["$this->fie_sendvar"],$len,$this->fie_attrib,$this->fie_lencampo);
 				    printf("</div> %s",$this->fie_txtextra);								 
					echo '<div id=bt style=float:left><input name="oc'.$nombre_campo.'"  type="Button" value="Subir" onClick=subirarchiv("'.$nombre_campo.'") class='.$this->fie_styleobj.'></div>';
								
			
				
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
		$rmp= "Archivo";
		printf("<div  class='%s'><b>%s</b></div>%s%s %s",$this->fie_style,$this->fie_title,$this->fie_txtizq,$rmp,$this->fie_txtextra);
		}
		}
		//Fin impresión
		}
?>
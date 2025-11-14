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
             printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td></td><td><div  class='%s'> %s</div></td><td class='txtextra'><input name='%s' type='text' class='%s'  value='%s' maxlength='%s' %s size='%s' %s readonly=0>  %s</td></tr>",$this->fie_style,$this->fie_title,$this->fie_style,$this->fie_txtizq,$nombre_campo,$this->fie_styleobj,$this->contenid[$nombre_campo],$len,$this->fie_attrib,$this->fie_lencampo,$tabindx,$this->fie_txtextra);
           }
		  else
           {
				if ($this->fie_sendvar)				
				 { 
					 printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td></td><td><div  class='%s'> %s</div></td><td class='txtextra'><input name='%s' type='text' class='%s'  value='%s' maxlength='%s' %s size='%s' %s readonly=0> %s</td></tr>",$this->fie_style,$this->fie_title,$this->fie_style,$this->fie_txtizq,$nombre_campo,$this->fie_styleobj,$this->sendvar[$this->fie_sendvar],$len,$this->fie_attrib,$this->fie_lencampo,$tabindx,$this->fie_txtextra);
				  }
				 else
				  {
					if ($this->dedatos)
					{
					   printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td></td><td><div  class='%s'> %s</div></td><td class='txtextra'><input name='%s' type='text' class='%s'  value='%s' maxlength='%s' %s size='%s' %s readonly=0> %s</td></tr>",$this->fie_style,$this->fie_title,$this->fie_style,$this->fie_txtizq,$nombre_campo,$this->fie_styleobj,$this->contenid[$nombre_campo],$len,$this->fie_attrib,$this->fie_lencampo,$tabindx,$this->fie_txtextra);
					}  
					else
					{
					  //Aleatorio
					srand($this->crear_semilla());					
					// Generamos la clave
					
					$clave="";
					$max_chars = round(rand($this->fie_naleatorio,$this->fie_naleatorio));  // tendrá entre 7 y 10 caracteres
					$chars = array();
					for ($ia="a"; $ia<"z"; $ia++) $chars[] = $ia;  // creamos vector de letras
					$chars[] = "z";
					for ($ic=0; $ic<$max_chars; $ic++) {
						$clave .= round(rand(0, 9));
						$letras.= $chars[round(rand(0, 28))];
					}
                             $an=date("Ymd");
							 //strtoupper($letras).
	 			     $aleat=$clave; 
					
					  printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td></td><td><div  class='%s'> %s</div></td><td class='txtextra'><input name='%s' type='text' class='%s'  value='%s' maxlength='%s' %s size='%s' %s readonly=0> %s</td></tr>",$this->fie_style,$this->fie_title,$this->fie_style,$this->fie_txtizq,$nombre_campo,$this->fie_styleobj,$aleat,$len,$this->fie_attrib,$this->fie_lencampo,$tabindx,$this->fie_txtextra);
					
					}
				  }  
           }
           //Fin no impresión
		   }
		   else
		   {
		   //Impresión
		   if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		   if ($this->contenid[$nombre_campo]<>'')
		{
				printf("<tr><td valign='top'><div  class='%s'><b>%s</b></div></td><td> </td><td class='txtextra'>%s%s  %s</td></tr>",$this->fie_styleobj,$this->fie_title,$this->fie_txtizq,$this->contenid[$nombre_campo],$this->fie_txtextra);		   
		 }  
		   //Impresión
		   }
		   
		?>
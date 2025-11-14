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
             
			 echo $this->fie_title." ".$this->fie_txtizq."<input name='".$nombre_campo."' type='text' class='".$this->fie_styleobj."'  value='".$this->contenid[$nombre_campo]."' maxlength='".$len."' ".$this->fie_attrib." size='".$this->fie_lencampo."'  >".$this->fie_txtextra;
			 
           }
		  else
           {
         	if ($this->fie_sendvar)				
             { 
			 echo $this->fie_title." ".$this->fie_txtizq."<input name='".$nombre_campo."' type='text' class='".$this->fie_styleobj."'  value='".$this->sendvar[$this->fie_sendvar]."' maxlength='".$len."' ".$this->fie_attrib." size='".$this->fie_lencampo."'  >".$this->fie_txtextra;
				 
              }
             else
              {
			    if ($this->dedatos)
				{
			      echo $this->fie_title." ".$this->fie_txtizq."<input name='".$nombre_campo."' type='text' class='".$this->fie_styleobj."'  value='".$this->contenid[$nombre_campo]."' maxlength='".$len."' ".$this->fie_attrib." size='".$this->fie_lencampo."' >".$this->fie_txtextra;				   
				}  
				else
				{
                   echo $this->fie_title." ".$this->fie_txtizq."<input name='".$nombre_campo."' type='text' class='".$this->fie_styleobj."'  value='".$this->fie_value."' maxlength='".$len."' ".$this->fie_attrib." size='".$this->fie_lencampo."' >".$this->fie_txtextra;				   				  
				  
				
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
				printf("<b>%s</b>%s%s  %s",$this->fie_title,$this->fie_txtizq,$this->contenid[$nombre_campo],$this->fie_txtextra);		   
				
		 }
		 
		 }  
		   //Impresión
		   
		   
		   
		   }
?>
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
			 if($this->fie_inactivoftabla)
			{
			echo '<textarea name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" rows="'.$this->fie_lineas.'" wrap="VIRTUAL" '.$this->fie_attrib.' cols="'.$this->fie_lencampo.'" >'.$this->contenid[$nombre_campo].'</textarea>';
			}
			else
			{
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >			 
			 <textarea name="'.$nombre_campo.'" class="'.$this->fie_styleobj.'"  id="'.$nombre_campo.'"  rows="'.$this->fie_lineas.'" wrap="VIRTUAL" '.$this->fie_attrib.' cols="'.$this->fie_lencampo.'" >'.$this->contenid[$nombre_campo].'</textarea>
			 '.$this->fie_txtextra.'</td>
			</tr>';			
			}
			
           }
          else
  		   {
            if ($this->fie_sendvar)				
             {
 				  
			  
			   if($this->fie_inactivoftabla)
			{
			echo '<textarea name="'.$nombre_campo.'" class="'.$this->fie_styleobj.'"  id="'.$nombre_campo.'"  rows="'.$this->fie_lineas.'" wrap="VIRTUAL" '.$this->fie_attrib.' cols="'.$this->fie_lencampo.'" >'.$this->sendvar["$this->fie_sendvar"].'</textarea>';
			}
			else
			{
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >			 
			 <textarea name="'.$nombre_campo.'" class="'.$this->fie_styleobj.'"  id="'.$nombre_campo.'"  rows="'.$this->fie_lineas.'" wrap="VIRTUAL" '.$this->fie_attrib.' cols="'.$this->fie_lencampo.'" >'.$this->sendvar["$this->fie_sendvar"].'</textarea>
			 '.$this->fie_txtextra.'</td>	
			 </tr>';			
			}
			  
			  
			  
			  
			  
             }
            else
             {  
 
			  
			     if($this->fie_inactivoftabla)
			{
			echo '<textarea name="'.$nombre_campo.'" class="'.$this->fie_styleobj.'"  id="'.$nombre_campo.'"  rows="'.$this->fie_lineas.'" wrap="VIRTUAL" '.$this->fie_attrib.' cols="'.$this->fie_lencampo.'" >'.$this->fie_value.'</textarea>';
			}
			else
			{
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'"  nowrap="nowrap" >			 
			 <textarea name="'.$nombre_campo.'" class="'.$this->fie_styleobj.'"  id="'.$nombre_campo.'"  rows="'.$this->fie_lineas.'" wrap="VIRTUAL" '.$this->fie_attrib.' cols="'.$this->fie_lencampo.'" >'.$this->fie_value.'</textarea>
			 '.$this->fie_txtextra.'</td>	
			 </tr>';			
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
		
		 if($this->fie_inactivoftabla)
			{
			echo $this->contenid[$nombre_campo];
			}
			else
			{
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->contenid[$nombre_campo].' '.$this->fie_txtextra.'</td>	
			 </tr>';			
			}
		
		
		
			   
		}
		}
		//Fin impresión
		}
?>
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
			 echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" readonly=0 >';
			}
			else
			{			 
			 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" readonly=0 >
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
			 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->sendvar[$this->fie_sendvar].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" readonly=0 >';
			}
			else
			{			 
			 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->sendvar[$this->fie_sendvar].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" readonly=0 >
			 '.$this->fie_txtextra.'</td>			 
			 </tr>';
			 }
				 
				 
				 
              }
             else
              {
			    if ($this->dedatos)
				{
				   		   
				   
				   if($this->fie_inactivoftabla)
			{
			 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" readonly=0 >';
			}
			else
			{			 
			 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" readonly=0 >
			 '.$this->fie_txtextra.'</td>			 
			 </tr>';
			 }
				   
				   
				   
				   
				}  
				else
				{
							  
				  
				  if($this->fie_inactivoftabla)
			{
			 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->fie_value.'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" readonly=0 >';
			}
			else
			{			 
			 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->fie_value.'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" readonly=0 >
			 '.$this->fie_txtextra.'</td>			 
			 </tr>';
			 }
				  
				  
				  
				
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
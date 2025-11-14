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
			 echo '<input name="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >';
			}
			else
			{
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'"  >';
			
			 echo  '<input type="reset" value=" ... " onclick= "return ';
			 echo  "showCalendar('".$nombre_campo."', '%Y-%m-%d', '24', true)";
			 echo '"; >'.$this->fie_txtextra.'</td>			 
			 </tr>';		
			}
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
		   	
        }
		  else
           {
         	if ($this->fie_sendvar)				
             { 
                				 
			if($this->fie_inactivoftabla)
			{
			 echo '<input name="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->sendvar[$this->fie_sendvar].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >';
			}
			else
			{
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->sendvar[$this->fie_sendvar].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'"  >';
			
			 echo  '<input type="reset" value=" ... " onclick= "return ';
			 echo  "showCalendar('".$nombre_campo."', '%Y-%m-%d', '24', true)";
			 echo '"; >'.$this->fie_txtextra.'</td>			 
			 </tr>';		
			}
				 
				  
				 
				 
				 
					 	  
			  }
             else
              {
			    if ($this->dedatos)
				{
				  
		 if($this->fie_inactivoftabla)
			{
			 echo '<input name="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >';
			}
			else
			{
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'"  >';
			
			 echo  '<input type="reset" value=" ... " onclick= "return ';
			 echo  "showCalendar('".$nombre_campo."', '%Y-%m-%d', '24', true)";
			 echo '"; >'.$this->fie_txtextra.'</td>			 
			 </tr>';		
			}
					 
					 
					 
					 
				   
				}  
				else
				{
				                     
			 
					  if($this->fie_inactivoftabla)
			{
			 echo '<input name="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->fie_value.'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >';
			}
			else
			{
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->fie_value.'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'"  >';
			
			 echo  '<input type="reset" value=" ... " onclick= "return ';
			 echo  "showCalendar('".$nombre_campo."', '%Y-%m-%d', '24', true)";
			 echo '"; >'.$this->fie_txtextra.'</td>			 
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
		   //Impresión
		   
		   
		   
		   }
?>
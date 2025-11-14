<?php

if (!($this->imprpt))
	   {
	   
	   ////////////////////////////////////////////////////
if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
       if (!($this->contenid[$nombre_campo]==""))
           {						
             if ($this->fie_value=="replace")
				{
				   $valorbus=$this->contenid[$nombre_campo];
			       $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$valorbus,$DB_gogess);  
			     
				  if($this->fie_inactivoftabla)
			{  
			
			if(!($this->pdfformato))
			{
				   echo '<input name="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$rmp.'</div>';
			 }
			 $this->varible_pdf.='<input name="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$rmp.'</div>';
			 
			 }
			 else
			 {
			 
			 if(!($this->pdfformato))
			{
			 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$rmp.'</div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" ></td>	
			 </tr>';
			 }
			 
			 $this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$rmp.'</div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" ></td>	
			 </tr>';
			 
			 
			 }
				   
				}
				else
				{
				  
					  if($this->fie_inactivoftabla)
			{   
			
			if(!($this->pdfformato))
			{
			 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$this->contenid[$nombre_campo].'</div>';
			 }
			 
			 $this->varible_pdf.='<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$this->contenid[$nombre_campo].'</div>';
			 
			 
			}
			else
			{
			
			if(!($this->pdfformato))
			{
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden"  id="'.$nombre_campo.'"  value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$this->contenid[$nombre_campo].'</div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" ></td>	
			 </tr>';
			}
			 
			 $this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden"  id="'.$nombre_campo.'"  value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$this->contenid[$nombre_campo].'</div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" ></td>	
			 </tr>';
			 
			 
			
			}	  
				  
				  
				  
				}   
           }
        else
          {
            if ($this->fie_sendvar)				
             {  
			    if ($this->fie_value=="replace")
				{
				
						  if($this->fie_inactivoftabla)
			{ 
				  $valorbus=$this->sendvar["$this->fie_sendvar"];
			      $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$valorbus,$DB_gogess);  				  
		  	 if(!($this->pdfformato))
			{ 
			 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">
			 <div class="cuadrot">'.$rmp.'</div>';
			 }
			 
			 $this->varible_pdf.='<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">
			 <div class="cuadrot">'.$rmp.'</div>';
			 
			 
			}
			else
			{
			 $valorbus=$this->sendvar["$this->fie_sendvar"];
			      $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$valorbus,$DB_gogess);  				  
		  	 if(!($this->pdfformato))
			{ 
			 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">
			 <div class="cuadrot">'.$rmp.'</div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" ></td>	
			 </tr>';
			}
			
			$this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">
			 <div class="cuadrot">'.$rmp.'</div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" ></td>	
			 </tr>';
			
			
			}	  
				  
				  
				}
				else
				{
			  
							  if($this->fie_inactivoftabla)
			{  
			if(!($this->pdfformato))
			{ 
				  echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">
			 <div class="cuadrot">'.$this->sendvar["$this->fie_sendvar"].'</div>';
			} 
			 $this->varible_pdf.='<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">
			 <div class="cuadrot">'.$this->sendvar["$this->fie_sendvar"].'</div>';
			 
			 
				  }
				  else
				  {
				  if(!($this->pdfformato))
			{
				  echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">
			 <div class="cuadrot">'.$this->sendvar["$this->fie_sendvar"].'</div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" ></td>	
			 </tr>';
			}	  
				  
				  $this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">
			 <div class="cuadrot">'.$this->sendvar["$this->fie_sendvar"].'</div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" ></td>	
			 </tr>';
				  
				  
				  }
				  
				  			
				}
             }
            else
             {
								  if($this->fie_inactivoftabla)
			{   
			
			if(!($this->pdfformato))
			{ 
			   echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->fie_value.'">
			 <div class="cuadrot">'.$this->fie_value.'</div>';
			}
			 
			  $this->varible_pdf.='<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->fie_value.'">
			 <div class="cuadrot">'.$this->fie_value.'</div>';
			 
			  }
			  else
			  {
			  
			  if(!($this->pdfformato))
			{
			    echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->fie_value.'">
			 <div class="cuadrot">'.$this->fie_value.'</div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" ></td>	
			 </tr>';
			  }
			  
			  $this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->fie_value.'">
			 <div class="cuadrot">'.$this->fie_value.'</div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" ></td>	
			 </tr>';
			  
			  
			  }
			  
			  
             }   
         
		  }
		  
		  }
		  else
		  {
		  
		     if ($this->fie_value=="replace")
				{
				   $valorbus=$this->contenid[$nombre_campo];
			       $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$valorbus,$DB_gogess);  

				   					  if($this->fie_inactivoftabla)
			{
			
			if(!($this->pdfformato))
			{
				     echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$rmp.'</div>';
			 }
			 
			 $this->varible_pdf.='<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$rmp.'</div>';
			 
			 
				}
				else
				{
				
				if(!($this->pdfformato))
			{
				 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$rmp.'</div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" ></td>	
			 </tr>';
				}
				
				$this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$rmp.'</div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" ></td>	
			 </tr>';
				
				
				}   
				   
				   
				}
				else
				{
			  	   					  if($this->fie_inactivoftabla)
			{
			
			if(!($this->pdfformato))
			{
				      echo '<input name="'.$nombre_campo.'"   id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$this->contenid[$nombre_campo].'</div>';
			}
			 
			 $this->varible_pdf.='<input name="'.$nombre_campo.'"   id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$this->contenid[$nombre_campo].'</div>';
			 
			 
				}
				else
				{
				
				if(!($this->pdfformato))
			{
				 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$this->contenid[$nombre_campo].'</div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" ></td>	
			 </tr>';
				}
				
				$this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot">'.$this->contenid[$nombre_campo].'</div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" ></td>	
			 </tr>';
				
				
				}  
				  
				}  
		     
		  
		  }
		  
		  
		  
?>
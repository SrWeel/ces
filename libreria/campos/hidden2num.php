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
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$rmp.'</span></div></div>';
			 }
			 $this->varible_pdf='<input name="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$rmp.'</span></div></div>';
			 
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
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$rmp.'</span></div></div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
			 </tr>';
			 }
			 
			 $this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$rmp.'</span></div></div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
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
			 <div class="cuadrot"><span class="currencyLabel">'.$this->contenid[$nombre_campo].'</span></div>';
			 }
			 
			 $this->varible_pdf.='<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot"><span class="currencyLabel">'.$this->contenid[$nombre_campo].'</span></div>';
			 
			 
			}
			else
			{
			
			if(!($this->pdfformato))
			{
			
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden"   value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$this->contenid[$nombre_campo].'</span></div></div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
			 </tr>';
			}
			 
			 $this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden"   value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$this->contenid[$nombre_campo].'</span></div></div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
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
			 <div class="cuadrot"><span class="currencyLabel">'.$rmp.'</span></div>';
			 }
			 
			 $this->varible_pdf.='<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">
			 <div class="cuadrot"><span class="currencyLabel">'.$rmp.'</span></div>';
			 
			 
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
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$rmp.'</span></div></div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
			 </tr>';
			}
			
			$this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$rmp.'</span></div></div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
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
			 <div class="cuadrot"><span class="currencyLabel">'.$this->sendvar["$this->fie_sendvar"].'</span></div>';
			} 
			 $this->varible_pdf.='<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">
			 <div class="cuadrot"><span class="currencyLabel">'.$this->sendvar["$this->fie_sendvar"].'</span></div>';
			 
			 
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
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$this->sendvar["$this->fie_sendvar"].'</span></div></div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
			 </tr>';
			}	  
				  
				  $this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$this->sendvar["$this->fie_sendvar"].'</span></div></div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
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
			 <div class="cuadrot"><span class="currencyLabel">'.$this->fie_value.'</span></div>';
			}
			 
			  $this->varible_pdf.='<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->fie_value.'">
			 <div class="cuadrot"><span class="currencyLabel">'.$this->fie_value.'</span></div>';
			 
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
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$this->fie_value.'</span></div></div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
			 </tr>';
			  }
			  
			  $this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->fie_value.'">
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$this->fie_value.'</span></div></div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
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
			 <div class="cuadrot"><span class="currencyLabel">'.$rmp.'</span></div>';
			 }
			 
			 $this->varible_pdf.='<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot"><span class="currencyLabel">'.$rmp.'</span></div>';
			 
			 
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
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$rmp.'</span></div></div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
			 </tr>';
				}
				
				$this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$rmp.'</span></div></div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
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
			 <div class="cuadrot"><span class="currencyLabel">'.$this->contenid[$nombre_campo].'</span></div>';
			}
			 
			 $this->varible_pdf.='<input name="'.$nombre_campo.'"   id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot"><span class="currencyLabel">'.$this->contenid[$nombre_campo].'</span></div>';
			 
			 
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
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$this->contenid[$nombre_campo].'</span></div></div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
			 </tr>';
				}
				
				$this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top"  >
			 <input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">
			 <div class="cuadrot"><div id="despliegue_'.$nombre_campo.'"><span class="currencyLabel">'.$this->contenid[$nombre_campo].'</span></div></div>
			 </td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
			 </tr>';
				
				
				}  
				  
				}  
		     
		  
		  }
		  
		  
		  
?>
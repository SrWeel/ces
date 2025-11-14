<?php
if(trim($this->fie_archivo))
{
$archivover=' <a href="archivo/'.$this->fie_archivo.'" target="_blank" ><img src="libreria/campos/imgtxtarchivo/descarga.jpg" width="20" height="21" border="0"></a>';
}
else
{
$archivover='';
}

 if (!($this->imprpt))
	   {
	   //No impresión
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
       if (!($this->contenid[$nombre_campo]==""))
           {						
            		 
			if(!($this->pdfformato))
			{
			 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'"></td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >';
			 
			echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">';
					 
			 echo $this->fie_txtextra.$archivover.'</td>			 
			 </tr>';
			 }
			 
			 
			 $this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'"></td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">'.$this->fie_txtextra.$archivover.'</td>			 
			 </tr>';
			 
			 
			 
           }
        else
          {
           
		    if ($this->fie_sendvar)				
             {          
			 
			 if(!($this->pdfformato))
			{
			  echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'"></td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >';
			 
			echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">';
					 
			 echo $this->fie_txtextra.$archivover.'</td>			 
			 </tr>';
			  }
			  
			  $this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'"></td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">'.$this->fie_txtextra.$archivover.'</td>			 
			 </tr>';
			  
			  
			  
			  
             }
            else
             {
			
			   if(!($this->pdfformato))
			{
			   echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'"></td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >';
			 
			echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->fie_value.'">';
					 
			 echo $this->fie_txtextra.$archivover.'</td>			 
			 </tr>';
			  }
			  
			    $this->varible_pdf.='<tr>
			 <td valign="top" class="'.$this->fie_style.'"></td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >
			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->fie_value.'">'.$this->fie_txtextra.$archivover.'</td>			 
			 </tr>';
				
				
			  
			  
			  
             } 
			 
			 
			 
			    
          }
		  //Fin no impresión
		  }

?>
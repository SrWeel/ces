<?php
$comillas='"';
$len=$this->field_maxcaracter;

if($this->fie_placeholder)
{
$placeholder=$this->fie_placeholder;
}else
{
$placeholder=$this->fie_title;

}

if (!($this->imprpt))
	   {
         //No impresi�n	  
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!(@$this->contenid[$nombre_campo]==""))
           {						
		 
		    if($this->fie_inactivoftabla)
			{
			 echo $this->fie_title.'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
			}
			else
			{
			 echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-5">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
			 echo '<div class="col-xs-5">';
			 echo '<input placeholder="'.utf8_encode($placeholder).'" name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
	         echo '<script>
			 $("#'.$nombre_campo.'").wickedpicker({twentyFour: true,now:"'.$this->contenid[$nombre_campo].'"});	
			 </script>
			 ';
			
			 
			} 
			 
           }
		  else
           {
         	if ($this->fie_sendvar)				
             { 
               		
					
			if($this->fie_inactivoftabla)
			{
			  echo $this->fie_title.'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->sendvar[$this->fie_sendvar].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
			}
			else
			{			 
			
			
			 echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-5">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
			 echo '<div class="col-xs-5">';
			 echo '<input placeholder="'.utf8_encode($placeholder).'" name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->sendvar[$this->fie_sendvar].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
			 echo '<script>
			 $("#'.$nombre_campo.'").wickedpicker({twentyFour: true,now:"'.$this->sendvar[$this->fie_sendvar].'"});	
			 </script>
			 ';
			 
			
			}	 
				 
				 
              }
             else
              {
			    if (@$this->dedatos)
				{
				
				if($this->fie_inactivoftabla)
			{			
		    echo $this->fie_title.'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
			}
			else
			{
			
			
			 echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-5">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
			 echo '<div class="col-xs-5">';
			 echo '<input placeholder="'.utf8_encode($placeholder).'" name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
			 echo '<script>
			 $("#'.$nombre_campo.'").wickedpicker({twentyFour: true,now:"'.$this->contenid[$nombre_campo].'"});	
			 </script>
			 ';
			 
			  
			}	   
				   
				}  
				else
				{
				  
				  	if($this->fie_inactivoftabla)
			{	
				  
				  echo $this->fie_title.'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->fie_value.'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
			}
			else
			{
				
			
             echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-5">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
			 echo '<div class="col-xs-5">';
			 echo '<input placeholder="'.utf8_encode($placeholder).'" name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->fie_value.'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
			 echo '<script>
			 $("#'.$nombre_campo.'").wickedpicker({twentyFour: true,now:"'.$this->fie_value.'"});	
			 </script>
			 ';
 
			
			
			}	  
				  
				
				}
              }  
           }
           //Fin no impresi�n
		   }
		   else
		   {
		   //Impresion
		   		
			if($this->fie_inactivoftabla)
			{
			   echo $this->contenid[$nombre_campo];
			}
			else
			{
			 echo '<div class="form-group">';
			 echo'<div class="col-xs-5" align="right" ><b>'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</b></div>';
			 echo '<div class="col-xs-5">';
			 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">';	
			 echo $this->contenid[$nombre_campo];
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
	         echo '<script>
			 $("#'.$nombre_campo.'").wickedpicker({twentyFour: true,now:"'.$this->contenid[$nombre_campo].'"});	
			 </script>
			 ';
			
			 
			} 
				
				 
		   //Impresion
		   
		   
		   
		   }
?>
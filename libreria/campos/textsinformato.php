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
		 
		   
			 echo $this->fie_title.'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
			
			
			 
           }
		  else
           {
         	if ($this->fie_sendvar)				
             { 
               		
					
			
			  echo $this->fie_title.'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->sendvar[$this->fie_sendvar].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
		
			 
				 
				 
              }
             else
              {
			    if (@$this->dedatos)
				{
				
					
		    echo $this->fie_title.'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
			
				   
				   
				}  
				else
				{
				  
			
				  
				  echo $this->fie_title.'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->fie_value.'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
			
				  
				  
				
				}
              }  
           }
           //Fin no impresi�n
		   }
		   else
		   {
		   //Impresi�n
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
			 
			 echo $this->fie_title.$this->contenid[$nombre_campo];
			 
			 
			 }
					   
		 }
		 
		 }  
		   //Impresi�n
		   
		   
		   
		   }
?>
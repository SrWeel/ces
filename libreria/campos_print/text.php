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
			 echo'<label class="control-label col-xs-3">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
			 echo '<div class="col-xs-7">';
			 echo '<input placeholder="'.utf8_encode($placeholder).'" name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
			 //campos concatenados
			/* if(@$this->fie_id)
			 {
			 $buscaconcatenacion="select * from  gogess_sisfieldconcatena where fie_id=".@$this->fie_id;
			 $rs_buscacampoc = $DB_gogess->executec($buscaconcatenacion,array());
			 if($rs_buscacampoc)
			 {
			    while (!$rs_buscacampoc->EOF) 
				{
				   
				    $this->generar_formulario_campossolos($rs_buscacampoc->fields["tab_name"],$rs_buscacampoc->fields["fieenlace_id"],$DB_gogess);
				   $rs_buscacampoc->MoveNext();
				}
			 }
			 }*/
			 //campos concatenados
			
			 
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
			 echo'<label class="control-label col-xs-3">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
			 echo '<div class="col-xs-7">';
			 echo '<input placeholder="'.utf8_encode($placeholder).'" name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->sendvar[$this->fie_sendvar].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
			 
			
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
			 echo'<label class="control-label col-xs-3">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
			 echo '<div class="col-xs-7">';
			 echo '<input placeholder="'.utf8_encode($placeholder).'" name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
			 
			  
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
			 echo'<label class="control-label col-xs-3">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
			 echo '<div class="col-xs-7">';
			 echo '<input placeholder="'.utf8_encode($placeholder).'" name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->fie_value.'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
 
			
			
			}	  
				  
				
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
		
			
			 echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-3">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
			 echo '<div class="col-xs-7">';
			 echo $this->contenid[$nombre_campo];
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
			
			 
			 
			 }
					   
		 }
		 
		 }  
		   //Impresi�n
		   
		   
		   
		   }
?>
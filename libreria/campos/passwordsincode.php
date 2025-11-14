<?php

if (!($this->imprpt))
	   {
	   
if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!(@$this->contenid[$nombre_campo]==""))
           {
         	 
			if($this->fie_inactivoftabla)
			{
			 echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="password" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.@$len.'" '.$this->fie_attrib.'  >';			 
			 echo '<input name="'.$nombre_campo.'1" id="'.$nombre_campo.'1" type="password" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.@$len.'" '.$this->fie_attrib.'  >';
			 }
			 else
			 {
			 
			 
			 echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-3">'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</label>';
			 echo '<div class="col-xs-7">';
			 echo '<input placeholder="'.$this->fie_title.'" name="'.$nombre_campo.'" id="'.$nombre_campo.'"  type="password" class="'.$this->fie_styleobj.'"  value="" maxlength="'.@$len.'" '.$this->fie_attrib.'  >';
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
			 
			 
			 echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-3"> Confirmar '.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</label>';
			 echo '<div class="col-xs-7">';
			 echo '<input placeholder="Confirmar '.$this->fie_title.'" name="'.$nombre_campo.'1" id="'.$nombre_campo.'1"  type="password" class="'.$this->fie_styleobj.'"  value="" maxlength="'.@$len.'" '.$this->fie_attrib.'  >';
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
			 echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'"  type="password" class="'.$this->fie_styleobj.'"  maxlength="'.$len.'" '.$this->fie_attrib.'  >';
			 
			 echo '<input name="'.$nombre_campo.'1" id="'.$nombre_campo.'1"  type="password" class="'.$this->fie_styleobj.'"  maxlength="'.$len.'" '.$this->fie_attrib.'  >';
			 }
			 else
			 {
			 
			  echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-3">'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</label>';
			 echo '<div class="col-xs-7">';
			 echo '<input placeholder="'.$this->fie_title.'" name="'.$nombre_campo.'" id="'.$nombre_campo.'"  type="password" class="'.$this->fie_styleobj.'"  value="" maxlength="'.@$len.'" '.$this->fie_attrib.'  >';
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
			 
			 
			 echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-3"> Confirmar '.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</label>';
			 echo '<div class="col-xs-7">';
			 echo '<input placeholder="Confirmar '.$this->fie_title.'" name="'.$nombre_campo.'1" id="'.$nombre_campo.'1"  type="password" class="'.$this->fie_styleobj.'"  value="" maxlength="'.@$len.'" '.$this->fie_attrib.'  >';
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
				//printf("<tr><td valign='top'><div  class='%s'><b>%s</b></div></td><td> </td><td class='txtextra'>%s%s  %s</td></tr>",$this->fie_style,$this->fie_title,$this->fie_txtizq,$this->contenid[$nombre_campo],$this->fie_txtextra);		   
		 }
		 
		 }  
		   //Impresión
		   
		   
		   }
?>
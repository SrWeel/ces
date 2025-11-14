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
			 
			 
			 echo '<div class="form-group">';
			 echo '<div class="col-xs-5">';
			 echo '<input placeholder="'.utf8_encode($placeholder).'" name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
             echo '</div>';
			 echo '<div class="col-xs-5">';
			 echo '<textarea class="'.$this->fie_styleobj.'" name="'.$nombre_campo.'_visorcie" cols="30" id="'.$nombre_campo.'_visorcie"></textarea>';
			 echo '</div>';
			 echo '<div class="col-xs-2">';
			 echo '<input class="'.$this->fie_styleobj.'" name="'.$nombre_campo.'_btnag" type="button" id="'.$nombre_campo.'_btnag" value="Agregar" onclick="'.$nombre_campo.'_agregar()" />';
			 echo '</div>';
			 echo '</div>';
			 
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
			 
			 
			 
			 
			 
			 echo '<div class="form-group">';
			 echo '<div class="col-xs-5">';
			 echo '<input placeholder="'.utf8_encode($placeholder).'" name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->sendvar[$this->fie_sendvar].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
             echo '</div>';
			 echo '<div class="col-xs-5">';
			 echo '<textarea class="'.$this->fie_styleobj.'" name="'.$nombre_campo.'_visorcie" cols="30" id="'.$nombre_campo.'_visorcie"></textarea>';
			 echo '</div>';
			 echo '<div class="col-xs-2">';
			 echo '<input class="'.$this->fie_styleobj.'" name="'.$nombre_campo.'_btnag" type="button" id="'.$nombre_campo.'_btnag" value="Agregar" onclick="'.$nombre_campo.'_agregar()" />';
			 echo '</div>';
			 echo '</div>';
			 
			 
			 
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
			 
			 
			 
			 
			 echo '<div class="form-group">';
			 echo '<div class="col-xs-5">';
			 echo '<input placeholder="'.utf8_encode($placeholder).'" name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
             echo '</div>';
			 echo '<div class="col-xs-5">';
			 echo '<textarea class="'.$this->fie_styleobj.'" name="'.$nombre_campo.'_visorcie" cols="30" id="'.$nombre_campo.'_visorcie"></textarea>';
			 echo '</div>';
			 echo '<div class="col-xs-2">';
			 echo '<input class="'.$this->fie_styleobj.'" name="'.$nombre_campo.'_btnag" type="button" id="'.$nombre_campo.'_btnag" value="Agregar" onclick="'.$nombre_campo.'_agregar()" />';
			 echo '</div>';
			 echo '</div>';
			 
			 
			 
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
			 
			 
			 
			 echo '<div class="form-group">';
			 echo '<div class="col-xs-5">';
			 echo '<input placeholder="'.utf8_encode($placeholder).'" name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->fie_value.'" maxlength="'.$len.'" '.str_replace("chr39","'",$this->fie_attrib).'  >';
             echo '</div>';
			 echo '<div class="col-xs-5">';
			 echo '<textarea class="'.$this->fie_styleobj.'" name="'.$nombre_campo.'_visorcie" cols="30" id="'.$nombre_campo.'_visorcie"></textarea>';
			 echo '</div>';
			 echo '<div class="col-xs-2">';
			 echo '<input class="'.$this->fie_styleobj.'" name="'.$nombre_campo.'_btnag" type="button" id="'.$nombre_campo.'_btnag" value="Agregar" onclick="'.$nombre_campo.'_agregar()" />';
			 echo '</div>';
			 echo '</div>';
			 
			 
			 
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
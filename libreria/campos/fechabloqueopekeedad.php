<?php

$comillas='"';
$len=$this->field_maxcaracter;


if (!($this->imprpt))
	   {

         //No impresión	  

		if (!($this->fie_tactive))
        {

			$this->fie_title="";

		}

		  if (!(@$this->contenid[$nombre_campo]==""))
           {						

		    if($this->fie_inactivoftabla)
			{
            
			 echo $this->fie_title.$this->fecha_bloqueedad("Y-m-d",$nombre_campo,$this->contenid[$nombre_campo],$this->txtobligatorio).'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"  value="'.$this->contenid[$nombre_campo].'"  >';

			}
			else
         {
		 
		     echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-5">'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</label>';
			 echo '<div class="col-xs-5">';
			 echo $this->fecha_bloqueedad("d-m-Y",$nombre_campo,$this->contenid[$nombre_campo],$this->txtobligatorio);
             echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"   value="'.$this->contenid[$nombre_campo].'" >';
			 echo '<div id="edad'.$nombre_campo.'" >Edad:</div>';
			 echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" > </div>';
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

			  echo $this->fie_title.$this->fecha_bloqueedad("Y-m-d",$nombre_campo,$this->sendvar[$this->fie_sendvar],$this->txtobligatorio).'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"  value="'.$this->sendvar[$this->fie_sendvar].'"  >';

			}

			else

			{			 


             echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-5">'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</label>';
			 echo '<div class="col-xs-5">';
			 echo $this->fecha_bloqueedad("d-m-Y",$nombre_campo,$this->sendvar[$this->fie_sendvar],$this->txtobligatorio);
             echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"  value="'.$this->sendvar[$this->fie_sendvar].'">';
			 echo '<div id="edad'.$nombre_campo.'" >Edad:</div>';
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

		    echo $this->fie_title.$this->fecha_bloqueedad("Y-m-d",$nombre_campo,$this->contenid[$nombre_campo],$this->txtobligatorio).'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"  value="'.$this->contenid[$nombre_campo].'"  >';

			}

			else
           {


             echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-5">'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</label>';
			 echo '<div class="col-xs-5">';
			 echo $this->fecha_bloqueedad("d-m-Y",$nombre_campo,$this->contenid[$nombre_campo],$this->txtobligatorio);
             echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"  value="'.$this->contenid[$nombre_campo].'">';
			 echo '<div id="edad'.$nombre_campo.'" >Edad:</div>';
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

				  

				  echo $this->fie_title.$this->fecha_bloqueedad("Y-m-d",$nombre_campo,$this->fie_value,$this->txtobligatorio).'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"   value="'.$this->fie_value.'"  >';

			}

			else

			{

			 echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-5">'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</label>';
			 echo '<div class="col-xs-5">';
			 echo $this->fecha_bloqueedad("d-m-Y",$nombre_campo,$this->fie_value,$this->txtobligatorio);
             echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden"  value="'.$this->fie_value.'">';
			 echo '<div id="edad'.$nombre_campo.'" >Edad:</div>';
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

			  echo '<tr '.$this->css_fila.' >

			 <td valign="top" class="'.$this->fie_style.'" width="10%" nowrap >'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->contenid[$nombre_campo].' </td>

			</tr>';

			 

			 

			 }

					   

		 }

		 

		 }  

		   //Impresión

		   

		   

		   

		   }

?>
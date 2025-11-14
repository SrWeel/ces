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

				   echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">

			 <div class="cuadrot">'.utf8_encode($rmp).'</div>';

			 }

			 else

			 {

			 echo '<tr>

			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >

			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">

			 <div class="cuadrot">'.utf8_encode($rmp).'</div>

			 </td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	

			 </tr>';

			 

			 

			 }

				   

				}

				else

				{

				  

					  if($this->fie_inactivoftabla)

			{   

			 echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">

			 <div class="cuadrot">'.utf8_encode($this->contenid[$nombre_campo]).'</div>';

			}

			else

			{

			echo '<tr>

			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >

			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">

			 <div class="cuadrot">'.utf8_encode($this->contenid[$nombre_campo]).'</div>

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

		  	  

			 echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">

			 <div class="cuadrot">'.utf8_encode($rmp).'</div>';

			}

			else

			{

			 $valorbus=@$this->sendvar["$this->fie_sendvar"];

			      $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$valorbus,$DB_gogess);  				   echo '<tr>

			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >

			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.@$this->sendvar["$this->fie_sendvar"].'">

			 <div class="cuadrot">'.utf8_encode($rmp).'</div>

			 </td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	

			 </tr>';

			

			

			}	  

				  

				  

				}

				else

				{

			  

							  if($this->fie_inactivoftabla)

			{   

				  echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">

			 <div class="cuadrot">'.$this->sendvar["$this->fie_sendvar"].'</div>';

				  }

				  else

				  {

				  echo '<tr>

			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >

			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'">

			 <div class="cuadrot">'.utf8_encode($this->sendvar["$this->fie_sendvar"]).'</div>

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

			   echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->fie_value.'">

			 <div class="cuadrot">'.$this->fie_value.'</div>';

			  }

			  else

			  {

			    echo '<tr>

			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >

			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->fie_value.'">

			 <div class="cuadrot">'.$this->fie_value.'</div>

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

				     echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">

			 <div class="cuadrot">'.utf8_encode($rmp).'</div>';

				}

				else

				{

				 echo '<tr>

			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >

			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">

			 <div class="cuadrot">'.utf8_encode($rmp).'</div>

			 </td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	

			 </tr>';

				

				

				}   

				   

				   

				}

				else

				{

			  	   					  if($this->fie_inactivoftabla)

			{

				      echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">

			 <div class="cuadrot">'.$this->contenid[$nombre_campo].'</div>';

				}

				else

				{

				 echo '<tr>

			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >

			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'">

			 <div class="cuadrot">'.$this->contenid[$nombre_campo].'</div>

			 </td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	

			 </tr>';

				

				

				}  

				  

				}  

		     

		  

		  }

		  

		  

		  

?>
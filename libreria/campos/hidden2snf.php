<?php
if (!($this->imprpt))
	   {

	   ////////////////////////////////////////////////////



if (!($this->fie_tactive))



        {



			$this->fie_title="";



		}



       if (!(@$this->contenid[$nombre_campo]==""))



           {						



             if ($this->fie_value=="replace")



				{



				   $valorbus=$this->contenid[$nombre_campo];



			       $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$valorbus,$DB_gogess);  



			     



				  if($this->fie_inactivoftabla)



			{  



			 }



			 else



			 {



			 

			 echo '<div class="form-group">';
			 echo '<div class="col-xs-12">';

			 echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value="'.$this->contenid[$nombre_campo].'"><div id="despliegue_'.$nombre_campo.'">'.$rmp.'</div>';

             echo '</div>';
			 echo '</div>';

		 



			 }



				   



				}



				else



				{



				  



					  if($this->fie_inactivoftabla)



			{   





			}



			else



			{



			 echo '<div class="form-group">';
			 echo '<div class="col-xs-12">';

			 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden"   value="'.$this->contenid[$nombre_campo].'"><div id="despliegue_'.$nombre_campo.'">'.$this->contenid[$nombre_campo].'</div>';

             echo '</div>';
			 echo '</div>';

			 

			}	  





				}   



           }



        else



          {



            if ($this->fie_sendvar)				



             {  



			    if (@$this->fie_value=="replace")



				{



				



						  if($this->fie_inactivoftabla)



			{ 



				  $valorbus=$this->sendvar["$this->fie_sendvar"];



			      $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$valorbus,$DB_gogess);  				  



			}



			else



			{



			 $valorbus=@$this->sendvar["$this->fie_sendvar"];



			      $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$valorbus,$DB_gogess);  				  



		  	

			 echo '<div class="form-group">';
			 echo '<div class="col-xs-12">';

			 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.@$this->sendvar[$this->fie_sendvar].'"><div id="despliegue_'.$nombre_campo.'">'.$rmp.'</div>';

             echo '</div>';
			 echo '</div>';

			}	  

				}
				else
				{


			 if($this->fie_inactivoftabla)

			{  

				  }
				  else
				  {



				 

		     echo '<div class="form-group">';
			 echo '<div class="col-xs-12">';
			 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->sendvar["$this->fie_sendvar"].'"><div id="despliegue_'.$nombre_campo.'">'.$this->sendvar["$this->fie_sendvar"].'</div>';

             echo '</div>';
			 echo '</div>';



				  }





				}



             }



            else



             {



			 if($this->fie_inactivoftabla)



			{   



			





			  }



			  else



			  {



			 echo '<div class="form-group">';
			 echo '<div class="col-xs-12">';
			 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->fie_value.'"><div id="despliegue_'.$nombre_campo.'">'.$this->fie_value.'</div>';
             echo '</div>';
			 echo '</div>';

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



				}
				else

				{

	

             echo '<div class="form-group">';
			 echo '<div class="col-xs-12">';
			 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'"><div id="despliegue_'.$nombre_campo.'">'.$rmp.'</div>';
             echo '</div>';
			 echo '</div>';

				}   


				}
				else
				{

			 if($this->fie_inactivoftabla)
			{

				}
				else
				{

             echo '<div class="form-group">';
			 echo '<div class="col-xs-12">';

			 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'"><div id="despliegue_'.$nombre_campo.'">'.$this->contenid[$nombre_campo].'</div>';

             echo '</div>';
			 echo '</div>';

				}  

				}  

		  }


?>
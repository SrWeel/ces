<?php
if (!($this->imprpt))

	   {

	   //No impresión

		if (!($this->fie_tactive))

        {

			$this->fie_title="";

		}

				 

				if (@$this->contenid[$nombre_campo]<>"")	

				{

			

			if($this->fie_inactivoftabla)

			{			 

     		 echo $nombre_campo;

			}

			else

			{

				//echo $nombre_campo."=".$this->contenid[$nombre_campo]."<br>";

			


             echo '<div class="form-group">';
			
			
			 echo'<label class="control-label col-xs-2">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
             
			 
			 echo '</div>';

			

			}					 

								 

								 

				}

				else

				{							 

					

			if($this->fie_inactivoftabla)

			{			 

			echo $nombre_campo;

				}

				else

				{

				

				
			 
			   echo '<div class="form-group">';
			
			
			 echo'<div class="col-xs-12" style="background-color:#000033;color:#FFFFFF" >'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</div>';
           
			 
			 echo '</div>';

			 

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

		$rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$this->contenid[$nombre_campo],$DB_gogess);

		  

		  		if($this->fie_inactivoftabla)

			{	

			echo $rmp;

			 }

			 else

			 {


             echo '<div class="form-group">';
			
			
			 echo'<label class="control-label col-xs-2">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
             
			 
			 echo '</div>';

			 

			 

			 }

	

		}

		}

		//Fin impresión

		}

?>
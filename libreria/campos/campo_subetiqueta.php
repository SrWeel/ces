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
			 echo'<b><hr />'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</b>';
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
			 echo'<b><hr />'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</b>';
			 echo '</div>';


				}				 


				}


		//Fin no impresión



		}
		else
		{

		//Impresion

		
  echo '<div class="form-group">';
			 echo'<b><hr />'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</b>';
			 echo '</div>';

		//Fin impresion



		}



?>
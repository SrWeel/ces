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

			echo '<tr '.$this->css_fila.' >

			 <td colspan="5" >';
			 
			 //include($this->fie_name);
			  if(@$this->sendvar[$this->fie_sendvar])
			  {
			   include(@$this->sendvar[$this->fie_sendvar]);
			  
			  }
			 echo '</td>

			
			 </tr>';	

			

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

				

				echo '<tr '.$this->css_fila.' >

			 <td colspan="5" >';
			  if(@$this->sendvar[$this->fie_sendvar])
			  {
			   include(@$this->sendvar[$this->fie_sendvar]);
			  
			  }
			 echo'</td>		

			 </tr>';

			 

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

			 echo '<tr '.$this->css_fila.' >

			 <td colspan="5" >';
			   if(@$this->sendvar[$this->fie_sendvar])
			  {
			   include(@$this->sendvar[$this->fie_sendvar]);
			  
			  }
			 echo '</td>

			 </tr>';

			 

			 

			 }

	

		}

		}

		//Fin impresión

		}

?>
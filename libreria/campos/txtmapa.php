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

			echo '<div id="txtHint'.$nombre_campo.'" style="float:left">			 

			 <input name="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >			 

			 </div>			 

			 <div id=bt style=float:left><input name="oc'.$nombre_campo.'"  type="Button" value="Subir" onClick=subirarchiv("'.$nombre_campo.'") class='.$this->fie_styleobj.'> </div><a href="archivo/'.$this->contenid[$nombre_campo].'" target="_blank" ><img src="libreria/campos/imgtxtarchivo/descarga.jpg" width="20" height="21" border="0"></a>			 

			 '.$this->fie_txtextra.'';

			}

			else

			{

			$comilla_s="'";
			 
			 echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-3">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
			 echo '<div class="col-xs-7">';
			 
			 echo '<div class="embed-container"><button type="button" class="mb-sm btn btn-primary"  onClick=refreshFrame("myFrameMapa","pruebamapa.php")  style="background-color:#000066"   >Actualizar Mapa</button><iframe
  width="400"
  height="400"
  frameborder="0" style="border:0"
  id="myFrameMapa"
  src="pruebamapa.php" allowfullscreen>
</iframe></div>';
			 
			echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value='.$comillasimple.$this->contenid[$nombre_campo].$comillasimple.'>';
		
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

						echo '<div id="txtHint'.$nombre_campo.'" style="float:left">			 

			 <input name="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->sendvar["$this->fie_sendvar"].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >			 

			 </div>			 

			 <div id=bt style=float:left><input name="oc'.$nombre_campo.'"  type="Button" value="Subir" onClick=subirarchiv("'.$nombre_campo.'") class='.$this->fie_styleobj.'> </div>';

				}

				else

				{

				

			 echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-3">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
			 echo '<div class="col-xs-7">';
			 $comilla_s="'";
			 
			 echo '<div class="embed-container"><button type="button" class="mb-sm btn btn-primary"  onClick=refreshFrame("myFrameMapa","pruebamapa.php")  style="background-color:#000066"   >Actualizar Mapa</button><iframe
  width="400"
  height="400"
  frameborder="0" style="border:0"
  id="myFrameMapa"
  src="pruebamapa.php" allowfullscreen>
</iframe></div>';
			 echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value='.$comillasimple.$this->contenid[$nombre_campo].$comillasimple.'>';
			 
			 
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

	

		    $rmp= "Archivo";

		

		  				if($this->fie_inactivoftabla)

			{

						echo $rmp;

			 }

			 else

			 {

			 

			 	echo '<tr>

			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap"  >'.$rmp.'	 		 

			 '.$this->fie_txtextra.'</td>			 

			 </tr>';

			 

			 }

		

		

		}

		}

		//Fin impresión

		}

?>
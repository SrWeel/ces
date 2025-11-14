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

			
			 
			 echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-3">'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</label>';
			 echo '<div class="col-xs-7">';
			 echo '<div id="txtHint'.$nombre_campo.'" style="float:left">			 
              <input name="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >			 
              </div>
			  <div id=bt style=float:left><input name="oc'.$nombre_campo.'"  type="Button" value="Subir" onClick=subirarchiv("'.$nombre_campo.'") class='.$this->fie_styleobj.'> </div>
			  <a href="archivo/'.$this->contenid[$nombre_campo].'" target="_blank" ><img src="libreria/campos/imgtxtarchivo/descarga.jpg" width="20" height="21" border="0"></a>';
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
			 echo'<label class="control-label col-xs-3">'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</label>';
			 echo '<div class="col-xs-7">';
			 echo '<div id="txtHint'.$nombre_campo.'" style="float:left">			 
              <input name="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.@$this->sendvar["$this->fie_sendvar"].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >			 
              </div>
			  <div id=bt style=float:left><input name="oc'.$nombre_campo.'"  type="Button" value="Subir" onClick=subirarchiv("'.$nombre_campo.'") class='.$this->fie_styleobj.'> </div>
			 ';
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
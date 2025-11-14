<?php
$path_archexcel='/artrofix/excel/';
if (!($this->imprpt))

	   {

	   //No impresi�n

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

			 <div id=bt style=float:left><input name="oc'.$nombre_campo.'"  type="Button" value="Subir" onClick=subirarchiv("'.$nombre_campo.'") class='.$this->fie_styleobj.'> </div><a href="'.$this->em_pathaexcel.$this->contenid[$nombre_campo].'" target="_blank" ><img src="libreria/campos/imgtxtarchivo/descarga.jpg" width="20" height="21" border="0"></a>			 

			 '.$this->fie_txtextra.'';

			}

			else

			{

			$comilla_s="'";
			 
			 echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-3">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
			 echo '<div class="col-xs-7">';
			 
			 
			 echo '<table border="0">
				  <tr>
					<td> 
					<label class="btn btn-primary" style="background-color:#000066" >Examinar...<input name="'.$nombre_campo.'imagen" type="file" id="'.$nombre_campo.'imagen" style="display: none;" onChange="informacion_archivo('.$comilla_s.$nombre_campo.$comilla_s.')" /></label>&nbsp;<a href="javascript:subir_archivopath('.$comilla_s.$nombre_campo.$comilla_s.','.$comilla_s.$table.$comilla_s.','.$comilla_s.$path_archexcel.$comilla_s.')" class="btn btn-default">Subir Archivo</a>  
					<input name="'.$nombre_campo.'" id="'.$nombre_campo.'"   type="hidden" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" '.$this->fie_attrib.'  >	
					</td>
					<td><div class="messages'.$nombre_campo.'">&nbsp;Tama&ntildeo m&aacute;ximo 2MB (xls)</div></td>
					
				  </tr>
				</table>';
				
             echo '<div class="showImage'.$nombre_campo.'"><a href="'.@$this->em_pathaexcel.$this->contenid[$nombre_campo].'" target="_blank"><img src="libreria/campos/imgtxtarchivo/descarga.jpg" alt="125x125" width="20" height="21" ></a></div>';
			 
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
			 
			 echo '<table border="0">
				  <tr>
					<td> 
					<label class="btn btn-primary" style="background-color:#000066" >Examinar...<input name="'.$nombre_campo.'imagen" type="file" id="'.$nombre_campo.'imagen" style="display: none;" onChange="informacion_archivo('.$comilla_s.$nombre_campo.$comilla_s.')" /></label>&nbsp;<a href="javascript:subir_archivopath('.$comilla_s.$nombre_campo.$comilla_s.','.$comilla_s.$table.$comilla_s.','.$comilla_s.$path_archexcel.$comilla_s.')" class="btn btn-default">Subir Archivo</a>  
					<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'" type="hidden" class="'.$this->fie_styleobj.'"  value="'.@$this->contenid[$nombre_campo].'" '.$this->fie_attrib.'  >	
					</td>
					
					<td><div class="messages'.$nombre_campo.'">&nbsp;Tama&ntildeo m&aacute;ximo 2MB (xls)</div></td>
				
				  </tr>
				</table>';
			  echo '<div class="showImage'.$nombre_campo.'"></div>';
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

		//Fin impresi�n

		}

?>
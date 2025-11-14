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

			 <div id=bt style=float:left><input name="oc'.$nombre_campo.'"  type="Button" value="Subir" onClick=subirarchiv("'.$nombre_campo.'") class='.$this->fie_styleobj.'> </div><a href="../archivo/'.$this->contenid[$nombre_campo].'" target="_blank" ><img src="libreria/campos/imgtxtarchivo/descarga.jpg" width="20" height="21" border="0"></a>			 

			 '.$this->fie_txtextra.'';

			}

			else

			{

			$comilla_s="'";
			 
			 echo '
             <tr>

			 <td valign="top" class="'.$this->fie_style.'">'.utf8_encode($this->fie_title).'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >';
			 
			 
			 echo '<table border="0">
				  <tr>
					<td> 
					<label class="btn btn-primary" style="background-color:#000066" >Examinar...<input name="'.$nombre_campo.'imagen" type="file" id="'.$nombre_campo.'imagen" style="display: none;" onChange="informacion_archivo('.$comilla_s.$nombre_campo.$comilla_s.')" /></label>&nbsp;<a href="javascript:subir_archivo('.$comilla_s.$nombre_campo.$comilla_s.','.$comilla_s.$table.$comilla_s.','.$comilla_s.$this->fie_anchothumb.$comilla_s.','.$comilla_s.$this->fie_altothumb.$comilla_s.','.$comilla_s.$this->fie_anchoor.$comilla_s.','.$comilla_s.$this->fie_altoor.$comilla_s.')" class="btn btn-default">Subir Archivo</a>  
					<input name="'.$nombre_campo.'" id="'.$nombre_campo.'"   type="hidden" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" '.$this->fie_attrib.'  >	
					</td>
					<td><div class="messages'.$nombre_campo.'">&nbsp;Tama&ntildeo m&aacute;ximo 2MB (jpg,png,gif)</div></td>
					
				  </tr>
				</table>';
				
				
				$foto_muestrad='';
                $foto_ver='';
                $foto_muestrad=explode(".",$this->contenid[$nombre_campo]);
                $foto_ver=$foto_muestrad[0]."".".".$foto_muestrad[1];
					
				
             echo '<div class="showImage'.$nombre_campo.'"><a href="../archivo/'.$this->contenid[$nombre_campo].'" target="_blank" class="thumbnail" ><img src="../archivo/'.$foto_ver.'" alt="125x125" width="180px" ></a></div>';
			 
			echo $this->txtobligatorio.'</td>

			  <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>

			  <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;

			 echo '</td>			 

			 </tr>';

			

			

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

				

			  echo '
             <tr>

			 <td valign="top" class="'.$this->fie_style.'">'.utf8_encode($this->fie_title).'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >';
			 $comilla_s="'";
			 
			 echo '<table border="0">
				  <tr>
					<td> 
					<label class="btn btn-primary" style="background-color:#000066" >Examinar...<input name="'.$nombre_campo.'imagen" type="file" id="'.$nombre_campo.'imagen" style="display: none;" onChange="informacion_archivo('.$comilla_s.$nombre_campo.$comilla_s.')" /></label>&nbsp;<a href="javascript:subir_archivo('.$comilla_s.$nombre_campo.$comilla_s.','.$comilla_s.$table.$comilla_s.','.$comilla_s.$this->fie_anchothumb.$comilla_s.','.$comilla_s.$this->fie_altothumb.$comilla_s.','.$comilla_s.$this->fie_anchoor.$comilla_s.','.$comilla_s.$this->fie_altoor.$comilla_s.')" class="btn btn-default">Subir Archivo</a>  
					<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'" type="hidden" class="'.$this->fie_styleobj.'"  value="'.@$this->contenid[$nombre_campo].'" '.$this->fie_attrib.'  >	
					</td>
					
					<td><div class="messages'.$nombre_campo.'">&nbsp;Tama&ntildeo m&aacute;ximo 2MB (jpg,png,gif)</div></td>
				
				  </tr>
				</table>';
			  echo '<div class="showImage'.$nombre_campo.'"></div>';
			  
			echo $this->txtobligatorio.'</td>

			  <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>

			  <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;

			 echo '</td>			 

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
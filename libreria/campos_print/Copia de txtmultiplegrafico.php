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
			 
			 
			 echo '<table border="0">
				  <tr>
					<td> 
					<label class="btn btn-primary" style="background-color:#000066" >Examinar...<input name="'.$nombre_campo.'imagen" type="file" id="'.$nombre_campo.'imagen" style="display: none;" onChange="informacion_archivomult('.$comilla_s.$nombre_campo.$comilla_s.')" /></label>&nbsp;<a href="javascript:subir_archivomult('.$comilla_s.$nombre_campo.$comilla_s.','.$comilla_s.$table.$comilla_s.')" class="btn btn-default">Agregar Archivo</a>  
					<input name="'.$nombre_campo.'" id="'.$nombre_campo.'"   type="hidden" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" '.$this->fie_attrib.'  >	
					</td>
					<td><div class="messages'.$nombre_campo.'">&nbsp;Tama&ntildeo m&aacute;ximo 16MB (jpg,png,gif,pdf,doc)</div></td>
					
				  </tr>
				</table>';
				
            // echo '<div class="showImage'.$nombre_campo.'"><a href="archivo/'.$this->contenid[$nombre_campo].'" target="_blank">Vista preliminar</a></div>';
			echo '<div class="showImage'.$nombre_campo.'">';
			
			 echo '<br><div class="row">';
			 $separa_img=explode(",",$this->contenid[$nombre_campo]);
			 $comillas="'";
			 for($ic=0; $ic<count($separa_img);$ic++)
			 {
				 if(trim($separa_img[$ic]))
				 {
					 echo '<div class="col-md-3">
					    <span class="glyphicon glyphicon-remove-circle" onClick="borrar_img('.$comillas.$nombre_campo.$comillas.','.$comillas.preg_replace("/[\n|\r|\n\r]/",'',$separa_img[$ic]).$comillas.')" style="cursor:pointer" ></span>
						<a href="archivo/'.preg_replace("/[\n|\r|\n\r]/",'',$separa_img[$ic]).'" class="thumbnail" target="_blank" >
						    
							<img src="archivo/'.preg_replace("/[\n|\r|\n\r]/",'',$separa_img[$ic]).'" alt="125x125" >
						</a>
						  </div>';
				  }
			 }	  
			 echo '</div>'; 
			 
			  echo '</div>';
			  
			  
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
					<label class="btn btn-primary" style="background-color:#000066" >Examinar...<input name="'.$nombre_campo.'imagen" type="file" id="'.$nombre_campo.'imagen" style="display: none;" onChange="informacion_archivomult('.$comilla_s.$nombre_campo.$comilla_s.')" /></label>&nbsp;<a href="javascript:subir_archivomult('.$comilla_s.$nombre_campo.$comilla_s.','.$comilla_s.$table.$comilla_s.')" class="btn btn-default">Agregar Archivo</a>  
					<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'" type="hidden" class="'.$this->fie_styleobj.'"  value="'.@$this->contenid[$nombre_campo].'" '.$this->fie_attrib.'  >	
					</td>
					
					<td><div class="messages'.$nombre_campo.'">&nbsp;Tama&ntildeo m&aacute;ximo 16MB (jpg,png,gif,pdf,doc)</div></td>
				
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
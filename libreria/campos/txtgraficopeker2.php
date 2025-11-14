<?php
if (!($this->imprpt))

	   {

	   //No impresion

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

			 <div id=bt style=float:left><input name="oc'.$nombre_campo.'"  type="Button" value="Subir" onClick=subirarchiv("'.$nombre_campo.'") class='.$this->fie_styleobj.'> </div><a href="'.@$this->pathext.'archivo/'.$this->contenid[$nombre_campo].'" target="_blank" ><img src="archivo/file.png" width="20" height="21" border="0"></a>			 

			 '.$this->fie_txtextra.'';

			}

			else

			{

			$comilla_s="'";
			 
			 echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-2">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
			 echo '<div class="col-xs-9">';
			 
			 
			 echo '<table border="0">
				  <tr>
					<td> 
					<label class="btn btn-primary" style="background-color:#000066" >Examinar...<input name="'.$nombre_campo.'imagen" type="file" id="'.$nombre_campo.'imagen" style="display: none;" onChange="informacion_archivo('.$comilla_s.$nombre_campo.$comilla_s.')" /></label>&nbsp;<a href="javascript:subir_archivo('.$comilla_s.$nombre_campo.$comilla_s.','.$comilla_s.$table.$comilla_s.')" class="btn btn-default">Subir Archivo.</a>  
					<input name="'.$nombre_campo.'" id="'.$nombre_campo.'"   type="hidden" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" '.$this->fie_attrib.'  >	
					</td>
					<td><div class="messages'.$nombre_campo.'">&nbsp;Tama&ntildeo m&aacute;ximo 2MB (jpg,png,gif,pdf,doc)</div></td>
					
				  </tr>
				</table>';
			
             $seara_ext=array();
			 $seara_ext=explode(".",@$this->contenid[$nombre_campo]);
			 //print_r($seara_ext);
			 if($seara_ext[1]=='doc' or $seara_ext[1]=='pdf' or $seara_ext[1]=='PDF' or $seara_ext[1]=='xml')
			 {
             echo '<div class="showImage'.$nombre_campo.'"><a href="'.@$this->pathext.'archivo/'.$this->contenid[$nombre_campo].'" target="_blank"><img src="archivo/file.png" alt="125x125" width="50px" ></a></div>';
			 }
			 else
			 {
			 echo '<div class="showImage'.$nombre_campo.'"><a href="'.@$this->pathext.'archivo/'.$this->contenid[$nombre_campo].'" target="_blank"><img src="archivo/file.png" alt="125x125" width="50px" ></a></div>';
			 }
			 
            
			 echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
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
			 echo'<label class="control-label col-xs-2">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
			 echo '<div class="col-xs-9">';
			 $comilla_s="'";
			 
			 echo '<table border="0">
				  <tr>
					<td> 
					<label class="btn btn-primary" style="background-color:#000066" >Examinar...<input name="'.$nombre_campo.'imagen" type="file" id="'.$nombre_campo.'imagen" style="display: none;" onChange="informacion_archivo('.$comilla_s.$nombre_campo.$comilla_s.')" /></label>&nbsp;<a href="javascript:subir_archivo('.$comilla_s.$nombre_campo.$comilla_s.','.$comilla_s.$table.$comilla_s.')" class="btn btn-default">Subir Archivo.</a>  
					<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'" type="hidden" class="'.$this->fie_styleobj.'"  value="'.@$this->contenid[$nombre_campo].'" '.$this->fie_attrib.'  >	
					</td>
					
					<td><div class="messages'.$nombre_campo.'">&nbsp;Tama&ntildeo m&aacute;ximo 2MB (jpg,png,gif,pdf,doc)</div></td>
				
				  </tr>
				</table>';
			  echo '<div class="showImage'.$nombre_campo.'"></div>';
			 echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '</div>';

				

				

				}				

			

				

				}



		//Fin no impresion

		}

		else

		{

		//Impresion
		     if (!($this->fie_tactive))
					{
						$this->fie_title="";
					}
		
		     $comilla_s="'";
			 
			 echo '<div class="form-group">';
			 echo'<label class="control-label col-xs-2">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';
			 echo '<div class="col-xs-9">';	 
			 echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'"   type="hidden" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" >';
			
             $seara_ext=array();
			 $seara_ext=explode(".",@$this->contenid[$nombre_campo]);
			 //print_r($seara_ext);
			 if($this->contenid[$nombre_campo])
			 {
				 if($seara_ext[1]=='doc' or $seara_ext[1]=='pdf' or $seara_ext[1]=='PDF')
				 {
				 echo '<div class="showImage'.$nombre_campo.'"><a href="'.@$this->pathext.'archivo/'.$this->contenid[$nombre_campo].'" target="_blank"><img src="archivo/file.png" alt="125x125" width="70px" ></a></div>';
				 }
				 else
				 {
				 echo '<div class="showImage'.$nombre_campo.'"><a href="'.@$this->pathext.'archivo/'.$this->contenid[$nombre_campo].'" target="_blank"><img src="'.@$this->pathext.'archivo/'.$this->contenid[$nombre_campo].'" alt="125x125" width="180px" ></a></div>';
				 }
			 }			 
            
			 echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>';  
			 echo '</div>';



		//Fin impresion

		}

?>
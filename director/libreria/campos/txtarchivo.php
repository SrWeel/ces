<?php

 if (!($this->imprpt))
	   {
	   //No impresión
				if (!($this->fie_tactive))
				{
					$this->fie_title="";
				}
						 
				if ($this->contenid[$nombre_campo]<>"")	
				{
			
					
					if($this->fie_inactivoftabla)
			{	
			echo '<div id="txtHint'.$nombre_campo.'" style="float:left">			 
			 <input id="'.$nombre_campo.'" name="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >			 
			 </div>			 
			 <div id=bt style=float:left><input name="oc'.$nombre_campo.'"  type="Button" value="Subir..." onClick=subirarchiv("'.$nombre_campo.'") class='.$this->fie_styleobj.'> </div><a href="'.$this->em_patharchivo.$this->contenid[$nombre_campo].'" target="_blank" ><img src="libreria/campos/imgtxtarchivo/descarga.jpg" width="20" height="21" border="0"></a>			 
			 '.$this->fie_txtextra.'';
			}
			else
			{
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap"  >
			 <div id="txtHint'.$nombre_campo.'" style="float:left">			 
			 <input id="'.$nombre_campo.'" name="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >			 
			 </div>			 
			 <div id=bt style=float:left><input name="oc'.$nombre_campo.'"  type="Button" value="Subir..." onClick=subirarchiv("'.$nombre_campo.'") class='.$this->fie_styleobj.'> </div><a href="'.$this->em_patharchivo.$this->contenid[$nombre_campo].'" target="_blank" ><img src="libreria/campos/imgtxtarchivo/descarga.jpg" width="20" height="21" border="0"></a>			 
			 '.$this->fie_txtextra.'</td>			 	
			 </tr>';
			
			
			}		
					
								
				}
				else
				{
			
							if($this->fie_inactivoftabla)
			{	
						echo '<div id="txtHint'.$nombre_campo.'" style="float:left">			 
			 <input id="'.$nombre_campo.'" name="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.$this->sendvar["$this->fie_sendvar"].'" maxlength="'.$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >			 
			 </div>			 
			 <div id=bt style=float:left><input name="oc'.$nombre_campo.'"  type="Button" value="Subir..." onClick=subirarchiv("'.$nombre_campo.'") class='.$this->fie_styleobj.'> </div>';
				}
				else
				{
				echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap"  >
			 <div id="txtHint'.$nombre_campo.'" style="float:left">			 
			 <input id="'.$nombre_campo.'" name="'.$nombre_campo.'" type="text" class="'.$this->fie_styleobj.'"  value="'.@$this->sendvar[$this->fie_sendvar].'" maxlength="'.@$len.'" '.$this->fie_attrib.' size="'.$this->fie_lencampo.'" >			 
			 </div>			 
			 <div id=bt style=float:left><input name="oc'.$nombre_campo.'"  type="Button" value="Subir..." onClick=subirarchiv("'.$nombre_campo.'") class='.$this->fie_styleobj.'> </div>		 
			 '.$this->fie_txtextra.'</td>			 
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
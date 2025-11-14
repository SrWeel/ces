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
     		 echo $this->fie_title.'<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.str_replace("chr39","'",$this->fie_attrib).'   >
			 <option value="0">---Seleccionar--</option>';
			  $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->contenid[$nombre_campo],$this->fie_sqlorder,$DB_gogess);			 
			 echo '</select>';
			}
			else
			{
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >			 
			 <select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.str_replace("chr39","'",$this->fie_attrib).'   >
			 <option value="0">---Seleccionar--</option>';
			  $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->contenid[$nombre_campo],$this->fie_sqlorder,$DB_gogess);			 
			 echo '</select>'.$this->fie_txtextra.'</td>				
			 </tr>';	
			
			}					 
								 
								 
				}
				else
				{							 
					
					if($this->fie_inactivoftabla)
			{			 
			echo $this->fie_title.'<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.str_replace("chr39","'",$this->fie_attrib).'   >
			 <option value="0">---Seleccionar--</option>';
			  $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->sendvar["$this->fie_sendvar"],$this->fie_sqlorder,$DB_gogess);			 
			 echo '</select>';
				}
				else
				{
				
				echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >			 
			 <select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.str_replace("chr39","'",$this->fie_attrib).'   >
			 <option value="0">---Seleccionar--</option>';
			  $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->sendvar["$this->fie_sendvar"],$this->fie_sqlorder,$DB_gogess);			 
			 echo '</select>'.$this->fie_txtextra.'</td>				
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
			 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$rmp.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
			 </tr>';
			 
			 
			 }
	
		}
		}
		//Fin impresión
		}
?>
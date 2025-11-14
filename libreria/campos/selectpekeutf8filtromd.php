<?php

 if($this->filtro_m)
 {
  $this->fie_sqlorder=$this->filtro_m; 
 } 
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
     		 echo '<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.'>
			 <option value="">---Seleccionar--</option>';
			  $this->fill_cmbutf8($this->fie_tabledb,$this->fie_datadb,$this->contenid[$nombre_campo],$this->fie_sqlorder,$DB_gogess);			 
			 echo '</select>';
			}
			else
			{
				
			 echo '<div class="form-group">';
			 echo'<div class="col-xs-5" align="right"><b>'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'<b></div>';
			 echo '<div class="col-xs-5">';
			 echo '<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.'>';
			 echo '<option value="">---Seleccionar--</option>';
			 $this->fill_cmbutf8($this->fie_tabledb,$this->fie_datadb,trim($this->contenid[$nombre_campo]),$this->fie_sqlorder,$DB_gogess);	
			 echo '</select>';
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
				
				//echo $nombre_campo."=".$this->contenid[$nombre_campo]."<br>";
			
			
			}					 
								 
								 
				}
				else
				{							 
					
					if($this->fie_inactivoftabla)
			{			 
			echo '<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.'>
			 <option value="">---Seleccionar--</option>';
			  $this->fill_cmbutf8($this->fie_tabledb,$this->fie_datadb,$this->sendvar["$this->fie_sendvar"],$this->fie_sqlorder,$DB_gogess);			 
			 echo '</select>';
				}
				else
				{
				
				
			 echo '<div class="form-group">';
			 echo'<div class="col-xs-5" align="right"><b>'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</b></div>';
			 echo '<div class="col-xs-5">';
			 echo '<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.'>';
			 echo '<option value="">---Seleccionar--</option>';
			 $this->fill_cmbutf8($this->fie_tabledb,$this->fie_datadb,@$this->sendvar[$this->fie_sendvar],$this->fie_sqlorder,$DB_gogess);
			 echo '</select>';
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
		
				if (!($this->fie_tactive))
				{
					$this->fie_title="";
				}
				
			    $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$this->contenid[$nombre_campo],$DB_gogess);
		  
				if($this->fie_inactivoftabla)
				{	
				echo $rmp;
				 }
				 else
				 {	 
					 echo '<div class="form-group">';
					 echo'<div class="col-xs-5" align="right" ><b>'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</b></div>';
					 echo '<div class="col-xs-5">';
					 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">';	
					 echo $rmp;
					 echo '</div>';
					 echo '<div class="col-xs-1">';
					 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
					 echo '</div>'; 
					 echo '<div class="col-xs-1">';
					 echo $this->fie_txtextra;
					 echo '</div>';  
					 echo '</div>'; 
				 }
	
		
		//Fin impresión
		}
?>
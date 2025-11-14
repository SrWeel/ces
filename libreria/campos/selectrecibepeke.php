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
								  echo '<div id=div'.$nombre_campo.'>		 
								 <select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.' '.$clicdata.' >
								 <option value="">---Seleccionar--</option>';
								  if($this->fie_evitaambiguo)
								  {
								   $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->contenid[$nombre_campo]," where ".$this->fie_evitaambiguo.".".$this->fie_camporecibe."=".$this->contenid[$this->fie_camporecibe]." ".$this->fie_sqlorder,$DB_gogess);
								 }
								 else
								 {
								    $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->contenid[$nombre_campo]," where ".$this->fie_camporecibe."=".$this->contenid[$this->fie_camporecibe]." ".$this->fie_sqlorder,$DB_gogess);								 
								 }								 	 
								 echo '</select>'.$this->fie_txtextra.'</div>';	
							}
							else
							{
							 
							 echo '<div class="form-group">';
							 echo'<div class="col-xs-5" align="right"><b>'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</b></div>';
							 echo '<div class="col-xs-5">';
							 echo '<div id=div'.$nombre_campo.'>';	
							 echo '<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.' '.$clicdata.' >';
							 echo '<option value="">---Seleccionar--</option>';
							 if($this->fie_evitaambiguo)
								  {
								   $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->contenid[$nombre_campo]," where ".$this->fie_evitaambiguo.".".$this->fie_camporecibe."=".$this->contenid[$this->fie_camporecibe]." ".$this->fie_sqlorder,$DB_gogess);
								 }
								 else
								 {
								    $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->contenid[$nombre_campo]," where ".$this->fie_camporecibe."=".$this->contenid[$this->fie_camporecibe]." ".$this->fie_sqlorder,$DB_gogess);								 
								 }	
							 echo '</select>';
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
								 echo '<div id=div'.$nombre_campo.'>		 
								 <select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.' '.$clicdata.' >
								 <option value="">---Seleccionar--</option>';
								 	 $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->sendvar["$this->fie_sendvar"]," where ".$this->fie_camporecibe."=".$this->contenid[$this->fie_camporecibe]." ".$this->fie_sqlorder,$DB_gogess);							 	 
								 echo '</select>'.$this->fie_txtextra.'</div>';	
							}
							else
							{
							    
							 echo '<div class="form-group">';
							 echo'<div class="col-xs-5" align="right"><b>'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</b></div>';
							 echo '<div class="col-xs-5">';
							 echo '<div id=div'.$nombre_campo.'>';	
							 echo '<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.' '.$clicdata.' >';
							 echo '<option value="">---Seleccionar--</option>';
							  $this->fill_cmb(@$this->fie_tabledb,@$this->fie_datadb,@$this->sendvar["$this->fie_sendvar"]," where ".@$this->fie_camporecibe."=".@$this->sendvar[$this->fie_camporecibe."x"]." ".@$this->fie_sqlorder,$DB_gogess);	
							 echo '</select>';
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

		//Fin no impresión
		}
		else
		{
		//Impresion
		
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
							 echo'<div class="col-xs-6" align="right" ><b>'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</b></div>';
							 echo '<div class="col-xs-6">';
							 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">';
							 
							 $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$this->contenid[$nombre_campo],$DB_gogess);
							 
							 echo $rmp;
							 
							 echo '</div>';
							 
							 echo '</div>';
 
								 
								 				
							}	
		
		
		 
		//Fin impresion
		}
?>
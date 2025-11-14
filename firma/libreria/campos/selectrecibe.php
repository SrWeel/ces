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
							     echo '<tr>
								 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
								 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
								 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >	
								 <div id=div'.$nombre_campo.'>		 
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
								 echo '</select>'.$this->txtobligatorio.'</div></td>			 
			 <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>			 
			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;			 
			 //campos concatenados
			 $buscaconcatenacion="select * from  sibase_sisfieldconcatena where fie_id=".$this->fie_id;
			 $rs_buscacampoc = $DB_gogess->Execute($buscaconcatenacion);
			 if($rs_buscacampoc)
			 {
			    while (!$rs_buscacampoc->EOF) 
				{
				   
				    $this->generar_formulario_campossolos($rs_buscacampoc->fields["tab_name"],$rs_buscacampoc->fields["fieenlace_id"],$DB_gogess);
				   $rs_buscacampoc->MoveNext();
				}
			 }
			 //campos concatenados
			 
			 echo '</td>				
								 </tr>';
							
							
							
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
							    echo '<tr>
								 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
								 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
								 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >	
								 <div id=div'.$nombre_campo.'>		 
								 <select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.' '.$clicdata.' >
								 <option value="">---Seleccionar--</option>';
								 	 $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->sendvar["$this->fie_sendvar"]," where ".$this->fie_camporecibe."=".$this->contenid[$this->fie_camporecibe]." ".$this->fie_sqlorder,$DB_gogess);							 	 
								 echo '</select>'.$this->txtobligatorio.'</div></td>			 
			 <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>			 
			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;			 
			 //campos concatenados
			 $buscaconcatenacion="select * from  sibase_sisfieldconcatena where fie_id=".$this->fie_id;
			 $rs_buscacampoc = $DB_gogess->Execute($buscaconcatenacion);
			 if($rs_buscacampoc)
			 {
			    while (!$rs_buscacampoc->EOF) 
				{
				   
				    $this->generar_formulario_campossolos($rs_buscacampoc->fields["tab_name"],$rs_buscacampoc->fields["fieenlace_id"],$DB_gogess);
				   $rs_buscacampoc->MoveNext();
				}
			 }
			 //campos concatenados
			 
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
								 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >'.$rmp.' '.$this->fie_txtextra.'</td>				
								 </tr>';
					    
					 
					 }
		}
		}
		//Fin impresión
		}
?>
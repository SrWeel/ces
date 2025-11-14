<?php

$funcionbuscar="pop_up_pantalla('libreria/extra/buscardor.php','Buscar',0,0,0,0,0,0,0)";
$boton_buscar='<input type="button" name="Submit" value="..."  onclick="'.$funcionbuscar.'" />';
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
     		 echo '<select name="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.'>
			 <option value="">---Seleccionar--</option>';
			  $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->contenid[$nombre_campo],$this->fie_sqlorder,$DB_gogess);			 
			 echo '</select>';
			}
			else
			{
			echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >			 
			 <select name="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.'>
			 <option value="">---Seleccionar--</option>';
			  $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->contenid[$nombre_campo],$this->fie_sqlorder,$DB_gogess);			 
			 echo '</select>'.$this->txtobligatorio.$boton_buscar.'</td>			 
			 <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>			 
			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;			 
			 //campos concatenados
			 $buscaconcatenacion="select * from  gogess_sisfieldconcatena where fie_id=".$this->fie_id;
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
			echo '<select name="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.'>
			 <option value="">---Seleccionar--</option>';
			  $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->sendvar["$this->fie_sendvar"],$this->fie_sqlorder,$DB_gogess);			 
			 echo '</select>';
				}
				else
				{
				
				echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" nowrap="nowrap" >			 
			 <select name="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.'>
			 <option value="">---Seleccionar--</option>';
			  $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->sendvar["$this->fie_sendvar"],$this->fie_sqlorder,$DB_gogess);			 
			 echo '</select>'.$this->txtobligatorio.$boton_buscar.'</td>			 
			 <td><div  id="'.$nombre_campo."_despliegue".'" ></div></td>			 
			 <td class="'.$this->fie_style.'" >'.$this->fie_txtextra;			 
			 //campos concatenados
			 $buscaconcatenacion="select * from  gogess_sisfieldconcatena where fie_id=".$this->fie_id;
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
			 <td valign="top" class="'.$this->fie_style.'" >'.$rmp.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtextra.'</td>	
			 </tr>';
			 
			 
			 }
	
		}
		}
		//Fin impresión
		}
?>
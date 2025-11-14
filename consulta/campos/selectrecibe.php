<?php

 if (!(@$objgridtablareporte->imprpt))
	   {
	   //No impresión
		
				 
				if (@$_POST[$nombre_campo]<>"")	
				{						 
								 
								if(@$objgridtablareporte->fie_inactivoftabla)
							{
								  echo '<div id=div'.$nombre_campo.'>		 
								 <select name="'.$nombre_campo.'" class="'.$objgridtablareporte->fie_styleobj.'" '.$objgridtablareporte->fie_attrib.' '.$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								  if($objgridtablareporte->fie_evitaambiguo)
								  {
								   $objgridtablareporte->fill_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,$_POST[$nombre_campo]," where ".$objgridtablareporte->fie_evitaambiguo.".".$objgridtablareporte->campo_camporecibe."=".$_POST[$objgridtablareporte->campo_camporecibe]." ".$objgridtablareporte->campo_cmbsqlorder,$conn);
								 }
								 else
								 {
								    $objgridtablareporte->fill_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,$_POST[$nombre_campo]," where ".$objgridtablareporte->campo_camporecibe."=".$_POST[$objgridtablareporte->campo_camporecibe]." ".$objgridtablareporte->campo_cmbsqlorder,$conn);								 
								 }								 	 
								 echo '</select>'.$objgridtablareporte->fie_txtextra.'</div>';	
							}
							else
							{
							     echo '<tr>
								 <td valign="top" class="'.@$objgridtablareporte->fie_style.'">'.@$objgridtablareporte->campo_titulo.'</td>
								 <td valign="top" class="'.@$objgridtablareporte->fie_style.'" >'.@$objgridtablareporte->fie_txtizq.'</td>
								 <td valign="top" class="'.@$objgridtablareporte->fie_style.'" nowrap="nowrap" >	
								 <div id=div'.$nombre_campo.'>		 
								 <select name="'.@$nombre_campo.'" id="'.@$nombre_campo.'" class="'.@$objgridtablareporte->fie_styleobj.'" '.@$objgridtablareporte->fie_attrib.' '.@$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								  if($objgridtablareporte->fie_evitaambiguo)
								  {
								   $objgridtablareporte->fill_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,$_POST[$nombre_campo]," where ".$objgridtablareporte->fie_evitaambiguo.".".$objgridtablareporte->campo_camporecibe."=".$_POST[$objgridtablareporte->campo_camporecibe]." ".$objgridtablareporte->campo_cmbsqlorder,$conn);
								 }
								 else
								 {
								    $objgridtablareporte->fill_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,$_POST[$nombre_campo]," where ".$objgridtablareporte->campo_camporecibe."=".$_POST[$objgridtablareporte->campo_camporecibe]." ".$objgridtablareporte->campo_cmbsqlorder,$conn);								 
								 }								 	 
								 echo '</select>'.$objgridtablareporte->fie_txtextra.'</div></td>				
								 </tr>';
							
							
							
							}	 
								 
				}
				else
				{
											 
									if(@$objgridtablareporte->fie_inactivoftabla)
							{ 
								 echo '<div id=div'.$nombre_campo.'>		 
								 <select name="'.$nombre_campo.'" class="'.$objgridtablareporte->fie_styleobj.'" '.$objgridtablareporte->fie_attrib.' '.$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								 	 $objgridtablareporte->fill_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,$objgridtablareporte->sendvar["$objgridtablareporte->fie_sendvar"]," where ".$objgridtablareporte->campo_camporecibe."=".$_POST[$objgridtablareporte->campo_camporecibe]." ".$objgridtablareporte->campo_cmbsqlorder,$conn);							 	 
								 echo '</select>'.$objgridtablareporte->fie_txtextra.'</div>';	
							}
							else
							{
							    echo '<tr>
								 <td valign="top" class="'.@$objgridtablareporte->fie_style.'">'.@$objgridtablareporte->campo_titulo.'</td>
								 <td valign="top" class="'.@$objgridtablareporte->fie_style.'" >'.@$objgridtablareporte->fie_txtizq.'</td>
								 <td valign="top" class="'.@$objgridtablareporte->fie_style.'" nowrap="nowrap" >	
								 <div id=div'.$nombre_campo.'>		 
								 <select name="'.@$nombre_campo.'" id="'.@$nombre_campo.'" class="'.@$objgridtablareporte->fie_styleobj.'" '.@$objgridtablareporte->fie_attrib.' '.@$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								 	 @$objgridtablareporte->fill_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,@$objgridtablareporte->sendvar[$objgridtablareporte->fie_sendvar]," where ".$objgridtablareporte->campo_camporecibe."=".@$_POST[$objgridtablareporte->campo_camporecibe]." ".@$objgridtablareporte->campo_cmbsqlorder,$conn);							 	 
								 echo '</select>'.@$objgridtablareporte->fie_txtextra.'</div></td>				
								 </tr>';
							
							}	 
								 
				
				
				}

		//Fin no impresión
		}
		else
		{
		//Impresión
		 if ($objgridtablareporte->fie_activarprt)
		 {
		if (!($objgridtablareporte->fie_tactive))
        {
			$objgridtablareporte->campo_titulo="";
		}
				
		if ($_POST[$nombre_campo]<>'')
		{	                
		$rmp= $objgridtablareporte->replace_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,$objgridtablareporte->campo_cmbsql,$_POST[$nombre_campo],$conn);
		
		if($objgridtablareporte->fie_inactivoftabla)
							{ 
		                        echo $rmp;
	
		             }
					 else
					 {
					    echo '<tr>
								 <td valign="top" class="'.$objgridtablareporte->fie_style.'">'.$objgridtablareporte->campo_titulo.'</td>
								 <td valign="top" class="'.$objgridtablareporte->fie_style.'" >'.$objgridtablareporte->fie_txtizq.'</td>
								 <td valign="top" class="'.$objgridtablareporte->fie_style.'" nowrap="nowrap" >'.$rmp.' '.$objgridtablareporte->fie_txtextra.'</td>				
								 </tr>';
					    
					 
					 }
		}
		}
		//Fin impresión
		}
?>
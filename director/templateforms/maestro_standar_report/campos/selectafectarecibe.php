<?php
 if (!($objformulario->imprpt))
	   {
	   //No impresión
		if (!($objformulario->fie_tactive))
        {
			$objformulario->fie_title="";
		}
		  if($objformulario->fie_evitaambiguo)
		  {
				 $clicdata="onClick=showUser_combog('".$objformulario->fie_campoafecta."',window.document.fa.".$nombre_campo.".value,'div".$objformulario->fie_campoafecta."','".$objformulario->fie_evitaambiguo.".".$nombre_campo."','".$objformulario->tab_name."','".$_POST[$objformulario->fie_campoafecta]."',0,0,0,0,0) ";
			}
			else
			{
			
			   $clicdata="onClick=showUser_combog('".$objformulario->fie_campoafecta."',window.document.fa.".$nombre_campo.".value,'div".$objformulario->fie_campoafecta."','".$nombre_campo."','".$objformulario->tab_name."','".$_POST[$objformulario->fie_campoafecta]."',0,0,0,0,0) ";
			}	 
				if ($_POST[$nombre_campo]<>"")	
				{
												 
									if($objformulario->fie_inactivoftabla)
							{
								  echo '<div id=div'.$nombre_campo.'>			 
								 <select name="'.$nombre_campo.'" class="'.$objformulario->fie_styleobj.'" '.$objformulario->fie_attrib.' '.$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								 $objformulario->fill_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$_POST[$nombre_campo]," where ".$objformulario->fie_camporecibe."=".$_POST[$objformulario->fie_camporecibe]." ".$objformulario->fie_sqlorder,$DB_gogess); 
								 echo '</select>'.$objformulario->fie_txtextra.'</div>';	
							}
							else
							{
							
							    echo '<tr>
								 <td valign="top" class="'.$objformulario->fie_style.'">'.$objformulario->fie_title.'</td>
								 <td valign="top" class="'.$objformulario->fie_style.'" >'.$objformulario->fie_txtizq.'</td>
								 <td valign="top" class="'.$objformulario->fie_style.'" nowrap="nowrap" >
								 <div id=div'.$nombre_campo.'>			 
								 <select name="'.$nombre_campo.'" class="'.$objformulario->fie_styleobj.'" '.$objformulario->fie_attrib.' '.$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								 $objformulario->fill_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$_POST[$nombre_campo]," where ".$objformulario->fie_camporecibe."=".$_POST[$objformulario->fie_camporecibe]." ".$objformulario->fie_sqlorder,$DB_gogess); 
								 echo '</select>'.$objformulario->fie_txtextra.'</div></td>				
								 </tr>';	
							
							}	 
								 
								 
				}
				else
				{	 
										if($objformulario->fie_inactivoftabla)
							{ 
								  echo '<div id=div'.$nombre_campo.'>			 
								 <select name="'.$nombre_campo.'" class="'.$objformulario->fie_styleobj.'" '.$objformulario->fie_attrib.' '.$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								 $objformulario->fill_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->sendvar["$objformulario->fie_sendvar"]," where ".$objformulario->fie_camporecibe."=".$_POST[$objformulario->fie_camporecibe]." ".$objformulario->fie_sqlorder,$DB_gogess); 
								 echo '</select>'.$objformulario->fie_txtextra.'</div>';
							}
							else
							{
							    echo '<tr>
								 <td valign="top" class="'.$objformulario->fie_style.'">'.$objformulario->fie_title.'</td>
								 <td valign="top" class="'.$objformulario->fie_style.'" >'.$objformulario->fie_txtizq.'</td>
								 <td valign="top" class="'.$objformulario->fie_style.'" nowrap="nowrap" >
								 <div id=div'.$nombre_campo.'>			 
								 <select name="'.$nombre_campo.'" class="'.$objformulario->fie_styleobj.'" '.$objformulario->fie_attrib.' '.$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								 $objformulario->fill_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->sendvar["$objformulario->fie_sendvar"]," where ".$objformulario->fie_camporecibe."=".$_POST[$objformulario->fie_camporecibe]." ".$objformulario->fie_sqlorder,$DB_gogess); 
								 echo '</select>'.$objformulario->fie_txtextra.'</div></td>				
								 </tr>';
							
							}	 
								 		
				
				}

		//Fin no impresión
		}
		else
		{
		//Impresión
		 if ($objformulario->fie_activarprt)
		 {
		if (!($objformulario->fie_tactive))
        {
			$objformulario->fie_title="";
		}
				
		if ($_POST[$nombre_campo]<>'')
		{	                
		$rmp= $objformulario->replace_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->fie_sql,$_POST[$nombre_campo],$DB_gogess);
		
		    		if($objformulario->fie_inactivoftabla)
							{ 
								 echo $rmp;
							}
							else
							{
							     echo '<tr>
								 <td valign="top" class="'.$objformulario->fie_style.'">'.$objformulario->fie_title.'</td>
								 <td valign="top" class="'.$objformulario->fie_style.'" >'.$objformulario->fie_txtizq.'</td>
								 <td valign="top" class="'.$objformulario->fie_style.'" nowrap="nowrap" >'.$rmp.''.$objformulario->fie_txtextra.'</div></td>				
								 </tr>';
							
							
							}	 

		}
		}
		//Fin impresión
		}
?>
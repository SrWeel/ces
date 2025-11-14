<?php
$clicdatax='';
 if (!($objformulario->imprpt))
	   {
	   //No impresión
		if (!($objformulario->fie_tactive))
        {
			$objformulario->fie_title="";
		}
				 
				if ($objformulario->fie_evitaambiguo)
				{
				
				//////////////////////////////////////////////////////////
				$listadecampos=split(",",$objformulario->fie_campoafecta);
				for ($cmbi=0;$cmbi<count($listadecampos);$cmbi++)
				{
				 $clicdatax=$clicdatax."showUser_combog('".$listadecampos[$cmbi]."',window.document.fa.".$nombre_campo.".value,'div".$listadecampos[$cmbi]."','".$objformulario->fie_evitaambiguo.".".$nombre_campo."','".$objformulario->tab_name."','".$_POST[$listadecampos[$cmbi]]."',0,0,0,0,0); ";
				 }
				 ////////////////////////////////////////////////////////////
				 
				 
				 
				 }
				 else
				 {
				 
				 $listadecampos=split(",",$objformulario->fie_campoafecta);
				 for ($cmbi=0;$cmbi<count($listadecampos);$cmbi++)
				 {
				 $clicdatax=$clicdatax."showUser_combog('".$listadecampos[$cmbi]."',window.document.fa.".$nombre_campo.".value,'div".$listadecampos[$cmbi]."','".$nombre_campo."','".$objformulario->tab_name."','".$_POST[$listadecampos[$cmbi]]."',0,0,0,0,0); ";
				 }
				 
				 
				 }
				 
				$clicdata='onClick="'.$clicdatax.'"';
				 
				 
				if ($_POST[$nombre_campo]<>"")	
				{
							
							if($objformulario->fie_inactivoftabla)
							{
							 echo '<select name="'.$nombre_campo.'" class="'.$objformulario->fie_styleobj.'" '.$objformulario->fie_attrib.' '.$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								  $objformulario->fill_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$_POST[$nombre_campo],$objformulario->fie_sqlorder,$DB_gogess);	 
								 echo '</select>';
							}
							else
							{
							 echo '<tr>
								 <td valign="top" class="'.$objformulario->fie_style.'">'.$objformulario->fie_title.'</td>
								 <td valign="top" class="'.$objformulario->fie_style.'" >'.$objformulario->fie_txtizq.'</td>
								 <td valign="top" class="'.$objformulario->fie_style.'" nowrap="nowrap" >			 
								 <select name="'.$nombre_campo.'" class="'.$objformulario->fie_styleobj.'" '.$objformulario->fie_attrib.' '.$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								  $objformulario->fill_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$_POST[$nombre_campo],$objformulario->fie_sqlorder,$DB_gogess);	 
								 echo '</select>'.$objformulario->fie_txtextra.'</td>				
								 </tr>';						
							}	 
								 
				}
				else
				{
				
							if($objformulario->fie_inactivoftabla)
							{
							 echo '<select name="'.$nombre_campo.'" class="'.$objformulario->fie_styleobj.'" '.$objformulario->fie_attrib.' '.$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								$objformulario->fill_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->sendvar["$objformulario->fie_sendvar"],$objformulario->fie_sqlorder,$DB_gogess);		 
								 echo '</select>';				
							}
							else
							{
								echo '<tr>
								 <td valign="top" class="'.$objformulario->fie_style.'">'.$objformulario->fie_title.'</td>
								 <td valign="top" class="'.$objformulario->fie_style.'" >'.$objformulario->fie_txtizq.'</td>
								 <td valign="top" class="'.$objformulario->fie_style.'" nowrap="nowrap" >			 
								 <select name="'.$nombre_campo.'" class="'.$objformulario->fie_styleobj.'" '.$objformulario->fie_attrib.' '.$clicdata.' >
								 <option value="-1">---Seleccionar--</option>';
								$objformulario->fill_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->sendvar["$objformulario->fie_sendvar"],$objformulario->fie_sqlorder,$DB_gogess);		 
								 echo '</select>'.$objformulario->fie_txtextra.'</td>				
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
			 <td valign="top" class="'.$objformulario->fie_style.'" nowrap="nowrap" >'.$rmp.' '.$objformulario->fie_txtextra.'</td>				
			 </tr>';
			
			}
		
		}
		}
		//Fin impresión
		}
		
		$clicdata='';
?>